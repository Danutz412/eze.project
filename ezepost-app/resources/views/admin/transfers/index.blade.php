@extends('layouts.admin')

@section('title', 'All Transfers')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">All Transfers</h1>
        <div class="flex gap-4">
            <a href="{{ route('admin.transfers.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                Send File
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Receiver</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($transfers as $transfer)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $transfer->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transfer->senderUser ? $transfer->senderUser->email : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transfer->receiverUser ? $transfer->receiverUser->email : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transfer->file_name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $transfer->is_viewed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $transfer->is_viewed ? 'Viewed' : 'Pending' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transfer->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <form action="{{ route('admin.transfers.download', $transfer) }}" method="POST" class="inline">
                                @csrf
                                @method('POST')
                                <button type="submit" class="text-red-600 hover:text-red-900 mr-3">Download</button>
                            </form>
                            @if(!$transfer->is_viewed && $transfer->receiver_user_id === auth()->id())
                                <form action="{{ route('admin.transfers.receive') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="tracking_id" value="{{ $transfer->controlstring }}">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Receive</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            No transfers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($transfers->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t">
                {{ $transfers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
