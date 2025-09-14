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


$csrf_token = mysql_real_escape_string($_POST["csrf"]);
$product_name = mysql_real_escape_string($_POST["carnme"]);
$price = mysql_real_escape_string($_POST["totalAmt"]);
$name = mysql_real_escape_string($_POST["name"]);
$phone = mysql_real_escape_string($_POST["phone"]);
$email = mysql_real_escape_string($_POST["email"]);
$car_id = mysql_real_escape_string($_POST['car_id']);
$_SESSION['trvlDte'] = mysql_real_escape_string($_POST['pdate']);
$_SESSION['trvltme'] = mysql_real_escape_string($_POST['ptime']);
$_SESSION['retnDte'] = mysql_real_escape_string($_POST['ddate']);
$_SESSION['retntme'] = mysql_real_escape_string($_POST['dtime']);
$_SESSION['car_id'] = mysql_real_escape_string($_POST['car_id']);
$booked_dte = mysql_real_escape_string($_POST['pdate']);
$booked_tme = mysql_real_escape_string($_POST['ptime']);

$returned_dte = mysql_real_escape_string($_POST['ddate']);
$returned_tme = mysql_real_escape_string($_POST['dtime']);

$securityPayment = mysql_real_escape_string($_POST['securityPayment']);
$securityprice = mysql_real_escape_string($_POST['securitymoneyprice']);

$securityPaymode = 0;
if($securityPayment=='online'){
    $securityPaymode = 1;
}elseif($securityPayment=='cash'){
    $securityPaymode = 2;
    $price = ($price-$securityprice);
}

// check booking date not less then current date
$cur_date = date("Y-m-d");
if($booked_dte < $cur_date || $booked_dte == '0000-00-00' || $returned_dte=='0000-00-00'){
   
    ?>
    <script>
        alert("Sorry!!! You entered Invalid date ");
        window.location = "all-cars-for-self-drive-bhubaneswar.php";
    </script>
<?php
return;
 
}

//$get_car_unavail = $dbObj->countRec("tbl_cabs","id = '".$_SESSION['car_id']."' AND (unavail_datefrm = '".$_SESSION['trvlDte']."' OR unavail_dateto = '".$_SESSION['trvlDte']."' OR unavail_datefrm = '".$_SESSION['retnDte']."' OR unavail_dateto = '".$_SESSION['retnDte']."')");
//$get_car_unavail = $dbObj->countRec("tbl_unavail_dtes","car_id = '".$_SESSION['car_id']."' AND (('".$_SESSION['trvlDte']." ".$_SESSION['trvltme']."' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '".$_SESSION['retnDte']." ".$_SESSION['retntme']."' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '".$_SESSION['trvlDte']." ".$_SESSION['trvltme']."' AND '".$_SESSION['retnDte']." ".$_SESSION['retntme']."' OR `unavail_dte_to` BETWEEN '".$_SESSION['trvlDte']." ".$_SESSION['trvltme']."' AND '".$_SESSION['retnDte']." ".$_SESSION['retntme']."'))");

$get_car_unavail = $dbObj->countRec("tbl_unavail_dtes", "car_id = '$car_id' AND (('" . $booked_dte . " " . $booked_tme . "' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '" . $returned_dte . " " . $returned_tme . "' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '" . $booked_dte . " " . $booked_tme . "' AND '" . $returned_dte . " " . $returned_tme . "' OR `unavail_dte_to` BETWEEN '" . $booked_dte . " " . $booked_tme . "' AND '" . $returned_dte . " " . $returned_tme . "'))");

if ($get_car_unavail > 0) {
    ?>
    <script>
        alert("Sorry!!! This car booked for your selected date range plaease check another date");
        window.location = "all-cars-for-self-drive-bhubaneswar.php";
    </script>
<?php

} else {

    include 'src/instamojo.php';

    $api = new Instamojo\Instamojo('1bf34c6da1ee6614445663e65365231a', 'f7d8746ab010d43828996a63a79977cd', 'https://www.instamojo.com/api/1.1/');


    try {
        
        if ($csrf_token == $_SESSION['token']) {


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
            //print_r($response);exit;
            $ins_dta = $dbObj->insertToDb("tbl_order", "`payment_id` = '" . $response['id'] . "', `buyer_name`='$name', `car_id`='$car_id', `email`='$email', `phone`='$phone', `amount`='$price', `booked_car`='$product_name', `status`='Pending', `booked_dte`='$booked_dte', `booked_tme`='$booked_tme', `returned_dte`='$returned_dte', `return_tme`='$returned_tme',secur_pay_type='$securityPaymode' ");
            $pay_ulr = $response['longurl'];

            //Redirect($response['longurl'],302); //Go to Payment page
            unset($_SESSION['token']);
        }else{
            echo '<script>
                    alert("Sorry!!! your session has timed out !");
                    window.location = "allcars.php";
                 </script>';
        }

        header("Location: $pay_ulr");
        exit();
    } catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }
}
?>
