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


$nxt6hr = date('Y-m-d H:i:s',strtotime($date ."+6 hour"));

$nxt18hr = date('Y-m-d H:i:s',strtotime($date ."+18 hour"));
?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Self Drive Cars Bhubaneswar Airport | Car Rental BBSR Airport Pickup & Drop</title>
<meta name="keywords" content="self drive cars Bhubaneswar airport, car rental Bhubaneswar airport, airport pickup car rental, self drive car rental Bhubaneswar airport, car rental BBSR airport, doorstep delivery car rental Bhubaneswar, 24 hour car rental Bhubaneswar, unlimited km car rental Bhubaneswar, instant booking car rental Bhubaneswar" />
<meta name="description" content="Self drive cars Bhubaneswar airport with free pickup & drop. 24 hour car rental service at BBSR airport. Doorstep delivery, unlimited km. Book online for instant confirmation!"/>
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
<div class="body">
  <?php include("includes/site-header-inner.php");?>
  <div role="main" class="main">
<style>
h3.all-cars-text-heading {
    font-size: 1.8em;
    font-weight: 600;
    letter-spacing: normal;
    line-height: 24px;
    margin-bottom: 33px;
    text-transform: capitalize!important;
    font-family: 'Montserrat', sans-serif;
    margin-right: 15px;
    margin-left: 15px;
} 
p.all-cars-text-para {
    color: #000;
    line-height: 24px;
    margin: -20px 18px 20px;
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
    margin-right: 15px;
    margin-left: 15px;
}
.hdetails{
    text-align:center;
}
</style>
    <div class="container">
        <h5 class="all-cars-text-headinglast">Check out our available self-drive cars below and book your preferred ride for a hassle-free experience at Bhubaneswar Airport!</h5>
      <div class="row">
          
        <?php if(!empty($act)){ ?>
        
            <div class="col-md-12">
                
              <?php 

              if(isset($pickuploc) && $pickuploc!=''){
                $ad_qr = " AND city ='$pickuploc' ";
              }
				$cnt = $dbObj->countRec("tbl_cabs","status = 1 $ad_qr  ORDER BY cost ASC ");
				if($cnt > 0){
					$getCar = $dbObj->fetch_data("tbl_cabs","status = 1 $ad_qr ORDER BY cost ASC");
					foreach($getCar as $key){
					$id = $key['id'];
					$get_unavail = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$st_dte' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$end_dte' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$st_dte' AND '$end_dte' OR `unavail_dte_to` BETWEEN '$st_dte' AND '$end_dte'))");
                                          // Get availability after 6- 18 hour 

                                          $nxt6hr1 = date('Y-m-d H:i:s',strtotime($st_dte ."+6 hour"));

                                          $nxt18hr1 = date('Y-m-d H:i:s',strtotime($st_dte ."+18 hour"));
                                           $get_unavail_next6hr = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$nxt6hr1' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$nxt18hr1' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$nxt6hr1' AND '$nxt18hr1' OR `unavail_dte_to` BETWEEN '$nxt6hr1' AND '$nxt18hr1'))");
 
					
			?>
                  <div class="col-md-4" style="height:348pt;">
                  <div  class="cardetas">  <img src="uploadedDocument/cab/<?php echo $key['car_image'];?>" class="img-responsive" alt="car_image" style="width:320px; height:195px;">
                        <h6 class="hdetails"><i class="fa fa-automobile"></i><span class="spandta"><?php echo $key['car_nme'];?></span></h6>
                        <h6 class="hdetails"><i class="fa fa-check"></i><span class="spandta"><?php echo $key['no_of_seat'];?> Seater</span></h6>
                        <h6 class="hdetails"><i class="fa fa-support"></i><span class="spandta"><?php echo $key['fuel'];?></span></h6>
                        <h6 class="hdetails"><i class="fa fa-money"></i><span class="spandta">Rs <?php echo $key['cost'];?> /24 Hr</span></h6>
                        <h6 class="hdetails" style="text-align:center; font-size : 8pt; "> Offer : 
                          <?php  echo $key['offers']!=''?$key['offers']:"NO"; //echo $id;?> </h6>
                        
                        <?php 
							   if($get_unavail > 0){

                                                       if($get_unavail_next6hr == 0){
$count = $dbObj->countRec("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$st_dte' AND '$nxt6hr1')");
if($count>0){
 $getres = $dbObj->fetch_data("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$st_dte' AND '$nxt6hr1')");

 $enddt = $getres[0]['unavail_dte_to']; 
 $totalhr = round((strtotime($enddt) - strtotime($st_dte))/3600);
if($totalhr==0){
$totalhr = 1;
}

echo '<h6 class="hdetails" style="text-align:center; font-size : 8pt; "> Available in next '.$totalhr.' hour </h6>';
                                                        } }
						 ?>
                        <h6 class="hdetails"><a href="javascript:void(0)" class="btn btn-success mb-xl">Car Booked <br> <?php //$avail = $tmto + 60*60; echo date("d M Y H:i", $avail);?></a></h6>
                        <?php
						}else{
						?>
                        <h6 class="hdetails"><a href="checkout.php?car=<?php echo md5($key['car_nme']);?>&cartype=<?php echo md5($key['fuel']);?>&cardta=<?php echo md5($key['id']);?>&pdate=<?php echo $tdate;?>&ptime=<?php echo $ptime;?>&ddate=<?php echo $ddate;?>&dtime=<?php echo $dtime;?>" class="btn btn-primary mb-xl">Book Now</a></h6>
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
        <?php }else{ ?>
        	<div class="col-md-12">
               <?php 
				$cnt = $dbObj->countRec("tbl_cabs","status = 1 ORDER BY cost ASC");
				if($cnt > 0){
					$getCar = $dbObj->fetch_data("tbl_cabs","status = 1 ORDER BY cost ASC");
					foreach($getCar as $key){
					$id = $key['id'];
					$get_unavail = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND ('$pdate' BETWEEN `unavail_dte` AND `unavail_dte_to`)");
					//print_r($get_unavail);

                                         // Get availability after 6- 18 hour 
                                           $get_unavail_next6hr = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$nxt6hr' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$nxt18hr' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$nxt6hr' AND '$nxt18hr' OR `unavail_dte_to` BETWEEN '$nxt6hr' AND '$nxt18hr'))");
			?>
                  <div class="col-md-4" style="height:348pt;">
                  <div  class="cardetas">  <img src="uploadedDocument/cab/<?php echo $key['car_image'];?>" class="img-responsive" alt="car_image" style="width:320px; height:195px;">
                        <h6 class="hdetails"><i class="fa fa-automobile"></i><span class="spandta"><?php echo $key['car_nme'];?></span></h6>
                        <h6 class="hdetails"><i class="fa fa-check"></i><span class="spandta"><?php echo $key['no_of_seat'];?> Seater</span></h6>
                        <h6 class="hdetails"><i class="fa fa-support"></i><span class="spandta"><?php echo $key['fuel'];?></span></h6>
                        <h6 class="hdetails"><i class="fa fa-money"></i><span class="spandta">Rs <?php echo $key['cost'];?> /24 Hr</span></h6>
                        <h6 class="hdetails" style="text-align:center; font-size : 8pt; ">Notes:  <?php echo $key['offers']!=''?$key['offers']:"NO"; //echo $id;  ?></h6>
                        <?php 
						
							
						?>
                         <?php 
							   if($get_unavail > 0){

                                                       if($get_unavail_next6hr == 0){

$count = $dbObj->countRec("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$date' AND '$nxt6hr')");
if($count>0){
 $getres = $dbObj->fetch_data("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$date' AND '$nxt6hr')");
         $enddt = $getres[0]['unavail_dte_to'];
                 $totalhr = round((strtotime($enddt) - strtotime($date))/3600);
           if($totalhr==0){
$totalhr = 1;
}

                                                          echo '<h6 class="hdetails" style="text-align:center; font-size : 8pt; "> Available in next '.$totalhr.' hour </h6>';
                                                        } }
						 ?>
                        <h6 class="hdetails"><a href="javascript:void(0)" class="btn btn-success mb-xl">Car Booked <br> <?php //$avail = $tmto + 60*60; echo date("d M Y H:i", $avail);?></a></h6>
                        <?php
						}else{
						?>
                         <h6 class="hdetails"><a href="checkout.php?pdate=<?php echo date("Y-m-d");?>&ptime=6:00&ddate=<?php echo date("Y-m-d");?>&dtime=12:00&car=<?php echo md5($key['car_nme']);?>&cartype=<?php echo md5($key['fuel']);?>&cardta=<?php echo md5($key['id']);?>" class="btn btn-primary mb-xl">Book Now</a></h6>
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
        <?php }?>
        
      </div>
      
      <h3 class="all-cars-text-heading">Best Self-Drive Car Rentals at Bhubaneswar Airport</h3>
        <p class="all-cars-text-para">Arriving in Bhubaneswar and need a car right away? Eduxon Cabs offers a hassle-free self-drive car rental service at Bhubaneswar Airport, ensuring a smooth and comfortable journey from the moment you land. Whether you're in town for business, a family trip, or a weekend getaway, our fleet of well-maintained cars is ready to cater to your needs.<br>
With easy pickup and drop-off options at the airport, you can skip the long waits and start your journey instantly. Choose from a wide range of vehicles, including hatchbacks, sedans, SUVs, and luxury cars, all available at affordable rates.
        </p>
        
        <h3 class="all-cars-text-heading">Why Rent a Car from Bhubaneswar Airport?</h3>
        <ul class="all-cars-text-list">
            <li>Instant pickup & drop-off at the airport for a seamless travel experience</li>
            <li>Well-maintained and sanitized cars for a safe journey</li>
            <li>Flexible rental options for short and long trips</li>
            <li>No hidden charges—transparent pricing with easy booking</li>
</ul>


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
