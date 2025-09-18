<?php
/**
 * Background PDF Invoice Generator
 * This script generates and emails PDF invoices for completed payments
 * Can be called asynchronously or via cron job
 */

require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");

use Mpdf\Mpdf;

require_once('php-mailer/class.phpmailer.php');
require_once('php-mailer/class.smtp.php');

// Get payment ID from command line or GET parameter
$payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : (isset($argv[1]) ? $argv[1] : null);

if (!$payment_id) {
    die("Payment ID is required\n");
}

$dbObj = new dbquery();

try {
    // Fetch payment and booking details
    $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");
    
    if (empty($dta)) {
        die("No booking found for payment ID: $payment_id\n");
    }
    
    $get_location_data = $dbObj->fetch_data("location", "id = " . $dta[0]['pickup_point']);
    $get_car_dtls = $dbObj->fetch_data("tbl_cabs", "id = " . $dta[0]['car_id']);
    
    $buyer_name = $dta[0]['booked_car']; // This should be buyer name from payment
    $email = $dta[0]['booked_car']; // This should be email from payment
    $car = $dta[0]['booked_car'];
    $frmDate = $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'];
    $toDate = $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'];
    $bookingPrice = $dta[0]['total_amount'] ?? 0;
    $bookingID = $dta[0]['id'];
    
    // Generate PDF HTML content
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Invoice - ' . $payment_id . '</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
            .invoice-header { text-align: center; margin-bottom: 30px; }
            .invoice-details { margin: 20px 0; }
            .detail-row { padding: 8px 0; border-bottom: 1px solid #eee; }
            .total { font-weight: bold; font-size: 18px; color: #d32f2f; }
        </style>
    </head>
    <body>
        <div class="invoice-header">
            <h1>EDUXONCABS</h1>
            <h2>Booking Invoice</h2>
        </div>
        
        <div class="invoice-details">
            <div class="detail-row"><strong>Payment ID:</strong> ' . $payment_id . '</div>
            <div class="detail-row"><strong>Booking ID:</strong> ' . $bookingID . '</div>
            <div class="detail-row"><strong>Vehicle:</strong> ' . $car . '</div>
            <div class="detail-row"><strong>From:</strong> ' . $frmDate . '</div>
            <div class="detail-row"><strong>To:</strong> ' . $toDate . '</div>
            <div class="detail-row"><strong>Pickup Location:</strong> ' . $get_location_data[0]['pickup_point'] . '</div>
            <div class="detail-row total"><strong>Total Amount:</strong> ₹' . $bookingPrice . '</div>
        </div>
        
        <div style="margin-top: 40px;">
            <p><strong>Terms & Conditions:</strong></p>
            <p>Please read carefully from Eduxoncabs Website/App all terms & conditions before vehicle Pickup</p>
        </div>
    </body>
    </html>';
    
    // Generate PDF
    require_once __DIR__ . '/mpdf/vendor/autoload.php';
    $mpdf = new Mpdf();
    
    $stylesheet = file_get_contents('pdf.css');
    $mpdf->writeHTML($stylesheet, 1);
    $mpdf->writeHTML($html, 2);
    
    $fileName = __DIR__ . '/invoice/' . $payment_id . '.pdf';
    $mpdf->Output($fileName, 'F');
    
    // Send email with PDF attachment
    $mail = new PHPMailer(true);
    
    try {
        $mail->AddAddress($email);
        $mail->SetFrom('eduxontechnologies@gmail.com', 'Eduxoncabs');
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Eduxoncabs - Detailed Invoice';
        $mail->Body = 'Please find attached your detailed booking invoice.';
        $mail->addAttachment($fileName);
        $mail->Send();
        
        echo "PDF invoice generated and sent successfully for payment ID: $payment_id\n";
        
    } catch (Exception $e) {
        echo "Email sending failed: " . $e->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "Error generating PDF: " . $e->getMessage() . "\n";
}
?>
