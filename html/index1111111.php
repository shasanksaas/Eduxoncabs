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

//$pdate = strtotime(date("Y-m-d H:i"));

$pdate = date("Y-m-d H:i");

$from_dt_time = date("Y-m-d")." 6:00";
$to_dt_time = date("Y-m-d")." 12:00";
?>



<!DOCTYPE html>

<html>

    <head>

        <!-- Basic -->

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Best Self Drive Car Rental in Bhubaneswar|Eduxon cars</title>

        <meta name="keywords" content="Self Drive Car Rental in Bhubaneswar" />

        <meta name="description" content="Eduxoncars offers Best Self-Drive Cars in Bhubaneswar with unlimited kilometers. Book your Self Drive Cars in Bhubaneswar at affordable prices. ">

        <meta name="author" content="Eduxoncabs">

        <!-- Favicon -->

        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

        <!-- Mobile Metas -->

        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Web Fonts  -->

        <?php include("includes/inc-css.php"); ?>

        <style>

            .ui-widget.ui-widget-content{

                z-index:9999 !important;

            }

        </style>

    </head>

    <body>

        <div class="body">

            <?php include("includes/site-header.php"); ?>

            <div role="main" class="main">



                <div class="slider-with-overlay">

                    <?php include("includes/site-banner1.php"); ?>

                    <div class="container" style="margin-top:15px;">

                        <div class="row">

                            <div class="col-md-12 center mb-xl">

                                <h2 class="mb-xl" style="color:#e60000;"> <strong>What kind of Car you want!</strong></h2>

                                <h4 class="mb-xl" style="color:#e60000;"> <strong>Best Self Drive Car Rental in Bhubaneswar</strong></h4>

                                <div class="owl-carousel owl-theme m-none" data-plugin-options="{'autoHeight': true, 'items': 3, 'margin': 0, 'nav': true, 'dots': false, 'stagePadding': 0}">







                                    <?php
                                    $cnt = $dbObj->countRec("tbl_cabs", "status = 1");

                                    if ($cnt > 0) {

                                        $getCar = $dbObj->fetch_data("tbl_cabs", "status = 1");

                                        foreach ($getCar as $key) {

                                            $id = $key['id'];

                                            $get_unavail = $dbObj->countRec("tbl_unavail_dtes", "car_id = $id AND ('$pdate' BETWEEN `unavail_dte` AND `unavail_dte_to`)");

                                            //print_r($get_unavail);
                                            ?>

                                            <div  class="cardetas"> <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php"> <img src="uploadedDocument/cab/<?php echo $key['car_image']; ?>" class="img-responsive" alt="">

                                                    <h6 class="hdetails"><i class="fa fa-automobile"></i><span class="spandta"><?php echo $key['car_nme']; ?></span></h6>

                                                    <h6 class="hdetails"><i class="fa fa-wheelchair"></i><span class="spandta"><?php echo $key['no_of_seat']; ?> Seater</span></h6>

                                                    <h6 class="hdetails"><i class="fa fa-beer"></i><span class="spandta"><?php echo $key['fuel']; ?></span></h6></a> 

                                                <h6 class="hdetails" style="text-align:center;"><i class="fa fa-money"></i><span class="spandta">Rs <?php echo $key['cost']; ?> /24 Hr</span></h6>

                                                <?php //echo $pdate."======".$key['unavail_datefrm']." ".$key['unavail_tmfrm']." TO ".$key['unavail_dateto']." ".$key['unavail_tmto']; ?>

                                                <?php
                                                if ($get_unavail > 0) {
                                                    ?>

                                                    <h6 class="hdetails" style="text-align:center;"><a href="javascript:void(0)" class="btn btn-success mb-xl">Car Booked <br> <?php //$avail = $tmto + 60*60; echo date("d M Y H:i", $avail); ?></a></h6>

                                                    <?php
                                                } else {
                                                    ?>

                                                    <h6 class="hdetails" style="text-align:center;"><a href="checkout.php?pdate=<?php echo date("Y-m-d"); ?>&ptime=6:00&ddate=<?php echo date("Y-m-d"); ?>&dtime=12:00&car=<?php echo md5($key['car_nme']); ?>&cartype=<?php echo md5($key['fuel']); ?>&cardta=<?php echo md5($key['id']); ?>" class="btn btn-primary mb-xl">Book Now</a></h6>

                                                <?php } ?>

                                            </div>

                                            <?php
                                        }
                                    } else {
                                        ?>  

                                        <div  class="cardetas"><h4>Sorry!!! No record found..</h4>

                                            </a> </div>

                                    <?php } ?>

                                </div>

                                <div class="col-md-12 center mt-xl mb-sm"> <a href="all-cars-for-self-drive-bhubaneswar.php" class="btn btn-primary mb-xl" data-appear-animation="fadeInUp" data-appear-animation-delay="900">View More</a> </div>

                            </div>

                            <div class="col-md-12 center mb-xl">

                                <h2 class="mb-xl" style="color:#e60000;"> <strong>What kind of Bike you want!</strong></h2>


                                <div class="owl-carousel owl-theme m-none" data-plugin-options="{'autoHeight': true, 'items': 3, 'margin': 0, 'nav': true, 'dots': false, 'stagePadding': 0}">

                                    <?php
                                    $cnt = $dbObj->countRec("tbl_bikes", "status = 1");

                                    if ($cnt > 0) {

                                        $getbike = $dbObj->fetch_data("tbl_bikes", "status = 1");

                                        foreach ($getbike as $key) {

                                            $id = $key['id'];

                                            $get_unavail = $dbObj->countRec("tbl_unavail_dtes", "bike_id = $id AND ('$pdate' BETWEEN `unavail_dte` AND `unavail_dte_to`)");

                                            //print_r($get_unavail);
                                            ?>

                                            <div  class="cardetas"> <a href="https://www.eduxoncabs.com/all-bikes-bike-for-rental-bhubaneswar.php"> <img src="uploadedDocument/bikes/<?php echo $key['bike_image']; ?>" class="img-responsive" alt="">

                                                    <h6 class="hdetails"><i class="fa fa-automobile"></i><span class="spandta"><?php echo $key['bike_name']; ?></span></h6>

                                                    <h6 class="hdetails"><i class="fa fa-beer"></i><span class="spandta"><?php echo $key['fuel']; ?></span></h6></a> 

                                                <h6 class="hdetails" style="text-align:center;"><i class="fa fa-money"></i><span class="spandta">Rs <?php echo $key['cost']; ?> /24 Hr</span></h6>

                                                <?php
                                                if ($get_unavail > 0) {
                                                    ?>

                                                    <h6 class="hdetails" style="text-align:center;"><a href="javascript:void(0)" class="btn btn-success mb-xl">Bike Booked <br> <?php //$avail = $tmto + 60*60; echo date("d M Y H:i", $avail); ?></a></h6>

                                                    <?php
                                                } else {
                                                    ?>

                                                <!--<h6 class="hdetails" style="text-align:center;"><a href="checkout_3.php?pdate=<?php echo date("Y-m-d"); ?>&ptime=6:00&ddate=<?php echo date("Y-m-d"); ?>&dtime=12:00&car=<?php echo md5($key['car_nme']); ?>&cartype=<?php echo md5($key['fuel']); ?>&cardta=<?php echo md5($key['id']); ?>" class="btn btn-primary mb-xl">Book Now</a></h6>-->
                                                <form action="checkout_3.php" method="post">
                                                <input type='hidden' name='vehicle_id' value='<?= md5($id); ?>' />
                                                <input type='hidden' name='vehicle_type' value='2' />
                                                <input type='hidden' name='from_dt_time' value='<?= $from_dt_time; ?>' />
                                                <input type='hidden' name='to_dt_time' value='<?= $to_dt_time; ?>' />
                                                
                                                <h6 class="hdetails" style="text-align:center;">
                                                    <input type='submit' name='book_bike' value='Book Now' class="btn btn-primary mb-xl" />
                                                    
                                                </h6>
                                            </form>
                                                <?php } ?>

                                            </div>

                                            <?php
                                        }
                                    } else {
                                        ?>  

                                        <div  class="cardetas"><h4>Sorry!!! No record found..</h4>

                                            </a> </div>

                                    <?php } ?>

                                </div>

                                <div class="col-md-12 center mt-xl mb-sm"> <a href="all-bikes-bike-for-rental-bhubaneswar.php" class="btn btn-primary mb-xl" data-appear-animation="fadeInUp" data-appear-animation-delay="900">View More</a> </div>

                            </div>

                        </div>

                    </div>

                </div>

                <section class="section section-primary">

                    <div class="container">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="content-grid content-grid-dashed mt-xlg mb-lg">

                                    <div class="row content-grid-row">

                                        <div class="content-grid-item col-md-6 center">

                                            <div class="counters">

                                                <div class="counter text-color-light"> <strong data-to="4567" data-append="+">0</strong>

                                                    <label>Happy Customers</label>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="content-grid-item col-md-6 center">

                                            <div class="counters">

                                                <div class="counter text-color-light"> <strong data-to="72" data-append="+">0</strong>

                                                    <label>Car Rental</label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row content-grid-row">

                                        <div class="content-grid-item col-md-6 center">

                                            <div class="counters">

                                                <div class="counter text-color-light"> <strong data-to="5">0</strong>

                                                    <label>Years in Business</label>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="content-grid-item col-md-6 center">

                                            <div class="counters">

                                                <div class="counter text-color-light"> <strong data-to="10">0</strong>

                                                    <label>Call Center Solution</label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <div class="container" style="margin-top:25px;">

                    <div class="col-md-12">

                        <div class="col-md-3"> <img src="img/customer-service (4).png" class="img-responsive" alt="">

                            <h4 class="mb-xl" style="color:#e60000; margin-top:10px;"> <strong>24*7 Car Support</strong></h4>

                        </div>

                        <div class="col-md-3"> <img src="img/wall-calendar (1).png" class="img-responsive" alt="">

                            <h4 class="mb-xl" style="color:#e60000; margin-top:10px;"> <strong>Reservation Time</strong></h4>

                        </div>

                        <div class="col-md-3"> <img src="img/low-price.png" class="img-responsive" alt="">

                            <h4 class="mb-xl" style="color:#e60000; margin-top:10px;"> <strong>Lowest Price</strong></h4>

                        </div>

                        <div class="col-md-3"> <img src="img/speed-limit-100.png" class="img-responsive" alt="">

                            <h4 class="mb-xl" style="color:#e60000; margin-top:10px;"> <strong>Unlimited Kilometeres</strong></h4>

                        </div>

                    </div>

                </div>

            </div>

            <hr class="tall"></hr>

            <div class="container" style="margin-top:30px;">

                <div class="col-md-12">

                    <h2 class="mb-none" style="text-align:center; color:#FF0000; font-weight:bold;">Gallery</h2>

                    <div class="owl-carousel owl-theme nav-bottom" data-plugin-options="{'loop': true, 'nav': true, 'dots': false}">

                        <?php
                        $get_all_img = $dbObj->fetch_data("tbl_banner", "", "banner_sequence ASC", "");

                        $cnt = $dbObj->countRec("tbl_banner");

                        if ($cnt > 0) {

                            foreach ($get_all_img as $key) {
                                ?>

                                <div>

                                    <img class="img-responsive" src="uploadedDocument/banner/<?php echo $key['banner_image']; ?>" alt="">

                                </div>

                                <?php
                            }
                        } else {

                            echo "Sorry No image found!!!";
                        }
                        ?>  

                    </div>

                </div>

            </div>


            <div class="container">
                <div class="row mt-xl">
                    <div class="col-md-12 center">
                        <h2 class="mt-xl mb-xl">Latest <strong>Posts</strong></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="recent-posts mt-xl">
                            <article class="post">

                                <h4 style="font-weight:bold; color::#e60000; text-align:center;"><a href="self-drive-car-rental.php">Best Self Drive Car Rental</a></h4>
                                <p>We have to lease a car more often than not for a few reasons. The decision of leasing a car has extended with the self drive option. This is extremely agreeable and financially savvy. You get the flexibility to plan your journey. If you've got to get a group of people from one place to the other, or are moving and need a way to transport your possessions, a Self Drive Car rental maybe just what you are looking for. </p>
                                <a  href="self-drive-car-rental.php" class="btn btn-primary mb-xl appear-animation animated fadeInUp appear-animation-visible">Read More</a>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="recent-posts mt-xl">
                            <article class="post">

                                <h4 style="font-weight:bold; color::#e60000; text-align:center;"><a href="self-drive-car.php">Self Drive Car: What to Look for

                                    </a></h4>
                                <p>Self Drive Car Rental Bhubaneswar services, whether they provide a driver or a self drive car option, are getting more and more popular today. There were only a few such companies a few years ago, but now there are dozens of high profile rental services that offer dedicated car rentals at really great prices. What most people want to know is - are they all the same or should you choose carefully?</p>
                                <a  href="self-drive-car.php" class="btn btn-primary mb-xl appear-animation animated fadeInUp appear-animation-visible">Read More</a>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="recent-posts mt-xl">
                            <article class="post">

                                <h4 style="font-weight:bold; color::#e60000; text-align:center;"><a href="self-drive-cars-rental.php">Self Drive Cars Rental</a></h4>
                                <p>Transportation is an essential part of all our lives. Some of us have our own vehicles; some of us travel by bus or train, while others choose taxis for their everyday ride. There is another growing option for us today that is affordable and also very convenient - self drive car rentals. You can rent any type of car you want in terms of days, weeks and even months.</p>
                                <a  href="self-drive-cars-rental.php" class="btn btn-primary mb-xl appear-animation animated fadeInUp appear-animation-visible">Read More</a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>

            <?php include("includes/site-footer.php"); ?>

        </div>

        <!-- Vendor -->

        <?php include("includes/inc-js.php"); ?>



        <script>

            $(document).ready(function () {



                $("#pdate").datepicker({

                    dateFormat: "yy-mm-dd",

                    minDate: 0,

                    onSelect: function (date) {



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



                        var dt1 = $('#pdate').datepicker('getDate');

                        var dt2 = $('#ddate').datepicker('getDate');



                        //check to prevent a user from entering a date below date of dt1

                        if (dt2 < dt1) {

                            var minDate = $('#ddate').datepicker('option', 'minDate');

                            $('#ddate').datepicker('setDate', minDate);

                        }

                    }

                });


                $("#vehicle").change(function () {

                    var vehicle = $(this).val();
                    if (vehicle == 2) {
                        //all-cars-for-self-drive-bhubaneswar.php
                        $("#search-form").attr("action", "all-bikes-bike-for-rental-bhubaneswar.php");
                    } else if (vehicle == 1) {
                        $("#search-form").attr("action", "all-cars-for-self-drive-bhubaneswar.php");
                    }

                });

<?php
$get_city_location_data1 = $dbObj->fetch_data("location", "city_id = '1'");
$get_city_location_data2 = $dbObj->fetch_data("location", "city_id = '2'");
$get_city_location_data3 = $dbObj->fetch_data("location", "city_id = '3'");
$ct1_picpoint="";
$ct1_drppoint="";
foreach ($get_city_location_data1 as $data1) {
    $picPoint = $data1['pickup_point'];
    $dropPoint = $data1['drop_point'];
    $picval = $data1['id'];
    $dropval = $data1['id'];
    $ct1_picpoint .=  "<option value='$picval' >$picPoint</option>";
    $ct1_drppoint .= "<option value='$dropval' >$dropPoint</option>";;
}

$ct2_picpoint="";
$ct2_drppoint="";
foreach ($get_city_location_data2 as $data2) {
    $picPoint = $data2['pickup_point'];
    $dropPoint = $data2['drop_point'];
    $picval = $data2['id'];
    $dropval = $data2['id'];
    $ct2_picpoint .=  "<option value='$picval' >$picPoint</option>";
    $ct2_drppoint .= "<option value='$dropval' >$dropPoint</option>";;
}

$ct3_picpoint="";
$ct3_drppoint="";
foreach ($get_city_location_data3 as $data3) {
    $picPoint = $data3['pickup_point'];
    $dropPoint = $data3['drop_point'];
    $picval = $data3['id'];
    $dropval = $data3['id'];
    $ct3_picpoint .=  "<option value='$picval' >$picPoint</option>";
    $ct3_drppoint .= "<option value='$dropval' >$dropPoint</option>";;
}

?>
                $("#city").change(function () {

                    var city = $(this).val();
                    if (city == 1) {

                        //all-cars-for-self-drive-bhubaneswar.php
                        $("#pickuploc").html("<?= $ct1_picpoint;?>");
                        $("#droploc").html("<?=$ct1_drppoint;?>");
                    } else if (city == 2) {
                        $("#pickuploc").html("<?=$ct2_picpoint;?>");
                        $("#droploc").html("<?=$ct2_drppoint?>");
                    }else if (city == 3) {
                        $("#pickuploc").html("<?=$ct3_picpoint;?>");
                        $("#droploc").html("<?=$ct3_drppoint?>");
                    }

                });

            });



            function calculateTime(dropTime, pdate, ptime, ddate) {

                var pickTime = pdate + " " + ptime;

                var dropTimeh = ddate + " " + dropTime;

                if (dropTime != 0) {

                    dt1 = new Date(pickTime);

                    dt2 = new Date(dropTimeh);

                    var t = diff_hours(dt1, dt2);

                    if (t < 12) {

                        alert("sorry you need to select more than 12 Hr.");

                        $('#ptime').val('');

                        $('#dtime').val('');

                        return false;

                    }

                }

            }



            function diff_hours(dt2, dt1)

            {



                var diff = (dt2.getTime() - dt1.getTime()) / 1000;

                diff /= (60 * 60);

                return Math.abs(Math.round(diff));



            }



            /*$(function() {
             
             $( "#pickuploc" ).autocomplete({
             
             source: 'search.php'
             
             }); */

            /*$( "#ddate" ).datepicker({
             
             minDate: 0,
             
             dateFormat: 'yy-mm-dd'
             
             });*/

            /*});*/





        </script>

    </body>

</html>

