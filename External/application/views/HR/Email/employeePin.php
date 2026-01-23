<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Employee PIN - Bizadmin</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f4f4f4; padding: 20px; text-align: center; border-radius: 5px; }
        .content { padding: 20px; background-color: #fff; }
        .pin-box { background-color: #e8f4fd; padding: 15px; border-radius: 5px; text-align: center; margin: 20px 0; }
        .pin-number { font-size: 24px; font-weight: bold; color: #2c5aa0; letter-spacing: 2px; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome to Bizadmin HR Portal</h2>
        </div>
        
        <div class="content">
            <p>Hello <?php echo $empName; ?>,</p>
            
            <p>Thank you for completing your onboarding process. Your employee profile has been successfully created.</p>
            
            <div class="pin-box">
                <p><strong>Your Employee PIN:</strong></p>
                <div class="pin-number"><?php echo $empPin; ?></div>
            </div>
            
            <p><strong>What's next?</strong></p>
            <ul>
                <li>Keep your PIN secure - you'll need it for clocking in/out and other HR functions</li>
                <li>Your manager will contact you shortly with your login credentials for the HR portal</li>
                <li>Access your portal at: <a href="<?php echo $portalUrl; ?>"><?php echo $portalUrl; ?></a></li>
            </ul>
            
            <p><strong>Important Notes:</strong></p>
            <ul>
                <li>Your PIN is: <strong><?php echo $empPin; ?></strong></li>
                <li>Do not share your PIN with anyone</li>
                <li>If you lose your PIN, please contact your manager immediately</li>
            </ul>
            
            <p>If you have any questions or need assistance, please don't hesitate to contact your manager or the Bizadmin support team.</p>
            
            <p>Welcome aboard!</p>
        </div>
        
        <div class="footer">
            <p><strong>Kind Regards,</strong></p>
            <p><strong>Bizadmin HR Team</strong></p>
            <hr>
            <p><em>This is an automated message. Please do not reply to this email.</em></p>
        </div>
    </div>
</body>
</html>