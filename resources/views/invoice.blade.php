<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-header img {
            max-width: 150px;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details h2 {
            margin: 0;
            font-size: 20px;
            color: #666;
        }
        .invoice-details p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .invoice-table td {
            text-align: right;
        }
        .invoice-table td:first-child {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <div class="invoice-header">
        <div>
            <h1>Invoice</h1>
        </div>
    </div>
    <div class="invoice-details">
        <h2>Invoice Details</h2>
        <p><strong>Amount:</strong> {{ $data['amount'] }} {{ $data['currency'] }}</p>
        <p><strong>Notify ID:</strong> {{ $data['notifyId'] }}</p>
        <p><strong>Order No:</strong> {{ $data['orderNo'] }}</p>
        <p><strong>Original Order No:</strong> {{ $data['originalOrderNo'] }}</p>
        <p><strong>Reference:</strong> {{ $data['reference'] }}</p>
        <p><strong>Status:</strong> {{ $data['status'] }}</p>
        <p><strong>Timestamp:</strong> {{ \Carbon\Carbon::createFromTimestampMs($data['timestamp'])->toDateTimeString() }}</p>
    </div>
    <table class="invoice-table">
        <thead>
        <tr>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Service/Product</td>
            <td>{{ $data['amount'] }} {{ $data['currency'] }}</td>
        </tr>
        </tbody>
    </table>
    <div class="invoice-footer">
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </div>
</div>
</body>
</html>
