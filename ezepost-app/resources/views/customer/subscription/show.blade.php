@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Subscription</h1>

    @if($activeInvoice)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Active Subscription</h2>
                    <p class="text-gray-600">Premium Plan</p>
                </div>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                    Active
                </span>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Invoice Number</p>
                    <p class="font-semibold text-gray-900">{{ $activeInvoice->invoice_no }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Amount Paid</p>
                    <p class="font-semibold text-gray-900">{{ $activeInvoice->currency }}{{ number_format($activeInvoice->amount, 2) }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Payment Date</p>
                    <p class="font-semibold text-gray-900">{{ $activeInvoice->issued_at ? $activeInvoice->issued_at->format('M d, Y') : $activeInvoice->created_at->format('M d, Y') }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Status</p>
                    <p class="font-semibold text-gray-900">{{ ucfirst($activeInvoice->payment_status) }}</p>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <a href="{{ route('customer.invoices.show', $activeInvoice) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                    View Invoice
                </a>
                @if($activeInvoice->hosted_invoice_url)
                    <a href="{{ $activeInvoice->hosted_invoice_url }}" target="_blank" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                        Manage on Stripe
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="text-xl font-bold text-gray-900 mb-2">No Active Subscription</h2>
                <p class="text-gray-600 mb-4">You don't have an active subscription yet.</p>
                <a href="{{ route('pricing') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
                    View Plans
                </a>
            </div>
        </div>
    @endif

    @if($team)
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Team Details</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Team Name</p>
                    <p class="font-semibold text-gray-900">{{ $team->name }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Total Licenses</p>
                    <p class="font-semibold text-gray-900">{{ $team->total_licenses }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Used Licenses</p>
                    <p class="font-semibold text-gray-900">{{ $team->used_licenses }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Remaining Licenses</p>
                    <p class="font-semibold text-gray-900">{{ $team->remaining_licenses }}</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('customer.teams.settings') }}" class="text-red-600 hover:text-red-700">
                    Manage Team Settings →
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
