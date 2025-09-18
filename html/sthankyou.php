<?php
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
require_once("sendsms.php");

$db = new SiteData();
$dbObj = new dbquery();
   $mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}
if ((filter($_GET['payment_id'],$mysqli_conn) != "") && filter($_GET['payment_request_id'],$mysqli_conn) != "") {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <!-- Basic -->
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Checkout | Eduxoncabs.com</title>
            <meta name="keywords" content="Eduxoncabs.com" />
            <meta name="description" content="Eduxoncabs.com">
            <meta name="author" content="Eduxoncabs.com">
            <!-- Favicon -->
            <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
            <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
            <!-- Mobile Metas -->
            <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <!-- Web Fonts  -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
            <!-- Vendor CSS -->
            <?php include("includes/inc-css.php"); ?>
        </head>

        <body>

            <div class="body">

                <?php include("includes/site-header-inner.php"); ?>

                <div role="main" class="main">



                    <div class="container">

                        <div class="row">



                            <?php
                            include 'src/instamojo.php';

                            $api = new Instamojo\Instamojo('1bf34c6da1ee6614445663e65365231a', 'f7d8746ab010d43828996a63a79977cd', 'https://www.instamojo.com/api/1.1/');

                            $payid = $_GET["payment_request_id"];


                            try {
                                $response = $api->paymentRequestStatus($payid);




                                //echo "<pre>";
                                //print_r($response); exit;
                                //echo "</pre>";
                                $payment_id = $response['payments'][0]['payment_id'];
                                $payment_status = $response['payments'][0]['status'];
                                $buyer_name = $response['buyer_name'];
                                $email = $response['email'];
                                $phone = $response['phone'];
                                $amount = $response['amount'];
                                $booked_car = $response['purpose'];
                                $status = $response['status'];
                                $booked_dte = $_SESSION['trvlDte'];
                                $booked_tme = $_SESSION['trvltme'];
                                $returned_dte = $_SESSION['retnDte'];
                                $returned_tme = $_SESSION['retntme'];
                                $vehicle_id = $_SESSION['vehicle_id'];

                                $chk_mojo_id = $dbObj->countRec("tbl_order", "payment_id = '$payment_id'");
                                if ($chk_mojo_id > 0) {
                                    ?>
                                    <script>alert("Sorry !! payment made already for further notification please contact service provider");</script>
                                    <?php
                                } else {

                                    if ($payment_status == "Failed") {
                                        //$ins_dta = $dbObj->insertToDb("tbl_order","`payment_id` = '$payment_id',`buyer_name`='$buyer_name',`email`='$email',`phone`='$phone',`amount`='$amount',`booked_car`='$booked_car',`status`='$status',`booked_dte`='$booked_dte',`booked_tme`='$booked_tme',`returned_dte`='$returned_dte',`return_tme`='$returned_tme'");
                                        $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = '$status'", "`payment_id` = '" . $response['id'] . "'");
                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");

                                        $get_location_data = $dbObj->fetch_data("location", "city_id =".$dta[0]['pickup_point']);
                                        
                                        echo '<h3 style="color:#ff0000">Sorry , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " .$get_location_data[0]['pickup_point']. "</h4>" ;
                                        echo "<h4>Total Cost  : " . $response['amount'] . "</h4>";
                                    } else {
                                        // UPDATE IN ORDER TABLE

                                        $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = '$status'", "`payment_id` = '" . $response['id'] . "'");

                                        // INSERT IN  UNAVAILABLE TABLE

                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");
                                        $dbObj->insertToDb("tbl_unavail_dtes", "type = '2', car_id = '0', bike_id = '" . $dta[0]['bike_id'] . "', unavail_dte = '" . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "', unavail_dte_to = '" . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "', status = '0', payment_id = '$payment_id'");

                                        $get_location_data = $dbObj->fetch_data("location", "city_id =".$dta[0]['pickup_point']);

                                        echo '<h3 style="color:#6da552">Thank You , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " .$get_location_data[0]['pickup_point']. "</h4>" ;
                                        echo "<h4>Total Cost  : " . $response['amount'] . "</h4>";


                                        //Mail to customer
                                        $to = $response['payments'][0]['buyer_email'];
                                        $from = "eduxontechnologies@gmail.com";
                                        // $from = "eduxonassociates@gmail.com";
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
                                                . "Amount : " . $response['amount'];

                                        //Send mail
                                        mail($to, $subject, $messagebody, $headers);

                                        $bike = $dta[0]['booked_car'];
                                             $frmDate = $dta[0]['booked_dte'].' '.$dta[0]['booked_tme'];
                                             $toDate = $dta[0]['returned_dte'].' '.$dta[0]['return_tme'];
                                             $bookingPrice = $response['amount'];
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