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

$mysqli_conn = new mysqli(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

$get_id = filter($_GET['cardta'],$mysqli_conn);

$get_car_dta = $dbObj->fetch_data("tbl_cabs", "md5(id) = '$get_id'");


$pdate = filter($_GET['pdate'],$mysqli_conn);

$ptime = filter($_GET['ptime'],$mysqli_conn);

$ddate = filter($_GET['ddate'],$mysqli_conn);

$dtime = filter($_GET['dtime'],$mysqli_conn);

//$_SESSION['car_id'] = $get_car_dta[0]['id'];
//CSRF
$_SESSION["token"] = md5(uniqid(mt_rand(), true));


if ($pdate != '' || $ptime != '' || $ddate != '' || $dtime != '') {
   ?>
   <!DOCTYPE html>
   <html>

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Checkout | Eduxoncabs.com</title>
      <meta name="keywords" content="Eduxoncabs.com" />
      <meta name="description" content="Eduxoncabs.com">
      <meta name="author" content="Eduxoncabs.com">
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
      <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
      <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light"
         rel="stylesheet" type="text/css">
      <?php include("includes/inc-css.php"); ?>
   </head>

   <body>
      <div class="body">
         <?php include("includes/site-header-inner.php"); ?>
         <div role="main" class="main">
            <div class="container">
               <div class="row">
                  <div class="col-md-8">
                     <h4 class="mb-sm mt-sm"><strong>Information for Booking</strong></h4>
                     <form action="razorpayment.php" method="POST" style="margin-top:20px;" enctype="multipart/form-data">
                         
                        <input type="hidden" name="car_id" id="car_id" value="<?php echo $get_car_dta[0]['id']; ?>" />
                        <input type="hidden" name="csrf" value="<?php echo $_SESSION["token"]; ?>" />
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-8">
                                 <label>City *</label>
                                 <?php
                                 $city_id = $get_car_dta[0]['city'];
                                 $get_city_dta = $dbObj->fetch_data("location", "id = '$city_id'");
                                 ?>
                                 <input type="text" value="<?= $get_city_dta[0]['city_location']; ?>" disabled
                                    class="form-control" name="city" id="city" autocomplete="off" required>
                                 <input type="hidden" name="city1"
                                    value="<?php echo $get_city_dta[0]['city_location']; ?>" />
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Name *</label>
                                 <input type="text" value="" data-msg-required="Please enter your name." maxlength="100"
                                    class="form-control" name="name" id="name" autocomplete="off" required>
                              </div>
                              <div class="col-md-6">
                                 <label>Email *</label>
                                 <input type="email" value="" data-msg-required="Please enter your email address."
                                    data-msg-email="Please enter a valid email address." autocomplete="off" maxlength="100"
                                    class="form-control" name="email" id="email" required>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Pick Up Location *</label>
                                 <select class="form-control" name="pickuploc" id="pickuploc" required>
                                    <?php
                                    $get_location_data1 = $dbObj->fetch_data("location", "id=" . $get_city_dta[0]['id']);
                                    foreach ($get_location_data1 as $data1) {
                                       ?>
                                       <option selected value="<?= $data1['id']; ?>">
                                          <?= $data1['pickup_point']; ?>
                                       </option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <div class="col-md-6">
                                 <label>Drop-off Location *</label>
                                 <select class="form-control" name="droploc" id="droploc" required>
                                    <?php
                                    foreach ($get_location_data1 as $data1) {

                                       ?>
                                       <option selected value="<?= $data1['drop_point']; ?>">
                                          <?= $data1['drop_point']; ?>
                                       </option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Pickup Date *</label>
                                 <input type="text" maxlength="100" class="form-control" name="pdate"
                                    value="<?php echo $pdate; ?>" id="pdate" autocomplete="off" required
                                    onChange="return calculateTime($('#dtime').val(), this.value, $('#ptime').val(), $('#ddate').val());">
                              </div>
                              <div class="col-md-6">
                                 <label>Pickup Time*</label>
                                 <select class="form-control" name="ptime" id="ptime" required
                                    onChange="return calculateTime($('#dtime').val(), $('#pdate').val(), this.value, $('#ddate').val());">
                                    <option value="">Select Time</option>
                                    <?php
                                    for ($i = 6; $i < 24; $i++) {

                                       $num = $i > 23 ? $i - 24 : $i;

                                       //$num = $num < 10 ? "0$num" : $num;
                                 
                                       $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                       if ($ptime == $num) {
                                          $sel = 'selected';
                                       } else {
                                          $sel = '';
                                       }

                                       echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Drop-off Date *</label>
                                 <input type="text" value="<?php echo $ddate; ?>" maxlength="100" class="form-control"
                                    name="ddate" autocomplete="off" id="ddate" required
                                    onBlur="return calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), this.value);"
                                    placeholder="YYYY-MM-DD">
                              </div>
                              <div class="col-md-6">
                                 <label>Drop-off Time*</label>
                                 <select class="form-control" name="dtime" id="dtime" required
                                    onChange="return calculateTime(this.value, $('#pdate').val(), $('#ptime').val(), $('#ddate').val());"
                                    placeholder="YYYY-MM-DD">
                                    <option value="">Select Time</option>
                                    <?php
                                    for ($i = 6; $i < 24; $i++) {

                                       $num = $i > 23 ? $i - 24 : $i;

                                       //$num = $num < 10 ? "0$num" : $num;
                                 
                                       $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                       if ($dtime == $num) {
                                          $sel = 'selected';
                                       } else {
                                          $sel = '';
                                       }

                                       //$select = 
                                 
                                       echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Message *</label>
                                 <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10"
                                    class="form-control" name="message" id="message"></textarea>
                              </div>
                              <div class="col-md-6">
                                 <label>Mobile No*</label>
                                 <input type="number" value="" data-msg-required="Please enter mobile number."
                                    maxlength="10" class="form-control" name="phone" autocomplete="off" id="phone"
                                    required>
                              </div>
                              <div class="col-md-6">
                                 <label>DOB (licence) *</label>
                                 <input type="text" value="" data-msg-required="Please enter DOB." class="form-control"
                                    name="dob" autocomplete="off" id="dob" placeholder="YYYY-MM-DD" required>
                              </div>
                              <div class="col-md-4">
                                 <label><span id='cpnmsg' style="font-size:9px;"></span></label>
                                 <input type="text" data-msg-required="Invalid Coupon." class="form-control" name="coupon"
                                    autocomplete="off" id="coupon" placeholder="coupon" /> <input type="button"
                                    name='checkgv' id='checkgv' value="Apply Coupon Code"
                                    style="background:#006600; color:#fff; border-radius:5px;font-size:17px; margin-top:10px; padding:5px 8px;">
                              </div>
                              <div class="col-md-6" style="margin-top:15px;">
                                 <label>DL Number *</label>
                                 <input type="text" class="form-control" name="licenseNumber" autocomplete="off"
                                    id="licenseNumber" maxlength="18" required />
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12">
                                 <label>
                                    Security Payment *
                                    <select style="border:2px solid #000;border-radius:4px;" name='securityPayment'
                                       id="security-payment-type">
                                       <!--<option value="online">Online</option>-->
                                       <option value="cash">Cash(Pay at Site)</option>
                                    </select>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12">
                                 <label>
                                    <input type="checkbox" required>
                                    I have Read & Accepted all <a href="https://www.eduxoncabs.com/page.php?page=faq"
                                       style="color:red;" target="blank">Terms & Conditions</a> and Payments etc*</label>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                           <div class="col-md-4"></div>
                           <div class="col-md-6">
                              <input type="hidden" name="totalAmt" id="totalAmt" value="" />
                              <input type="hidden" name="gvcode" id="gvcode" value="" />
                              <input type="hidden" name="gvamount" id="gvamount" value="" />
                              <input type="hidden" name="wkdayshr" id="wkdayshr" value="" />
                              <input type="hidden" name="wkendhr" id="wkendhr" value="" />
                              <input type="hidden" name="wkdaysamnt" id="wkdaysamnt" value="" />
                              <input type="hidden" name="wkendamnt" id="wkendamnt" value="" />
                              <input type="hidden" name="carnme" id="carnme"
                                 value="<?php echo $get_car_dta[0]['car_nme']; ?>" />
                              <input type="hidden" id="securitymoneyprice" name='securitymoneyprice'
                                 value="<?php echo $get_car_dta[0]['security']; ?>" />
                              <input type="submit" id='book_now' name='reserve' value="Reserve Now"
                                 class="btn btn-primary btn-lg mb-xlg">
                             <a href="razorpayment.php" id="reserve_with_razorpay" name="reserve" class="btn btn-primary btn-lg mb-xlg" style="display:none;">
                                    Reserve Now With Razorpay
                                </a>


                           </div>
                        </div>
                     </form>
                     
                     
                  </div>
                  <div class="col-md-4">
                     <div class="col-md-12"> <img src="uploadedDocument/cab/<?php echo $get_car_dta[0]['car_image']; ?>"
                           class="img-responsive" alt="car_image"> </div>
                     <div class="col-md-12">
                        <h4 style="text-align:center"><?php echo $get_car_dta[0]['car_nme']; ?></h4>
                     </div>
                     <div class="col-md-12">
                        <h6 class="mb-sm mt-sm" style="color:#000;text-align:justify;">
                           <strong>Price Regular Days Rs. <span id="price"><?php echo $get_car_dta[0]['cost']; ?></span> /
                              24 Hr</strong></h4>
                     </div>
                     <div class="col-md-12">
                        <h6 class="mb-sm mt-sm" style="color:#000;text-align:justify;">
                           <strong>Weekend Price:Rs. <span id="price"><?php echo $get_car_dta[0]['weekend_cost']; ?></span>
                              / 24 Hr</strong></h4>
                     </div>
                     <div class="col-md-12" id='weekday'> </div>
                     <div class="col-md-12" id="wkendPrice"> </div>
                     <div class="col-md-12">
                     </div>
                     <div class="col-md-12">
                        <h6 class="mb-sm mt-sm" style="color:#000;text-align:justify;"><strong> Refundable Security
                              Fees:Rs. <span id="price"><?php echo $get_car_dta[0]['security']; ?></span> / -</strong></h6>
                     </div>
                     <div class="col-md-12" id="discount"> </div>
                     <div class="col-md-12">
                        <hr
                           style="display: block; margin-top: 0.5em; margin-bottom: 0.5em; margin-left: auto; margin-right: auto;    border-style: inset;  border-width: 1px;">
                     </div>
                     <div class="col-md-12" style="color:#000;text-align:justify;" id="finalPrice"> </div>
                  </div>
               </div>
            </div>
         </div>
         <?php include("includes/site-footer.php"); ?>
      </div>
      <?php include("includes/inc-js.php"); ?>
      
      
      
      <script>
         $(document).ready(function () {
        // Get the user's IP address using an external API
        $.get('https://api.ipify.org?format=json', function(data) {
            var userIp = data.ip;

            // Check if the user's IP matches the specific IP
            if (userIp === '124.253.128.203') {
                // Show the "Reserve Now With Razorpay" button if IP matches
                $('#reserve_with_razorpay').show();
            } else {
                // Hide the "Reserve Now With Razorpay" button if IP doesn't match
                $('#reserve_with_razorpay').hide();
            }
        });
    

            var date1 = new Date('<?php echo $pdate . " " . $ptime; ?>'.replace(/-/g, "/"));

            var date2 = new Date('<?php echo $ddate . " " . $dtime; ?>'.replace(/-/g, "/"));

            var totalHr = diff_hours(date1, date2);

            var perHr = <?php echo $get_car_dta[0]['cost'] / 24; ?>;

            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var dayName = days[date1.getDay()];
            if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
               actuyalprice = <?php echo $get_car_dta[0]['weekend_cost']; ?>;

            } else {
               actuyalprice = <?php echo $get_car_dta[0]['cost']; ?>;
            }

            if (totalHr <= 12) {
               actuyalprice = actuyalprice / 2;
            }

            //var totalAmt = calc_price(date1, date2);
            var totalAmt = (totalHr <= 12) ? actuyalprice : calc_price(date1, date2);


            $('#totalAmt').val(Math.round(totalAmt + <?php echo $get_car_dta[0]['security']; ?>));
            $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(totalAmt) + '</span> / -</strong></h4>');
            //$('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(totalAmt +<?php
            //echo $get_car_dta[0]['security']; ?>) + '</span> / -</strong></h4>');



            $("#security-payment-type").change(function () {



               var securityPaymentType = $(this).val();
               var totalpayable = $('#totalAmt').val();

               //if Gv applied then final price
               var gvrequiredAmount = Math.round(totalpayable - <?php echo $get_car_dta[0]['security']; ?>);
               var applycoupon = $('#gvcode').val();
               var discountprice = 0;
               if (gvrequiredAmount > 3500 && applycoupon == "successgv") {
                  //$('#discount').html('Discount Price : ');  
                  discountprice = $('#gvamount').val();
               } else {
                  $('#discount').html('');
                  $('#gvcode').val("");
                  $('#cpnmsg').html("");
               }

               if (securityPaymentType == "cash") {

                  $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(totalpayable - <?php echo $get_car_dta[0]['security']; ?> - discountprice) + '</span> / -</strong></h4>');

               }
               if (securityPaymentType == "online") {

                  $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(totalpayable - discountprice) + '</span> / -</strong></h4>');
               }

            });



            $('#ptime').val('<?php echo $ptime; ?>');

            $('#dtime').val('<?php echo $dtime; ?>');


            $("#dob").datepicker({

               dateFormat: "yy-mm-dd",

               maxDate: '<?php echo $dat = date("Y-m-d", strtotime('-21 years')); ?>',

            });

            $("#pdate").datepicker({

               dateFormat: "yy-mm-dd",

               minDate: 0,

               onSelect: function (date) {

                  calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), $('#ddate').val());

                  var date2 = $('#pdate').datepicker('getDate');

                  //date2.setDate(date2.getDate() + 1);

                  $('#ddate').datepicker('setDate', date2);

                  //sets minDate to dt1 date + 1

                  $('#ddate').datepicker('option', 'minDate', date2);

               }

            });

            $('#ddate').datepicker({

               dateFormat: "yy-mm-dd",

               minDate: 0,

               onClose: function () {

                  calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), $('#ddate').val());

                  var dt1 = $('#pdate').datepicker('getDate');

                  var dt2 = $('#ddate').datepicker('getDate');

                  //check to prevent a user from entering a date below date of dt1

                  if (dt2 < dt1) {

                     var minDate = $('#ddate').datepicker('option', 'minDate');

                     $('#ddate').datepicker('setDate', minDate);

                  }

               }

            });
            $("#book_now").click(function () {
               calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), $('#ddate').val());
            });


            // Check Coupon code checkgv
            $("#checkgv").click(function () {
               var gvcoupon = $('#coupon').val();
               var phonenumber = $('#phone').val();
               var bookingAmount = $('#totalAmt').val() - $('#securitymoneyprice').val();

               $.post("checkgv.php", { phone: phonenumber, voucher: gvcoupon, bookAmont: bookingAmount }, function (data) {

                  var pay_type = "online";
                  var secure_price = <?php echo $get_car_dta[0]['security'] ?>;
                  if ($('#security-payment-type').val() == "cash") {
                     pay_type = "cash";
                     secure_price = 0;
                  }

                  if (data['status'] == 'success') {
                     $('#gvcode').val("successgv");
                     $('#discount').html('Discount applied :' + data['coupon_amount']);
                     $('#gvamount').val(data['coupon_amount']);
                     $('#cpnmsg').html(data['msg']);
                     $('#cpnmsg').css("color", "Green");
                     $('#security-payment-type').val(pay_type);

                     $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(bookingAmount + secure_price - data['coupon_amount']) + '</span> / -</strong></h4>');

                  } else {
                     $('#gvcode').val("");
                     $('#cpnmsg').html(data['msg']);
                     $('#cpnmsg').css("color", "red");
                     $('#discount').html('');
                     $('#gvamount').val(0);
                     $('#security-payment-type').val(pay_type);

                     $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(bookingAmount + secure_price) + '</span> / -</strong></h4>');

                  }
               }, "json");
            });



         });


         <?php
         $get_hour_res = $dbObj->fetch_data("tbl_min_hour", "status = '1'");
         $min_book_hour = $get_hour_res[0]['hours'];
         ?>
         function calculateTime(dropTime, pdate, ptime, ddate) {

            //alert(dropTime);

            var pickTime = pdate + " " + ptime;

            var dropTimeh = ddate + " " + dropTime;

            if (dropTime != 0) {

               dt1 = new Date(pickTime.replace(/-/g, "/"));

               dt2 = new Date(dropTimeh.replace(/-/g, "/"));

               var t = diff_hours(dt1, dt2);

               if (t < <?= $min_book_hour; ?>) {

                  alert("sorry you need to select more than <?= $min_book_hour; ?> Hr.");

                  $('#ptime').val('');

                  $('#dtime').val('');

                  return false;

               }
               if (dt2 < dt1) {

                  alert("sorry , return time can't be less than booking time");

                  $('#ptime').val('');

                  $('#dtime').val('');

                  return false;

               }

               var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
               var dayName = days[dt1.getDay()];
               if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
                  actuyalprice = <?php echo $get_car_dta[0]['weekend_cost']; ?>;

               } else {
                  actuyalprice = <?php echo $get_car_dta[0]['cost']; ?>;
               }
               if (t <= 12) {
                  actuyalprice = actuyalprice / 2;
               }

               var ct = actuyalprice / 24;
               //var ct = calc_price(dt1, dt2);

               //var tot = (t <= 24) ? calc_price(dt1, dt2) : t * ct;
               var tot = (t <= 12) ? actuyalprice : calc_price(dt1, dt2);

               var applycoupon = $('#gvcode').val();
               var discountprice = 0;
               if (tot > 3500 && applycoupon == "successgv") {
                  //$('#discount').html('Discount Price : ');  
                  discountprice = $('#gvamount').val();
               } else {
                  $('#discount').html('');
                  $('#gvcode').val("");
                  $('#cpnmsg').html("");
               }

               // check payment type and set price based on that
               var pay_type = "online";
               var secure_price = <?php echo $get_car_dta[0]['security'] ?>;
               if ($('#security-payment-type').val() == "cash") {
                  pay_type = "cash";
                  secure_price = 0;
               }

               $('#totalAmt').val(Math.round(tot + <?php echo $get_car_dta[0]['security']; ?>));

               $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(tot + secure_price - discountprice) + '</span> / -</strong></h4>');

               $('#security-payment-type').val(pay_type);



            }

         }

         function diff_hours(dt2, dt1) {



            var diff = (dt2.getTime() - dt1.getTime()) / 1000;

            diff /= (60 * 60);

            return Math.abs(Math.round(diff));


         }
         function calc_price(frmDate, toDate) {
            // MY CODE ***************
            var day_start_dt = new Date(frmDate); //new Date("2018-03-09 09:00");

            var day_start_date = new Date(frmDate); //new Date("2018-03-09 09:00");
            var day_end = new Date(toDate); //new Date("2018-03-12 10:00");

            //*************************

            var end_date_only = new Date(day_end.getFullYear() + "/" + (day_end.getMonth() + 1) + "/" + day_end.getDate());  // only date not time
            var start_date_only = new Date(day_start_date.getFullYear() + "/" + (day_start_date.getMonth() + 1) + "/" + day_start_date.getDate());  // only date not time

            //var total_days = (day_end - day_start_dt) / (1000 * 60 * 60 * 24);
            var total_day_hour = (day_end.getTime() - start_date_only.getTime()) / 1000;
            total_day_hour /= (60 * 60);
            total_day_hour = Math.round(total_day_hour);



            var no_of_loop = Math.ceil(total_day_hour / 24);

            if (total_day_hour % 24 == 0) {

               no_of_loop += 1;
            }


            var price = 0;
            var totalHourPerday = 0;
            var total_price = 0;
            var wkend_price = 0;
            var weekend_hour = 0;
            var wkday_price = 0;
            var weekday_hour = 0;

            for (var i = 0; i < no_of_loop; i++) {

               // getting day name from date
               var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
               var dayName = days[day_start_dt.getDay()];

               if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
                  price = <?php echo $get_car_dta[0]['weekend_cost']; ?>;

               } else {
                  price = <?php echo $get_car_dta[0]['cost']; ?>;
               }
               var perhour = price / 24;

               var newstartTime = new Date(day_start_date.setDate(day_start_dt.getDate() + 1)); // next day start is end of last date
               newstartTime = new Date(newstartTime.getFullYear() + "/" + (newstartTime.getMonth() + 1) + "/" + newstartTime.getDate() + " 00:00");  // next day start is end of last date

               //console.log(newstartTime);

               var cur_date = new Date(day_start_dt.getFullYear() + "/" + (day_start_dt.getMonth() + 1) + "/" + day_start_dt.getDate());  // only date not time
               var end_date = new Date(day_end.getFullYear() + "/" + (day_end.getMonth() + 1) + "/" + day_end.getDate());  // only date not time
               // Calculate total hour
               var current_day_start = newstartTime;

               // Total hour per day
               var diff = (newstartTime.getTime() - day_start_dt.getTime()) / 1000;
               diff /= (60 * 60);
               totalHourPerday = Math.round(diff);



               if ("'" + cur_date + "'" == "'" + end_date + "'") {
                  var diff = (day_end.getTime() - day_start_dt.getTime()) / 1000;
                  diff /= (60 * 60);
                  totalHourPerday = Math.round(diff);
                  total_price += Math.round(totalHourPerday * perhour);

                  console.log(cur_date + " : " + totalHourPerday + " : " + perhour + " : " + total_price);

               } else {

                  total_price += Math.round(totalHourPerday * perhour);

                  //console.log(totalHourPerday+" : "+total_price);
                  console.log(cur_date + " : " + totalHourPerday + " : " + perhour + " : " + total_price);
               }
               if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
                  wkend_price += perhour * totalHourPerday;
                  weekend_hour += totalHourPerday;

               } else {
                  wkday_price += perhour * totalHourPerday;
                  weekday_hour += totalHourPerday;
               }

               day_start_dt = newstartTime;


            }
            if (wkend_price > 0) {

               $('#wkdayshr').val(weekday_hour);
               $('#wkendhr').val(weekend_hour);
               $('#wkdaysamnt').val(wkday_price);
               $('#wkendamnt').val(wkend_price);

               $("#wkendPrice").html("<h6 class='mb-sm mt-sm' style='color:#000;text-align:justify;'><strong> Total Weekend Hrs " + weekend_hour + " Hrs total : " + Math.round(wkend_price) + "</strong></h6>");

               $("#weekday").html("<h6 class='mb-sm mt-sm' style='color:#000;text-align:justify;'><strong> Total Regular days Hrs " + weekday_hour + " Hrs total : " + Math.round(wkday_price) + "</strong></h6>");
            } else {
               $('#wkdayshr').val(weekday_hour);
               $('#wkdaysamnt').val(wkday_price);

               $("#wkendPrice").html("");

               $("#weekday").html("<h6 class='mb-sm mt-sm' style='color:#000;text-align:justify;'><strong> Total Regular days Hrs " + weekday_hour + " Hrs total : " + Math.round(wkday_price) + "</strong></h6>");
            }
            return total_price;
         }


      </script>
      
      
      
      
      
      
      <script type="text/javascript">
         $(document).ready(function () {
            //Disable cut copy paste
            $('body').bind('cut copy paste', function (e) {
               e.preventDefault();
            });
         
                Disable mouse right click
            $("body").on("contextmenu", function (e) {
               return false;
            });
         });
      </script>
   </body>

   </html>
   <?php
} else {

   header("location:index.php");
}
?>