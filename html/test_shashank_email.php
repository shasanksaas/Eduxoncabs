<?php
echo "=== SENDING TEST EMAILS TO SHASHANKMUSICON@GMAIL.COM ===\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

// Test email for the new address
$email = "shashankmusicon@gmail.com";
$booking_id = "BK" . time();
$car_name = "Swift Dzire";
$total_amount = "2500";

echo "📧 Sending test emails to: $email\n\n";

// Email 1: Payment Confirmation
echo "📤 SENDING EMAIL 1: Payment Confirmation\n";
$subject1 = "✅ Payment Successful - EduxonCabs Booking #$booking_id";
$message1 = "
<html>
<head>
    <title>Payment Confirmation</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: white; }
        .header { background: linear-gradient(135deg, #4CAF50, #45a049); color: white; padding: 30px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { padding: 30px 20px; }
        .booking-details { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .detail-row { display: flex; justify-content: space-between; margin: 10px 0; padding: 8px 0; border-bottom: 1px solid #eee; }
        .amount { font-size: 24px; font-weight: bold; color: #4CAF50; text-align: center; margin: 20px 0; }
        .footer { background: #f1f1f1; padding: 20px; text-align: center; font-size: 14px; color: #666; }
        .btn { background: #4CAF50; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 20px 0; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🎉 Payment Successful!</h1>
            <p style='margin: 10px 0 0 0; font-size: 18px;'>Your booking is confirmed</p>
        </div>
        <div class='content'>
            <h2>Dear Customer,</h2>
            <p>Great news! Your payment has been successfully processed and your car booking is confirmed.</p>
            
            <div class='booking-details'>
                <h3>📋 Booking Summary</h3>
                <div class='detail-row'>
                    <span><strong>Booking ID:</strong></span>
                    <span>$booking_id</span>
                </div>
                <div class='detail-row'>
                    <span><strong>Car Model:</strong></span>
                    <span>$car_name</span>
                </div>
                <div class='detail-row'>
                    <span><strong>Payment Date:</strong></span>
                    <span>" . date('d M Y, H:i') . "</span>
                </div>
                <div class='detail-row'>
                    <span><strong>Payment Method:</strong></span>
                    <span>Razorpay (Online)</span>
                </div>
            </div>
            
            <div class='amount'>
                💰 Amount Paid: ₹$total_amount
            </div>
            
            <p><strong>What's Next?</strong></p>
            <ul>
                <li>📄 Your invoice will be sent in a separate email</li>
                <li>📞 Our team will contact you within 24 hours</li>
                <li>🚗 Your car will be ready as per booking schedule</li>
            </ul>
            
            <center>
                <a href='tel:+917008899993' class='btn'>📞 Contact Support</a>
            </center>
            
            <p>Thank you for choosing EduxonCabs - Your trusted car rental partner!</p>
        </div>
        <div class='footer'>
            <p><strong>EduxonCabs</strong><br>
            📧 support@eduxoncabs.com | 📞 +91 70088 99993<br>
            🌐 www.eduxoncabs.com</p>
        </div>
    </div>
</body>
</html>
";

$headers1 = "MIME-Version: 1.0\r\n";
$headers1 .= "Content-type: text/html; charset=UTF-8\r\n";
$headers1 .= "From: EduxonCabs <payments@eduxoncabs.com>\r\n";
$headers1 .= "Reply-To: support@eduxoncabs.com\r\n";
$headers1 .= "X-Mailer: EduxonCabs Payment System\r\n";

$result1 = mail($email, $subject1, $message1, $headers1);
echo ($result1 ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";

// Email 2: Invoice
echo "📤 SENDING EMAIL 2: Invoice\n";
$subject2 = "📄 Invoice - EduxonCabs Booking #$booking_id";
$message2 = "
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: white; }
        .header { background: linear-gradient(135deg, #2196F3, #1976D2); color: white; padding: 30px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { padding: 30px 20px; }
        .invoice-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .invoice-table { width: 100%; border-collapse: collapse; margin: 20px 0; background: white; }
        .invoice-table th { background: #2196F3; color: white; padding: 15px; text-align: left; }
        .invoice-table td { padding: 15px; border-bottom: 1px solid #eee; }
        .total-section { background: #e3f2fd; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .total-amount { font-size: 28px; font-weight: bold; color: #1976D2; text-align: center; }
        .status-paid { background: #4CAF50; color: white; padding: 8px 16px; border-radius: 20px; font-weight: bold; }
        .footer { background: #f1f1f1; padding: 20px; text-align: center; font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>📄 INVOICE</h1>
            <p style='margin: 10px 0 0 0; font-size: 18px;'>Tax Invoice / Receipt</p>
        </div>
        <div class='content'>
            <div class='invoice-info'>
                <h3>Invoice Details</h3>
                <p><strong>Invoice Number:</strong> INV-$booking_id</p>
                <p><strong>Invoice Date:</strong> " . date('d M Y') . "</p>
                <p><strong>Customer:</strong> $email</p>
                <p><strong>Booking ID:</strong> $booking_id</p>
            </div>
            
            <table class='invoice-table'>
                <thead>
                    <tr>
                        <th>Service Description</th>
                        <th>Vehicle</th>
                        <th>Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Car Rental Service<br><small>Self-drive car rental</small></td>
                        <td>$car_name<br><small>Premium Category</small></td>
                        <td style='font-weight: bold; font-size: 18px;'>$total_amount</td>
                    </tr>
                </tbody>
            </table>
            
            <div class='total-section'>
                <div style='display: flex; justify-content: space-between; margin-bottom: 10px;'>
                    <span>Subtotal:</span>
                    <span>₹$total_amount</span>
                </div>
                <div style='display: flex; justify-content: space-between; margin-bottom: 10px;'>
                    <span>Tax (GST included):</span>
                    <span>₹0</span>
                </div>
                <hr>
                <div class='total-amount'>
                    Total: ₹$total_amount
                </div>
            </div>
            
            <div style='text-align: center; margin: 20px 0;'>
                <span class='status-paid'>✅ PAID</span>
            </div>
            
            <div style='background: #fff3cd; padding: 15px; border-radius: 5px; border-left: 4px solid #ffc107;'>
                <p><strong>📋 Important Notes:</strong></p>
                <ul style='margin: 10px 0;'>
                    <li>Payment processed via Razorpay</li>
                    <li>This is a computer generated invoice</li>
                    <li>Keep this invoice for your records</li>
                    <li>Contact support for any queries</li>
                </ul>
            </div>
            
            <p style='text-align: center; margin-top: 30px;'>
                <strong>Thank you for your business!</strong>
            </p>
        </div>
        <div class='footer'>
            <p><strong>EduxonCabs Private Limited</strong><br>
            📧 invoice@eduxoncabs.com | 📞 +91 70088 99993<br>
            🌐 www.eduxoncabs.com</p>
        </div>
    </div>
</body>
</html>
";

$headers2 = "MIME-Version: 1.0\r\n";
$headers2 .= "Content-type: text/html; charset=UTF-8\r\n";
$headers2 .= "From: EduxonCabs Invoice <invoice@eduxoncabs.com>\r\n";
$headers2 .= "Reply-To: accounts@eduxoncabs.com\r\n";
$headers2 .= "X-Mailer: EduxonCabs Invoice System\r\n";

$result2 = mail($email, $subject2, $message2, $headers2);
echo ($result2 ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";

echo "=== 📧 EMAIL SUMMARY ===\n";
echo "Recipient: $email\n";
echo "Email 1 (Payment Confirmation): " . ($result1 ? "✅ SENT" : "❌ FAILED") . "\n";
echo "Email 2 (Invoice): " . ($result2 ? "✅ SENT" : "❌ FAILED") . "\n\n";

echo "🔍 CHECK YOUR INBOX FOR:\n";
echo "1. Subject: $subject1\n";
echo "2. Subject: $subject2\n\n";

echo "📱 IMPORTANT: Check these folders in Gmail:\n";
echo "- Primary Inbox\n";
echo "- Spam/Junk folder\n";
echo "- Promotions tab\n";
echo "- Updates tab\n\n";

echo "⏰ Emails may take 1-5 minutes to arrive\n";
echo "=== TEST COMPLETE ===\n";
?>
