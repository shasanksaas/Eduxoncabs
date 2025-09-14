<?php
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
$db = new SiteData();
$dbObj = new dbquery();
if(filter($_GET['payment_id'] != "") && filter($_GET['payment_request_id']) != ""){
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
<?php include("includes/inc-css.php");?>
</head>
<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>
  <div role="main" class="main">
   
    <div class="container">
      <div class="row">
      <h3 style="color:#6da552">Thank You, Payment success!!</h3>
        <?php

			include 'src/instamojo.php';
			
			$api = new Instamojo\Instamojo('1bf34c6da1ee6614445663e65365231a', 'f7d8746ab010d43828996a63a79977cd','https://www.instamojo.com/api/1.1/');
			
			$payid = $_GET["payment_request_id"];
			
			
			try {
				$response = $api->paymentRequestStatus($payid);
			
			
				echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
				echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
				echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
				echo "<h4>Booking Date: " . $_SESSION['trvlDte']. "</h4>" ;
				echo "<h4>Drop up Date: " .$_SESSION['retnDte']. "</h4>" ;
				echo "<h4>Total Cost  : " . $response['amount'] . "</h4>" ;
			
			  /*echo "<pre>";
			   print_r($response);
			echo "</pre>";*/
				$payment_id	  = $response['payments'][0]['payment_id'];
				$buyer_name   = $response['buyer_name'];
				$email		  = $response['email'];;
				$phone 		  = $response['phone'];
				$amount 	  = $response['amount'];
				$booked_car   = $response['purpose'];
				$status 	  = $response['status'];
				$booked_dte   = $_SESSION['trvlDte'];
				$booked_tme   = $_SESSION['trvltme'];
				$returned_dte = $_SESSION['retnDte'];
				$returned_tme = $_SESSION['retntme'];
				$car_id		  = $_SESSION['car_id'];
				$ins_dta = $dbObj->insertToDb("tbl_order","`payment_id` = '$payment_id',`buyer_name`='$buyer_name',`email`='$email',`phone`='$phone',`amount`='$amount',`booked_car`='$booked_car',`status`='$status',`booked_dte`='$booked_dte',`booked_tme`='$booked_tme',`returned_dte`='$returned_dte',`return_tme`='$returned_tme'");

				$dbObj->insertToDb("tbl_unavail_dtes","car_id = '$car_id', unavail_dte = '$booked_dte $booked_tme', unavail_dte_to = '$returned_dte $returned_tme'");
			}
			catch (Exception $e) {
				print('Error: ' . $e->getMessage());
			}



  ?>
      </div>
    </div>
  </div>
  <?php unset($_SESSION['trvlDte']); unset($_SESSION['trvltme']); unset($_SESSION['retnDte']); unset($_SESSION['retntme']); unset($_SESSION['car_id']); session_destroy(); ?>
  <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>

</body>
</html>
<?php
}else{
	header("location:index.php");
}
?>