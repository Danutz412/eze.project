@extends('layouts.customer')

@section('title', 'Received Items')
@section('breadcrumb', 'Received Items')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <!-- Header with Search -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-900">Received Items</h2>
            <div class="flex items-center space-x-3">
                <form method="GET" action="{{ route('customer.transfers.received') }}" class="flex items-center space-x-3">
                    <input type="text" name="search" placeholder="Search for files..." value="{{ request('search') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                    <button type="submit" class="p-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="flex items-center space-x-4 text-sm">
            <span class="text-gray-600">Filter by:</span>
            <a href="{{ route('customer.transfers.received') }}" 
               class="px-3 py-1 rounded-lg {{ !request('status') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                All
            </a>
            <a href="{{ route('customer.transfers.received', ['status' => 'unread']) }}" 
               class="px-3 py-1 rounded-lg {{ request('status') == 'unread' ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Unread
            </a>
            <a href="{{ route('customer.transfers.received', ['status' => 'read']) }}" 
               class="px-3 py-1 rounded-lg {{ request('status') == 'read' ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Read
            </a>
        </div>
    </div>

    <!-- Transfer List -->
    <div class="divide-y divide-gray-200">
        @forelse($transfers as $transfer)
            <div class="p-6 hover:bg-gray-50 transition-colors {{ $transfer->is_viewed ? '' : 'bg-blue-50' }}">
                <div class="flex items-center justify-between">
                    <!-- File Icon & Info -->
                    <div class="flex items-center flex-1">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">
                                {{ $transfer->file_name }}
                                @if(!$transfer->is_viewed)
                                    <span class="ml-2 px-2 py-0.5 text-xs bg-blue-600 text-white rounded-full">New</span>
                                @endif
                            </h3>
                            <p class="text-sm text-gray-600">
                                From: <span class="font-medium">{{ $transfer->senderUser->displayname ?? $transfer->sender_name }}</span>
                                ({{ $transfer->sender_vepost_addr }})
                            </p>
                        </div>
                    </div>

                    <!-- Date & Size -->
                    <div class="text-right mr-6">
                        <p class="text-sm font-medium text-gray-900">{{ $transfer->created_at->format('Y-m-d H:i:s') }}</p>
                        <p class="text-sm text-gray-600">File Size: {{ $transfer->file_size_formatted }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('customer.transfers.download', $transfer->id) }}" 
                           class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Download">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V10"></path>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('customer.transfers.destroy', $transfer->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                                    title="Delete" onclick="return confirm('Are you sure you want to delete this file?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No received items</h3>
                <p class="text-gray-600 mb-6">You haven't received any files yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($transfers->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $transfers->links() }}
        </div>
    @endif
</div>
@endsection
