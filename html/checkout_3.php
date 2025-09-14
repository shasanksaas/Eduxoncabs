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
   
   //print_r($_REQUEST);
   $get_id = 0;
   $from_dt_time = date("Y-m-d") . " 6:00";
   $to_dt_time = date("Y-m-d") . " 12:00";
   $vehicle_id ="";
   if (isset($_POST['book_bike'])) {
       $vehicle_id = filter($_POST['vehicle_id'],$mysqli_conn);
       $from_dt_time = filter($_POST['from_dt_time'],$mysqli_conn);
       $to_dt_time = filter($_POST['to_dt_time'],$mysqli_conn);
   
   }else{
       header("location:all-bikes-bike-for-rental-bhubaneswar.php");
   }
   
   if($vehicle_id==""){
        header("location:all-bikes-bike-for-rental-bhubaneswar.php");
   }
   
   
   $get_bike_data = $dbObj->fetch_data("tbl_bikes", "md5(id) = '$vehicle_id'");
   
   
   $_SESSION['car_id'] = $get_bike_data[0]['id'];
   //CSRF
   $_SESSION["token"] = md5(uniqid(mt_rand(), true));
   
   
   if ($from_dt_time != '' || $to_dt_time != '') {
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
                     <form action="bikeRazorPay.php" method="POST" style="margin-top:20px;">
                        <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $get_bike_data[0]['id']; ?>"/>
                        <input type="hidden" name="csrf"  value="<?php echo $_SESSION["token"]; ?>" />
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-8">
                                 <label>City *</label>
                                 <!--<input type="text" value="Bhubaneswar"  maxlength="100" class="form-control" name="city" id="city" readonly="readonly">-->
                                 <?php ?>                                                <?php
                                    $city_id = $get_bike_data[0]['city'];
                                    $get_city_dta = $dbObj->fetch_data("tbl_city", "id = '$city_id'");
                                    ?>
                                 <input type="text" value="<?= $get_city_dta[0]['city']; ?>" disabled class="form-control" name="city" id="city" autocomplete="off" required>
                                 <input type="hidden" name="city1"  value="<?php echo $get_city_dta[0]['city']; ?>" />
                                 <?php ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Name *</label>
                                 <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" autocomplete="off" required>
                              </div>
                              <div class="col-md-6">
                                 <label>Email *</label>
                                 <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." autocomplete="off" maxlength="100" class="form-control" name="email" id="email" required>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Pick Up Location *</label>
                                 <!--<input type="text" maxlength="100" class="form-control" name="pickuploc" id="pickuploc" value="Bharti Tower,Airport Road,Forest Park,Bhubaneswar,Odisha" readonly>-->
                                 <?php ?>   
                                 <select class="form-control" name="pickuploc" id="pickuploc" required>
                                    <?php
                                       $get_location_data1 = $dbObj->fetch_data("location", "id=".$get_city_dta[0]['id']);
                                       foreach ($get_location_data1 as $data1) {                                                        
                                       ?>
                                    <option selected value="<?=$data1['id'];?>" >
                                       <?=$data1['pickup_point'];?>
                                    </option>
                                    <?php } ?>
                                 </select>
                                 <?php ?>
                              </div>
                              <div class="col-md-6">
                                 <label>Drop-off Location *</label>
                                 <!--<input type="text" maxlength="100" class="form-control" name="droploc" value="Bharti Tower,Airport Road,Forest Park,Bhubaneswar,Odisha" id="droploc" readonly>-->
                                 <?php ?>
                                 <select class="form-control" name="droploc" id="droploc" required>
                                    <?php 
                                       foreach ($get_location_data1 as $data1) {
                                       
                                       ?>
                                    <option selected value="<?=$data1['drop_point'];?>" >
                                       <?=$data1['drop_point'];?>
                                    </option>
                                    <?php } ?>
                                 </select>
                                 <?php ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6">
                                 <label>Pickup Date *</label>
                                 <input type="text" maxlength="100" class="form-control" name="pdate" value="<?php echo date('Y-m-d', strtotime($from_dt_time)); ?>" id="pdate" autocomplete="off" required onChange="return calculateTime($('#dtime').val(), this.value, $('#ptime').val(), $('#ddate').val());">
                              </div>
                              <div class="col-md-6">
                                 <label>Pickup Time*</label>
                                 <select class="form-control" name="ptime" id="ptime" required onChange="return calculateTime($('#dtime').val(), $('#pdate').val(), this.value, $('#ddate').val());">
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
                                 <input type="text" value="<?php echo date('Y-m-d', strtotime($to_dt_time)); ?>" maxlength="100" class="form-control" name="ddate" autocomplete="off" id="ddate" required onBlur="return calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), this.value);" placeholder="YYYY-MM-DD">
                              </div>
                              <div class="col-md-6">
                                 <label>Drop-off Time*</label>
                                 <select class="form-control" name="dtime" id="dtime" required onChange="return calculateTime(this.value, $('#pdate').val(), $('#ptime').val(), $('#ddate').val());" placeholder="YYYY-MM-DD">
                                    <option value="">Select Time</option>
                                    <?php
                                       for ($i = 6; $i < 24; $i++) {
                                       
                                           $num = $i > 23 ? $i - 24 : $i;
                                       
                                           $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                       
                                           if ($dtime == $num) {
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
                                 <label>Message *</label>
                                 <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message"></textarea>
                              </div>
                              <div class="col-md-6">
                                 <label>Mobile No*</label>
                                 <input type="number" value="" data-msg-required="Please enter the subject." maxlength="10" class="form-control" name="phone" autocomplete="off" id="phone" required>
                              </div>
                              <div class="col-md-6">
                                 <label>DOB (licence) *</label>
                                 <input type="text" value="" data-msg-required="Please enter DOB."  class="form-control" name="dob" autocomplete="off"  id="dob" required  placeholder="YYYY-MM-DD" required>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12">
                                 <label>
                                    Security Payment * 
                                    <select style="border:2px solid #000;border-radius:4px;" name='securityPayment' id="security-payment-type">
                                       <!--<option value="online">Online</option>-->
                                       <option value="cash">Cash</option>
                                    </select>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12">
                                 <label><input type="checkbox" required>  I accept all information and Payments etc*</label>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                           <div class="col-md-4"></div>
                           <div class="col-md-6">
                              <input type="hidden" name="totalAmt" id="totalAmt" value=""/>
                              <input type="hidden" name="vehicle_name" id="vehicle_name" value="<?php echo $get_bike_data[0]['bike_name']; ?>"/>
                              <input type="hidden" name='securitymoneyprice' value="<?php echo $get_bike_data[0]['security']; ?>" />
                              <input type="submit" name='reserve' value="Reserve Now" class="btn btn-primary btn-lg mb-xlg" >
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-4">
                     <div class="col-md-12">
                        <img src="uploadedDocument/bikes/<?php echo $get_bike_data[0]['bike_image']; ?>" class="img-responsive" alt="bike_image">
                     </div>
                     <div class="col-md-12">
                        <h4 style="text-align:center"><?php echo $get_bike_data[0]['bike_name']; ?></h4>
                     </div>
                     <!--<div class="col-md-6">
                        <h5 class="mb-sm mt-sm"><strong>Pickup Date & Time</strong></h5>
                        
                         <h6 class="mb-sm mt-sm"><strong>24-04-2016 & 8.30</strong></h6>
                        
                         </div>
                        
                         <div class="col-md-6">
                        
                          <h5 class="mb-sm mt-sm"><strong>Pickup Date & Time</strong></h5>
                        
                         <h6 class="mb-sm mt-sm"><strong>24-04-2016 & 8.30</strong></h6>
                        
                        </div>-->
                     <div class="col-md-12">
                        <h6 class="mb-sm mt-sm" style="color:#000;text-align:justify;"><strong>Price Regular Days Rs. <span id="price"><?php echo $get_bike_data[0]['cost']; ?></span> / 24 Hr</strong></h6>
                     </div>
                     <div class="col-md-12" style="text-align:center" id="finalPrice">
                     </div>
                     <!--<div class="col-md-12" style="text-align:center" id="wkendPrice"> </div>-->
                     <div class="col-md-12">
                        <h4 class="mb-sm mt-sm" style="color:#FF0000;text-align:center"><strong> Security Fees includes Rs. <span id="price"><?php echo $get_bike_data[0]['security']; ?></span> / -</strong></h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php include("includes/site-footer.php"); ?>
      </div>
      <?php include("includes/inc-js.php"); ?>
      <script>
         $(document).ready(function () {
         
             var date1 = new Date('<?php echo $from_dt_time ?>'.replace(/-/g, "/"));
         
             var date2 = new Date('<?php echo $to_dt_time ?>'.replace(/-/g, "/"));
         
             var totalHr = diff_hours(date1, date2);
         
             var perHr = <?php echo $get_bike_data[0]['cost'] / 24; ?>;
         
             var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
             var dayName = days[date1.getDay()];
             if (dayName == 'Saturday' || dayName == 'Sunday') {
                 actuyalprice = <?php echo $get_bike_data[0]['weekend_cost']; ?>;
         
             } else {
                 actuyalprice = <?php echo $get_bike_data[0]['cost']; ?>;
             }
         
             //var totalAmt = calc_price(date1, date2);
             var totalAmt = (totalHr <= 24) ? actuyalprice : calc_price(date1, date2);
         
         
         
             $('#totalAmt').val(Math.round(totalAmt +<?php echo $get_bike_data[0]['security']; ?>));
             $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(totalAmt +<?php echo $get_bike_data[0]['security']; ?>) + '</span> / -</strong></h4>');
         
         
         
             $("#security-payment-type").change(function () {
         
         
                 var securityPaymentType = $(this).val();
                 var totalpayable = $('#totalAmt').val();
         
                 if (securityPaymentType == "cash") {
                     //$('#totalAmt').val(amount);
                     $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(totalpayable -<?php echo $get_bike_data[0]['security']; ?>) + '</span> / -</strong></h4>');
                     //$('#totalAmt').val(totalpayable-<?php echo $get_bike_data[0]['security']; ?>);
                 }
                 if (securityPaymentType == "online") {
                     //$('#totalAmt').val(totalAmt-3000);
                     //$('#totalAmt').val(totalpayable);
                     $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(totalpayable) + '</span> / -</strong></h4>');
                 }
         
             });
         
         
         
             $('#ptime').val('<?php echo date('G:i', strtotime($from_dt_time)); ?>');
         
             $('#dtime').val('<?php echo date('G:i', strtotime($to_dt_time)); ?>');
         
             $("#dob").datepicker({
         
                 dateFormat: "yy-mm-dd",
         
                 maxDate: '<?php echo $dat =date("Y-m-d",strtotime('-21 years')); ?>',
         
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
         
         
         
         });
         
         
         $(function () {
         
            /* $("#pickuploc").autocomplete({
         
                 source: 'search.php'
         
             });
         
             $( "#ddate" ).datepicker({
                  
              minDate: 0,
                  
              dateFormat: 'yy-mm-dd'
                  
              });*/
         
         });
         
         
         function calculateTime(dropTime, pdate, ptime, ddate) {
         
             //alert(dropTime);
         
             var pickTime = pdate + " " + ptime;
         
             var dropTimeh = ddate + " " + dropTime;
         
             if (dropTime != 0) {
         
                 dt1 = new Date(pickTime.replace(/-/g, "/"));
         
                 dt2 = new Date(dropTimeh.replace(/-/g, "/"));
         
                 var t = diff_hours(dt1, dt2);
         
                 if (t < 12) {
         
                     alert("sorry you need to select more than 12 Hr.");
         
                     $('#ptime').val('');
         
                     $('#dtime').val('');
         
                     return false;
         
                 }
         
                 var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                 var dayName = days[dt1.getDay()];
                 if (dayName == 'Saturday' || dayName == 'Sunday') {
                     actuyalprice = <?php echo $get_bike_data[0]['weekend_cost']; ?>;
         
                 } else {
                     actuyalprice = <?php echo $get_bike_data[0]['cost']; ?>;
                 }
         
                 var ct = actuyalprice / 24;
                 //var ct = calc_price(dt1, dt2);
         
                 //var tot = (t <= 24) ? calc_price(dt1, dt2) : t * ct;
                 var tot = (t <= 24) ? actuyalprice : calc_price(dt1, dt2);
         
                 $('#totalAmt').val(Math.round(tot +<?php echo $get_bike_data[0]['security']; ?>));
         
                 $('#finalPrice').html('<h4 class="mb-sm mt-sm" style="color:#FF0000"><strong> Total Cost Rs. <span id="price">' + Math.round(tot +<?php echo $get_bike_data[0]['security']; ?>) + '</span> / -</strong></h4>');
         
                 $('#security-payment-type').val('online');
         
         
             }
         
         }
         
         function diff_hours(dt2, dt1)
         {
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
             for (var i = 0; i < no_of_loop; i++) {
         
                 // getting day name from date
                 var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                 var dayName = days[day_start_dt.getDay()];
         
                 if (dayName == 'Saturday' || dayName == 'Sunday') {
                     price = <?php echo $get_bike_data[0]['weekend_cost']; ?>;
         
                 } else {
                     price = <?php echo $get_bike_data[0]['cost']; ?>;
                 }
                 var perhour = price / 24;
         
                 var newstartTime = new Date(day_start_date.setDate(day_start_dt.getDate() + 1)); // next day start is end of last date
                 newstartTime = new Date(newstartTime.getFullYear() + "/" + (newstartTime.getMonth() + 1) + "/" + newstartTime.getDate() + " 00:00");  // next day start is end of last date
         
                 //console.log();
         
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
                 if (dayName == 'Saturday' || dayName == 'Sunday') {
                     wkend_price += perhour * totalHourPerday;
                     weekend_hour += totalHourPerday;
         
                 }
         
                 day_start_dt = newstartTime;
         
         
             }
             if (wkend_price > 0) {
         
                 $("#wkendPrice").html("<h4 class='mb-sm mt-sm' style='color:#FF0000'><strong> Weekend price  <?php echo $get_bike_data[0]['weekend_cost']; ?> / 24 Hr <br> Weekend Hr " + weekend_hour + " total : " + Math.round(wkend_price) + "</strong></h4>")
             } else {
                 $("#wkendPrice").html("");
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
         
             //Disable mouse right click
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