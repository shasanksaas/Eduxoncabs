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

if($tdate!="" && $ptime!="" && $ddate!="" && $dtime){
$from_dt_time = "$st_dte";
$to_dt_time = "$end_dte";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>All Bikes for Self Drive in Bhubaneswar – Eduxon Cabs</title>
        <meta name="keywords" content="Eduxoncabs.com" />
        <meta name="description" content="Explore all self-drive car options in Bhubaneswar with Eduxon Cabs. Enjoy flexible, affordable, and hassle-free rentals for your journey!"/>
        <meta name="author" content="Eduxoncabs.com">
        <!-- Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Web Fonts  -->
        <?php include("includes/inc-css.php"); ?>
    </head>
    <body>
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
            .bike-img {
             height: 195px;
             width: 320px;
            }
        </style>
        <div class="body">
            <?php include("includes/site-header-inner.php"); ?>
            <div role="main" class="main">

                <div class="container">
                    
<h5 class="all-cars-text-headinglast">Scroll down to explore our collection of self-drive bikes and book your preferred ride today!</h5>


                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            $i = 1;
                            $ad_qr = "";
                            if (isset($city) && $city != '') {
                                $ad_qr = " city ='$city' ";
                            }
                            

                            $bike_data = $dbObj->fetch_data("tbl_bikes", "$ad_qr", "  cost ASC");

                            $count = $dbObj->countRec("tbl_bikes", "$ad_qr", "  cost ASC");

                            if ($count > 0) {

                                foreach ($bike_data as $bike) {
                                    ?>
                                    <div class="col-md-4">
                                        <div  class="cardetas"> 
                                           <img src="uploadedDocument/bikes/<?php echo $bike['bike_image']; ?>" class="img-responsive bike-img" alt="bike_image">


                                            <h6 class="hdetails"><i class="fa fa-automobile"></i><span class="spandta"><?php echo $bike['bike_name']; ?></span></h6>
                                           

                                            <h6 class="hdetails"><i class="fa fa-beer"></i><span class="spandta"><?php echo $bike['fuel']; ?></span></h6>

                                            <h6 class="hdetails"><i class="fa fa-money"></i><span class="spandta">Rs <?php echo $bike['cost']; ?> /24 Hr</span></h6>

                                           
                                            <form action="checkout_3.php" method="post">
                                                <input type='hidden' name='vehicle_id' value='<?= md5($bike["id"]); ?>' />
                                                <input type='hidden' name='vehicle_type' value='2' />
                                                <input type='hidden' name='from_dt_time' value='<?= $from_dt_time; ?>' />
                                                <input type='hidden' name='to_dt_time' value='<?= $to_dt_time; ?>' />

                                                <?php 

                                                $btn_class = "btn btn-primary mb-xl";
                                                $btn_type = "submit";
                                                $btn_value = "Book Now";
                                                    $bike_id = $bike['id'];

                                                    $get_unavail = $dbObj->countRec("tbl_unavail_dtes","bike_id = $bike_id AND (('$from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$from_dt_time' AND '$to_dt_time' OR `unavail_dte_to` BETWEEN '$from_dt_time' AND '$to_dt_time'))");
                                                     if($get_unavail > 0){
                                                        $btn_class = "btn btn-success mb-xl";
                                                        $btn_type = "button";
                                                        $btn_value = "Bike Booked";

                                                     }
                                                ?>
                                                
                                                <h6 class="hdetails">
                                                    <input type='<?= $btn_type;?>' name='book_bike' value='<?=$btn_value;?>' class="<?=$btn_class;?>" />
                                                    
                                                </h6>
                                            </form>

                                        </div>
                                    </div>
        <?php
    }
                            }
    ?>



                            </div>



                        </div>
                        <h3 class="all-cars-text-heading">Explore Our Wide Range of Self-Drive Bikes in Bhubaneswar</h3>
        <p class="all-cars-text-para">Looking for a convenient and budget-friendly way to explore Bhubaneswar? Eduxon Cabs offers a diverse selection of self-drive bikes, giving you the freedom to ride at your own pace. Whether you need a bike for daily commuting, city exploration, or a weekend trip, we have multiple options to suit your travel needs.<br>
From fuel-efficient scooters to powerful sports bikes, our fleet is well-maintained, affordable, and available for both short and long-term rentals. With an easy booking process and flexible rental plans, you can pick up your ride without any hassle and enjoy a smooth journey across the city.
        </p>
        
        <h3 class="all-cars-text-heading">Why Choose Our Self-Drive Bike Rentals?</h3>
        <ul class="all-cars-text-list">
            <li>Wide range of bikes – scooters, cruisers, and sports models</li>
            <li>Affordable rental plans with no hidden charges</li>
            <li>Well-maintained and regularly serviced bikes for a smooth ride</li>
            <li>Flexible pickup and drop-off options</li>
</ul>
                    </div>
                </div>

    <?php include("includes/site-footer.php"); ?>
            </div>
  <?php 
include("includes/inc-js.php"); 

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
