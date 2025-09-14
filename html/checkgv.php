<?php

require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
$db = new SiteData();
$dbObj = new dbquery();
$date = date("Y-m-d");

if (isset($_POST['voucher'])) {
    // echo $_POST['voucher'] . $_POST['phone'];
    $coupon_code = $_POST['voucher'];
    $phone = $_POST['phone'];
    $amount = $_POST['bookAmont']; 
    if ($amount >= 3500) {
        $query = "gv_code = '$coupon_code' AND '$date' BETWEEN from_date AND to_date and status=1 ";
        $get_gv_count = $dbObj->countRec("master_gv", $query);
        if ($get_gv_count > 0) {
            // $ins_dta = $dbObj->insertToDb("campaign_details","c_name ='$name',phone='$phone' ");

            $gv_data = $dbObj->fetch_data("master_gv", "gv_code = '$coupon_code'");
            $gv_percent = round($gv_data[0]['gv_percent']);

            $gv_amount = round(($amount/100)*$gv_percent);
            $res = array("status"=>"success","msg"=>"success","coupon_amount"=>$gv_amount);
            echo json_encode($res);
            
        }else{
                $res = array("status"=>"error","msg"=>"This Is not a valid Coupon");
                echo json_encode($res);
        }
    }else{
        $res = array("status"=>"error","msg"=>"Available only above booking amount of 3500");
        echo json_encode($res);
    }
}
?>