<?php include('Crypto.php');
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
$db = new SiteData();
$dbObj = new dbquery();
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
      <h3 style="color:#6da552">Thank You, Payment succus!!</h3>
        <?php
			error_reporting(0);
			
			$workingKey='077B753E5D5E2DE97443B685A0DCE311';		//Working Key should be provided here.
			$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
			$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
			$order_status="";
			$decryptValues=explode('&', $rcvdString);
			$dataSize=sizeof($decryptValues);
			echo "<center>";
		
			for($i = 0; $i < $dataSize; $i++) 
			{
				$information=explode('=',$decryptValues[$i]);
				if($i==3)	$order_status=$information[1];
				//print_r($information);
			}
		
			if($order_status==="Success")
			{
				$information = explode('=',$decryptValues[0]);
				$payment_id	  = $information[1];
				$buyer_name   = $_SESSION['name'];
				$email		  = $_SESSION['email'];;
				$phone 		  = $_SESSION['phone'];
				$amount 	  = $_SESSION['price'];
				$booked_car   = $_SESSION['product_name'];
				$status 	  = "Completed";
				$booked_dte   = $_SESSION['trvlDte'];
				$booked_tme   = $_SESSION['trvltme'];
				$returned_dte = $_SESSION['retnDte'];
				$returned_tme = $_SESSION['retntme'];
				$car_id		  = $_SESSION['car_id'];
				$ins_dta = $dbObj->insertToDb("tbl_order","`payment_id` = '$payment_id',`buyer_name`='$buyer_name',`email`='$email',`phone`='$phone',`amount`='$amount',`booked_car`='$booked_car',`status`='$status',`booked_dte`='$booked_dte',`booked_tme`='$booked_tme',`returned_dte`='$returned_dte',`return_tme`='$returned_tme'");
				$dbObj->insertToDb("tbl_unavail_dtes","type = '1', car_id = '$car_id', bike_id = '0', unavail_dte = '$booked_dte $booked_tme', unavail_dte_to = '$returned_dte $returned_tme', status = '0', payment_id = ''");
				?>
                <h3 style="color:#6da552">Thank You, Payment succus!!</h3>
                <?php
				
				/*echo "<table cellspacing=4 cellpadding=4>";
				for($i = 0; $i < $dataSize; $i++) 
				{
					$information=explode('=',$decryptValues[$i]);
						echo '<tr><td>'.$information[0].'</td><td>'.urldecode($information[1]).'</td></tr>';
				}
			
				echo "</table><br>";
				echo "</center>";*/
				
			}
			else if($order_status==="Aborted")
			{
				
			}
			else if($order_status==="Failure")
			{
				
			}
			else
			{
				echo "<br>Security Error. Illegal access detected";
			
			}
				
  ?>
      </div>
    </div>
  </div>
  <?php //unset($_SESSION['trvlDte']); unset($_SESSION['trvltme']); unset($_SESSION['retnDte']); unset($_SESSION['retntme']); unset($_SESSION['car_id']); session_destroy(); ?>
  <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>

</body>
</html>