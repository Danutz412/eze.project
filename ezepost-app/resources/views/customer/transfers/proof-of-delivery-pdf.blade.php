<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Proof of Delivery - {{ $transfer->file_name }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #333; }
        .header { border-bottom: 2px solid #dc2626; padding-bottom: 20px; margin-bottom: 30px; }
        .company { font-size: 24px; font-weight: bold; color: #dc2626; }
        .title { text-align: center; font-size: 20px; font-weight: bold; margin: 20px 0; }
        .file-info { display: table; width: 100%; margin-bottom: 30px; }
        .file-info-item { display: table-cell; padding: 10px; background: #f9f9f9; }
        .file-info-label { font-size: 10px; font-weight: bold; color: #666; text-transform: uppercase; }
        .file-info-value { font-size: 12px; color: #333; margin-top: 5px; }
        .section { margin-bottom: 30px; }
        .section-title { font-size: 12px; font-weight: bold; margin-bottom: 10px; color: #666; text-transform: uppercase; }
        .two-column { display: table; width: 100%; }
        .column { display: table-cell; width: 48%; padding: 20px; vertical-align: top; }
        .column.left { background: #f9f9f9; margin-right: 4%; }
        .column p { margin: 5px 0; font-size: 11px; }
        .terms { border-top: 1px solid #ddd; padding-top: 20px; margin-top: 30px; }
        .terms h3 { font-size: 12px; font-style: italic; margin-bottom: 10px; }
        .terms p { font-size: 10px; color: #666; margin: 3px 0; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company">EZePost</div>
    </div>

    <div class="title">PROOF OF DELIVERY</div>

    <div class="file-info">
        <div class="file-info-item">
            <div class="file-info-label">FILE NAME</div>
            <div class="file-info-value">{{ $transfer->file_name }}</div>
        </div>
        <div class="file-info-item">
            <div class="file-info-label">FILE SIZE</div>
            <div class="file-info-value">{{ number_format($transfer->file_size / 1024, 2) }} KB</div>
        </div>
        <div class="file-info-item">
            <div class="file-info-label">TIME SEND</div>
            <div class="file-info-value">{{ $transfer->created_at->format('Y-m-d H:i:s') }}</div>
        </div>
        <div class="file-info-item">
            <div class="file-info-label">TIME RECEIVE</div>
            <div class="file-info-value">{{ $transfer->received_at ? $transfer->received_at->format('Y-m-d H:i:s') : 'N/A' }}</div>
        </div>
        <div class="file-info-item">
            <div class="file-info-label">TIME OPEN</div>
            <div class="file-info-value">{{ $transfer->viewed_at ? $transfer->viewed_at->format('Y-m-d H:i:s') : 'N/A' }}</div>
        </div>
    </div>

    <div class="two-column">
        <div class="column left">
            <div class="section-title">RECEIVER</div>
            <p>{{ $transfer->receiverUser->email ?? 'N/A' }}</p>
            <p>{{ $transfer->receiver_company ?? 'N/A' }}</p>
            <p>{{ $transfer->receiver_name ?? 'N/A' }}</p>
            <p>{{ $transfer->receiver_ip ?? 'N/A' }}</p>
            <p>{{ $transfer->receiver_device ?? 'N/A' }}</p>
            <p>{{ $transfer->receiver_browser ?? 'N/A' }}</p>
            <p>{{ $transfer->receiver_os ?? 'N/A' }}</p>
        </div>

        <div class="column">
            <div class="section-title">SENDER</div>
            <p>{{ $transfer->senderUser->email ?? 'N/A' }}</p>
            <p>{{ $transfer->sender_company ?? 'N/A' }}</p>
            <p>{{ $transfer->sender_name ?? 'N/A' }}</p>
            <p>{{ $transfer->sender_ip ?? 'N/A' }}</p>
            <p>{{ $transfer->sender_device ?? 'N/A' }}</p>
            <p>{{ $transfer->sender_browser ?? 'N/A' }}</p>
            <p>{{ $transfer->sender_os ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="terms">
        <h3>Terms & Conditions</h3>
        <p>This document serves as proof of delivery for the file transfer.</p>
        <p>The information provided above includes sender and receiver details.</p>
        <p>All timestamps are recorded in UTC timezone.</p>
        <p>This is an automated system-generated document.</p>
    </div>
</body>
</html>
