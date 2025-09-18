<?php
echo "=== REAL PAYMENT EMAIL MONITOR ===\n";
echo "Monitoring verify.php for real Razorpay payments...\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

// Let me enhance verify.php with real-time logging for your test
echo "🔧 ADDING ENHANCED LOGGING TO VERIFY.PHP...\n";

// First, let's check current error logs
echo "📋 CHECKING CURRENT ERROR LOGS:\n";
echo "----------------------------------------\n";

$error_log_paths = [
    '/var/log/apache2/error.log',
    '/var/log/nginx/error.log', 
    '/Applications/XAMPP/logs/error_log',
    '/opt/lampp/logs/error_log',
    ini_get('error_log'),
    './error.log'
];

$found_logs = false;
foreach ($error_log_paths as $log_path) {
    if (file_exists($log_path) && is_readable($log_path)) {
        echo "✅ Found log: $log_path\n";
        $found_logs = true;
        
        // Show last few lines
        $lines = file($log_path);
        if ($lines && count($lines) > 0) {
            echo "Last 3 entries:\n";
            $recent_lines = array_slice($lines, -3);
            foreach ($recent_lines as $line) {
                echo "  " . trim($line) . "\n";
            }
        }
        echo "\n";
        break; // Use first found log
    }
}

if (!$found_logs) {
    echo "⚠️  No accessible error logs found\n";
    echo "Creating custom log file...\n";
    
    // Create a custom log file
    $custom_log = './payment_debug.log';
    file_put_contents($custom_log, "=== Payment Debug Log Started ===\n" . date('Y-m-d H:i:s') . "\n\n", FILE_APPEND);
    echo "✅ Created: $custom_log\n";
}

echo "\n🔍 REAL-TIME PAYMENT MONITORING:\n";
echo "Now perform a real Razorpay payment...\n";
echo "I'll show you exactly what happens with emails:\n\n";

// Create a payment monitoring script
$monitor_script = '<?php
// Payment Email Monitor - Run this while making payments
date_default_timezone_set("Asia/Kolkata");

function logPaymentDebug($message) {
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = "[$timestamp] $message\n";
    file_put_contents("./payment_debug.log", $logMessage, FILE_APPEND);
    echo $logMessage;
}

logPaymentDebug("=== PAYMENT MONITOR STARTED ===");
logPaymentDebug("Monitoring for Razorpay payments and email sending...");

// Monitor the payment debug log in real-time
$logFile = "./payment_debug.log";
$lastSize = 0;

while (true) {
    if (file_exists($logFile)) {
        $currentSize = filesize($logFile);
        
        if ($currentSize > $lastSize) {
            // New content added
            $handle = fopen($logFile, "r");
            fseek($handle, $lastSize);
            $newContent = fread($handle, $currentSize - $lastSize);
            fclose($handle);
            
            echo $newContent;
            $lastSize = $currentSize;
        }
    }
    
    sleep(1); // Check every second
}
?>';

file_put_contents('./monitor_payments.php', $monitor_script);
echo "✅ Created payment monitor: monitor_payments.php\n\n";

echo "📧 NOW FOR REAL EMAIL TESTING:\n";
echo "1. Open another terminal and run: php monitor_payments.php\n";
echo "2. Make a real Razorpay payment on your site\n";
echo "3. Watch the monitor show real-time email sending\n\n";

echo "🔎 WHAT TO LOOK FOR:\n";
echo "- Payment verification success\n";
echo "- Email sending attempts\n";
echo "- PHPMailer vs fallback results\n";
echo "- Actual email delivery status\n\n";

// Let me also add specific debugging to verify.php
echo "🛠️  ADDING DEBUG LOGGING TO VERIFY.PHP...\n";

// Read the current verify.php to see where to add logging
$verify_content = file_get_contents('./verify.php');

// Check if our debug logging is already added
if (strpos($verify_content, 'PAYMENT_DEBUG_LOG') === false) {
    echo "Adding debug logging to verify.php...\n";
    
    // Add debug logging function at the top of verify.php
    $debug_function = '
// PAYMENT DEBUG LOGGING - Added for real payment testing
function debugLog($message) {
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = "[$timestamp] PAYMENT_DEBUG: $message\n";
    file_put_contents("./payment_debug.log", $logMessage, FILE_APPEND);
    error_log("PAYMENT_DEBUG: $message");
}
';
    
    // Insert after the first <?php tag
    $verify_content = str_replace('<?php', '<?php' . $debug_function, $verify_content);
    
    // Add debug calls before email sending
    $verify_content = str_replace(
        '// Email sending with improved error handling and fallback',
        'debugLog("Starting email sending process for payment: " . $payment_id);
                                        // Email sending with improved error handling and fallback'
    , $verify_content);
    
    $verify_content = str_replace(
        'error_log("PHPMailer: Invoice email sent successfully to: " . $to);',
        'error_log("PHPMailer: Invoice email sent successfully to: " . $to);
                                                debugLog("SUCCESS: PHPMailer sent email to: " . $to);'
    , $verify_content);
    
    $verify_content = str_replace(
        'error_log("PHP mail(): Invoice email sent successfully to: " . $to);',
        'error_log("PHP mail(): Invoice email sent successfully to: " . $to);
                                                debugLog("SUCCESS: PHP mail() sent email to: " . $to);'
    , $verify_content);
    
    // Save the enhanced verify.php
    file_put_contents('./verify.php', $verify_content);
    echo "✅ Enhanced verify.php with debug logging\n";
} else {
    echo "✅ Debug logging already present in verify.php\n";
}

echo "\n🎯 INSTRUCTIONS FOR REAL PAYMENT TEST:\n";
echo "1. Open terminal and run: php monitor_payments.php\n";
echo "2. Go to your website and make a real Razorpay payment\n";
echo "3. Use email: shashankmusicon@gmail.com\n";
echo "4. Watch the monitor show exactly what happens\n";
echo "5. Check payment_debug.log for detailed logs\n\n";

echo "💡 THIS WILL SHOW:\n";
echo "- If payment verification works\n";
echo "- If email code is triggered\n";
echo "- Why emails might not reach Gmail\n";
echo "- Complete debugging information\n\n";

echo "=== SETUP COMPLETE ===\n";
echo "Ready for real payment testing!\n";
?>
