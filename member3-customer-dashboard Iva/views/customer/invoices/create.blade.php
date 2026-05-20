@extends('layouts.customer')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Generate Invoice</h2>

        <form action="{{ route('customer.invoices.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                <input type="number" name="amount" id="amount" step="0.01" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="{{ old('amount', '0.00') }}">
                @error('amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                <select name="currency" id="currency" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="GBP" {{ old('currency', 'GBP') == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                    <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                </select>
                @error('currency')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Generate Invoice
                </button>
                <a href="{{ route('customer.invoices.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
