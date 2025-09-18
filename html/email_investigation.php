<?php
// Simple email test without attachments first
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== Email Delivery Investigation for shivp017@gmail.com ===\n\n";

// Check if mail function works
echo "1. Testing basic PHP mail function...\n";
$to = 'shivp017@gmail.com';
$subject = 'Test Email - Simple Mail Function';
$message = 'This is a test email to check if basic PHP mail() function works.';
$headers = 'From: noreply@eduxoncabs.com' . "\r\n" .
           'Content-Type: text/html; charset=UTF-8' . "\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "✅ PHP mail() function executed successfully\n";
} else {
    echo "❌ PHP mail() function failed\n";
}

// Check mail configuration
echo "\n2. Checking PHP mail configuration...\n";
echo "sendmail_path: " . ini_get('sendmail_path') . "\n";
echo "SMTP: " . ini_get('SMTP') . "\n";
echo "smtp_port: " . ini_get('smtp_port') . "\n";

// Check recent transactions
echo "\n3. Recent transactions for shivp017@gmail.com:\n";
$payments = [
    'pay_Q6HYKEwIfX4lz9' => [
        'amount' => '7901',
        'date' => '2025-03-13 12:54:44',
        'vehicle' => 'Renault Kwid( Automatic)'
    ],
    'pay_Q6IyYZ1dc6wEpt' => [
        'amount' => '272',
        'date' => '2025-03-13 14:18:17', 
        'vehicle' => 'Hyundai Santro Sptz(New Version)'
    ]
];

foreach ($payments as $paymentId => $details) {
    echo "\nPayment ID: {$paymentId}\n";
    echo "Amount: ₹{$details['amount']}\n";
    echo "Date: {$details['date']}\n";
    echo "Vehicle: {$details['vehicle']}\n";
    
    // Check if invoice PDF exists
    $pdfPath = __DIR__ . '/invoice/' . $paymentId . '.pdf';
    if (file_exists($pdfPath)) {
        $fileSize = round(filesize($pdfPath) / 1024, 2);
        $createdTime = date('Y-m-d H:i:s', filemtime($pdfPath));
        echo "Invoice PDF: ✅ EXISTS ({$fileSize} KB) - Created: {$createdTime}\n";
    } else {
        echo "Invoice PDF: ❌ MISSING\n";
    }
}

// Check verify.php for email logs
echo "\n4. Checking verify.php for email logging...\n";
$verifyPath = __DIR__ . '/verify.php';
if (file_exists($verifyPath)) {
    $verifyContent = file_get_contents($verifyPath);
    $logCount = substr_count($verifyContent, 'error_log');
    echo "Found {$logCount} error_log statements in verify.php\n";
    
    // Check if email sending code exists
    if (strpos($verifyContent, 'PHPMailer') !== false) {
        echo "✅ PHPMailer usage found in verify.php\n";
    }
    if (strpos($verifyContent, 'mail(') !== false) {
        echo "✅ PHP mail() usage found in verify.php\n";
    }
    if (strpos($verifyContent, 'AddAttachment') !== false) {
        echo "✅ PDF attachment code found in verify.php\n";
    }
} else {
    echo "❌ verify.php not found\n";
}

// Check for any email-related error logs
echo "\n5. Looking for error logs...\n";
$logFiles = glob(__DIR__ . '/*.log');
if (!empty($logFiles)) {
    foreach ($logFiles as $logFile) {
        echo "Found log file: " . basename($logFile) . "\n";
    }
} else {
    echo "No .log files found in current directory\n";
}

// Test SMTP connectivity
echo "\n6. Testing SMTP connectivity...\n";
$smtp_servers = ['localhost', 'smtp.gmail.com', 'smtp-mail.outlook.com'];
foreach ($smtp_servers as $server) {
    $connection = @fsockopen($server, 25, $errno, $errstr, 5);
    if ($connection) {
        echo "✅ SMTP connection to {$server}:25 successful\n";
        fclose($connection);
    } else {
        echo "❌ SMTP connection to {$server}:25 failed: {$errstr}\n";
    }
}

echo "\n=== Investigation Complete ===\n";
?>
