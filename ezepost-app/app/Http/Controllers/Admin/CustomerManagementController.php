<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Invoice;
use App\Services\ControllingStringService;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
{
    public function index()
    {
        $customers = User::with('ezepostUser')->latest()->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $user)
    {
        $user->load(['invoices', 'teams']);
        return view('admin.customers.show', compact('user'));
    }

    public function block(User $user, Request $request, ControllingStringService $stringService)
    {
        if ($user->ezepostUser) {
            $user->ezepostUser->update([
                'status' => 'locked',
                'controlstring' => $stringService->lock($user->ezepostUser->controlstring),
            ]);
        }

        return back()->with('success', 'Customer blocked successfully. They cannot transfer files until unblocked.');
    }

    public function unblock(User $user, ControllingStringService $stringService)
    {
        if ($user->ezepostUser) {
            $user->ezepostUser->update([
                'status' => 'active',
                'controlstring' => $stringService->unlock($user->ezepostUser->controlstring),
            ]);
        }

        return back()->with('success', 'Customer unblocked successfully. They can now transfer files.');
    }

    public function createInvoice(User $user, Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|in:GBP,USD,EUR',
        ]);

        $invoice = Invoice::create([
            'user_id' => $user->id,
            'invoice_no' => Invoice::generateInvoiceNumber(),
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'payment_status' => 'pending',
            'stripe_invoice_id' => null,
            'issued_at' => now(),
        ]);

        return back()->with('success', 'Invoice created successfully.');
    }
}
