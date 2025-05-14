<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Reply</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f5;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 32px;
        }

        .email-header {
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .email-header h2 {
            margin: 0;
            font-size: 20px;
            color: #333333;
        }

        .email-body p {
            font-size: 15px;
            line-height: 1.6;
            color: #444444;
            margin-bottom: 20px;
        }

        .email-footer {
            border-top: 1px solid #eaeaea;
            padding-top: 16px;
            font-size: 13px;
            color: #888888;
            text-align: center;
        }

        .highlight {
            color: #1d4ed8;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h2>📬 You've received a reply from the admin</h2>
        </div>

        <div class="email-body">
            <p>Hello,</p>

            <p>{{ $replyBody }}</p>

            <p>Best regards,<br>
            <span class="highlight">The Admin Team</span></p>
        </div>

        <div class="email-footer">
            This is an automated email from your system. Please do not reply directly.
        </div>
    </div>
</body>
</html>
