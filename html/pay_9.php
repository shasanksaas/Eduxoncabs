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

 $date = date('Y-m-d H:i:s');
 //$date = date('Y-m-d H:i:s',strtotime($date)+19800);

$csrf_token = mysql_real_escape_string($_POST["csrf"]);
$product_name = mysql_real_escape_string($_POST["vehicle_name"]);
$form_price = mysql_real_escape_string($_POST["totalAmt"]); // comming with security price
$name = mysql_real_escape_string($_POST["name"]);
$phone = mysql_real_escape_string($_POST["phone"]);
$email = mysql_real_escape_string($_POST["email"]);
$vehicle_id = mysql_real_escape_string($_POST['vehicle_id']);
$city = mysql_real_escape_string($_POST['city1']);
$pickuploc = mysql_real_escape_string($_POST['pickuploc']);
$dob = mysql_real_escape_string($_POST['dob']);

$_SESSION['trvlDte'] = mysql_real_escape_string($_POST['pdate']);
$_SESSION['trvltme'] = mysql_real_escape_string($_POST['ptime']);
$_SESSION['retnDte'] = mysql_real_escape_string($_POST['ddate']);
$_SESSION['retntme'] = mysql_real_escape_string($_POST['dtime']);
$_SESSION['vehicle_id'] = mysql_real_escape_string($_POST['vehicle_id']);
$booked_dte = mysql_real_escape_string($_POST['pdate']);
$booked_tme = mysql_real_escape_string($_POST['ptime']);

$returned_dte = mysql_real_escape_string($_POST['ddate']);
$returned_tme = mysql_real_escape_string($_POST['dtime']);

$securityPayment = mysql_real_escape_string($_POST['securityPayment']);
$securityprice = mysql_real_escape_string($_POST['securitymoneyprice']);

$vehicle_type = 2;

$securityPaymode = 0;
if($securityPayment=='online'){
    $securityPaymode = 1;
}elseif($securityPayment=='cash'){
    $securityPaymode = 2;
    $form_price = ($form_price-$securityprice);
}

if($vehicle_id==""){
   header("location:all-bikes-bike-for-rental-bhubaneswar.php");
   exit;
}



// total booking Hour
$start_book_time = date("Y-m-d H:i",strtotime("$booked_dte $booked_tme"));
$end_book_time = date("Y-m-d H:i",strtotime("$returned_dte $returned_tme"));

//Fetch car price based on car id
$get_bike_data = $dbObj->fetch_data("tbl_bikes", "id = '$vehicle_id'");


$strtdt = strtotime($start_book_time);
$day = strtolower(date("l", $strtdt));

$vehicle_cost = $get_bike_data[0]['cost'];
$vehicle_weekend_cost = $get_bike_data[0]['weekend_cost'];

if ($day == 'saturday' || $day == 'sunday') {

    $vehicle_cost = $get_bike_data[0]['weekend_cost'];
}

$totalhr = round((strtotime($end_book_time) - strtotime($start_book_time))/3600);
if($totalhr<=24){
    $price = $vehicle_cost;
    if($securityPaymode==1){
        $price = $price+$securityprice;
    }
}else{
    $price = calc_price($start_book_time, $end_book_time , $get_bike_data[0]['cost'] , $vehicle_weekend_cost);
    if($securityPaymode==1){
        $price = $price+$securityprice;
    }
}

if($form_price ==0 || $form_price != $price)
{
    $ins_dta = $dbObj->insertToDb("err_tbl", " c_name ='$name', phone='$phone', `from_date_time` = '" . $start_book_time . "', `to_date_time`='$end_book_time', `bike_id`='$vehicle_id', `form_amount`='$form_price', `actual_amount`='$price',secur_pay_type='$securityPaymode' ");
     
?>
    <script>
        
        window.location = "all-bikes-bike-for-rental-bhubaneswar.php?ermsg=1";
    </script>
<?php
return;
}else{
    $price=$price;
}



// check booking date not less then current date
$cur_date = date("Y-m-d",strtotime($date));
if($booked_dte < $cur_date || $booked_dte == '0000-00-00' || $returned_dte=='0000-00-00' || $end_book_time < $start_book_time ){

   
    ?>
    <script>
       
        window.location = "all-bikes-bike-for-rental-bhubaneswar.php?ermsg=2";
    </script>
<?php
return;
 
}

$get_bike_unavail = $dbObj->countRec("tbl_unavail_dtes", "bike_id = '$vehicle_id' AND (('" . $booked_dte . " " . $booked_tme . "' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '" . $returned_dte . " " . $returned_tme . "' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '" . $booked_dte . " " . $booked_tme . "' AND '" . $returned_dte . " " . $returned_tme . "' OR `unavail_dte_to` BETWEEN '" . $booked_dte . " " . $booked_tme . "' AND '" . $returned_dte . " " . $returned_tme . "'))");

if ($get_bike_unavail > 0) {
    ?>
    <script>
        alert("Sorry!!! This Bike booked for your selected date range plaease check another date");
         window.location = "all-bikes-bike-for-rental-bhubaneswar.php";
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
                "redirect_url" => "http://www.eduxoncabs.com/sthankyou.php",
                "webhook" => "http://www.eduxoncabs.com/webhook.php"
            ));
            //print_r($response);exit;

            //Check the customer 
            $get_customer = $dbObj->countRec("tbl_customer", "phone_number= '$phone'");

            if ($get_customer > 0) {
                $data = $dbObj->fetch_data("tbl_customer","phone_number= '$phone'");
            }else{
           // INSERT TO Customer table
             $ins_dta = $dbObj->insertToDb("tbl_customer","customer_name='$name',phone_number='$phone',`email_id` = '$email',dob='$dob' ");

               $data = $dbObj->fetch_data("tbl_customer","phone_number= '$phone'");
            }   
            $customer_id = $data[0]['cust_id'];         



            $ins_dta = $dbObj->insertToDb("tbl_order", "customer_id = '$customer_id' , `payment_id` = '" . $response['id'] . "', `buyer_name`='$name', `bike_id`='$vehicle_id', `email`='$email', `phone`='$phone', `amount`='$price', `booked_car`='$product_name', `status`='Pending', `booked_dte`='$booked_dte', `booked_tme`='$booked_tme', `returned_dte`='$returned_dte', `return_tme`='$returned_tme',secur_pay_type='$securityPaymode',vehicle_type='$vehicle_type',city='$city', pickup_point='$pickuploc', customer_dob='$dob' ");
            $pay_ulr = $response['longurl'];

            //Redirect($response['longurl'],302); //Go to Payment page
            unset($_SESSION['token']);
        }else{
            echo '<script>
                    alert("Sorry!!! your session has timed out !");
                    window.location = "all-bikes-bike-for-rental-bhubaneswar.php";
                 </script>';
        }

        header("Location: $pay_ulr");
        exit();
    } catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }
}


//price calculation

function calc_price($start_book_time, $end_book_time , $vehicle_cost , $vehicle_weekend_cost){

        $strt_dt_tm = $start_book_time;
        $strt_date_tm = $start_book_time;
        $end_dt_tm = $end_book_time;


        $end_date_only = date('Y-m-d 00:00:00', strtotime($end_dt_tm)); // only date not time
        $start_date_only = date('Y-m-d 00:00:00', strtotime($strt_date_tm)); // only date not time


        $totalhr = round((strtotime($end_dt_tm) - strtotime($start_date_only))/3600);
        if($totalhr<24){
            return $total_price=$vehicle_cost;
        }


        $time1 = strtotime($strt_date_tm);
        $time2 = strtotime($end_dt_tm);
         //$no_of_loop =  ceil( ($time2-$time1) /(60*60*24));
         $no_of_loop = ceil($totalhr/24);
         if($totalhr%24==0){
                                
            $no_of_loop+=1;
        }


        $cur_date = "";
        $total_price="";

        for ($i = 0; $i < $no_of_loop; $i++) {
            $strtdt = strtotime($strt_dt_tm);
            $day = strtolower(date("l", $strtdt));
           
           $price = $vehicle_cost;
           
            if ($day == 'saturday' || $day == 'sunday') {
                $price = $vehicle_weekend_cost;
            }
            
             $perhour = $price / 24;

             $day_end_time = date('Y-m-d 00:00:00', strtotime($strt_dt_tm . "+1 day"));// next day start is end of last date
           
            
             $totalhrperday = (strtotime($day_end_time) - strtotime($strt_dt_tm)) / 3600; // no of hour per day
            
             $daystart_time =date('Y-m-d 00:00:00', strtotime($strt_dt_tm)); // new day start time from 12.00 pm
             
             $cur_date = date('Y-m-d',strtotime($strt_dt_tm));  // date of current date
             $start_new_date = date('Y-m-d',strtotime($day_end_time)); // new date start
             
           
            $end_date = date('Y-m-d',strtotime($end_dt_tm)); // date of end date

            if ( $cur_date == $end_date) {
                
                $totalhrperday = (strtotime($end_dt_tm) - strtotime($daystart_time) )/3600; 
                $total_price += round($totalhrperday* $perhour);
                
                
            }else{
            
             $total_price += round($totalhrperday * $perhour); 
            }
            //echo " : ".$total_price ." - $totalhrperday : $perhour <br>";
           
            $strt_dt_tm = date('Y-m-d 00:00:00', strtotime($strt_dt_tm . "+1 day"));
        }
return  round($total_price);
}
?>
