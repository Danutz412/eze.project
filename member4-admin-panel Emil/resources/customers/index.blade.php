@extends('layouts.admin')

@section('title', 'Customer Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold">All Customers</h3>
        <p class="text-gray-600">Manage customer accounts and permissions</p>
    </div>
    <div class="flex space-x-3">
        <input type="text" placeholder="Search customers..." class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Search
        </button>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Registered</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($customers as $customer)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $customer->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                            {{ substr($customer->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="font-medium">{{ $customer->name }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $customer->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($customer->ezepostUser)
                        @php
                            $parsed = app(\App\Services\ControllingStringService::class)->parse($customer->ezepostUser->controlstring ?? '00000000000000000000');
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full {{ $parsed['group'] == 1 ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $parsed['group'] == 1 ? 'Business' : 'Individual' }}
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">N/A</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($customer->ezepostUser)
                        @php
                            $isActive = app(\App\Services\ControllingStringService::class)->isActive($customer->ezepostUser->controlstring ?? '00000000000000000000');
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full {{ $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $isActive ? 'Active' : 'Locked' }}
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">No EzePost Account</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $customer->created_at->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.customers.show', $customer) }}" class="text-blue-600 hover:text-blue-800">
                            View
                        </a>
                        @if($customer->ezepostUser)
                            @if(app(\App\Services\ControllingStringService::class)->isActive($customer->ezepostUser->controlstring ?? '00000000000000000000'))
                                <form method="POST" action="{{ route('admin.customers.block', $customer) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to block this customer?')">
                                        Block
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.customers.unblock', $customer) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800">
                                        Unblock
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="font-medium">No customers found</p>
                    <p class="text-sm">Customers will appear here once they register</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $customers->links() }}
</div>
@endsection
