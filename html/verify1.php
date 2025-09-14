<?php

require('config.php');
session_start();

require('razorpay-php/Razorpay.php');
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
require_once("sendsms.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$db = new SiteData();
$dbObj = new dbquery();
$success = false;
$error = "Payment Failed";

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
                                // $payment_status = $payment['status'];
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
                                $vehicle_id = $_SESSION['vehicle_id'];
                                $order_id=$_SESSION['razorpay_order_id'];


                                $chk_mojo_id = $dbObj->countRec("tbl_order", "payment_id = '$payment_id'");
                                if ($chk_mojo_id > 0) {
                                    ?>
                                    <script>alert("Sorry !! payment made already for further notification please contact service provider");</script>
                                    <?php
                                } else {

                                    if ($payment_status == "Failed") {
                                        $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = '$status'", "`order_id` = '$order_id'");
                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");

                                        $get_location_data = $dbObj->fetch_data("location", "city_id =".$dta[0]['pickup_point']);
                                        
                                        echo '<h3 style="color:#ff0000">Sorry , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $payment['id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $payment['notes']['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $payment['notes']['email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " .$get_location_data[0]['pickup_point']. "</h4>" ;
                                        echo "<h4>Total Cost  : " . $payment['amount']/100 . "</h4>";
                                    } else {

                                    $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = '$status'", "`order_id` = '$order_id'");


                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");
                                        $dbObj->insertToDb("tbl_unavail_dtes", " type = '2', bike_id = '" . $dta[0]['bike_id'] . "', unavail_dte = '" . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "', unavail_dte_to = '" . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "'");

                                        $get_location_data = $dbObj->fetch_data("location", "city_id =".$dta[0]['pickup_point']);

                                        echo '<h3 style="color:#6da552">Thank You , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $payment['id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $payment['notes']['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $payment['notes']['email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " .$get_location_data[0]['pickup_point']. "</h4>" ;
                                        echo "<h4>Total Cost  : " . $payment['amount']/100 . "</h4>";


                                        $to = $payment['buyer_email'];
                                        $from = "eduxontechnologies@gmail.com"; 
                                        $subject = "Booking Confirmation";
                                        $headers .= "From: $from" . "\r\n";
                                        $messagebody = "Dear Customer, \r\n \r\n"
                                                . "Thank you for choosing our service. Your Booking details are \r\n \r\n"
                                                . "Name : $buyer_name,\r\n"
                                                . "Mobile no :$phone \r\n"
                                                . "Book From Date Time:" . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . " \r\n"
                                                . "To date Time : " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . " \r\n"
                                                . "Pickup Point :".$get_location_data[0]['pickup_point']." \r\n"
												. "Booked Bike :".$dta[0]['booked_car']." \r\n"
                                                . "Amount : " . $payment['amount']/100;

                                        //Send mail
                                        mail($to, $subject, $messagebody, $headers);

                                        $bike = $dta[0]['booked_car'];
                                             $frmDate = $dta[0]['booked_dte'].' '.$dta[0]['booked_tme'];
                                             $toDate = $dta[0]['returned_dte'].' '.$dta[0]['return_tme'];
                                             $bookingPrice = $payment['amount']/100;
                                             $bookingID = $dta[0]['id'];

                                             $sms = "Booking confirm, Booking ID-$bookingID, Your $bike Booking from $frmDate to $toDate Total Price Rs.$bookingPrice";
                                             $phone_number = $dta[0]['phone'];
                                             sendsms($phone_number,$sms);
                                    }
                                }
                            } catch (Exception $e) {

                                print('Error: ' . $e->getMessage());
                            }
                            ?>

                        </div>

                    </div>

                </div>

                            <?php unset($_SESSION['trvlDte']);
                            unset($_SESSION['trvltme']);
                            unset($_SESSION['retnDte']);
                            unset($_SESSION['retntme']);
                            unset($_SESSION['vehicle_id']);
                            session_destroy(); ?>

                            <?php include("includes/site-footer.php"); ?>

            </div>

                            <?php include("includes/inc-js.php"); ?>



        </body>

    </html>

                <?php
            } else {

                header("location:index.php");
            }
            ?>