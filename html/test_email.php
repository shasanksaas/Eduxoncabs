<?php
// Test email delivery for shivp017@gmail.com
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log to a specific file
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/email_test.log');

// Include PHPMailer
require_once __DIR__ . '/php-mailer/class.phpmailer.php';
require_once __DIR__ . '/php-mailer/class.smtp.php';

// Test email configuration
$mail = new PHPMailer();
$mail->IsHTML(true);
$mail->SetFrom('noreply@eduxoncabs.com', 'Eduxon Cabs');
$mail->Subject = 'Test Email - Invoice Delivery Check';
$mail->AddAddress('shivp017@gmail.com', 'Shiv');

// Test if PDF exists
$pdfPath = __DIR__ . '/invoice/pay_Q6IyYZ1dc6wEpt.pdf';
if (file_exists($pdfPath)) {
    $mail->AddAttachment($pdfPath, 'invoice_Q6IyYZ1dc6wEpt.pdf');
    echo "PDF attachment found and added: " . $pdfPath . "\n";
} else {
    echo "PDF not found: " . $pdfPath . "\n";
}

$mail->Body = "
<h2>Test Email - Invoice Delivery Check</h2>
<p>This is a test email to verify if invoice emails are being delivered to shivp017@gmail.com</p>
<p>If you receive this email with PDF attachment, email delivery is working correctly.</p>
<p>Payment ID: Q6IyYZ1dc6wEpt</p>
<p>Timestamp: " . date('Y-m-d H:i:s') . "</p>
";

// Send email
echo "Attempting to send test email to shivp017@gmail.com...\n";
error_log("Test email attempt started for shivp017@gmail.com");

if ($mail->Send()) {
    echo "✅ SUCCESS: Test email sent successfully!\n";
    error_log("SUCCESS: Test email sent to shivp017@gmail.com");
} else {
    echo "❌ FAILED: " . $mail->ErrorInfo . "\n";
    error_log("FAILED: Email sending failed - " . $mail->ErrorInfo);
}

// Check recent transactions and verify if emails were sent
echo "\n--- Checking Recent Transactions for shivp017@gmail.com ---\n";
$recentPayments = [
    'pay_Q6HYKEwIfX4lz9' => '2025-03-13 12:54:44',
    'pay_Q6IyYZ1dc6wEpt' => '2025-03-13 14:18:17'
];

foreach ($recentPayments as $paymentId => $timestamp) {
    $invoicePath = __DIR__ . '/invoice/' . $paymentId . '.pdf';
    if (file_exists($invoicePath)) {
        $fileSize = round(filesize($invoicePath) / 1024, 2);
        echo "✅ Invoice PDF exists: {$paymentId}.pdf ({$fileSize} KB) - Created: " . date('Y-m-d H:i:s', filemtime($invoicePath)) . "\n";
    } else {
        echo "❌ Invoice PDF missing: {$paymentId}.pdf\n";
    }
}

echo "\n--- Email Log Check ---\n";
$logFile = __DIR__ . '/email_test.log';
if (file_exists($logFile)) {
    echo "Log entries:\n";
    echo file_get_contents($logFile);
} else {
    echo "No log file created yet.\n";
}
?>
