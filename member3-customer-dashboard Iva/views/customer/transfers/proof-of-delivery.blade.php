@extends('layouts.customer')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-8">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center">
                <img src="{{ asset('logo.png') }}" alt="EZE" class="h-12 mr-4">
            </div>
            <h1 class="text-2xl font-bold text-gray-900">PROOF OF DELIVERY</h1>
            <a href="{{ route('customer.transfers.generate-pdf', $transfer) }}" class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-2 rounded-lg">
                Generate PDF
            </a>
        </div>

        <div class="grid grid-cols-5 gap-4 mb-6 text-xs font-semibold text-gray-600 uppercase">
            <div>
                <p class="mb-1">FILE NAME</p>
                <p class="text-gray-900 font-normal normal-case">{{ $transfer->file_name }}</p>
            </div>
            <div>
                <p class="mb-1">FILE SIZE</p>
                <p class="text-gray-900 font-normal normal-case">{{ number_format($transfer->file_size / 1024, 2) }} KB</p>
            </div>
            <div>
                <p class="mb-1">TIME SEND</p>
                <p class="text-gray-900 font-normal normal-case">{{ $transfer->created_at->format('Y-m-d H:i:s') }}</p>
            </div>
            <div>
                <p class="mb-1">TIME RECEIVE</p>
                <p class="text-gray-900 font-normal normal-case">{{ $transfer->received_at ? $transfer->received_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
            </div>
            <div>
                <p class="mb-1">TIME OPEN</p>
                <p class="text-gray-900 font-normal normal-case">{{ $transfer->opened_at ? $transfer->opened_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">RECEIVER</h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>{{ $transfer->receiverUser->email ?? 'N/A' }}</p>
                    <p>{{ $transfer->receiver_company ?? 'corporate' }}</p>
                    <p>{{ $transfer->receiver_name ?? 'Sarah Goldner' }}</p>
                    <p>{{ $transfer->receiver_address_1 ?? '31.55.217.3' }}</p>
                    <p>{{ $transfer->receiver_address_2 ?? '4044' }}</p>
                    <p>{{ $transfer->receiver_city ?? '150.110.113.100' }}</p>
                    <p>{{ $transfer->receiver_postcode ?? '105:48' }}</p>
                    <p>{{ $transfer->receiver_country ?? 'Linux' }}</p>
                    <p>{{ $transfer->receiver_device ?? '0.0.4' }}</p>
                    <p>{{ $transfer->receiver_browser ?? '3D:4C:0D:4D:43:94' }}</p>
                    <p>{{ $transfer->receiver_os ?? 'Airl-Laptop' }}</p>
                    <p>{{ $transfer->receiver_platform ?? 'mnichurst' }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">SENDER</h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>{{ $transfer->senderUser->email ?? 'N/A' }}</p>
                    <p>{{ $transfer->sender_company ?? 'schuster.page' }}</p>
                    <p>{{ $transfer->sender_name ?? 'Prof. Dahlia Hettinger V' }}</p>
                    <p>{{ $transfer->sender_address_1 ?? '41.25.115.177' }}</p>
                    <p>{{ $transfer->sender_address_2 ?? '25442' }}</p>
                    <p>{{ $transfer->sender_city ?? '211.57.181.1' }}</p>
                    <p>{{ $transfer->sender_postcode ?? '4407' }}</p>
                    <p>{{ $transfer->sender_country ?? 'macOS' }}</p>
                    <p>{{ $transfer->sender_device ?? '0.1.0' }}</p>
                    <p>{{ $transfer->sender_browser ?? 'F6:73:72:F9:8F:78' }}</p>
                    <p>{{ $transfer->sender_os ?? 'Ova-PC' }}</p>
                    <p>{{ $transfer->sender_platform ?? 'jerta93' }}</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-sm font-semibold text-gray-900 italic mb-3">Terms & Conditions</h3>
            <div class="text-xs text-gray-600 space-y-1">
                <p>"This is another box sentence-not a text to box at it.</p>
                <p>Just testing the paragraph to see how they format.</p>
                <p>JSON lines args for sender/tos.</p>
                <p>Trying to see what this looks like."</p>
                <p>Yes, they do!</p>
                <p>What does it look like?</p>
                <p>Not bad at all!</p>
            </div>
        </div>
    </div>
</div>
@endsection
