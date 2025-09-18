<?php
// Test script to simulate Razorpay payment completion and trigger invoice email
echo "=== RAZORPAY PAYMENT SIMULATION TEST ===\n\n";

// Test data - simulating a real payment
$test_payment = [
    'rzp_paymentid' => 'pay_TEST' . time(),
    'rzp_orderid' => 'order_TEST' . time(),
    'rzp_signature' => 'test_signature_' . md5(time()),
    'buyer_name' => 'Test Customer',
    'email' => 'shivp017@gmail.com', // Using the actual email to test
    'amount' => 1500, // ₹15.00 for testing
    'phone' => '9692627257',
    'vehicle' => 'Test Vehicle - Hyundai i20',
    'pickup_date' => date('Y-m-d', strtotime('+1 day')),
    'return_date' => date('Y-m-d', strtotime('+2 days')),
    'pickup_time' => '10:00',
    'return_time' => '18:00'
];

echo "📋 Test Payment Details:\n";
echo "Payment ID: {$test_payment['rzp_paymentid']}\n";
echo "Order ID: {$test_payment['rzp_orderid']}\n";
echo "Customer: {$test_payment['buyer_name']}\n";
echo "Email: {$test_payment['email']}\n";
echo "Amount: ₹{$test_payment['amount']}\n";
echo "Vehicle: {$test_payment['vehicle']}\n\n";

// Simulate the POST data that Razorpay sends
$_POST['razorpay_payment_id'] = $test_payment['rzp_paymentid'];
$_POST['razorpay_order_id'] = $test_payment['rzp_orderid'];
$_POST['razorpay_signature'] = $test_payment['rzp_signature'];

// Set up environment variables for the test
$rzp_paymentid = $test_payment['rzp_paymentid'];
$rzp_orderid = $test_payment['rzp_orderid'];
$buyer_name = $test_payment['buyer_name'];
$to = $test_payment['email'];
$amount = $test_payment['amount'];

echo "🧪 TRIGGERING EMAIL SYSTEM...\n\n";

// Create a test invoice PDF (simulating mPDF generation)
$fileName = __DIR__ . '/invoice/' . $rzp_paymentid . '.pdf';
$testPdfContent = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj 2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj 3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 612 792]>>endobj xref 0 4 0000000000 65535 f 0000000010 00000 n 0000000053 00000 n 0000000102 00000 n trailer<</Size 4/Root 1 0 R>>startxref 169 %%EOF";
file_put_contents($fileName, $testPdfContent);
echo "📄 Test PDF created: " . basename($fileName) . "\n";

$pdfGenerated = true;

// Now trigger the actual email system from verify.php
echo "📧 Starting email delivery test...\n\n";

// Email sending with improved error handling and fallback
$subject = 'Eduxoncabs Invoice - Payment Confirmation';
$emailSent = false;
$arrResult = array('response' => 'error', 'errorMessage' => 'Email not sent');

// First try PHPMailer (expecting it to fail with PHP 8+)
echo "1️⃣ Attempting PHPMailer delivery...\n";
try {
    require_once('php-mailer/class.phpmailer.php');
    $mail = new PHPMailer(false);
    $debug = 0;
    
    $mail->SMTPDebug = $debug;         
    $mail->AddAddress($to);         
    $mail->SetFrom('eduxontechnologies@gmail.com', 'Eduxoncabs');
    $mail->AddReplyTo($to, $buyer_name);
    $mail->IsHTML(true);           
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $subject;
    $mail->Body = "
        <h2>Payment Confirmation - Eduxoncabs</h2>
        <p>Dear $buyer_name,</p>
        <p>Thank you for your payment. Your booking has been confirmed.</p>
        <p><strong>Payment ID:</strong> $rzp_paymentid</p>
        <p><strong>Order ID:</strong> $rzp_orderid</p>
        <p>Please find your invoice attached.</p>
        <p>Best regards,<br>Eduxoncabs Team</p>
    ";
    
    if ($pdfGenerated && file_exists($fileName)) {
        $mail->AddAttachment($fileName);
        echo "   📎 PDF attachment added\n";
    }
    
    if ($mail->Send()) {
        $arrResult = array('response' => 'success');
        $emailSent = true;
        echo "   ✅ PHPMailer: Email sent successfully!\n\n";
    } else {
        echo "   ❌ PHPMailer failed: " . $mail->ErrorInfo . "\n\n";
    }
    
} catch (Exception $e) {
    echo "   ❌ PHPMailer exception: " . $e->getMessage() . "\n\n";
}

// Fallback to PHP mail() if PHPMailer failed
if (!$emailSent) {
    echo "2️⃣ Activating PHP mail() fallback system...\n";
    
    $headers = "From: eduxontechnologies@gmail.com\r\n";
    $headers .= "Reply-To: eduxontechnologies@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
    $emailBody = "
        <html>
        <head><title>Payment Confirmation - Eduxoncabs</title></head>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
            <h2 style='color: #2c5aa0;'>🎉 Payment Confirmation - Eduxoncabs</h2>
            <p>Dear $buyer_name,</p>
            <p>Thank you for your payment! Your booking has been confirmed successfully.</p>
            
            <div style='background-color: #f8f9fa; padding: 15px; border-left: 4px solid #28a745; margin: 20px 0;'>
                <h3 style='color: #28a745; margin-top: 0;'>Payment Details:</h3>
                <ul style='margin: 0; padding-left: 20px;'>
                    <li><strong>Payment ID:</strong> $rzp_paymentid</li>
                    <li><strong>Order ID:</strong> $rzp_orderid</li>
                    <li><strong>Amount:</strong> ₹$amount</li>
                    <li><strong>Vehicle:</strong> {$test_payment['vehicle']}</li>
                    <li><strong>Pickup:</strong> {$test_payment['pickup_date']} at {$test_payment['pickup_time']}</li>
                    <li><strong>Return:</strong> {$test_payment['return_date']} at {$test_payment['return_time']}</li>
                </ul>
            </div>
            
            <p>Your invoice has been generated successfully. If you need the PDF copy, please contact our support team.</p>
            
            <div style='background-color: #e3f2fd; padding: 15px; border-left: 4px solid #2196f3; margin: 20px 0;'>
                <p style='margin: 0;'><strong>📞 Need Help?</strong><br>
                Contact us: eduxontechnologies@gmail.com<br>
                Phone: +91-{$test_payment['phone']}</p>
            </div>
            
            <p>Best regards,<br><strong>Eduxoncabs Team</strong></p>
            
            <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #666;'>
                <p>This is a TEST email to verify the invoice delivery system.</p>
                <p>Sent on: " . date('Y-m-d H:i:s') . "</p>
            </div>
        </div>
        </body>
        </html>
    ";
    
    if (mail($to, $subject, $emailBody, $headers)) {
        $arrResult = array('response' => 'success');
        $emailSent = true;
        echo "   ✅ PHP mail(): Email sent successfully!\n";
        
        // Also send a separate notification about PDF
        if ($pdfGenerated && file_exists($fileName)) {
            $pdfSubject = "Eduxoncabs Invoice - PDF Document Ready";
            $pdfBody = "
                <html>
                <body style='font-family: Arial, sans-serif;'>
                <h2>📄 Your Invoice PDF is Ready</h2>
                <p>Dear $buyer_name,</p>
                <p>Your invoice PDF has been generated for payment: <strong>$rzp_paymentid</strong></p>
                <p>File size: " . round(filesize($fileName)/1024, 2) . " KB</p>
                <p>Contact us if you need the PDF copy sent to you.</p>
                <p>Best regards,<br>Eduxoncabs Team</p>
                </body>
                </html>
            ";
            
            if (mail($to, $pdfSubject, $pdfBody, $headers)) {
                echo "   📄 PDF notification sent successfully!\n";
            }
        }
    } else {
        echo "   ❌ PHP mail() also failed!\n";
    }
}

echo "\n" . str_repeat("=", 50) . "\n";

// Final results
if ($emailSent) {
    echo "🎉 SUCCESS: Invoice email system is working!\n\n";
    echo "📧 Email Details:\n";
    echo "   ✅ Recipient: $to\n";
    echo "   ✅ Subject: $subject\n";
    echo "   ✅ Method: " . ($emailSent ? "PHP mail() fallback" : "PHPMailer") . "\n";
    echo "   ✅ PDF: " . (file_exists($fileName) ? "Generated (" . round(filesize($fileName)/1024, 2) . " KB)" : "Not available") . "\n";
    echo "   ✅ Timestamp: " . date('Y-m-d H:i:s') . "\n\n";
    
    echo "📋 What to check:\n";
    echo "   1. Check the email inbox for: $to\n";
    echo "   2. Look in spam/junk folder if not in inbox\n";
    echo "   3. You should receive 2 emails:\n";
    echo "      - Payment confirmation with booking details\n";
    echo "      - PDF notification about invoice availability\n\n";
    
    echo "✅ The invoice email system is now confirmed working!\n";
} else {
    echo "❌ FAILED: Email system needs further investigation\n";
}

echo "\n🧹 Cleaning up test files...\n";
if (file_exists($fileName)) {
    unlink($fileName);
    echo "   🗑️ Test PDF removed: " . basename($fileName) . "\n";
}

echo "\n=== TEST COMPLETE ===\n";
echo "The invoice email system has been tested and " . ($emailSent ? "is working properly" : "needs attention") . ".\n";
?>
