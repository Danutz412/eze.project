@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Invoice #{{ $invoice->invoice_no }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('customer.invoices.download', $invoice) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                Download PDF
            </a>
            @if($invoice->payment_status === 'pending')
                <form action="{{ route('customer.invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                        Delete
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-8">
        <div class="flex justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">EZePost</h2>
                <p class="text-gray-600">Secure File Transfer Service</p>
            </div>
            <div class="text-right">
                <p class="text-gray-600">Invoice #{{ $invoice->invoice_no }}</p>
                <p class="text-gray-600">Date: {{ $invoice->issued_at ? $invoice->issued_at->format('M d, Y') : $invoice->created_at->format('M d, Y') }}</p>
                @if($invoice->stripe_invoice_id)
                    <p class="text-gray-600">Stripe Invoice: {{ $invoice->stripe_invoice_id }}</p>
                @endif
            </div>
        </div>

        <div class="border-t border-gray-200 pt-8 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Bill To</h3>
            <p class="text-gray-700">{{ $invoice->user->name }}</p>
            <p class="text-gray-600">{{ $invoice->user->email }}</p>
        </div>

        <div class="border-t border-gray-200 pt-8 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Invoice Details</h3>
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 text-gray-600">Description</th>
                        <th class="text-right py-3 text-gray-600">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-4">
                            <p class="font-medium text-gray-900">Service Fee</p>
                        </td>
                        <td class="py-4 text-right text-gray-900">
                            {{ $invoice->currency }}{{ number_format($invoice->amount, 2) }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="py-4 text-right font-semibold text-gray-900">Total:</td>
                        <td class="py-4 text-right font-bold text-xl text-gray-900">
                            {{ $invoice->currency }}{{ number_format($invoice->amount, 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-600">Status:</p>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $invoice->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                           ($invoice->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                           'bg-red-100 text-red-800') }}">
                        {{ ucfirst($invoice->payment_status) }}
                    </span>
                </div>
                @if($invoice->hosted_invoice_url)
                    <div class="text-right">
                        <a href="{{ $invoice->hosted_invoice_url }}" target="_blank" class="text-red-600 hover:text-red-700">
                            View on Stripe →
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
