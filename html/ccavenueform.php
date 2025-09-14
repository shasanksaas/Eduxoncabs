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



$product_name = $_POST["carnme"];
$price = $_POST["totalAmt"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$_SESSION['product_name'] = $_POST["carnme"];
$_SESSION['price'] = $_POST["totalAmt"];
$_SESSION['name'] = $_POST["name"];
$_SESSION['phone'] = $_POST["phone"];
$_SESSION['email'] = $_POST["email"];
$_SESSION['trvlDte'] = $_POST['pdate'];
$_SESSION['trvltme'] = $_POST['ptime'];
$_SESSION['retnDte'] = $_POST['ddate'];
$_SESSION['retntme'] = $_POST['dtime'];
$_SESSION['car_id']  = $_SESSION['car_id'];

//$get_car_unavail = $dbObj->countRec("tbl_cabs","id = '".$_SESSION['car_id']."' AND (unavail_datefrm = '".$_SESSION['trvlDte']."' OR unavail_dateto = '".$_SESSION['trvlDte']."' OR unavail_datefrm = '".$_SESSION['retnDte']."' OR unavail_dateto = '".$_SESSION['retnDte']."')");
$get_car_unavail = $dbObj->countRec("tbl_unavail_dtes","car_id = '".$_SESSION['car_id']."' AND (('".$_SESSION['trvlDte']." ".$_SESSION['trvltme']."' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '".$_SESSION['retnDte']." ".$_SESSION['retntme']."' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '".$_SESSION['trvlDte']." ".$_SESSION['trvltme']."' AND '".$_SESSION['retnDte']." ".$_SESSION['retntme']."' OR `unavail_dte_to` BETWEEN '".$_SESSION['trvlDte']." ".$_SESSION['trvltme']."' AND '".$_SESSION['retnDte']." ".$_SESSION['retntme']."'))");

if($get_car_unavail > 0){ ?>
	<script>
		alert("Sorry!!! This car booked for your selected date range plaease check another date");
		window.location = "allcars.php";
    </script>
<?php }else{
    
    
	$payment_id	  = uniqid();
	$buyer_name   = $name;
	$email		  = $email;
	$phone 		  = $phone;
	$amount 	  = $price;
	
	$booked_dte   = $_POST['pdate'];
	$booked_tme   = $_POST['ptime'];
	
	$returned_dte = $_POST['ddate'];
	$returned_tme = $_POST['dtime'];
	
	//$str_to_insert = ':';
	//$booked_tme = substr_replace($booked_tme, $str_to_insert, -2, 0);
	//$returned_tme=substr_replace($returned_tme, $str_to_insert, -2, 0);
	$ins_dta = $dbObj->insertToDb("tbl_order","`payment_id` = '$payment_id',`buyer_name`='$buyer_name',`email`='$email',`phone`='$phone',`amount`='$amount',`booked_car`='$product_name',`status`='Pending',`booked_dte`='$booked_dte',`booked_tme`='$booked_tme',`returned_dte`='$returned_dte',`return_tme`='$returned_tme'");

?>
<html>
<head>
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
</head>
<body>
	<form method="POST" name="customerData" action="ccavRequestHandler.php">
		<input type="hidden" name="tid" id="tid" readonly />
        <input type="hidden" name="merchant_id" value="160659"/>
        <input type="hidden" name="order_id" value="<?php echo uniqid();?>"/>
        <input type="hidden" name="amount" value="<?php echo $price;?>"/>
        <input type="hidden" name="currency" value="INR"/>
        <input type="hidden" name="redirect_url" value="http://eduxoncabs.com/ccavResponseHandler.php"/>
        <input type="hidden" name="cancel_url" value="http://eduxoncabs.com/ccavResponseHandler.php"/>
        <input type="hidden" name="language" value="EN"/>
        <input type="hidden" name="billing_name" value="<?php echo $name;?>"/>
        <input type="hidden" name="billing_address" value="Bharati Tower,Forest Park,Aerodrome Area"/>
        <input type="hidden" name="billing_city" value="Bhubaneswar"/>
        <input type="hidden" name="billing_state" value="Odisha"/>
        <input type="hidden" name="billing_zip" value="751020"/>
        <input type="hidden" name="billing_country" value="India"/>
        <input type="hidden" name="billing_tel" value="<?php echo $phone;?>"/>
        <input type="hidden" name="billing_email" value="<?php echo $email;?>"/>
        <input type="hidden" name="delivery_name" value="<?php echo $name;?>"/>
        <input type="hidden" name="delivery_address" value="Bharati Tower,Forest Park,Aerodrome Area"/>
        <input type="hidden" name="delivery_city" value="Bhubaneswar"/>
        <input type="hidden" name="delivery_state" value="Odisha"/>
        <input type="hidden" name="delivery_zip" value="751020"/>
        <input type="hidden" name="delivery_country" value="India"/>
        <input type="hidden" name="delivery_tel" value="<?php echo $name;?>"/>
        <input type="hidden" name="merchant_param1" value="<?php echo $_POST['pdate']." ".$_POST['ptime'];?>"/>
        <input type="hidden" name="merchant_param2" value="<?php echo $_POST['ddate']." ".$_POST['dtime'];?>"/>
        <input type="hidden" name="merchant_param3" value="<?php echo $_SESSION['car_id'];?>"/>
        <input type="hidden" name="merchant_param4" value="<?php echo $_POST["carnme"];?>"/>
        <input type="hidden" name="merchant_param5" value=""/>
        <input type="submit" value="CheckOut" style="visibility:hidden;">
	</form>
    <script language='javascript'>document.customerData.submit();</script>
</body>
</html>
<?php } ?>