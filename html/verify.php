<?php
require('config.php'); // Load API keys
require('razorpay-php/Razorpay.php');
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
require_once("sendsms.php");

use Mpdf\Mpdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');
// echo "hi";





use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

session_start();

$success = false;
$error = "Payment Failed";

$db = new SiteData();
$dbObj = new dbquery();
if (!empty($_GET['payment_id']) && !empty($_GET['payment_signature']) && !empty($_SESSION['razorpay_order_id'])) {
    $api = new Api($keyId, $keySecret);
    $payment = $api->order->fetch($_SESSION['razorpay_order_id']);

        $payment_id = $_GET['payment_id'];
        $payment = $api->payment->fetch($payment_id);

    try {
        $attributes = [
            'razorpay_order_id'   => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_GET['payment_id'],
            'razorpay_signature'  => $_GET['payment_signature']
        ];

        $api->utility->verifyPaymentSignature($attributes);
        $success = true;
    } catch (SignatureVerificationError $e) {
        $error = 'Razorpay Error: ' . $e->getMessage();
    }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Checkout | Eduxoncabs.com</title>
            <meta name="keywords" content="Eduxoncabs.com" />
            <meta name="description" content="Eduxoncabs.com">
            <meta name="author" content="Eduxoncabs.com">
            <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
            <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
            <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
            <?php include("includes/inc-css.php"); ?>
        </head>

        <body>

            <div class="body">

                <?php include("includes/site-header-inner.php"); ?>

                <div role="main" class="main">



                    <div class="container">

                        <div class="row">



                            <?php


                            try {
                                $payment_id = $payment['id'];
                                $payment_status = ($payment['status']=="captured")?"Completed":$payment['status'];
                                $buyer_name = $payment['notes']['buyer_name'];
                                $email = $payment['notes']['email'];
                                $phone = $payment['notes']['phone'];
                                $amount = $payment['amount']/100;
                                $booked_car = $payment['notes']['purpose'];
                                // $status = $payment['status'];
                                $status = ($payment['status']=="captured")?"Completed":$payment['status'];
                                $booked_dte = $_SESSION['trvlDte'];
                                $booked_tme = $_SESSION['trvltme'];
                                $returned_dte = $_SESSION['retnDte'];
                                $returned_tme = $_SESSION['retntme'];
                                $car_id = $_SESSION['vehicle_id'];
                                $order_id=$_SESSION['razorpay_order_id'];

                                $chk_mojo_id = $dbObj->countRec("tbl_order",  "payment_id = '$payment_id'");
                                if ($chk_mojo_id > 0) {
                                    ?>
                                    <script>alert("Sorry !! payment made already for further notification please contact service provider");</script>
                                    <?php
                                } else {

                                    if ($payment_status == "Failed") {
                                        $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = '$status'", "`order_id` = '$order_id'");
                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");

                                        $get_location_data = $dbObj->fetch_data("location", "id =" . $dta[0]['pickup_point']);

                                        echo '<h3 style="color:#ff0000">Sorry , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $payment['id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $payment['notes']['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $payment['notes']['email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " . $get_location_data[0]['pickup_point'] . "</h4>";
                                        echo "<h4>Total Cost  : " . $payment['amount']/100 . "</h4>";

                                        $car = $dta[0]['booked_car'];
                                        $frmDate = $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'];
                                        $toDate = $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'];
                                        $bookingPrice = $payment['amount']/100;
                                        $bookingID = $dta[0]['id'];

                                        unlink($_SESSION['filename']);
                                    } else {
                                        $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', `status` = '$status'","`order_id` = '$order_id'");
                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");
                                        $dbObj->insertToDb("tbl_unavail_dtes", "type = '1',car_id = '" . $dta[0]['car_id'] . "', unavail_dte = '" . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "', unavail_dte_to = '" . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "'");
                                        
                                        $get_car_dtls = $dbObj->fetch_data("tbl_cabs", "id = $car_id");
                                        $cab_cost = $get_car_dtls[0]['cost'];
                                        $weekend_cost = $get_car_dtls[0]['weekend_cost'];
                                        $get_location_data = $dbObj->fetch_data("location", "id =" . $dta[0]['pickup_point']);

                                        echo '<h3 style="color:#6da552">Thank You , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $payment['id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $payment['notes']['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $payment['notes']['email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " . $get_location_data[0]['pickup_point'] . "</h4>";
                                        echo "<h4>Total Cost  : " . $payment['amount']/100 . "</h4>";



                                        $to = $payment['notes']['email'];
                                        $from = "eduxontechnologies@gmail.com";
                                        $subject = "Booking Confirmation";
                                        $headers .= "From: $from" . "\r\n";
                                        $messagebody = "Dear Customer, \r\n \r\n"
                                                . "Thank you for choosing our service. Your Booking details are \r\n \r\n"
                                                . "Name : $buyer_name,\r\n"
                                                . "Mobile no :$phone \r\n"
                                                . "Book From Date Time:" . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . " \r\n"
                                                . "To date Time : " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . " \r\n"
                                                . "Pickup Point :" . $get_location_data[0]['pickup_point'] . " \r\n"
                                                . "Booked Car :" . $dta[0]['booked_car'] . " \r\n"
                                                . "Amount : " . $payment['amount']/100;

                                        mail($to, $subject, $messagebody, $headers);
                                        $car = $dta[0]['booked_car'];
                                        $frmDate = $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'];
                                        $toDate = $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'];
                                        $bookingPrice = $payment['amount']/100;
                                        $bookingID = $dta[0]['id'];

                                        $sms = "Booking confirm, Booking ID-$bookingID, Your $car Booking from $frmDate to $toDate Total Price Rs.$bookingPrice";
                                        $phone_number = $dta[0]['phone'];
                                        sendsms($phone_number, $sms);

                                        $regulardayHour = $dta[0]['regulardayhour'];
                                        $regulardayAmount = $dta[0]['regulardayamount'];
                                        $weekendHour = $dta[0]['weekendhour'];
                                        $weekendAmount = $dta[0]['weekendamount'];
                  
                                        $regularRow="";
                                        $weekendRow="";

                                       if($regulardayHour>0){
                                               $regularRow = '<tr class="item last">
                                                    <td>
                                                        Toatl Regular Days Hour
                                                    </td>

                                                    <td>
                                                        '. $regulardayHour .'hour total '.$regulardayAmount .'
                                                    </td>
                                                </tr>';
                                       }
                                       if($weekendHour>0){
                                               $weekendRow = '<tr class="item last">
                                                    <td>
                                                        Toatl Weekend Hour
                                                    </td>

                                                    <td>
                                                        '. $weekendHour.'hour total '.$weekendAmount .'
                                                    </td>
                                                </tr>';
                                       }


                                        $html = '<div class="invoice-box">
                                            <table cellpadding="0" cellspacing="0">
                                                <tr class="top">
                                                    <td colspan="2">
                                                        <table width="446">
                                                            <tr>
                                                                <td width="217" class="title">
                                                                    <img src="https://www.eduxoncabs.com/img/Eduxoncabs.png" style="width:102px;height:35px;">                                      </td>

                                                                <td width="217" style="font-weight:bold;">
                                                                    Invoice No: ' . $bookingID . '<br>
                                                                    Booking Date: ' . $frmDate . '<br>
                                                                    <span style="font-size:16px;">Booking For:' . $car . '</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr class="information">
                                                    <td colspan="2">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <strong style="color:#6C0D12;"> Company Address</strong><br> Room No:116,Bharati Tower,<br> Forest Park,Aerodrome Area,<br> Bhubaneswar, Odisha 751020 </td>

                                                                <td>
                                                                    <strong style="color:#6C0D12;">Billing To</strong><br>Name:' . $buyer_name . '<br>
                                                                    Contct No:' . $phone_number . '<br>
                                                                    Email:' . $to . '
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>     
                                            <table width="460">
                                                <tr class="heading" style="width:50%;">
                                                    <td width="222"> Rental Duration </td>

                                                    <td width="226"> Delivery Location </td>
                                                </tr>


                                                <tr class="details" style="width:50%;">
                                                    <td>
                                                        <span style="font-weight:bold;">From:</span>' . $frmDate . ' </br><span style="font-weight:bold;">To:</span> ' . $toDate . '
                                                    </td>

                                                    <td>'. $get_location_data[0]["pickup_point"] .'</td>
                                                </tr>
                                            </table>
                                            <table width="461">
                                                <tr class="heading" style="background:#6C0D12; width:100%;">
                                                    <td  style="width:100%;background:#6C0D12; text-align:center;">
                                                        Order Summary</td>
                                                </tr>
                                            </table>
                                            <table>            
                                                <tr class="item">
                                                    <td>  Vehicle Type: </td>

                                                    <td>
                                                        Car

                                                    </td>
                                                </tr>

                                                <tr class="item">
                                                    <td>
                                                        Vehicle Name:
                                                    </td>

                                                    <td>
                                                        ' . $car . ' 
                                                    </td>
                                                </tr>

                                                <tr class="item">
                                                    <td>
                                                        Price For 24 Hours Regular days:
                                                    </td>

                                                    <td>
                                                        Rs.' . $cab_cost . '
                                                    </td>
                                                </tr>

                                                <tr class="item">
                                                    <td>
                                                        Price For 24 Hours Weekend days:
                                                    </td>

                                                    <td>
                                                        Rs.' . $weekend_cost . '
                                                    </td>
                                                </tr>
                                                 '. $regularRow.' '. $weekendRow .'

                                                <tr class="total">
                                                    <td></td>

                                                    <td>
                                                        Total:Rs.' . $payment['amount']/100 . '
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td></td>

                                                    <td>
                                                        Payment Received:Rs.' . $payment['amount']/100 . '
                                                    </td>
                                                </tr>
                                            </table>

                                            <table style="margin-top:20px;">
                                                <tr class="information">
                                                <tr>
                                                    <td style="width:100%;"><span style="font-weight:bold; color:#6C0D12; font-size:17px;">Terms & Conditions</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Please read carefully from Eduxoncabs Website/App all terms & conditions before vehicle Pickup</td>
                                                </tr>
                                                </tr>
                                            </table>

                                        </div>';

                                       
                                        // require_once( 'MPDF/mpdf.php');
                                        
                                        require_once __DIR__ . '/mpdf/vendor/autoload.php';
                                        $mpdf = new Mpdf();


                                        $stylesheet = file_get_contents('pdf.css');
                                        // $stylesheet = '<style>' . file_get_contents('pdf.css') . '</style>';

                                        $mpdf->writeHTML($stylesheet, 1);
                                        $mpdf->writeHTML($html, 2);
                                        $fileName = __DIR__ . '/invoice/'.$payment_id . '.pdf';
                                        $mpdf->Output($fileName, 'F');
                                        $subject = 'Eduxoncabs Invoice';
                                        $message = 'Invoice for your booking at Eduxoncabs';
                                        $mail = new PHPMailer(true);
                                        $debug = 0;
                                        try {

                                        $mail->SMTPDebug = $debug;         

                                        $mail->AddAddress($to);         

                                        $mail->SetFrom('eduxontechnologies@gmail.com', 'Eduxoncabs');
                                        $mail->AddReplyTo($to, $buyer_name);

                                        $mail->IsHTML(true);           
                                        $mail->CharSet = 'UTF-8';

                                        $mail->Subject = $subject;
                                        $mail->Body = $message;
                                        $mail->addAttachment($fileName);
                                            $mail->Send();
                                            $arrResult = array('response' => 'success');
                                        } catch (phpmailerException $e) {
                                            $arrResult = array('response' => 'error', 'errorMessage' => $e->errorMessage());
                                            $arrResult = array('response' => 'error', 'errorMessage' => $e->errorMessage());
                                        } catch (Exception $e) {
                                            $arrResult = array('response' => 'error', 'errorMessage' => $e->getMessage());
                                        }
                                    }
                                }
                            } catch (Exception $e) {

                                print('Error: ' . $e->getMessage());
                            }
                            ?>

                        </div>

                    </div>

                </div>

                <?php
                unset($_SESSION['trvlDte']);
                unset($_SESSION['trvltme']);
                unset($_SESSION['retnDte']);
                unset($_SESSION['retntme']);
                unset($_SESSION['vehicle_id']);
                session_destroy();
                ?>

    <?php include("includes/site-footer.php"); ?>

            </div>

    <?php include("includes/inc-js.php"); ?>



        </body>

    </html>
    
        <?php
} else {

    header("location:index.php");
}

