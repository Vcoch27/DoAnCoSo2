<!DOCTYPE html>
<html>

<head>
    <title>Premium Upgrade Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #badabe;
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
            background-color: #4CAF50;
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
            color: #4CAF50;
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
            <h1>Congratulations, {{ $user->name }}!</h1>
            <p>You've successfully upgraded to the Premium Membership.</p>
            <p>Your premium subscription is now active and valid until <strong>{{ $subscription->end_date }}</strong>.</p>
            <p>Thank you for your support! We hope you enjoy the exclusive benefits of our Premium Membership.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 ProgAccum. All rights reserved.</p>
            <p>Contact us at <a href="mailto:froxfive@gmail.com">froxfive@gmail.com</a></p>
        </div>
    </div>
</body>

</html>