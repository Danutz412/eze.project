<?php
namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeCheckoutController extends Controller
{
    public function subscribe(Request $request, Plan $plan)
    {
        $request->validate(['period' => ['required','in:monthly,yearly']]);

        $priceId = $request->period === 'yearly'
            ? $plan->stripe_price_id_yearly
            : $plan->stripe_price_id_monthly;

        abort_if(!$priceId, 422, 'Stripe price ID missing.');

        $stripe = new StripeClient(config('services.stripe.secret'));

        $session = $stripe->checkout->sessions->create([
            'mode' => 'subscription',
            'customer_email' => auth()->user()->email,
            'line_items' => [['price' => $priceId, 'quantity' => 1]],
            'success_url' => route('customer.dashboard') . '?payment=success',
            'cancel_url' => route('pricing') . '?payment=cancelled',
            'metadata' => [
                'user_id' => auth()->id(),
                'plan_id' => $plan->id,
                'period' => $request->period,
            ],
        ]);

        return redirect($session->url);
    }
}
