<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EzePost Transfer Receipt</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 11px; 
            color: #333;
            margin: 40px;
        }
        .header { 
            text-align: center; 
            border-bottom: 3px solid #FF6B35; 
            padding-bottom: 20px;
            margin-bottom: 30px; 
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #555;
        }
        .logo .orange { color: #FF6B35; }
        .receipt-title {
            font-size: 18px;
            color: #555;
            margin-top: 10px;
        }
        .info-section {
            margin-bottom: 25px;
        }
        .info-row {
            margin-bottom: 8px;
            padding: 5px 0;
        }
        .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 150px;
        }
        .value {
            color: #333;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
        }
        th { 
            background-color: #f5f5f5; 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: left;
            font-weight: bold;
            color: #555;
        }
        td { 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: left; 
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .highlight-box {
            background-color: #f8f9fa;
            border-left: 4px solid #FF6B35;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <span>E</span><span class="orange">Z</span><span>E</span> <span style="font-size: 24px;">POST</span>
        </div>
        <div class="receipt-title">File Transfer Receipt</div>
    </div>

    <div class="highlight-box">
        <div class="info-row">
            <span class="label">Transfer Reference:</span>
            <span class="value">{{ $transfer->transfer_reference ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Control String:</span>
            <span class="value">{{ $transfer->controlstring ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="info-section">
        <h3 style="color: #555; border-bottom: 2px solid #f0f0f0; padding-bottom: 8px;">Transfer Details</h3>
        
        <div class="info-row">
            <span class="label">Sender:</span>
            <span class="value">{{ $transfer->senderUser->name ?? 'N/A' }} ({{ $transfer->senderUser->email ?? 'N/A' }})</span>
        </div>
        
        <div class="info-row">
            <span class="label">Receiver:</span>
            <span class="value">{{ $transfer->receiverUser->name ?? 'N/A' }} ({{ $transfer->receiverUser->email ?? 'N/A' }})</span>
        </div>
        
        <div class="info-row">
            <span class="label">File Name:</span>
            <span class="value">{{ $transfer->file_name ?? 'N/A' }}</span>
        </div>
        
        <div class="info-row">
            <span class="label">File Size:</span>
            <span class="value">{{ number_format($transfer->file_size / 1024 / 1024, 2) }} MB</span>
        </div>
        
        <div class="info-row">
            <span class="label">Status:</span>
            <span class="value">
                <span class="status-badge status-{{ $transfer->is_viewed ? 'completed' : 'pending' }}">
                    {{ $transfer->is_viewed ? 'Viewed' : 'Pending' }}
                </span>
            </span>
        </div>
        
        <div class="info-row">
            <span class="label">Sent At:</span>
            <span class="value">{{ $transfer->created_at->format('d M Y, H:i:s') }}</span>
        </div>
        
        @if($transfer->viewed_at)
        <div class="info-row">
            <span class="label">Viewed At:</span>
            <span class="value">{{ $transfer->viewed_at->format('d M Y, H:i:s') }}</span>
        </div>
        @endif
        
        @if($transfer->expires_at)
        <div class="info-row">
            <span class="label">Expires At:</span>
            <span class="value">{{ $transfer->expires_at->format('d M Y, H:i:s') }}</span>
        </div>
        @endif
    </div>

    @if($transfer->message)
    <div class="info-section">
        <h3 style="color: #555; border-bottom: 2px solid #f0f0f0; padding-bottom: 8px;">Message</h3>
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 4px;">
            {{ $transfer->message }}
        </div>
    </div>
    @endif

    <div class="info-section">
        <h3 style="color: #555; border-bottom: 2px solid #f0f0f0; padding-bottom: 8px;">Transfer Options</h3>
        
        <table>
            <tr>
                <th>Option</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Notify Recipient</td>
                <td>{{ $transfer->notify_recipient ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td>Require Password</td>
                <td>{{ $transfer->require_password ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td>Track Download</td>
                <td>{{ $transfer->track_download ? 'Yes' : 'No' }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p><strong>EzePost</strong> - Secure File Transfer Service</p>
        <p>Generated on {{ now()->format('d M Y, H:i:s') }}</p>
        <p>This is an automatically generated receipt. Please keep it for your records.</p>
    </div>
</body>
</html>
