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

if(isset($_POST['act']) && $_POST['act'] == 'subscribe'){
	$phone = filter($_POST['phone']);

        $cnt = $dbObj->countRec("tbl_customer", "phone_number='$phone'");
        if ($cnt == 0) {
	    $ins = $dbObj->insertToDb("tbl_customer","phone_number='$phone',customer_name='Subscriber' ");
	     if($ins){ 
                 $res = array("status"=>"success");
                 echo json_encode($res);
             }else{
                 $res = array("status"=>"Error");
                 echo json_encode($res);
             }
      }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<title>Best Self Drive Car Rental in Bhubaneswar-Eduxon Cars </title>
<meta name="keywords" content="Best Self Drive Car Rental in Bhubaneswar" />
<meta name="description" content="Best Self-Drive Car Rental in Bhubaneswar - Eduxon Cars Self Drive Cars & Bikes ✓ Choose from a range of cars ✓ Enjoy your Travel and Outstation trip ✓ Book Now! ">
<meta name="author" content="Eduxoncabs">
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<?php include("includes1/inc-css.php"); ?>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5af299a65f7cdf4f0533fb81/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-9419287565252741",
          enable_page_level_ads: true
     });
</script>
</head>
<body>
<div class="r-wrapper">
  <?php include("includes1/site-banner1.php"); ?>
  <section id="r-advantages-part" class="r-advantages-part">
    <div class="r-advantage-main-part r-advantage-main-part-white">
      <div class="container clearfix">
        <div class="advantage-head">
          <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right"> <span>30+ CARS TYPE &amp; BRANDS</span>
              <h2>Eduxon cabs <b></b></h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
              <p class="r-sub-head-text">Eduxon Self Drive Car Rental in Bhubaneswar is Odisha’s Best Self drive Car Rental service provider today offering a complete bouquet of end-to-end long and short term Self Drive Cars Sevices through its fleet of wide range of cars across Odisha.</p>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="r-advantages-box">
              <div class="icon"> <img src="img/support.png" alt="" style="height:70px; width:70px;"> </div>
              <div class="head">24/7 Customer Online Support</div>
              <div class="sub-text">Call us Anywhere Anytime</div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="r-advantages-box">
              <div class="icon"> <img src="img/calendar.png" alt="" style="height:70px; width:70px;"> </div>
              <div class="head">Reservation Anytime You Wants</div>
              <div class="sub-text">24/7 Online Reservation</div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="r-advantages-box">
              <div class="icon"> <img src="img/destination.png" alt="" style="height:70px; width:70px;"> </div>
              <div class="head">Lowest Price Guaranteed</div>
              <div class="sub-text">Multiple Locations</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="r-who-royal">
    <div class="r-who-royal">
      <div class="container">
        <div class="row clearfix">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="r-about-info-content">
              <div class="r-sec-head r-sec-head-left r-sec-head-line r-sec-head-w pt-0"> <span>KNOW MORE ABOUT US</span>
                <h2 style="color:#fff;">Who <b>Eduxon Cabs</b> Are.</h2>
              </div>
              <p> Eduxoncars was launched in the year 2016 with a short-term objective of offering a safe and reliable medium of travel to customers and a long-term vision of giving form and structure to the unorganized Indian personal self driven transportation industry and helping the industry get its due recognition </p>
              <ul class="mb-0 pl-0">
                <li><i class="fa fa-check-circle"></i> We working since 2016 above 5000+ customers</li>
                <li><i class="fa fa-check-circle"></i> All brand &amp; type cars in our Multiple Parking Locations</li>
                <li><i class="fa fa-check-circle"></i> Multiple Pick Up locations around the city</li>
                <li><i class="fa fa-check-circle"></i> No hidden Charges with Unlimited Kilometers</li>
              </ul>
              <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" class="btn-primary" style="background:#6C0D12; border-radius:5px;">VIEW ALL VEHICLES</a> </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="r-best-offer">
    <div class="r-best-vehicles">
      <div class="r-sec-head r-accent-color r-sec-head-v"> <span>FEATURED CARS</span>
        <h2>Our <b>Best Offers.</b></h2>
      </div>
      <div class="container">
        <div class="row clearfix r-best-offer-list owl-theme owl-carousel" id="r-best-offers">
          <?php
				$cnt = $dbObj->countRec("tbl_cabs", "status = 1");
				if ($cnt > 0) {
					$getCar = $dbObj->fetch_data("tbl_cabs", "status = 1");
					foreach ($getCar as $key) {
						$id = $key['id'];
						$get_unavail = $dbObj->countRec("tbl_unavail_dtes", "car_id = $id AND ('$pdate' BETWEEN `unavail_dte` AND `unavail_dte_to`)")
			  ?>
          <div class="">
            <div class="r-best-offer-single">
              <div class="r-best-offer-in">
                <div class="r-offer-img"> <a class="d-inline-block" href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php"><img src="uploadedDocument/cab/<?php echo $key['car_image']; ?>" class="img-fluid d-block m-auto" alt=""></a> <a href="car-booking.html" class="d-block">
                  <div class="r-offer-img-over"> <i class="fa fa-search"></i> </div>
                  </a> </div>
                <div class="r-best-offer-content" style="color:#000;"> <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" style="color:#6C0D12; font-weight:bold;"><?php echo $key['car_nme']; ?></a>
                  <p>Start at <b>Rs <?php echo $key['cost']; ?> </b> /24 Hr</p>
                  <ul class="pl-0 mb-0">
                    <li><i class="fa fa-beer"></i><span><?php echo $key['fuel']; ?></span></li>
                    <li><i class="fa fa-wheelchair"></i><span><?php echo $key['no_of_seat']; ?></span></li>
                  </ul>
                </div>
                <div class="r-offer-rewst-this">
                  <?php 
								if ($get_unavail > 0) {
                                                    ?>
                  <span class="text-uppercase">Car Booked</span>
                  <?php
                                                } else {
                                                    ?>
                  <span class="text-uppercase"><a href="checkout.php?pdate=<?php echo date("Y-m-d"); ?>&ptime=6:00&ddate=<?php echo date("Y-m-d"); ?>&dtime=12:00&car=<?php echo md5($key['car_nme']); ?>&cartype=<?php echo md5($key['fuel']); ?>&cardta=<?php echo md5($key['id']); ?>" class="btn btn-primary mb-xl">Book Now</a></span>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <?php } }else{ ?>
          <h4>Sorry!!! No record found..</h4>
          <?php }?>
        </div>
      </div>
    </div>
  </section>
  <div id="r-quote">
    <div class="r-quote">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-wow-delay="0.2s">
            <div id="r-quote-carousel" class="carousel slide">
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item">
                  <p>“Much thanks to you for giving boundless kilometers. Our excursion with companions was so calm and fun since we knew we didn't need to pay anything over the cash every one of us pooled in regardless of where all we went.”</p>
                </div>
                <div class="carousel-item active">
                  <p>“I had a decent by and large involvement with my ongoing auto rental through Eduxoncabs.To begins with, the way toward booking the auto was very straightforward and simple. On landing in office to get the auto, the staff was exceptionally gracious, and had every one of the papers and the auto prepared. It took me under 5 minutes between landing at the workplace and heading out with the auto. The auto itself was spotless and all around kept up, and I had no inconvenience at all with the car.The preparing of restoring the auto was similarly lovely and snappy.”</p>
                </div>
                <div class="carousel-item">
                  <p>“Eduxoncabs made things extremely advantageous for me in wording that I didn't need to worry about a driver holding up extend periods of time when I was grinding away and in addition there being no confinement on the kilometer it truly makes life simple for somebody like me who needs to movement among workplaces and home spread crosswise over various corners of the city. Your vehicles are very much thought about and feel great when going in them. I had an extraordinary ordeal, bless your heart.”</p>
                </div>
              </div>
              <ol class="carousel-indicators">
                <li data-target="#r-quote-carousel" data-slide-to="0"> <img class="img-fluid d-block" src="assets/images/user-02.jpg" alt=""> <span> <b>Rohit Mishra</b> </span> </li>
                <li data-target="#r-quote-carousel" data-slide-to="1" class="active text-center"> <img class="img-fluid d-block" src="assets/images/user-01.png" alt=""> <span> <b>Puja Sharma</b> </span> </li>
                <li data-target="#r-quote-carousel" data-slide-to="2"> <img class="img-fluid d-block" src="assets/images/user-03.jpg" alt=""> <span> <b>Dipti Mallick</b>  </span> </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="r-newsletter-suscribe">
    <div class="r-newsletter-suscribe">
      <div class="container">
        <div class="r-newsletter-head"> <img src="img/Eduxoncabs.png" class="d-block img-fluid m-auto" alt=""> </div>
        <div class="r-newsletter-form"> <i class="fa fa-envelope"></i>
          <p>SUBSCRIBE FOR OFFERS</p>
          <form action="" method="post">
            <div class="r-newsletter">
              <input type="number" name="phone" id="phone" maxlength="10" placeholder="Phone No" required>
              <input type="button" class="btn btn-full" id="subscribebtn" value="REGISTER NOW"  style="background:#6C0D12; border-radius:5px; color:#fff;"/>
             <!-- <button class="btn btn-full">REGISTER NOW</button>-->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="r-counter-section r-counter-with-bg m-0" style="background:#6C0D12;">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-happy-customer-white.png" alt="" class="img-fluid"> </div>
            <div class="r-counts" data-count="4567">
              <!-- 1.172.700 -->
              <span class="r-count">0</span> </div>
            <span class="r-count-title"> HAPPY CUSTOMERS </span> </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-cars-count-white.png" alt="" class="img-fluid"> </div>
            <div class="r-counts" data-count="20">
              <!-- 2.450 -->
              <span class="r-count">0</span> </div>
            <span class="r-count-title"> CARS IN GARAGE </span> </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-total-km-white.png" alt="" class="img-fluid"> </div>
            <div class="r-counts" data-count="127100">
              <!-- 1.211.100 -->
              <span class="r-count">0</span> </div>
            <span class="r-count-title"> TOTAL KILOMETER/MIL </span> </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-car-center-white.png" alt="" class="img-fluid"> </div>
            <div class="r-counts" data-count="10">
              <!-- 47.250 -->
              <span class="r-count">0</span> </div>
            <span class="r-count-title"> CAR CENTER SOLUTIONS </span> </div>
        </div>
      </div>
    </div>
  </div>
  <section id="r-faq-section">
    <div class="r-faq-section r-faq-white-bg">
      <div class="container">
        <div class="row v-align-center r-faq-header-wrapper">
          <div class="col-md-8 col-sm-12">
            <div class="r-faq-header"> <span>FIND YOUR ANSWER HERE</span>
              <h2>Frequenly <strong>Ask &amp; Questions.</strong></h2>
            </div>
          </div>
        </div>
        <div class="row r-faq-accordion-wrapper">
          <div class="col-lg-6 col-md-12">
            <div class="r-accordion">
              <div class="r-accordion-heading"> <span class="r-accordion-toggle"> <i class="fa-arrow-circle-down fa"></i> </span> What are Documents needed to reserved a car here? </div>
              <div class="r-accordion-body">
                <p> a.Copy of Driving license and Other ID Proof Such as Adhar Card, Voter Id, Pan Card, Any other ID Issued by Authority or Institution.</p>
 <p>b. Local IDs/Students Must carry their Job/Collage/institution Id Card for the Address Proof.</p>
 <p>c. Without absence of Job/Collage ID,No Local IDs is eligible to rent a car under Eduxon Platform.</p>
 <p>d. Mail  your Driving license,Adhar Card Copy or Other ID & Live Photo  in eduxonassociates@gmail.com for the Pre verification of your documents.</p>
 <p>e. In the absence of any Valid/required Documents the booking will be treated as Cancelled and Rs.500/- is deuctable from Total amount Paid. </p>
              </div>
            </div>
            <!-- /r-accordion -->
            <div class="r-accordion">
              <div class="r-accordion-heading"> <span class="r-accordion-toggle"> <i class="fa-arrow-circle-down fa"></i> </span> Age Requirement for booking car? </div>
              <div class="r-accordion-body">
                <p> Minimum 21 Years for Normal vehicles. </p>
              </div>
            </div>
            <!-- /r-accordion -->
            <div class="r-accordion">
              <div class="r-accordion-heading"> <span class="r-accordion-toggle"> <i class="fa-arrow-circle-down fa"></i> </span> Over Speeding charges: (Exceeding 80km/Hour)? </div>
              <div class="r-accordion-body">
                <p> a. A penalty of Rs. 200 shall be charged on the first instance.</p>
<p>b. An additional penalty of Rs 500/- shall be charged each time from the second instance of speed violation. </p>
              </div>
            </div>
            <!-- /r-accordion -->
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="r-accordion">
              <div class="r-accordion-heading"> <span class="r-accordion-toggle"> <i class="fa-arrow-circle-down fa"></i> </span>What are Kilometers Limitation? </div>
              <div class="r-accordion-body" style="display: none;">
                <p> a.There is Unlimited Kms Offered to the Customer In the Normal range vehicles.</p>
 <p>b. 180 Kms/24 Hours is limited In the BMW, Mercedes, Audi Range Vehicles. Extra per Kilometers Charges is Rs, 30/km Will be charged from the customer.</p>
 <p>c.Customer Must Infrom In Advance if planning to go Outisde the Odisha State Border.</p>
              </div>
            </div>
            <!-- /r-accordion -->
            <div class="r-accordion">
              <div class="r-accordion-heading"> <span class="r-accordion-toggle"> <i class="fa-arrow-circle-down fa"></i> </span> What are Late Charges? </div>
              <div class="r-accordion-body">
                <p> If the Customer Exceeds the Time Limit without any information Before 06 Hours of expiry Of time then it will be Chargeable Rs, 500/- as a fine in addition to extra Per Hour Charge Rs, 200/Hour. </p>
              </div>
            </div>
            <!-- /r-accordion -->
            <div class="r-accordion">
              <div class="r-accordion-heading"> <span class="r-accordion-toggle"> <i class="fa-arrow-circle-down fa"></i> </span> Home delievery? </div>
              <div class="r-accordion-body">
                <p> a.Airport Delivery is free(Only toll charges applicable)</p>
<p>b.Home delivery is Chargeble Rs. 400/- Including Pick up/Drop up within the radius of 20Km.</p>
              </div>
            </div>
            <!-- /r-accordion -->
          </div>
        </div>
        <!--<div class="row">
          <div class="col-md-12 text-center"> <a href="#" class="btn-primary icon-btn"> <i class="fa fa-question-circle icon"></i> MAKE A QUESTIONS </a> </div>
        </div>-->
      </div>
    </div>
  </section>
  <!--<section id="r-drivers">
          <div class="r-driver-blog-light">
            <div class="r-sec-head r-accent-color r-sec-head-s">
              <span>OUR PROFESSIONAL STAFF</span>
              <h2>Eduxon cabs <b>Drivers.</b></h2>
            </div>
            <div class="container">
              <div class="r-driver-blog">
                <div class="row clearfix">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="r-drivers">
                        <div class="r-drivers-detail">
                          <div class="name">Luis <br>Henrique</div>
                          <div class="text">5 Years Experience</div>
                          <div class="icon">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="drivers-img">
                          <img src="assets/images/driver-blog-img.jpg" class="img-fluid d-block m-auto" alt="">
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="r-drivers">
                        <div class="r-drivers-detail">
                          <div class="name">Robertho Garcia</div>
                          <div class="text">5 Years Experience</div>
                          <div class="icon">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="drivers-img">
                          <img src="assets/images/driver-blog-img-2.jpg" class="img-fluid d-block m-auto" alt="">
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="r-drivers">
                        <div class="r-drivers-detail">
                          <div class="name">Daniel Quaresma</div>
                          <div class="text">5 Years Experience</div>
                          <div class="icon">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="drivers-img">
                          <img src="assets/images/driver-blog-img-3.jpg" class="img-fluid d-block m-auto" alt="">
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="r-all-but text-center pt-5">
                <a href="#" class="btn btn-full">View All Drivers</a>
              </div>
            </div>
          </div>
        </section>-->
  <section id="r-latest-news">
    <div class="r-latest-news r-latest-news-light">
      <div class="r-sec-head r-sec-head-b"> <span>ARTICLES FROM BLOG</span>
        <h2 style="color:#000;">Our <b>Latest News.</b></h2>
      </div>
      <div class="container">
        <div class="owl-carousel r-latest-news-list" id="r-latest-news-slider">
          <div class="r-latest-news-single"> <a href="https://www.eduxoncabs.com/self-drive-car-hire.php" class="d-inline-block"><img src="assets/images/latest-news-01.jpg" class="img-fluid d-block m-auto" alt=""></a>
            <div class="r-latest-news-content"> <!--<span class="r-date">27 JUNE 2018</span>-->
              <h4><a href="https://www.eduxoncabs.com/self-drive-car-hire.php">Best Self Drive Car Rentals In Bhubaneswar</a></h4>
              <p>We have to lease a car more often than not for a few reasons. The decision of leasing a car has extended with the self drive option. This is extremely agreeable and financially savvy. You get the flexibility to plan your journey. If you've got to get a group of people from one place to the other, or are moving and need a way to transport your possessions, a Self Drive Car Hire maybe just what you are looking for. </p>
              <a href="https://www.eduxoncabs.com/self-drive-car-hire.php" class="r-read-more">READ MORE</a> </div>
          </div>
          <div class="r-latest-news-single"> <a href="https://www.eduxoncabs.com/self-drive-car.php" class="d-inline-block"><img src="assets/images/latest-news-02.jpg" class="img-fluid d-block m-auto" alt=""></a>
            <div class="r-latest-news-content"> <!--<span class="r-date">27 JUNE 2018</span>-->
              <h4><a href="https://www.eduxoncabs.com/self-drive-car.php">Self Drive Car: What to Look for</a></h4>
              <p>Car rental services, whether they provide a driver or a self drive car option, are getting more and more popular today. There were only a few such companies a few years ago, but now there are dozens of high profile rental services that offer dedicated car rentals at really great prices. What most people want to know is - are they all the same or should you choose carefully?</p>
              <a href="https://www.eduxoncabs.com/self-drive-car.php" class="r-read-more">READ MORE</a> </div>
          </div>
          <div class="r-latest-news-single"> <a href="https://www.eduxoncabs.com/self-drive-cars-rental.php" class="d-inline-block"><img src="assets/images/latest-news-03.jpg" class="img-fluid d-block m-auto" alt=""></a>
            <div class="r-latest-news-content"> <!--<span class="r-date">27 JUNE 2018</span>-->
              <h4><a href="https://www.eduxoncabs.com/self-drive-cars-rental.php">Self Drive Cars In Bhubaneswar</a></h4>
              <P>Transportation is an essential part of all our lives. Some of us have our own vehicles; some of us travel by bus or train, while others choose taxis for their everyday ride. There is another growing option for us today that is affordable and also very convenient - self drive car rentals. You can rent any type of car you want in terms of days, weeks and even months.</P>
              <a href="https://www.eduxoncabs.com/self-drive-cars-rental.php" class="r-read-more">READ MORE</a> </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--<section id="r-new-member">
    <div class="r-new-member">
      <div class="container">
        <div class="r-sec-head r-sec-head-left r-sec-head-line r-sec-head-r pt-0"> <span>NEW MEMBER DISCOUNT</span>
          <h2>Reserved Now & Get <b>50% Off</b> <br>
            for Audi & Mercedes Only.</h2>
        </div>
        <div class="row r-discounted-car">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="r-discount-single"> <a href="#"><img src="assets/images/discount-car-01.jpg" alt=""></a>
              <div class="r-discount-content">
                <ul class="mb-0 pl-0 r-starts">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <h4><a href="#">Audi Cabriolet R8</a></h4>
                <div class="r-price-discount"><span class="r-cut-price">$50.00</span> <b>25.00 USD</b> per day</div>
                <ul class="pl-0 mb-0 r-car-point clearfix">
                  <li><i class="fa fa-cogs"></i><span>MANUAL</span></li>
                  <li><i class="fa fa-beer"></i><span>PETROL</span></li>
                  <li><i class="fa fa-road"></i><span>2.3k CC</span></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="r-discount-single"> <a href="#"><img src="assets/images/discount-car-02.jpg" alt=""></a>
              <div class="r-discount-content">
                <ul class="mb-0 pl-0 r-starts">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <h4><a href="#">Mercedes Benz I7</a></h4>
                <div class="r-price-discount"><span class="r-cut-price">$50.00</span> <b>25.00 USD</b> per day</div>
                <ul class="pl-0 mb-0 r-car-point clearfix">
                  <li><i class="fa fa-cogs"></i><span>MANUAL</span></li>
                  <li><i class="fa fa-beer"></i><span>PETROL</span></li>
                  <li><i class="fa fa-road"></i><span>2.3k CC</span></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="r-discount-single"> <a href="#"><img src="assets/images/discount-car-03.jpg" alt=""></a>
              <div class="r-discount-content">
                <ul class="mb-0 pl-0 r-starts">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <h4><a href="#">Audi Cabriolet R8</a></h4>
                <div class="r-price-discount"><span class="r-cut-price">$50.00</span> <b>25.00 USD</b> per day</div>
                <ul class="pl-0 mb-0 r-car-point clearfix">
                  <li><i class="fa fa-cogs"></i><span>MANUAL</span></li>
                  <li><i class="fa fa-beer"></i><span>PETROL</span></li>
                  <li><i class="fa fa-road"></i><span>2.3k CC</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <div id="r-gallery-part">
  <h2 style="text-align:center;">Gallery</h2>
    <div class="r-gallery-part r-gallery-part-home py-0">
      <ul class="clearfix">
        <?php
                        $get_all_img = $dbObj->fetch_data("tbl_banner", "", "banner_sequence ASC", "");

                        $cnt = $dbObj->countRec("tbl_banner");

                        if ($cnt > 0) {

                            foreach ($get_all_img as $key) {
            ?>
        <li> <a href="uploadedDocument/banner/<?php echo $key['banner_image']; ?>" data-rel="lightcase:myCollection"> <img src="uploadedDocument/banner/<?php echo $key['banner_image']; ?>" class="d-block img-fluid" alt="" loading="lazy">
          <div class="gallery-hover">
            <div class="gallery-text">
              <div class="icon-gallery"><i class="fa fa-search" aria-hidden="true"></i></div>
            </div>
          </div>
          </a> </li>
        <?php
                            }
                        } else {

                            echo "Sorry No image found!!!";
                        }
                        ?>
      </ul>
    </div>
  </div>
  <?php include("includes1/site-footer.php"); ?>
</div>
<div id="r-to-top" class="r-to-top"><i class="fa fa-angle-up"></i></div>
<!-- JQUERY:: JQUERY.JS -->
<?php include("includes1/inc-js.php"); ?>
<script>

            $(document).ready(function () {

                      $("#subscribebtn").click(function(){
                           
                           var phonenumber= $('#phone').val();
                                                     

                           $.post("index.php",{phone: phonenumber,act:'subscribe'}, function(data,status){
                            if(status=='success'){ alert('Registration Successful');
                                $('#phone').val('');
                                 }
                           });
                       });



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
    $ct1_picpoint .=  "<option value='$picPoint' >$picPoint</option>";
    $ct1_drppoint .= "<option value='$dropPoint' >$dropPoint</option>";;
}

$ct2_picpoint="";
$ct2_drppoint="";
foreach ($get_city_location_data2 as $data2) {
    $picPoint = $data2['pickup_point'];
    $dropPoint = $data2['drop_point'];
    $ct2_picpoint .=  "<option value='$picPoint' >$picPoint</option>";
    $ct2_drppoint .= "<option value='$dropPoint' >$dropPoint</option>";;
}

$ct3_picpoint="";
$ct3_drppoint="";
foreach ($get_city_location_data3 as $data3) {
    $picPoint = $data3['pickup_point'];
    $dropPoint = $data3['drop_point'];
    $ct3_picpoint .=  "<option value='$picPoint' >$picPoint</option>";
    $ct3_drppoint .= "<option value='$dropPoint' >$dropPoint</option>";;
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


<?php 
    $get_hour_res = $dbObj->fetch_data("tbl_min_hour", "status = '1'"); 
    $min_hour = $get_hour_res[0]['hours'];
?>
            function calculateTime(dropTime, pdate, ptime, ddate) {

                var pickTime = pdate + " " + ptime;

                var dropTimeh = ddate + " " + dropTime;

                if (dropTime != 0) {

                    dt1 = new Date(pickTime);

                    dt2 = new Date(dropTimeh);

                    var t = diff_hours(dt1, dt2);

                    if (t < <?=$min_hour;?>) {

                        alert("sorry you need to select more than <?=$min_hour;?> Hr.");

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
