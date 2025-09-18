<?php
echo "=== SIMULATING RAZORPAY PAYMENT EMAIL ===\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

// Simulate the exact scenario from verify.php
$email = "shivp017@gmail.com";
$car_id = "TEST001";
$car_name = "Test Car Model";
$total_amount = "1500";
$booking_id = "BK" . time();

echo "📋 SIMULATED BOOKING DETAILS:\n";
echo "Email: $email\n";
echo "Car ID: $car_id\n";
echo "Car Name: $car_name\n";
echo "Amount: ₹$total_amount\n";
echo "Booking ID: $booking_id\n\n";

// Test 1: Payment confirmation email (like in verify.php)
echo "📧 TEST 1: PAYMENT CONFIRMATION EMAIL\n";
echo "----------------------------------------\n";

$subject1 = "Payment Confirmation - Booking #$booking_id";
$message1 = "
<html>
<head>
    <title>Payment Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4CAF50; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>✅ Payment Successful!</h1>
        </div>
        <div class='content'>
            <h2>Dear Customer,</h2>
            <p>Your payment has been successfully processed!</p>
            
            <h3>📋 Booking Details:</h3>
            <ul>
                <li><strong>Booking ID:</strong> $booking_id</li>
                <li><strong>Car:</strong> $car_name</li>
                <li><strong>Amount Paid:</strong> ₹$total_amount</li>
                <li><strong>Payment Time:</strong> " . date('Y-m-d H:i:s') . "</li>
            </ul>
            
            <p>Your invoice will be sent separately in the next email.</p>
            
            <p>Thank you for choosing EduxonCabs!</p>
        </div>
        <div class='footer'>
            <p>EduxonCabs - Your trusted car rental partner</p>
        </div>
    </div>
</body>
</html>
";

$headers1 = "MIME-Version: 1.0\r\n";
$headers1 .= "Content-type: text/html; charset=UTF-8\r\n";
$headers1 .= "From: EduxonCabs Payment <payments@eduxoncabs.com>\r\n";
$headers1 .= "Reply-To: support@eduxoncabs.com\r\n";

$result1 = mail($email, $subject1, $message1, $headers1);
echo ($result1 ? "✅ Payment confirmation email SENT" : "❌ Payment confirmation email FAILED") . "\n\n";

// Test 2: Invoice email (like in verify.php)
echo "📧 TEST 2: INVOICE EMAIL\n";
echo "----------------------------------------\n";

$subject2 = "Invoice - Booking #$booking_id";
$message2 = "
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2196F3; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .invoice-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .invoice-table th { background: #f2f2f2; }
        .total { font-weight: bold; font-size: 18px; color: #2196F3; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>📄 INVOICE</h1>
        </div>
        <div class='content'>
            <h2>Invoice #INV-$booking_id</h2>
            <p><strong>Date:</strong> " . date('Y-m-d') . "</p>
            <p><strong>Customer Email:</strong> $email</p>
            
            <table class='invoice-table'>
                <tr>
                    <th>Description</th>
                    <th>Car Model</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>Car Rental Service</td>
                    <td>$car_name</td>
                    <td class='total'>₹$total_amount</td>
                </tr>
            </table>
            
            <p class='total'>Total Amount: ₹$total_amount</p>
            <p><strong>Payment Status:</strong> ✅ PAID</p>
            <p><strong>Payment Method:</strong> Razorpay</p>
            
            <p>Thank you for your business!</p>
        </div>
        <div class='footer'>
            <p>EduxonCabs - Contact: support@eduxoncabs.com</p>
        </div>
    </div>
</body>
</html>
";

$headers2 = "MIME-Version: 1.0\r\n";
$headers2 .= "Content-type: text/html; charset=UTF-8\r\n";
$headers2 .= "From: EduxonCabs Invoice <invoice@eduxoncabs.com>\r\n";
$headers2 .= "Reply-To: support@eduxoncabs.com\r\n";

$result2 = mail($email, $subject2, $message2, $headers2);
echo ($result2 ? "✅ Invoice email SENT" : "❌ Invoice email FAILED") . "\n\n";

echo "=== EMAIL SUMMARY ===\n";
echo "📧 Emails sent to: $email\n";
echo "1. Payment Confirmation: " . ($result1 ? "SUCCESS" : "FAILED") . "\n";
echo "2. Invoice: " . ($result2 ? "SUCCESS" : "FAILED") . "\n\n";

echo "🔍 CHECK YOUR EMAIL INBOX FOR:\n";
echo "Subject 1: $subject1\n";
echo "Subject 2: $subject2\n\n";

echo "⚠️  IMPORTANT NOTES:\n";
echo "- Check your SPAM/JUNK folder\n";
echo "- Emails may take 1-5 minutes to arrive\n";
echo "- Some email providers block emails from localhost\n";
echo "- Gmail might filter emails from unknown domains\n\n";

echo "=== TEST COMPLETE ===\n";
?>
