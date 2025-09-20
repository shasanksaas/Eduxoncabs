<?php
// Include required files and initialize API
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();
require_once "includes/settings.php";
require_once "includes/database.php";
require_once "includes/classes/db.cls.php";
require_once "includes/classes/sitedata.cls.php";
require_once "includes/functions/common.php";
require_once "includes/classes/DBquery.cls.php";

use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);

// Initialize database objects
$db = new SiteData();
$dbObj = new dbquery();

// Include centralized database connection
require_once "includes/db_connection.php";

$date = date("Y-m-d H:i:s");

// Sanitize input data
$csrf_token = $mysqli_conn->real_escape_string($_POST["csrf"]);
$product_name = $mysqli_conn->real_escape_string($_POST["carnme"]);
$form_price = $mysqli_conn->real_escape_string($_POST["totalAmt"]);
$name = $mysqli_conn->real_escape_string($_POST["name"]);
$phone = $mysqli_conn->real_escape_string($_POST["phone"]);
$email = $mysqli_conn->real_escape_string($_POST["email"]);
$city = $mysqli_conn->real_escape_string($_POST["city1"]);
$car_id = $mysqli_conn->real_escape_string($_POST["car_id"]);
$pickuploc = $mysqli_conn->real_escape_string($_POST["pickuploc"]);
$dob = $mysqli_conn->real_escape_string($_POST["dob"]);
$coupon_status = $mysqli_conn->real_escape_string($_POST["gvcode"]);
$coupon_code = $mysqli_conn->real_escape_string($_POST["coupon"]);
$gvamount = isset($_POST["gvamount"]) && $_POST["gvamount"] !== '' ? (int)$mysqli_conn->real_escape_string($_POST["gvamount"]) : 0;
$licenseNumber = $mysqli_conn->real_escape_string($_POST["licenseNumber"]);

// Save form data to session for persistence (in case user returns from payment)
$_SESSION['booking_name'] = $name;
$_SESSION['booking_email'] = $email;
$_SESSION['booking_phone'] = $phone;
$_SESSION['booking_dob'] = $dob;
$_SESSION['booking_license'] = $licenseNumber;
if (isset($_POST['message'])) {
    $_SESSION['booking_message'] = $mysqli_conn->real_escape_string($_POST['message']);
}

$count = $dbObj->countRec("blocked_dl", "dl_number = '$licenseNumber'");
if ($count > 0) {
    $url = $_SERVER["HTTP_REFERER"];
    header("location:$url");
    exit();
}

$wkdayshr = isset($_POST["wkdayshr"]) && $_POST["wkdayshr"] !== '' ? (int)$mysqli_conn->real_escape_string($_POST["wkdayshr"]) : 0;
$wkendhr = isset($_POST["wkendhr"]) && $_POST["wkendhr"] !== '' ? (int)$mysqli_conn->real_escape_string($_POST["wkendhr"]) : 0;
$wkdaysamnt = isset($_POST["wkdaysamnt"]) && $_POST["wkdaysamnt"] !== '' ? (float)$mysqli_conn->real_escape_string($_POST["wkdaysamnt"]) : 0;
$wkendamnt = isset($_POST["wkendamnt"]) && $_POST["wkendamnt"] !== '' ? (float)$mysqli_conn->real_escape_string($_POST["wkendamnt"]) : 0;

$_SESSION["trvlDte"] = $mysqli_conn->real_escape_string($_POST["pdate"]);
$_SESSION["trvltme"] = $mysqli_conn->real_escape_string($_POST["ptime"]);
$_SESSION["retnDte"] = $mysqli_conn->real_escape_string($_POST["ddate"]);
$_SESSION["retntme"] = $mysqli_conn->real_escape_string($_POST["dtime"]);
$_SESSION["vehicle_id"] = $mysqli_conn->real_escape_string($_POST["car_id"]);
$booked_dte = $mysqli_conn->real_escape_string($_POST["pdate"]);
$booked_tme = $mysqli_conn->real_escape_string($_POST["ptime"]);

$returned_dte = $mysqli_conn->real_escape_string($_POST["ddate"]);
$returned_tme = $mysqli_conn->real_escape_string($_POST["dtime"]);

$securityPayment = $mysqli_conn->real_escape_string($_POST["securityPayment"]);
$securityprice = $mysqli_conn->real_escape_string($_POST["securitymoneyprice"]);

$vehicle_type = 1;
$securityPaymode = 0;
if ($securityPayment == "online") {
    $securityPaymode = 1;
} elseif ($securityPayment == "cash") {
    $securityPaymode = 2;
    $form_price = $form_price - $securityprice;
}

    
if ($car_id == "") {
    //header("location:allcars-car-for-self-drive.php");
    header("location:all-cars-for-self-drive-bhubaneswar.php");
    exit();
}

$start_book_time = date("Y-m-d H:i", strtotime("$booked_dte $booked_tme"));
$end_book_time = date("Y-m-d H:i", strtotime("$returned_dte $returned_tme"));

$get_car_dta = $dbObj->fetch_data("tbl_cabs", "id = '$car_id'");

$strtdt = strtotime($start_book_time);
$day = strtolower(date("l", $strtdt));

$vehicle_cost = $get_car_dta[0]["cost"];
$vehicle_weekend_cost = $get_car_dta[0]["weekend_cost"];

if ($day == "saturday" || $day == "sunday" || $day == "friday") {
    $vehicle_cost = $get_car_dta[0]["weekend_cost"];
}

$totalhr = round(
    (strtotime($end_book_time) - strtotime($start_book_time)) / 3600
);
$get_hour_res = $dbObj->fetch_data("tbl_min_hour", "status = '1'");
$min_book_hour = $get_hour_res[0]["hours"];

if ($totalhr <= $min_book_hour) {
    $price = $vehicle_cost;
    if ($totalhr <= 12 && $min_book_hour == 12) {
        $price = $vehicle_cost / 2;
    }
    if ($securityPaymode == 1) {
        $price = $price + $securityprice;
    }
} else {
    $price = calc_price(
        $start_book_time,
        $end_book_time,
        $get_car_dta[0]["cost"],
        $vehicle_weekend_cost
    );
    if ($securityPaymode == 1) {
        $price = $price + $securityprice;
    }
}

if ($form_price == 0 || $form_price != $price) {
    $ins_dta = $dbObj->insertToDb(
        "err_tbl",
        "c_name ='$name',phone='$phone',`from_date_time` = '" .
        $start_book_time .
        "', `to_date_time`='$end_book_time', `car_id`='$car_id', `bike_id`='0', `form_amount`='$form_price', `actual_amount`='$price',secur_pay_type='$securityPaymode',comment='price mismatch $date' "
    ); ?>
    <script>
        window.location = "all-cars-for-self-drive-bhubaneswar.php?ermsg=1";
    </script>
    <?php return;
}

// Give 10 percent discount
$withoutsecurity = $price;
if ($securityPaymode == 1) {
    $withoutsecurity = $price - $securityprice;
}
if ($coupon_status == "successgv" && $withoutsecurity >= 3500) {
    $price = round($price - $gvamount);
}

$cur_date = date("Y-m-d", strtotime($date));
if (
    $booked_dte < $cur_date ||
    $booked_dte == "0000-00-00" ||
    $returned_dte == "0000-00-00" ||
    $end_book_time < $start_book_time
) {
    $ins_dta = $dbObj->insertToDb(
        "err_tbl",
        "c_name ='$name',phone='$phone',`from_date_time` = '" .
        $start_book_time .
        "', `to_date_time`='$end_book_time', `car_id`='$car_id', `form_amount`='$form_price', `actual_amount`='$price',secur_pay_type='$securityPaymode', comment='date issue $date' "
    ); ?>
    <script>
        //window.location = "allcars-car-for-self-drive.php?ermsg=2";
        window.location = "all-cars-for-self-drive-bhubaneswar.php?ermsg=2";
    </script>
    <?php return;
}

$get_car_unavail = $dbObj->countRec(
    "tbl_unavail_dtes",
    "car_id = '$car_id' AND (('" .
    $booked_dte .
    " " .
    $booked_tme .
    "' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '" .
    $returned_dte .
    " " .
    $returned_tme .
    "' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '" .
    $booked_dte .
    " " .
    $booked_tme .
    "' AND '" .
    $returned_dte .
    " " .
    $returned_tme .
    "' OR `unavail_dte_to` BETWEEN '" .
    $booked_dte .
    " " .
    $booked_tme .
    "' AND '" .
    $returned_dte .
    " " .
    $returned_tme .
    "'))"
);

if ($get_car_unavail > 0) { ?>
    <script>
        alert("Sorry!!! This car is booked for your selected date range. Please check another date.");
        // window.location = "allcars-car-for-self-drive.php";
         window.location = "all-cars-for-self-drive-bhubaneswar.php";
    </script>
    <?php } else {
    $filename = "";
    try {
        if ($csrf_token == $_SESSION["token"]) {
            $orderData = [
                'amount' => $price * 100, // Convert to paise
                'currency' => 'INR',
                'payment_capture' => 1 // Auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
// print_r($_SESSION['razorpay_order_id']);
            $get_customer = $dbObj->countRec(
                "tbl_customer",
                "phone_number= '$phone'"
            );

            if ($get_customer > 0) {
                $data = $dbObj->fetch_data(
                    "tbl_customer",
                    "phone_number= '$phone'"
                );
            } else {
                $ins_dta = $dbObj->insertToDb(
                    "tbl_customer",
                    "customer_name='$name',phone_number='$phone',`email_id` = '$email',dob='$dob' "
                );

                $data = $dbObj->fetch_data(
                    "tbl_customer",
                    "phone_number= '$phone'"
                );
            }
          $customer_id = $data[0]["cust_id"];

$updatelicenseImg = $dbObj->updateToDb(
    "tbl_customer",
    "license_number='$licenseNumber'",
    "cust_id = '$customer_id'"
);
$razorpay_order_id = $_SESSION['razorpay_order_id'];
$ins_dta = $dbObj->insertToDb(
    "tbl_order",
    "customer_id = '$customer_id', payment_id = '', order_id='$razorpay_order_id', buyer_name='$name', car_id='$car_id', bike_id='0', email='$email', phone='$phone', amount='$price', booked_car='$product_name', status='Pending', booked_dte='$booked_dte', booked_tme='$booked_tme', returned_dte='$returned_dte', return_tme='$returned_tme', secur_pay_type='$securityPaymode', vehicle_type='$vehicle_type', city='$city', pickup_point='$pickuploc', customer_dob='$dob', coupon='$coupon_code', coupon_status='$coupon_status', reedem_amount='$gvamount', from_date='$start_book_time', to_date='$end_book_time', regulardayhour='$wkdayshr', regulardayamount='$wkdaysamnt', weekendhour='$wkendhr', weekendamount='$wkendamnt', extended_time='1970-01-01 00:00:00', return_status='0'"
);

$pay_ulr = $response["longurl"];
unset($_SESSION["token"]);

// Order data for Razorpay


$displayAmount = $amount = $orderData['amount'];

// If currency is different from INR, convert the amount
if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);
    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

// Force automatic checkout
$checkout = 'automatic';
$data = [
    "key" => $keyId,
    "amount" => $displayAmount,
    "name" => $product_name,
    "buyer_name" => $name,
    "prefill" => [
        "name" => $name,
        "email" => $email,
        "contact" => $phone,
    ],
    "order_id" => $razorpayOrderId,
];


if ($displayCurrency !== 'INR') {
    $data['display_currency'] = $displayCurrency;
    $data['display_amount'] = $displayAmount;
}

$json = json_encode($data);
require("automatic.php");
// Redirect to payment page
header("Location: $pay_ulr");
exit();

} else {
    echo '<script>
            alert("Sorry!!! your session has timed out!");
            window.location = "all-cars-for-self-drive-bhubaneswar.php";
         </script>';
}

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo '<script>
            alert("An error occurred: ' . $e->getMessage() . '");
            window.location = "all-cars-for-self-drive-bhubaneswar.php";
          </script>';
}
}

// Function to calculate price
function calc_price($start_book_time, $end_book_time, $vehicle_cost, $vehicle_weekend_cost) {
    $strt_dt_tm = $start_book_time;
    $strt_date_tm = $start_book_time;
    $end_dt_tm = $end_book_time;

    $end_date_only = date("Y-m-d 00:00:00", strtotime($end_dt_tm)); // only date not time
    $start_date_only = date("Y-m-d 00:00:00", strtotime($strt_date_tm)); // only date not time

    $totalhr = round(
        (strtotime($end_dt_tm) - strtotime($start_date_only)) / 3600
    );

    $time1 = strtotime($strt_date_tm);
    $time2 = strtotime($end_dt_tm);
    $no_of_loop = ceil($totalhr / 24);
    if ($totalhr % 24 == 0) {
        $no_of_loop += 1;
    }

    $cur_date = "";
    $total_price = 0;

    for ($i = 0; $i < $no_of_loop; $i++) {
        $strtdt = strtotime($strt_dt_tm);
        $day = strtolower(date("l", $strtdt));

        if ($day == "saturday" || $day == "sunday" || $day == "friday") {
            $price = $vehicle_weekend_cost;
        } else {
            $price = $vehicle_cost;
        }

        $perhour = $price / 24;

        $day_end_time = date(
            "Y-m-d 00:00:00",
            strtotime($strt_dt_tm . "+1 day")
        );

        $daystart_time = date("Y-m-d 00:00:00", strtotime($strt_dt_tm));

        $totalhrperday =
            (strtotime($day_end_time) - strtotime($strt_dt_tm)) / 3600;

        $cur_date = date("Y-m-d", strtotime($strt_dt_tm));
        $end_date = date("Y-m-d", strtotime($end_dt_tm));

        if ($cur_date == $end_date) {
            $totalhrperday =
                (strtotime($end_dt_tm) - strtotime($strt_dt_tm)) / 3600;
            $total_price += round($totalhrperday * $perhour);
        } else {
            $total_price += round($totalhrperday * $perhour);
        }

        $strt_dt_tm = date("Y-m-d 00:00:00", strtotime($strt_dt_tm . "+1 day"));
    }

    return round($total_price);
}

?>





