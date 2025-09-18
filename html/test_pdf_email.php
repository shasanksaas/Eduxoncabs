<?php
// Test PDF generation and email sending
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include PHPMailer
require_once('php-mailer/class.phpmailer.php');

echo "<h1>Testing PDF Generation and Email Sending</h1>";

// Test 1: Check if mPDF library exists
echo "<h2>1. Testing mPDF Library</h2>";
if (file_exists(__DIR__ . '/MPDF/mpdf.php')) {
    echo "✅ mPDF library found<br>";
    require_once(__DIR__ . '/MPDF/mpdf.php');
    try {
        $mpdf = new mPDF();
        echo "✅ mPDF object created successfully<br>";
    } catch (Exception $e) {
        echo "❌ mPDF error: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ mPDF library not found<br>";
}

// Test 2: Check invoice directory
echo "<h2>2. Testing Invoice Directory</h2>";
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

// Test 3: Create a simple PDF
echo "<h2>3. Testing PDF Creation</h2>";
try {
    $html = '<h1>Test Invoice</h1><p>This is a test PDF for invoice functionality.</p>';
    $mpdf->WriteHTML($html);
    $testFileName = $invoiceDir . 'test_' . date('Y-m-d_H-i-s') . '.pdf';
    $mpdf->Output($testFileName, 'F');
    
    if (file_exists($testFileName)) {
        echo "✅ Test PDF created successfully: " . basename($testFileName) . " (Size: " . filesize($testFileName) . " bytes)<br>";
    } else {
        echo "❌ Test PDF was not created<br>";
    }
} catch (Exception $e) {
    echo "❌ PDF creation error: " . $e->getMessage() . "<br>";
}

// Test 4: Check PHPMailer
echo "<h2>4. Testing PHPMailer</h2>";
try {
    $mail = new PHPMailer(false);
    echo "✅ PHPMailer object created successfully<br>";
    
    // Test basic settings
    $mail->SetFrom('test@eduxoncabs.com', 'Test Sender');
    $mail->AddAddress('test@example.com');
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email';
    
    if (isset($testFileName) && file_exists($testFileName)) {
        $mail->AddAttachment($testFileName);
        echo "✅ PDF attachment added to email<br>";
    }
    
    echo "✅ Email configuration completed (not sent in test mode)<br>";
    
} catch (Exception $e) {
    echo "❌ PHPMailer error: " . $e->getMessage() . "<br>";
}

// Test 5: Check error logs
echo "<h2>5. Recent Error Logs</h2>";
$errorLog = ini_get('error_log');
if ($errorLog && file_exists($errorLog)) {
    $logs = file_get_contents($errorLog);
    $recentLogs = array_slice(explode("\n", $logs), -10);
    echo "<pre>" . implode("\n", $recentLogs) . "</pre>";
} else {
    echo "Error log not found or not configured<br>";
}

echo "<h2>Test Complete</h2>";
echo "<p>If all tests pass, the PDF email functionality should work correctly.</p>";
?>
