@extends('layouts.customer')

@section('title', 'Viewed Today')
@section('breadcrumb', 'Viewed Today')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900">Viewed Today</h2>
        <p class="text-sm text-gray-600 mt-1">Files viewed today: {{ $transfers->total() }}</p>
    </div>

    <div class="divide-y divide-gray-200">
        @forelse($transfers as $transfer)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $transfer->file_name }}</h3>
                            <p class="text-sm text-gray-600">
                                @if($transfer->sender_ezepost_user_id == auth()->user()->ezepostUser?->id)
                                    Sent to: {{ $transfer->receiverUser->displayname ?? 'Unknown' }}
                                @else
                                    From: {{ $transfer->senderUser->displayname ?? 'Unknown' }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="text-right mr-6">
                        <p class="text-sm font-medium text-gray-900">{{ $transfer->viewed_at ? $transfer->viewed_at->format('H:i:s') : 'Today' }}</p>
                        <p class="text-sm text-gray-600">{{ $transfer->file_size_formatted }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('customer.transfers.download', $transfer) }}" class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V10"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No files viewed today</h3>
                <p class="text-gray-600">No files have been viewed today.</p>
            </div>
        @endforelse
    </div>

    @if($transfers->hasPages())
        <div class="p-6 border-t border-gray-200">{{ $transfers->links() }}</div>
    @endif
</div>
@endsection
