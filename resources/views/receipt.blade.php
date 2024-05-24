<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://th.bing.com/th/id/OIP.oB20qG5NLJYJL_ZfsvjgjwAAAA?rs=1&pid=ImgDetMain" alt="DIT" style="height: 100px; width:100px;">
            <h1>HOSTEL MANAGEMENT SYSTEM</h1>
            <h3>Receipt</h3>
            <p>Booking ID: {{ $booking->id }}</p>
        </div>
        <div class="details">
            <p><strong>Hostel Name:</strong> {{ $booking->hostel_name }}</p>
            <p><strong>Duration:</strong> {{ $booking->duration }}</p>
            <p><strong>Room Number:</strong> {{ $booking->room_number }}</p>
            <p><strong>Price:</strong> {{ $booking->price }}</p>
            <p><strong>Payment Status:</strong> {{ $booking->payment_status }}</p>
            <p><strong>Cardholder Name:</strong> {{ $payment->cardholder_name }}</p>
            <p><strong>Card Number:</strong> **** **** **** {{ substr($payment->card_number, -4) }}</p>
            <p><strong>Expiration Date:</strong> {{ $payment->card_expiry }}</p>
            <p><strong>Payment Amount:</strong> {{ $payment->payment_amount }}</p>
        </div>
        <div class="footer">
            <p>Thank you for your payment.</p>
        </div>
    </div>
</body>
</html>
