<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\TransferController;
use App\Http\Controllers\Customer\TeamController;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\SubscriptionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CustomerManagementController;

Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/pricing', [PublicPageController::class, 'pricing'])->name('pricing');
Route::get('/download', [PublicPageController::class, 'download'])->name('download');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');
Route::get('/register-info', function() {
    return view('auth.register-info');
})->name('register.info');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', CustomerDashboardController::class)->name('customer.dashboard');
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/customer/profile', [ProfileController::class, 'edit'])->name('customer.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Teams - specific routes before resource
    Route::get('/teams/settings', [TeamController::class, 'settings'])->name('customer.teams.settings');
    Route::post('/teams/invite', [TeamController::class, 'invite'])->name('customer.teams.invite');
    Route::get('/teams/invitations/{token}/accept', [TeamController::class, 'acceptInvitation'])->name('customer.teams.accept-invitation');
    Route::delete('/teams/invitations/{invitation}', [TeamController::class, 'cancelInvitation'])->name('customer.teams.cancel-invitation');
    Route::delete('/team-members/{member}', [TeamController::class, 'removeMember'])->name('customer.teams.remove-member');
    Route::patch('/teams/update-settings', [TeamController::class, 'update'])->name('customer.teams.update-settings');
    
    Route::resource('teams', TeamController::class)->names([
        'index' => 'customer.teams.index',
        'create' => 'customer.teams.create',
        'store' => 'customer.teams.store',
        'show' => 'customer.teams.show',
        'edit' => 'customer.teams.edit',
        'update' => 'customer.teams.update',
        'destroy' => 'customer.teams.destroy',
    ]);
    
    // Transfers - Send (protected by account status check)
    Route::get('/transfers/create', [TransferController::class, 'create'])->name('customer.transfers.create');
    Route::post('/transfers', [TransferController::class, 'store'])->name('customer.transfers.store');
    
    // Transfers - Today
    Route::get('/transfers/received-today', [TransferController::class, 'receivedToday'])->name('customer.transfers.received-today');
    Route::get('/transfers/viewed-today', [TransferController::class, 'viewedToday'])->name('customer.transfers.viewed-today');
    Route::get('/transfers/sent-today', [TransferController::class, 'sentToday'])->name('customer.transfers.sent-today');
    
    // Transfers - History
    Route::get('/transfers/received', [TransferController::class, 'received'])->name('customer.transfers.received');
    Route::get('/transfers/viewed', [TransferController::class, 'viewed'])->name('customer.transfers.viewed');
    Route::get('/transfers/sent', [TransferController::class, 'sent'])->name('customer.transfers.sent');
    Route::get('/transfers/download/{id}', [TransferController::class, 'download'])->name('customer.transfers.download');
    Route::delete('/transfers/{id}', [TransferController::class, 'destroy'])->name('customer.transfers.destroy');

    // Invoices
    Route::resource('invoices', InvoiceController::class)->names([
        'index' => 'customer.invoices.index',
        'create' => 'customer.invoices.create',
        'store' => 'customer.invoices.store',
        'show' => 'customer.invoices.show',
        'destroy' => 'customer.invoices.destroy',
    ]);
    Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('customer.invoices.download');
    
    // Subscription
    Route::get('/subscription', [SubscriptionController::class, 'show'])->name('customer.subscription');
    Route::get('/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('customer.subscription.checkout');
    Route::post('/subscription/process', [SubscriptionController::class, 'process'])->name('customer.subscription.process');
    Route::get('/portal', [App\Http\Controllers\Customer\SubscriptionController::class, 'portal'])->name('customer.portal');
    
    Route::get('/transfers/{transfer}/proof-of-delivery', function(\App\Models\EzepostTracking $transfer) {
        return view('customer.transfers.proof-of-delivery', compact('transfer'));
    })->name('customer.transfers.proof-of-delivery');
    Route::get('/transfers/{transfer}/generate-pdf', [\App\Http\Controllers\Customer\TransferController::class, 'generatePdf'])->name('customer.transfers.generate-pdf');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', function() { return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::get('/customers', [CustomerManagementController::class, 'index'])->name('customers.index');
    Route::get('/customers/{user}', [CustomerManagementController::class, 'show'])->name('customers.show');
    Route::post('/customers/{user}/block', [CustomerManagementController::class, 'block'])->name('customers.block');
    Route::post('/customers/{user}/unblock', [CustomerManagementController::class, 'unblock'])->name('customers.unblock');
    Route::post('/customers/{user}/invoice', [CustomerManagementController::class, 'createInvoice'])->name('customers.create-invoice');
    
    Route::get('/transfers', function() { return view('admin.transfers.index', ['transfers' => \App\Models\EzepostTracking::with(['senderUser', 'receiverUser'])->latest()->paginate(20)]); })->name('transfers.index');
    Route::get('/transfers/create', function() { return view('admin.transfers.create'); })->name('transfers.create');
    Route::post('/transfers/send', [\App\Http\Controllers\Admin\TransferController::class, 'send'])->name('transfers.send');
    Route::post('/transfers/{transfer}/download', [\App\Http\Controllers\Admin\TransferController::class, 'download'])->name('transfers.download');
    
    Route::get('/plans', function() { return view('admin.plans.index', ['plans' => \App\Models\Plan::all()]); })->name('plans.index');
    
    Route::get('/invoices', function() { return view('admin.invoices.index', ['invoices' => \App\Models\Invoice::with('user')->latest()->paginate(20)]); })->name('invoices.index');
    Route::get('/invoices/{invoice}/download', [\App\Http\Controllers\Admin\InvoiceController::class, 'download'])->name('invoices.download');
    Route::get('/invoices/{invoice}/pdf', [\App\Http\Controllers\Admin\InvoiceController::class, 'generatePdf'])->name('invoices.pdf');
    
    Route::get('/teams', [\App\Http\Controllers\Admin\TeamManagementController::class, 'index'])->name('teams.index');
    Route::get('/teams/{team}', [\App\Http\Controllers\Admin\TeamManagementController::class, 'show'])->name('teams.show');
    Route::post('/teams/{team}/adjust-licenses', [\App\Http\Controllers\Admin\TeamManagementController::class, 'adjustLicenses'])->name('teams.adjust-licenses');
});

require __DIR__.'/auth.php';
