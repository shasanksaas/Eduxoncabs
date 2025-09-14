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

include 'src/instamojo.php';

$api = new Instamojo\Instamojo('1bf34c6da1ee6614445663e65365231a', 'f7d8746ab010d43828996a63a79977cd','https://www.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => false,
        "send_sms" => false,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://www.eduxoncabs.com/thankyou.php",
        "webhook" => "http://www.eduxoncabs.com/webhook.php"
        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}  

}   
  ?>
