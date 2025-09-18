<?php
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
require_once("sendsms.php");
require_once('php-mailer/PHPMailerAutoload.php');

$db = new SiteData();
$dbObj = new dbquery();
if (filter($_GET['payment_id'] != "") && filter($_GET['payment_request_id']) != "") {
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
                                $payment_id = '7161fd972e784a13a6cdab5668b1546d';$response['payments'][0]['payment_id'];
                                $payment_status = 'success';//$response['payments'][0]['status'];
                                $buyer_name = $response['buyer_name'];
                                $email = $response['email'];
                                $phone = $response['phone'];
                                $amount = $response['amount']; $response['amount']=5983;
                                $booked_car = $response['purpose'];
                                $status = $response['status'];
                                $booked_dte = $_SESSION['trvlDte'];
                                $booked_tme = $_SESSION['trvltme'];
                                $returned_dte = $_SESSION['retnDte'];
                                $returned_tme = $_SESSION['retntme'];
                                $car_id = $_SESSION['vehicle_id'];


                                $chk_mojo_id = $dbObj->countRec("tbl_order", "payment_id = '$payment_id'");
                                if ($chk_mojo_id == 0) {
                                    ?>
                                    <script>alert("Sorry !! payment made already for further notification please contact service provider");</script>
                                    <?php
                                } else {

                                    /*                                     * *************** old code *************************
                                      //$ins_dta = $dbObj->insertToDb("tbl_order","`payment_id` = '$payment_id',`buyer_name`='$buyer_name',`email`='$email',`phone`='$phone',`amount`='$amount',`booked_car`='$booked_car',`status`='$status',`booked_dte`='$booked_dte',`booked_tme`='$booked_tme',`returned_dte`='$returned_dte',`return_tme`='$returned_tme'");
                                      $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = 'Completed'", "`payment_id` = '".$response['id']."'");
                                      //$upd_data = $dbObj->updateToDb("tbl_cabs","unavail_datefrm = '$booked_dte', unavail_tmfrm = '$booked_tme', unavail_dateto = '$returned_dte', unavail_tmto = '$returned_tme'", "id = $car_id");
                                      $dta = $dbObj->fetch_data("tbl_order","payment_id = '$payment_id'");
                                      $dbObj->insertToDb("tbl_unavail_dtes","type = '1', car_id = '".$dta[0]['car_id']."', bike_id = '0', unavail_dte = '".$dta[0]['booked_dte'].' '.$dta[0]['booked_tme']."', unavail_dte_to = '".$dta[0]['returned_dte'].' '.$dta[0]['return_tme']."', status = '0', payment_id = '$payment_id'");
                                      echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
                                      echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
                                      echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
                                      echo "<h4>Booking Date: " . $dta[0]['booked_dte'].' '.$dta[0]['booked_tme']. "</h4>" ;
                                      echo "<h4>Drop up Date: " .$dta[0]['returned_dte'].' '.$dta[0]['return_tme']. "</h4>" ;
                                      echo "<h4>Total Cost  : " . $response['amount'] . "</h4>" ;
                                     */

                                    if ($payment_status == "Failed") {
                                        //$ins_dta = $dbObj->insertToDb("tbl_order","`payment_id` = '$payment_id',`buyer_name`='$buyer_name',`email`='$email',`phone`='$phone',`amount`='$amount',`booked_car`='$booked_car',`status`='$status',`booked_dte`='$booked_dte',`booked_tme`='$booked_tme',`returned_dte`='$returned_dte',`return_tme`='$returned_tme'");
                                        $dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = '$status'", "`payment_id` = '" . $response['id'] . "'");
                                        //$upd_data = $dbObj->updateToDb("tbl_cabs","unavail_datefrm = '$booked_dte', unavail_tmfrm = '$booked_tme', unavail_dateto = '$returned_dte', unavail_tmto = '$returned_tme'", "id = $car_id");

                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");
                                        //$dbObj->insertToDb("tbl_unavail_dtes","car_id = '".$dta[0]['car_id']."', unavail_dte = '".$dta[0]['booked_dte'].' '.$dta[0]['booked_tme']."', unavail_dte_to = '".$dta[0]['returned_dte'].' '.$dta[0]['return_tme']."'");

                                        $get_location_data = $dbObj->fetch_data("location", "id =" . $dta[0]['pickup_point']);

                                        echo '<h3 style="color:#ff0000">Sorry , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " . $get_location_data[0]['pickup_point'] . "</h4>";
                                        echo "<h4>Total Cost  : " . $response['amount'] . "</h4>";

                                        $car = $dta[0]['booked_car'];
                                        $frmDate = $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'];
                                        $toDate = $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'];
                                        $bookingPrice = $response['amount'];
                                        $bookingID = $dta[0]['id'];

                                        unlink($_SESSION['filename']);

                                        //$sms = "Booking confirm, Booking ID-$bookingID, Your $car Booking from $frmDate to $toDate Total Price Rs.$bookingPrice";
                                        //$phone_number = $dta[0]['phone'];
                                        //sendsms($phone_number,$sms);
                                    } else {
                                        //$ins_dta = $dbObj->insertToDb("tbl_order","`payment_id` = '$payment_id',`buyer_name`='$buyer_name',`email`='$email',`phone`='$phone',`amount`='$amount',`booked_car`='$booked_car',`status`='$status',`booked_dte`='$booked_dte',`booked_tme`='$booked_tme',`returned_dte`='$returned_dte',`return_tme`='$returned_tme'");
                                        //$dbObj->updateToDb("tbl_order", "`payment_id` = '$payment_id', status = '$status'", "`payment_id` = '" . $response['id'] . "'");
                                        //$upd_data = $dbObj->updateToDb("tbl_cabs","unavail_datefrm = '$booked_dte', unavail_tmfrm = '$booked_tme', unavail_dateto = '$returned_dte', unavail_tmto = '$returned_tme'", "id = $car_id");
                                        $dta = $dbObj->fetch_data("tbl_order", "payment_id = '$payment_id'");
                                        //$dbObj->insertToDb("tbl_unavail_dtes", "car_id = '" . $dta[0]['car_id'] . "', unavail_dte = '" . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "', unavail_dte_to = '" . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "'");
                                        $get_car_dtls = $dbObj->fetch_data("tbl_cabs", "id = $car_id");
                                        $cab_cost = $get_car_dtls[0]['cost'];
                                        $weekend_cost = $get_car_dtls[0]['weekend_cost'];
                                        $get_location_data = $dbObj->fetch_data("location", "id =" . $dta[0]['pickup_point']);

                                        echo '<h3 style="color:#6da552">Thank You , Payment ' . $payment_status . ' !!</h3>';
                                        echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>";
                                        echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>";
                                        echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>";
                                        echo "<h4>Booking Date: " . $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'] . "</h4>";
                                        echo "<h4>Drop up Date: " . $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'] . "</h4>";
                                        echo "<h4>Pickup Point: " . $get_location_data[0]['pickup_point'] . "</h4>";
                                        echo "<h4>Total Cost  : " . $response['amount'] . "</h4>";



                                        //Mail to customer
                                        $to = $response['payments'][0]['buyer_email'];
                                        $from = "eduxonassociates@gmail.com";
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
                                                . "Amount : " . $response['amount'];

                                        //Send mail
                                        //mail($to, $subject, $messagebody, $headers);
                                        /***********************Mail attachment invoice************************************ */
                                        $car = $dta[0]['booked_car'];
                                        $frmDate = $dta[0]['booked_dte'] . ' ' . $dta[0]['booked_tme'];
                                        $toDate = $dta[0]['returned_dte'] . ' ' . $dta[0]['return_tme'];
                                        $bookingPrice = $response['amount'];
                                        $bookingID = $dta[0]['id'];

                                        $sms = "Booking confirm, Booking ID-$bookingID, Your $car Booking from $frmDate to $toDate Total Price Rs.$bookingPrice";
                                        $phone_number = $dta[0]['phone'];
                                        //sendsms($phone_number, $sms);


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
                                                        Total:Rs.' . $response['amount'] . '
                                                    </td>
                                                </tr>

                                                <tr class="total">
                                                    <td></td>

                                                    <td>
                                                        Payment Received:Rs.' . $response['amount'] . '
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


                                        require_once( 'MPDF/mpdf.php');
                                        $mpdf = new mPDF();
                                        $stylesheet = file_get_contents('pdf.css');
                                        $mpdf->WriteHTML($stylesheet, 1);
                                        $mpdf->WriteHTML($html, 2);
                                        //$emailAttachment = $mpdf->Output('filename.pdf','S');
                                        $fileName = $payment_id . '.pdf';
                                        $mpdf->Output('invoice/' . $fileName, 'F');
exit;
                                        //$emailAttachment = chunk_split(base64_encode($emailAttachment));
                                        $subject = 'Eduxoncabs Invoice';
                                        $message = 'Invoice for your booking at Eduxoncabs';
                                        $mail = new PHPMailer(true);
                                        $debug = 0;
                                        try {

                                            $mail->SMTPDebug = $debug;                                 // Debug Mode

                                            $mail->AddAddress($to);               // Add another recipient

                                            $mail->SetFrom('eduxonassociates@gmail.com', 'Eduxoncabs');
                                            $mail->AddReplyTo($to, $buyer_name);

                                            $mail->IsHTML(true);                                  // Set email format to HTML

                                            $mail->CharSet = 'UTF-8';

                                            $mail->Subject = $subject;
                                            $mail->Body = $message;
                                            //$mail->AddStringAttachment($emailAttachment,'filename.pdf','base64','application/pdf');
                                            $mail->addAttachment('invoice/' . $fileName);
                                            $mail->Send();
                                            $arrResult = array('response' => 'success');
                                        } catch (phpmailerException $e) {
                                            $arrResult = array('response' => 'error', 'errorMessage' => $e->errorMessage());
                                        } catch (Exception $e) {
                                            $arrResult = array('response' => 'error', 'errorMessage' => $e->getMessage());
                                        }
                                        //unlink($fileName);
                                        /*                                         * ***********************************************Mail attachment invoice****************************************************************** */
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
?>