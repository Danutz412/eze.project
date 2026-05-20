<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Invitation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background: #f5f5f5;">
    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: bold; letter-spacing: 2px; margin: 0;">
                EZEPOST
            </h1>
        </div>

        <!-- Content -->
        <p style="margin-bottom: 20px; font-size: 16px;">
            You have been invited to join the <strong>{{ $invitation->team->name }}</strong> team!
        </p>
        
        <p style="margin-bottom: 30px; font-size: 16px;">
            You may accept this invitation by clicking the button below and logging in:
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('customer.teams.accept-invitation', $invitation->token) }}" 
               style="display: inline-block; background: #333; color: white; padding: 14px 40px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 16px;">
                Accept Invitation
            </a>
        </div>

        <p style="margin-top: 30px; margin-bottom: 10px; font-size: 14px; color: #666;">
            If you do not have an account yet, click the register link on the login page. After creating an account, you will be automatically added to the team.
        </p>

        <p style="margin-bottom: 0; font-size: 14px; color: #666;">
            If you did not expect to receive an invitation to this team, you may discard this email.
        </p>

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">

        <p style="font-size: 12px; color: #999; text-align: center; margin: 0;">
            © {{ date('Y') }} EZEPOST. All rights reserved.
        </p>
    </div>
</body>
</html>
