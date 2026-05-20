@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Subscription Checkout</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-700">Plan</span>
                    <span class="font-semibold text-gray-900">{{ $plan->name }}</span>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-700">Price</span>
                    <span class="font-semibold text-gray-900">£{{ number_format($price, 2) }}</span>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-700">Billing Period</span>
                    <span class="font-semibold text-gray-900">{{ ucfirst($period) }}</span>
                </div>

                <div class="border-t border-gray-300 pt-4 mt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-gray-900">£{{ number_format($price, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h2>
                
                <form action="{{ route('customer.subscription.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <input type="hidden" name="period" value="{{ $period }}">

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                        <input type="text" name="card_number" placeholder="4242 4242 4242 4242"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            value="4242 4242 4242 4242">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                            <input type="text" name="expiry" placeholder="MM/YY"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                value="12/25">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CVC</label>
                            <input type="text" name="cvc" placeholder="123"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                value="123">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cardholder Name</label>
                        <input type="text" name="cardholder" placeholder="John Doe"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            value="{{ auth()->user()->name }}">
                    </div>

                    <input type="hidden" name="payment_method" value="card">

                    <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                        Pay £{{ number_format($price, 2) }}
                    </button>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        This is a demo. No actual payment will be processed.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
