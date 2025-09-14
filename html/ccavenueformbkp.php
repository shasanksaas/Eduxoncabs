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
		<input type="text" name="tid" id="tid" readonly />
        <input type="text" name="merchant_id" value="160659"/>
        <input type="text" name="order_id" value="<?php echo uniqid();?>"/>
        <input type="text" name="amount" value="<?php echo $price;?>"/>
        <input type="text" name="currency" value="INR"/>
        <input type="text" name="redirect_url" value="http://eduxoncabs.com/ccavResponseHandler.php"/>
        <input type="text" name="cancel_url" value="http://eduxoncabs.com/ccavResponseHandler.php"/>
        <input type="text" name="language" value="EN"/>
        <input type="text" name="billing_name" value="<?php echo $name;?>"/>
        <input type="text" name="billing_address" value="Bharati Tower,Forest Park,Aerodrome Area"/>
        <input type="text" name="billing_city" value="Bhubaneswar"/>
        <input type="text" name="billing_state" value="Odisha"/>
        <input type="text" name="billing_zip" value="751020"/>
        <input type="text" name="billing_country" value="India"/>
        <input type="text" name="billing_tel" value="<?php echo $phone;?>"/>
        <input type="text" name="billing_email" value="<?php echo $email;?>"/>
        <input type="text" name="delivery_name" value="<?php echo $name;?>"/>
        <input type="text" name="delivery_address" value="Bharati Tower,Forest Park,Aerodrome Area"/>
        <input type="text" name="delivery_city" value="Bhubaneswar"/>
        <input type="text" name="delivery_state" value="Odisha"/>
        <input type="text" name="delivery_zip" value="751020"/>
        <input type="text" name="delivery_country" value="India"/>
        <input type="text" name="delivery_tel" value="<?php echo $name;?>"/>
        <input type="text" name="merchant_param1" value=""/>
        <input type="text" name="merchant_param2" value=""/>
        <input type="text" name="merchant_param3" value=""/>
        <input type="text" name="merchant_param4" value=""/>
        <input type="text" name="merchant_param5" value=""/>
        <input type="submit" value="CheckOut" style="visibility:hidden;">
	</form>
    <script language='javascript'>document.customerData.submit();</script>
</body>
</html>
<?php } ?>