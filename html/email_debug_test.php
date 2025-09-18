<?php
echo "=== EMAIL DEBUG TEST ===\n";
echo "Current time: " . date('Y-m-d H:i:s') . "\n\n";

// Test email configuration
$to = "shivp017@gmail.com";
$subject = "TEST EMAIL - Debug Check " . date('H:i:s');

echo "📧 TESTING EMAIL SENDING...\n";
echo "To: $to\n";
echo "Subject: $subject\n\n";

// Create test email content
$message = "
<html>
<head>
    <title>Email Debug Test</title>
</head>
<body>
    <h2>🔍 EMAIL DEBUG TEST</h2>
    <p><strong>Test Time:</strong> " . date('Y-m-d H:i:s') . "</p>
    <p><strong>Server:</strong> " . $_SERVER['SERVER_NAME'] ?? 'localhost' . "</p>
    <p><strong>PHP Version:</strong> " . phpversion() . "</p>
    <p>This is a test email to verify the email system is working.</p>
    <hr>
    <p><em>If you receive this email, the system is working correctly!</em></p>
</body>
</html>
";

// Headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: EduxonCabs <noreply@eduxoncabs.com>\r\n";
$headers .= "Reply-To: support@eduxoncabs.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

echo "📤 SENDING EMAIL...\n";

// Try to send email
$result = mail($to, $subject, $message, $headers);

if ($result) {
    echo "✅ EMAIL SENT SUCCESSFULLY!\n";
    echo "Result: " . ($result ? "TRUE" : "FALSE") . "\n";
} else {
    echo "❌ EMAIL FAILED TO SEND!\n";
    echo "Result: " . ($result ? "TRUE" : "FALSE") . "\n";
    
    // Check for error details
    $error = error_get_last();
    if ($error) {
        echo "Last Error: " . $error['message'] . "\n";
    }
}

echo "\n=== EMAIL CONFIGURATION CHECK ===\n";

// Check mail configuration
echo "📋 MAIL CONFIGURATION:\n";
echo "sendmail_path: " . ini_get('sendmail_path') . "\n";
echo "SMTP: " . ini_get('SMTP') . "\n";
echo "smtp_port: " . ini_get('smtp_port') . "\n";
echo "mail.add_x_header: " . ini_get('mail.add_x_header') . "\n";

echo "\n=== EMAIL CONTENT PREVIEW ===\n";
echo "📝 EMAIL THAT WAS SENT:\n";
echo "----------------------------------------\n";
echo "To: $to\n";
echo "Subject: $subject\n";
echo "Headers:\n$headers\n";
echo "Message:\n$message\n";
echo "----------------------------------------\n";

echo "\n=== TEST COMPLETE ===\n";
echo "Check your email inbox for: $to\n";
echo "Subject line should be: $subject\n";
?>
