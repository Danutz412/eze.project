<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New File Transfer</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f4f4f4; padding: 30px; border-radius: 8px;">
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <!-- Logo -->
            <div style="text-align: center; margin-bottom: 30px;">
                <div style="display: inline-block; background: #f4f4f4; padding: 20px; border-radius: 8px;">
                    <div style="font-size: 32px; font-weight: bold;">
                        <span style="color: #666;">E</span><span style="color: #f97316;">Z</span><span style="color: #666;">E</span>
                        <span style="color: #666; font-size: 20px; margin-left: 5px;">POST</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <h1 style="color: #333; margin-bottom: 20px;">You have received a new file transfer!</h1>
            
            <p style="margin-bottom: 15px;">
                <strong>{{ $transfer->senderUser->name }}</strong> has sent you a file through EzePost.
            </p>

            <div style="background: #f9fafb; padding: 20px; border-radius: 6px; margin-bottom: 20px;">
                <h3 style="margin-top: 0; color: #333;">File Details:</h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 10px;">
                        <strong>File Name:</strong> {{ $transfer->file_name }}
                    </li>
                    <li style="margin-bottom: 10px;">
                        <strong>File Size:</strong> {{ $transfer->file_size_formatted }}
                    </li>
                    @if($transfer->message)
                        <li style="margin-bottom: 10px;">
                            <strong>Message:</strong> {{ $transfer->message }}
                        </li>
                    @endif
                    @if($transfer->expires_at)
                        <li style="margin-bottom: 10px;">
                            <strong>Expires:</strong> {{ $transfer->expires_at->format('F j, Y, g:i A') }}
                        </li>
                    @endif
                </ul>
            </div>

            @if($transfer->require_password)
                <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin-bottom: 20px;">
                    <p style="margin: 0; color: #856404;">
                        <strong>⚠️ Password Required:</strong> This transfer requires a password to access the file.
                    </p>
                </div>
            @endif

            <p style="margin-bottom: 20px;">
                To download this file, please log in to your EzePost account and navigate to your received items.
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ config('app.url') }}/transfers/received" style="display: inline-block; background: #f97316; color: white; padding: 12px 30px; text-decoration: none; border-radius: 6px; font-weight: bold;">
                    View Received Files
                </a>
            </div>

            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">

            <p style="font-size: 12px; color: #666; text-align: center; margin: 0;">
                This email was sent by EzePost. If you did not expect this transfer, please ignore this email.
            </p>
        </div>
    </div>
</body>
</html>
