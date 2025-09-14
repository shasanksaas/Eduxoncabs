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
//print_r($_REQUEST);

$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

 $date = date('Y-m-d H:i:s');
 //$date = date('Y-m-d H:i:s',strtotime($date)+19800);

$pickuploc = isset($_GET['pickuploc']) ? filter($_GET['pickuploc'], $mysqli_conn) : '';
$droploc   = isset($_GET['droploc']) ? filter($_GET['droploc'], $mysqli_conn) : '';
//$tdate	   = date("Y-m-d",strtotime(filter($_GET['pdate'])));
$tdate     = isset($_GET['pdate']) ? filter($_GET['pdate'], $mysqli_conn) : '';
$ptime     = isset($_GET['ptime']) ? filter($_GET['ptime'], $mysqli_conn) : '';
$ddate     = isset($_GET['ddate']) ? filter($_GET['ddate'], $mysqli_conn) : '';
$dtime     = isset($_GET['dtime']) ? filter($_GET['dtime'], $mysqli_conn) : '';
$st_dte	   = $tdate." ".$ptime;
$end_dte   = $ddate." ".$dtime;
$act       = isset($_GET['act']) ? filter($_GET['act'], $mysqli_conn) : '';
$today	   = date("Y-m-d",strtotime($date));
//$pdate = strtotime(date("Y-m-d H:i"));
$pdate = date("Y-m-d H:i",strtotime($date));
$city      = isset($_GET['city']) ? filter($_GET['city'], $mysqli_conn) : '';


$from_dt_time = date("Y-m-d")." 6:00";
$to_dt_time = date("Y-m-d")." 12:00";
$nxt6hr = date('Y-m-d H:i:s',strtotime($date ."+6 hour"));

$nxt18hr = date('Y-m-d H:i:s',strtotime($date ."+18 hour"));

if($tdate!="" && $ptime!="" && $ddate!="" && $dtime){
$from_dt_time = "$st_dte";
$to_dt_time = "$end_dte";
$nxt6hr = date('Y-m-d H:i:s',strtotime($st_dte ."+6 hour"));

$nxt18hr = date('Y-m-d H:i:s',strtotime($st_dte ."+18 hour"));
}

?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>All Cars for Self Drive in Bhubaneswar – Eduxon Cabs</title>
<meta name="keywords" content="Eduxoncabs.com" />
<meta name="description" content="Browse all self-drive cars in Bhubaneswar with Eduxon Cabs. Affordable rentals, no hidden charges, and unlimited kilometers. Book your ride today!"/>
<meta name="author" content="Eduxoncabs.com">
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
</head>
<body>
    <style>
        .hdetails{
            text-align:center;
        }
        .col-fixed-height {
  height: 348pt;
}
.car-img {
  width: 320px;
  height: 195px;
}
.note-text {
  font-size: 8pt;
}

    </style>
<div class="body">
  <?php include("includes/site-header-inner.php");?>

  <div role="main" class="main">
   
    <div class="container">
<h5 class="all-cars-text-headinglast">Check out our available self-drive cars below and book your preferred vehicle today!</h5>
      <div class="row">
               <?php 
                                 $ad_qr = "";
                                 if(isset($city) && $city!=''){
                $ad_qr = " AND city ='$city' ";
              }
				$cnt = $dbObj->countRec("tbl_cabs","status = 1 $ad_qr ORDER BY cost ASC");
				if($cnt > 0){
					$getCar = $dbObj->fetch_data("tbl_cabs","status = 1 $ad_qr ORDER BY cost ASC");
					foreach($getCar as $key){
					$id = $key['id'];
				// 	$get_unavail = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND ('$pdate' BETWEEN `unavail_dte` AND `unavail_dte_to`)");
				
                   $get_unavail = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$from_dt_time' AND '$to_dt_time' OR `unavail_dte_to` BETWEEN '$from_dt_time' AND '$to_dt_time'))");

                                        //   Get availability after 6- 18 hour 
                                          $get_unavail_next6hr = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$nxt6hr' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$nxt18hr' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$nxt6hr' AND '$nxt18hr' OR `unavail_dte_to` BETWEEN '$nxt6hr' AND '$nxt18hr'))");
			?>
                 <div class="col-md-4 col-fixed-height">
                  <div class="cardetas">
                     <img src="uploadedDocument/cab/<?php echo $key['car_image'];?>" class="img-responsive car-img" alt="car_image">
                        <h6 class="hdetails"><i class="fa fa-automobile"></i><span class="spandta"><?php echo $key['car_nme'];?></span></h6>
                        <h6 class="hdetails"><i class="fa fa-check"></i><span class="spandta"><?php echo $key['no_of_seat'];?> Seater</span></h6>
                        <h6 class="hdetails"><i class="fa fa-support"></i><span class="spandta"><?php echo $key['fuel'];?></span></h6>
                        <h6 class="hdetails"><i class="fa fa-money"></i><span class="spandta">Rs <?php echo $key['cost'];?> /24 Hr</span></h6>
                       <h6 class="hdetails note-text">
                        Notes: <?php echo $key['offers'] != '' ? $key['offers'] : "NO"; ?>
                       </h6>

                        <?php 
						
							
						?>
                         <?php 
							   if($get_unavail > 0){

                                if($get_unavail_next6hr == 0){
                        //  $count = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$from_dt_time' AND '$to_dt_time' OR `unavail_dte_to` BETWEEN '$from_dt_time' AND '$to_dt_time'))");
                         $count = $dbObj->countRec("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$date' AND '$nxt6hr')");
                        if($count>0){
                        
                        //  $getres = $dbObj->fetch_data("tbl_unavail_dtes","car_id = $id AND (('$from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$from_dt_time' AND '$to_dt_time' OR `unavail_dte_to` BETWEEN '$from_dt_time' AND '$to_dt_time'))");
                         $getres = $dbObj->fetch_data("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$date' AND '$nxt6hr')");
                                 $enddt = $getres[0]['unavail_dte_to'];
                                         $totalhr = round((strtotime($enddt) - strtotime($date))/3600);
                                   if($totalhr==0){
                        $totalhr = 1;
                        }

                                                          echo '<h6 class="hdetails" style="font-size : 8pt; "> Available in next '.$totalhr.' hour </h6>';
                                                        } }
						 ?>
                        <h6 class="hdetails"><a href="javascript:void(0)" class="btn btn-success mb-xl">Car Booked <br> <?php //$avail = $tmto + 60*60; echo date("d M Y H:i", $avail);?></a></h6>
                        <?php
						}else{
						?>
                             
                               <h6 class="hdetails" style="text-align:center;">
    <a href="checkout.php?
        pdate=<?php echo !empty($tdate) ? $tdate : date('Y-m-d'); ?>&
        ptime=<?php echo !empty($ptime) ? $ptime : '6:00'; ?>&
        ddate=<?php echo !empty($ddate) ? $ddate : date('Y-m-d'); ?>&
        dtime=<?php echo !empty($dtime) ? $dtime : '12:00'; ?>&
        car=<?php echo md5($key['car_nme']); ?>&
        cartype=<?php echo md5($key['fuel']); ?>&
        cardta=<?php echo md5($key['id']); ?>" 
        class="btn btn-primary mb-xl">
        Book Now
    </a>
</h6>

                        <?php }?>
                         </div>
                  </div>
                  
                <?php
                }
                }else{
                ?>  
                    <div  class="cardetas"><h4>Sorry!!! No record found..</h4>
                            </a> </div>
                <?php }?>  
              
             
            </div>
              <h3 class="all-cars-text-heading">All Cars - Explore a Wide Range of Self-Drive Cars in Bhubaneswar </h3>
  <p class="all-cars-text-para">At <strong>Eduxon Cabs,</strong> we offer a wide selection of self-drive cars in Bhubaneswar, providing you with the flexibility and convenience to travel at your own pace. Whether you need a compact hatchback for city commuting, a comfortable sedan for business trips, an SUV for long drives, or a luxury car for a premium experience, we have the perfect vehicle for every need.<br>
Our self-drive car rental in Bhubaneswar is designed to give you a seamless experience with easy booking, transparent pricing, and no hidden charges. We also provide self-drive car rental services at Bhubaneswar Airport, ensuring you can pick up your car right after landing. With the best self-drive car rental in Bhubaneswar, you can enjoy unlimited kilometers, doorstep delivery, and well-maintained vehicles at affordable prices.</p>
<h3 class="all-cars-text-heading">Why Choose Our Self-Drive Car Rental Service?</h3>
<style>
    
h3.all-cars-text-heading {
    font-size: 1.8em;
    font-weight: 600;
    letter-spacing: normal;
    line-height: 24px;
    margin-bottom: 33px;
    text-transform: capitalize!important;
    font-family: 'Montserrat', sans-serif;
}

p.all-cars-text-para {
    color: #000;
    line-height: 24px;
    margin: -20px 0 20px;
    font-family: 'Montserrat', sans-serif;
}

ul.all-cars-text-list {
    list-style: none;
    margin: -20px 0 20px;
    font-family: 'Montserrat', sans-serif;
}

h5.all-cars-text-headinglast {
    font-size: 1.8em;
    font-weight: 600;
    letter-spacing: normal;
    line-height: 24px;
    margin-bottom: 33px;
    text-transform: capitalize!important;
    font-family: 'Montserrat', sans-serif;
}
</style>
<ul class="all-cars-text-list">
    <li>Multiple car options – hatchbacks, sedans, SUVs & luxury cars</li>
    <li>Hassle-free booking with no hidden charges</li>
    <li>Unlimited kilometers for long, worry-free trips</li>
    <li>Affordable pricing with the cheapest self-drive car rental in Bhubaneswar</li>
    <li>Pickup & drop-off services, including at Bhubaneswar Airport</li>
</ul>
        
      </div>
    </div>
  </div>
  
   <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");
 if(isset($_GET['ermsg']) && $_GET['ermsg']==1){
?>
<script>
   alert("Sorry!!! Some problem occur while booking");
</script>
<?php  } 
if(isset($_GET['ermsg']) && $_GET['ermsg']==2){
?>
<script>
   alert("Sorry!!! You entered Invalid date ");
</script>
<?php  } ?>


</body>
</html>