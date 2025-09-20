<?php
/**
 * Fast2SMS Webhook Handler for EduxonCabs
 * 
 * This file receives delivery status updates from Fast2SMS
 * and logs them for monitoring SMS delivery success rates.
 * 
 * Webhook URL: https://yourdomain.com/sms-webhook.php
 */

// Include configuration
require_once("includes/sms-config.php");

// Set content type for JSON response
header('Content-Type: application/json');

// Function to log webhook data
function logWebhookData($data, $type = 'info') {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[$timestamp] [$type] SMS Webhook: " . json_encode($data) . "\n";
    file_put_contents('logs/sms-webhook.log', $log_entry, FILE_APPEND | LOCK_EX);
}

// Function to send response
function sendResponse($success = true, $message = 'OK') {
    echo json_encode(array(
        'status' => $success ? 'success' : 'error',
        'message' => $message,
        'timestamp' => time()
    ));
    exit;
}

try {
    // Get the webhook data
    $json_input = file_get_contents('php://input');
    
    if (empty($json_input)) {
        logWebhookData(['error' => 'Empty webhook payload'], 'error');
        sendResponse(false, 'Empty payload');
    }
    
    // Decode JSON data
    $webhook_data = json_decode($json_input, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        logWebhookData(['error' => 'Invalid JSON', 'payload' => $json_input], 'error');
        sendResponse(false, 'Invalid JSON');
    }
    
    // Log the received webhook data
    logWebhookData($webhook_data, 'received');
    
    // Process SMS reports
    if (isset($webhook_data['sms_reports']) && is_array($webhook_data['sms_reports'])) {
        foreach ($webhook_data['sms_reports'] as $report) {
            $request_id = $report['request_id'] ?? 'unknown';
            $route = $report['route'] ?? 'unknown';
            
            // Process delivery status for each SMS in the report
            if (isset($report['delivery_status']) && is_array($report['delivery_status'])) {
                foreach ($report['delivery_status'] as $delivery) {
                    $mobile = $delivery['mobile'] ?? 'unknown';
                    $status = $delivery['status'] ?? 'unknown';
                    $status_description = $delivery['status_description'] ?? '';
                    $amount_debited = $delivery['amount_debited'] ?? '0';
                    $sent_time = $delivery['sent_time'] ?? '';
                    $delivery_time = $delivery['delivery_time'] ?? '';
                    
                    // Log individual delivery status
                    logWebhookData([
                        'request_id' => $request_id,
                        'mobile' => $mobile,
                        'status' => $status,
                        'description' => $status_description,
                        'amount' => $amount_debited,
                        'sent' => $sent_time,
                        'delivered' => $delivery_time
                    ], 'delivery');
                    
                    // You can add database updates here to track delivery status
                    // For example, update a delivery_status table:
                    /*
                    require_once("includes/db_connection.php");
                    if (!$mysqli_conn->connect_error) {
                        $stmt = $mysqli_conn->prepare("INSERT INTO sms_delivery_log (request_id, mobile, status, status_description, amount_debited, sent_time, delivery_time, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                        $stmt->bind_param("sssssss", $request_id, $mobile, $status, $status_description, $amount_debited, $sent_time, $delivery_time);
                        $stmt->execute();
                        $stmt->close();
                        $mysqli_conn->close();
                    }
                    */
                }
            }
        }
    }
    
    // Send success response to Fast2SMS
    sendResponse(true, 'Webhook processed successfully');
    
} catch (Exception $e) {
    // Log any errors
    logWebhookData(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 'error');
    sendResponse(false, 'Internal error');
}
?>
