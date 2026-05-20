<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Team;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function checkout(Request $request)
    {
        $planId = $request->query('plan');
        $period = $request->query('period', 'monthly'); // Default to monthly

        if (!$planId) {
            return redirect()->route('pricing')->with('error', 'Please select a plan.');
        }

        $plan = Plan::findOrFail($planId);

        // Determine price based on period
        $price = $period === 'yearly' ? $plan->price_yearly : $plan->price_monthly;

        return view('customer.subscription.checkout', compact('plan', 'period', 'price'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'payment_method' => 'required|string',
            'period' => 'required|in:monthly,yearly',
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);
        $period = $validated['period'];

        // Determine price based on period
        $price = $period === 'yearly' ? $plan->price_yearly : $plan->price_monthly;

        // Create invoice
        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'invoice_no' => Invoice::generateInvoiceNumber(),
            'amount' => $price,
            'currency' => $plan->currency ?? 'GBP',
            'payment_status' => 'paid', // For demo purposes, mark as paid
            'stripe_invoice_id' => 'in_' . uniqid(),
            'issued_at' => now(),
        ]);

        // Update user's controlling string to reflect active subscription
        $user = auth()->user();
        
        // Ensure user has an ezepost_user record
        $ezepostUser = $user->ezepostUser;
        if (!$ezepostUser) {
            // Generate proper controlling string using the service
            $controllingStringService = app(\App\Services\ControllingStringService::class);
            $controlstring = $controllingStringService->generateFromPlan($plan, $period);
            
            $ezepostUser = \App\Models\EzepostUser::create([
                'user_id' => $user->id,
                'username' => strtolower(str_replace(' ', '', $user->name)),
                'vepost_addr' => strtolower(str_replace(' ', '', $user->name)) . '@example.com#ezepost',
                'password' => $user->password ?? \Illuminate\Support\Facades\Hash::make('default_password'),
                'controlstring' => $controlstring,
                'status' => 'active',
                'user_group' => $plan->user_group_code ?? 0,
            ]);
        }

        // Update controlling string with new plan
        $controllingStringService = app(\App\Services\ControllingStringService::class);
        $currentControlString = $ezepostUser->controlstring ?? str_pad('10000', 20, '0');
        
        // Update plan code in controlling string (index 2)
        $newControlString = $controllingStringService->updatePlan(
            $currentControlString,
            $plan->id,
            $plan->team_size_code ?? 0,
            $plan->package_size_code ?? 0
        );

        $ezepostUser->update([
            'controlstring' => $newControlString,
            'user_group' => $plan->user_group_code ?? 0,
        ]);

        return redirect()->route('customer.invoices.show', $invoice)
            ->with('success', 'Subscription completed successfully!');
    }

    public function portal()
    {
        // For demo purposes, return a message about Stripe integration
        return view('customer.subscription.portal');
    }

    public function show()
    {
        $user = auth()->user();
        $activeInvoice = $user->invoices()->where('payment_status', 'paid')->latest()->first();
        $team = $user->teams()->where('is_personal', true)->first();

        return view('customer.subscription.show', compact('activeInvoice', 'team'));
    }
}
