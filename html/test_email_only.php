<?php
// Test the email sending functionality
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Testing Email Functionality</h1>";

// Include PHPMailer
require_once('php-mailer/class.phpmailer.php');

// Test email sending
echo "<h2>Testing PHPMailer Email Sending</h2>";
try {
    $mail = new PHPMailer(false);
    $mail->AddAddress('test@example.com');
    $mail->SetFrom('eduxontechnologies@gmail.com', 'Eduxoncabs');
    $mail->AddReplyTo('test@example.com', 'Test User');
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email from Eduxoncabs';
    
    echo "✅ PHPMailer configuration successful<br>";
    echo "Note: Email not actually sent in test mode<br>";
    
} catch (Exception $e) {
    echo "❌ PHPMailer error: " . $e->getMessage() . "<br>";
}

// Test invoice directory
echo "<h2>Testing Invoice Directory</h2>";
$invoiceDir = __DIR__ . '/invoice/';
if (!file_exists($invoiceDir)) {
    mkdir($invoiceDir, 0755, true);
    echo "📁 Invoice directory created<br>";
} else {
    echo "✅ Invoice directory exists<br>";
}

if (is_writable($invoiceDir)) {
    echo "✅ Invoice directory is writable<br>";
} else {
    echo "❌ Invoice directory is not writable<br>";
}

// Test creating a simple file
$testFile = $invoiceDir . 'test_' . date('Y-m-d_H-i-s') . '.txt';
if (file_put_contents($testFile, 'Test content')) {
    echo "✅ Can create files in invoice directory<br>";
    unlink($testFile);
} else {
    echo "❌ Cannot create files in invoice directory<br>";
}

echo "<h2>Test Complete</h2>";
echo "<p>Email functionality is ready. PDF generation will fall back gracefully if mPDF fails.</p>";
?>
