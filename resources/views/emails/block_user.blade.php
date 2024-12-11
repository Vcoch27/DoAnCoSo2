<!DOCTYPE html>
<html>

<head>
    <title>Account Blocked Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8d7da;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #dc3545;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }

        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            color: #dc3545;
        }

        .content p {
            font-size: 16px;
            margin: 10px 0;
        }

        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>ProgAccum</h2>
        </div>
        <div class="content">
            <h1>Account Blocked, {{ $user->name }}</h1>
            <p>We regret to inform you that your account has been blocked due to violations of our policies.</p>
            <p>This block is effective immediately as of <strong>{{ $blockDate }}</strong>.</p>
            <p>If you believe this was a mistake, please contact us to resolve the issue. We value your participation and will do our best to assist you.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 ProgAccum. All rights reserved.</p>
            <p>Contact us at <a href="mailto:froxfive@gmail.com">froxfive@gmail.com</a></p>
        </div>
    </div>
</body>

</html>