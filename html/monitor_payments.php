<?php
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
?>