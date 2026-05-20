@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Customer Details</h1>

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Name</p>
                <p class="font-semibold text-gray-900">{{ $user->name }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Email</p>
                <p class="font-semibold text-gray-900">{{ $user->email }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Admin Status</p>
                <p class="font-semibold text-gray-900">
                    @if($user->is_admin)
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Yes</span>
                    @else
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">No</span>
                    @endif
                </p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Email Verified</p>
                <p class="font-semibold text-gray-900">
                    @if($user->email_verified_at)
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Yes</span>
                    @else
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">No</span>
                    @endif
                </p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Created At</p>
                <p class="font-semibold text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Updated At</p>
                <p class="font-semibold text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Teams</h2>
        <div class="space-y-3">
            @forelse($user->teams as $team)
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="font-medium text-gray-900">{{ $team->name }}</p>
                    <p class="text-sm text-gray-600">Role: {{ $team->pivot->role }}</p>
                </div>
            @empty
                <p class="text-sm text-gray-500">No teams found.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Invoices</h2>
        <div class="space-y-3">
            @forelse($user->invoices as $invoice)
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="font-medium text-gray-900">Invoice #{{ $invoice->invoice_no }}</p>
                    <p class="text-sm text-gray-600">Amount: {{ $invoice->currency }}{{ number_format($invoice->amount, 2) }} | Status: {{ ucfirst($invoice->payment_status) }}</p>
                </div>
            @empty
                <p class="text-sm text-gray-500">No invoices found.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Create Invoice</h2>
        <form action="{{ route('admin.customers.create-invoice', $user) }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="number" name="amount" step="0.01" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                    <select name="currency" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="GBP">GBP (£)</option>
                        <option value="USD">USD ($)</option>
                        <option value="EUR">EUR (€)</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="mt-4 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                Create Invoice
            </button>
        </form>
    </div>

    <div class="flex gap-4">
        @if($user->is_admin)
            <form action="{{ route('admin.customers.unblock', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove admin status?')">
                @csrf
                <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg">
                    Remove Admin
                </button>
            </form>
        @else
            <form action="{{ route('admin.customers.block', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to make this user an admin?')">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                    Make Admin
                </button>
            </form>
        @endif
        <a href="{{ route('admin.customers.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">
            Back to Customers
        </a>
    </div>
</div>
@endsection
