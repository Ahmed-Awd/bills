<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dddddd;
        }
        .email-header h2 {
            margin: 0;
            color: #333333;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
        }
        .email-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
        }
        .email-footer p {
            font-size: 14px;
            color: #999999;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>Invoice Attached</h2>
    </div>
    <div class="email-body">
        <p>Dear {{$user->name}},</p>
        <p>As requested, please find your invoice with the code <strong>{{ $code }}</strong> attached to this email.</p>
        <p>Thank you for using our services</p>
    </div>
</div>
</body>
</html>
