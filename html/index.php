<?php
session_start();

// Get the requested path
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Check if it's the homepage or an actual PHP file
if ($path === '' || file_exists($path)) {
    // Continue as usual — let the page render
} else {
    // If file does not exist — show 404
    http_response_code(404);
    include '404.php';
    exit;
}

require_once "includes/settings.php";

require_once "includes/database.php";

require_once "includes/classes/db.cls.php";

require_once "includes/classes/sitedata.cls.php";

require_once "includes/functions/common.php";

require_once "includes/classes/DBquery.cls.php";

$db = new SiteData();

$dbObj = new dbquery();

//$pdate = strtotime(date("Y-m-d H:i"));

$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

$pdate = date("Y-m-d H:i");

$from_dt_time = date("Y-m-d") . " 6:00";
$to_dt_time = date("Y-m-d") . " 12:00";

if (isset($_POST["act"]) && $_POST["act"] == "subscribe") {
    $phone = filter($_POST["phone"],$mysqli_conn);

    $cnt = $dbObj->countRec("tbl_customer", "phone_number='$phone'");
    if ($cnt == 0) {
        $ins = $dbObj->insertToDb(
            "tbl_customer",
            "phone_number='$phone',customer_name='Subscriber' "
        );
        if ($ins) {
            $res = ["status" => "success"];
            echo json_encode($res);
        } else {
            $res = ["status" => "Error"];
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
<title>Book Best-Self Drive Car Rental In Bhubaneswar at lowest Price</title>
<meta name="keywords" content="Best Car Rental For Self drive, Self Drive Car Rental In Bhubaneswar, Self Drive Cars In Bhubaneswar, Self Drive Car Rental In Bhubaneswar Airport, Cheapest Self Drive Car Rental In Bhubaneswar, No.#1 Self Drive Cars In Bhubaneswar, Self Drive Car In Bhubaneswar, Self Drive Cars In Bhubaneswar at Affordable Prices"/>
<meta name="description" content="Best Self drive car rental in Bhubaneswar starting@₹35/hour. Free airport pickup/drop, unlimited km. Renault Kwid AT(2025),Tata Punch(2025), Hyundai creta(2024),Mahindra Scorpio N(2025),Maruti Fronx any many more new car available for rent."/>
<meta name="author" content="Best Self Drive Car Rental in Bhubaneswar">
<meta property="product:brand" content="Best Self Drive Car Rental In Bhubaneswar" />
<meta property="og:site_name" content="Best Self Drive Car Rental In Bhubaneswar" />
<meta property="og:title" content="Best Self Drive Car Rental In Bhubaneswar" />
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R24JTT23LT">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
 
  gtag('config', 'G-R24JTT23LT');
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J20L19B243">
</script>
<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());
 
  gtag('config', 'G-J20L19B243');
</script>
 
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11129753133"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11129753133');
</script>
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<?php include "includes1/inc-css.php"; ?>

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
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "Best Self Drive Car Rental In Bhubaneswar",
  "url": "https://www.eduxoncabs.com/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.eduxoncabs.com/{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-680DFSCXM6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-680DFSCXM6');
</script>

</script>
<!--End of Tawk.to Script-->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-9419287565252741",
          enable_page_level_ads: true
     });
</script>

<meta name="google-site-verification" content="4JJju5tQZWNJy-xHGcY0GDueqFmxCdBrnj7ozilP2bw" />
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "additionalType": "http://schema.org/CarRental",
  "name": "Eduxon Cars - Best Self Drive Car Rental in Bhubaneswar",
  "image": "https://www.eduxoncabs.com/img/Eduxoncabs.png",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Bharti Towers, 129, Ekamra Rd, Forest Park",
    "addressLocality": "Bhubaneswar",
    "addressRegion": "Odisha",
    "postalCode": "751020",
    "addressCountry": "IN"
  },
  "telephone": "+91 94371 44274",
  "url": "https://eduxoncabs.com",
  "priceRange": "₹30/hour and up",
  "openingHours": "Mo-Su 09:00-23:00",
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "20.2561162",
    "longitude": "85.8244668"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.2",
    "reviewCount": "444"
  },
  "sameAs": [
    "https://www.facebook.com/eduxoncabs/",
    "https://www.instagram.com/eduxon_cars/",
    "https://www.google.com/search?kgmid=/g/11g8_2z210"
  ],
  "description": "Eduxon Cabs offers Best self-drive car rentals in Bhubaneswar, featuring a fleet of over 30+ well-maintained vehicles including hatchbacks, sedans, SUVs, and luxury cars. Enjoy unlimited kilometers, free airport pickup, 24/7 roadside assistance, and flexible rental options starting at ₹30/hour.",
  "paymentAccepted": ["Credit Card", "Debit Card", "Cash", "UPI"],
  "currenciesAccepted": "INR",
  "areaServed": {
    "@type": "Place",
    "name": "Bhubaneswar, Odisha"
  }
}
</script>
</head>
<body>
<div class="r-wrapper">
  <?php include "includes1/site-banner1.php"; ?>
  <section id="r-advantages-part" class="r-advantages-part">
    <div class="r-advantage-main-part r-advantage-main-part-white">
      <div class="container clearfix">
        <div class="advantage-head">
          <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left"> <span>30+ CARS TYPE &amp; BRANDS</span>
              <h1>Best Self Drive Car Rental Service in Bhubaneswar<b></b></h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
              <p class="r-sub-head-text"><a href="https://eduxoncabs.com/index.php" target="_bhubaneswar">Eduxon Cabs provides Bhubaneswar's Best self drive car rental service </a> at exceptional pricing. Our selection of <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php">well-maintained rental cars </a> allows customers to freely explore Bhubaneswar as well as surrounding regions. Guests can choose between daily or weekly or outstation rental trips from Eduxon Cabs while benefiting from unrestricted mileage and nonstop service support and premium vehicles from famous manufacturers. Our transportation system ensures all cars receive scheduled maintenance in addition to cleanliness which guarantees a risk-free driving experience for each user.</p>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="r-advantages-box">
              <div class="icon">
                  <picture>
  <source type="image/webp" srcset="assets/images/support.webp">
  <img src="assets/images/support.png" class="icon-img" alt="Best self drive cars in Bhubaneswar with 24x7 assistance">
</picture>

              </div>
              <div class="head">24x7 Customer Support</div>
              <div class="sub-text">Best self drive cars in Bhubaneswar with 24x7 assistance.</div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="r-advantages-box">
              <div class="icon">
                 <picture>
                <source type="image/webp" srcset="assets/images/calendar.webp">
                  <img src="assets/images/calendar.png" class="icon-img" alt="Starting at just ₹35/hr – affordable self drive car rental in Bhubaneswa">
             </picture>
          </div>
              <div class="head">Lowest Price Guaranteed</div>
              <div class="sub-text">Starting at just ₹35/hr – affordable self drive car rental in Bhubaneswar.</div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="r-advantages-box">
              <div class="icon">
                 <picture>
               <source type="image/webp" srcset="assets/images/destination.webp">
             <img src="assets/images/destination.png" class="icon-img" alt="Pickup from Bhubaneswar Airport">
             </picture>
             </div>
              <div class="head">Choice of Picking Locations</div>
              <div class="sub-text">Pickup from Bhubaneswar Airport or multiple city spots.</div>
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
                <h2 class="heading-white">About <b>Eduxon cabs</b> – Best Self Drive Car Rental in Bhubaneswar</h2>
              </div>
              <p><a href="https://eduxoncabs.com/index.php" target="_blank" rel="noopener noreferrer">Eduxon Cabs</a>
              has been offering reliable self drive car rentals in Bhubaneswar since 2016. With over 5000+ satisfied customers and a fleet of 30+ vehicles, we deliver safe, flexible travel across the city and airport. </p>
              <ul class="mb-0 pl-0">
                <li><i class="fa fa-check-circle"></i> 5000+ happy customers</li>
                <li><i class="fa fa-check-circle"></i> Pickup from city or Bhubaneswar Airport</li>
                <li><i class="fa fa-check-circle"></i> Unlimited kilometers, zero hidden charges</li>
                <li><i class="fa fa-check-circle"></i> Best self drive car rental in bhubaneswar</li>
              </ul>
              <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" class="btn-primary eduxon-button">VIEW ALL VEHICLES</a>
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

                  $id = $key["id"];
                  $get_unavail = $dbObj->countRec(
                      "tbl_unavail_dtes",
                      "car_id = $id AND ('$pdate' BETWEEN `unavail_dte` AND `unavail_dte_to`)"
                  );
                  ?>
          <div class="">
            <div class="r-best-offer-single">
              <div class="r-best-offer-in">
                <div class="r-offer-img"> <a class="d-inline-block" href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php"><img src="uploadedDocument/cab/<?php echo $key[
                    "car_image"
                ]; ?>" class="img-fluid d-block m-auto" alt=" Bike Rental In Bhubaneswar"></a> <a href="car-booking.html" class="d-block">
                  <div class="r-offer-img-over"> <i class="fa fa-search"></i> </div>
                  </a> </div>
               <div class="r-best-offer-content black-text">
  <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" class="highlight-link">
    <?php echo $key["car_nme"]; ?>
  </a>
                  <p>Start at <b>Rs <?php echo $key["cost"]; ?> </b> /24 Hr</p>
                  <ul class="pl-0 mb-0">
                    <li><i class="fa fa-beer"></i><span><?php echo $key[
                        "fuel"
                    ]; ?></span></li>
                    <li><i class="fa fa-wheelchair"></i><span><?php echo $key[
                        "no_of_seat"
                    ]; ?></span></li>
                  </ul>
                </div>
                <div class="r-offer-rewst-this">
                  <?php if ($get_unavail > 0) { ?>
                  <span class="text-uppercase">Car Booked</span>
                  <?php } else { ?>
                  <span class="text-uppercase"><a href="checkout.php?pdate=<?php echo date(
                      "Y-m-d"
                  ); ?>&ptime=6:00&ddate=<?php echo date(
    "Y-m-d"
); ?>&dtime=12:00&car=<?php echo md5(
    $key["car_nme"]
); ?>&cartype=<?php echo md5($key["fuel"]); ?>&cardta=<?php echo md5(
    $key["id"]
); ?>" class="btn btn-primary mb-xl">Book Now</a></span>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <?php
              }
          } else {
               ?>
          <h4>Sorry!!! No record found..</h4>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <div id="r-quote">
    <div class="r-quote">
      <div class="container">
          <div class="r-sec-head r-sec-head-b">
              <h2 class="heading-black"><strong>What Customers Say About Our Self Drive Car Rentals</strong></h2>
          </div>
        <div class="row">
          <div class="col-md-12" data-wow-delay="0.2s">
            <div id="r-quote-carousel" class="carousel slide">
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item">
                  <p>“My time using Eduxon Cabs for self drive car rental in Bhubaneswar proved to be truly excellent from start to finish. The booking operation progressed swiftly and easily while staff members kept their professionalism during support activities. All paperwork was ready together with a clean vehicle when I reached the location. I left the rental facility within a brief interval to continue my journey. Eduxon Cabs delivered an outstanding car experience for urban travels along with speedy effortless procedures for return. Eduxon Cabs delivers dependable self drive car rental services to Bhubaneswar residents and I strongly suggest their services.”</p>
                </div>
                <div class="carousel-item active">
                  <p>“The car rental service I experienced with Eduxon Cabs in Bhubaneswar for a self drive vehicle left no room for complaints. The booking process was straightforward while the car pickup destination stood nearby the airport. Their staff provided quick key delivery while the vehicle was immaculately clean along with a full tank. The trip lasted two days without difficulties and the unlimited distance traveled added major convenience to my journey. The return process of the vehicle turned out to be simple. Eduxon provides Bhubaneswar residents the top service for self drive car rentals.”</p>
                </div>
                <div class="carousel-item">
                  <p>“Eduxon Cabs made renting a self drive car in Bhubaneswar completely hassle-free. From booking to pickup, the process was fast and efficient. The car was spotless, mechanically sound, and ideal for local travel. I was impressed with their 24x7 customer support and clear pricing. I returned the vehicle after a 3-day trip and everything was processed instantly. This was easily the best experience I’ve had with self drive car rentals in Bhubaneswar.”</p>
                </div>
              </div>
              <ol class="carousel-indicators">
                <li data-target="#r-quote-carousel" data-slide-to="0"> <img class="img-fluid d-block" src="assets/images/user-04.png" alt="Self Drive Car Rental In Bhubaneswar"> <span> <b>Ankit Jena</b> </span> </li>
                <li data-target="#r-quote-carousel" data-slide-to="1" class="active text-center"> <img class="img-fluid d-block" src="assets/images/user-05.png" alt=" Car Rental In Bhubaneswar"> <span> <b>Saurav Singh</b> </span> </li>
                <li data-target="#r-quote-carousel" data-slide-to="2"> <img class="img-fluid d-block" src="assets/images/user-06.png" alt=" Car Rental In Bhubaneswar"> <span> <b>Shashank Singh</b>  </span> </li>
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
        <div class="r-newsletter-head"> 
       <picture>
        <source type="image/webp" srcset="assets/images/Eduxoncabs.webp">
       <img src="assets/images/Eduxoncabs.png" class="d-block img-fluid m-auto" alt="Self Drive Car Rental In Bhubaneswar">
       </picture>
        </div>
        <div class="r-newsletter-form"> <i class="fa fa-envelope"></i>
          <p>SUBSCRIBE FOR OFFERS</p>
          <form action="" method="post">
            <div class="r-newsletter">
              <input type="number" name="phone" id="phone" maxlength="10" placeholder="Phone No" required>
              <input type="button" class="btn btn-full custom-register-btn" id="subscribebtn" value="REGISTER NOW" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="r-counter-section r-counter-with-bg m-0 counter-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-happy-customer-white.png" alt=" Bike Rental In Bhubaneswar" class="img-fluid"> </div>
            <div class="r-counts" data-count="4567">
              <!-- 1.172.700 -->
              <span class="r-count">0</span> </div>
            <span class="r-count-title"> HAPPY CUSTOMERS </span> </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-cars-count-white.png" alt="Best Self Drive Car Rental In Bhubaneswar" class="img-fluid"> </div>
            <div class="r-counts" data-count="20">
              <!-- 2.450 -->
              <span class="r-count">0</span> </div>
            <span class="r-count-title"> CARS IN GARAGE </span> </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-total-km-white.png" alt=" Bike Rental In Bhubaneswar" class="img-fluid"> </div>
            <div class="r-counts" data-count="127100">
              <!-- 1.211.100 -->
              <span class="r-count">0</span> </div>
            <span class="r-count-title"> TOTAL KILOMETERS </span> </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="r-counter-box">
            <div class="r-counter-icon"> <img src="assets/images/icon-car-center-white.png" alt="Best Self Drive Cars In Bhubaneswar" class="img-fluid"> </div>
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
              <div class="r-accordion-body is-hidden">
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
  <section id="r-latest-news">
    <div class="r-latest-news r-latest-news-light">
      <div class="r-sec-head r-sec-head-b"> <span>ARTICLES FROM BLOG</span>
        <h2 class="heading-black">Our <b>Latest News.</b></h2>
      </div>
      <div class="container">
        <div class="owl-carousel r-latest-news-list" id="r-latest-news-slider">
          <div class="r-latest-news-single"> <a href="https://www.eduxoncabs.com/self-drive-car-hire.php" class="d-inline-block">
              <picture>
             <source type="image/webp" srcset="assets/images/latest-news-01.webp">
         <img src="assets/images/latest-news-01.jpg" class="img-fluid d-block m-auto" alt="Self Drive Car Rental In Bhubaneswar">
           </picture>
              </a>
            <div class="r-latest-news-content"> <!--<span class="r-date">27 JUNE 2018</span>-->
              <h4><a href="https://www.eduxoncabs.com/self-drive-car-hire.php">Self Drive Cars in Bhuaneswar</a></h4>
              <p>The daily commute in the city becomes so much simpler if anybody opts self drive car rental in Bhubaneswar.One can lease a car more often than not for a few reasons. The decision of Hire a car in Bhubaneswar has extended with the self drive option.You get the flexibility to plan your journey. If you've got to get a group of people from one place to the other, or are moving and need a way to transport your possessions, a Self Drive Car Hire maybe just what you are looking for. </p>
              <a href="https://www.eduxoncabs.com/self-drive-car-hire.php" class="r-read-more">READ MORE</a> </div>
          </div>
          <div class="r-latest-news-single"> <a href="https://www.eduxoncabs.com/self-drive-car.php" class="d-inline-block">
              <picture>
            <source type="image/webp" srcset="assets/images/latest-news-02 (1).webp">
           <img src="assets/images/latest-news-02.jpg" class="img-fluid d-block m-auto" alt="Bike Rental In Bhubaneswar">
            </picture>
              </a>
            <div class="r-latest-news-content"> <!--<span class="r-date">27 JUNE 2018</span>-->
              <h4><a href="https://www.eduxoncabs.com/self-drive-car.php">Self Drive Car Rental in Bhubaneswar</a></h4>
              <p>The "Temple City" Bhubaneswar has many outing option and Tourist attractions around the state.With Eduxon Cabs,Bhubaneswar Car Hire can be arranged in a jiffy which provides provides self drive through Eduxon cabs.With the freedom of Self Drive,ones get privacy to travel with family,cost benefits.One also gets Benefit of Unlimited Kilometers</p>
              <a href="https://www.eduxoncabs.com/self-drive-car.php" class="r-read-more">READ MORE</a> </div>
          </div>
          <div class="r-latest-news-single"> <a href="https://www.eduxoncabs.com/self-drive-cars-rental.php" class="d-inline-block">
              <picture>
                <source type="image/webp" srcset="assets/images/latest-news-03.webp">
                <img src="assets/images/latest-news-03.jpg" class="img-fluid d-block m-auto" alt="Self Drive Car Rental In Bhubaneswar">
            </picture>
              </a>
            <div class="r-latest-news-content"> <!--<span class="r-date">27 JUNE 2018</span>-->
              <h4><a href="https://www.eduxoncabs.com/self-drive-cars-rental.php">Best Car Rental in Bhubaneswar</a></h4>
              <P>Car Rental is an essential part of all our lives. Some of us have our own vehicles; some of us travel by bus or train, while others choose taxis for their everyday ride. There is another growing option for us today that is affordable and also very convenient - Self drive cars in Bhubaneswar. You can rent any type of self drive from Bhubaneswar Airport or Railway Station as per your need in terms of days, weeks and even months.</P>
              <a href="https://www.eduxoncabs.com/self-drive-cars-rental.php" class="r-read-more">READ MORE</a> </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="r-gallery-part">
  <h2 class="text-center">Gallery</h2>
    <div class="r-gallery-part r-gallery-part-home py-0">
      <ul class="clearfix">
        <?php
        $get_all_img = $dbObj->fetch_data(
            "tbl_banner",
            "",
            "banner_sequence ASC",
            ""
        );

        $cnt = $dbObj->countRec("tbl_banner");

        if ($cnt > 0) {
            foreach ($get_all_img as $key) { ?>
        <li> <a href="uploadedDocument/banner/<?php echo $key[
            "banner_image"
        ]; ?>" data-rel="lightcase:myCollection"> <img src="uploadedDocument/banner/<?php echo $key[
    "banner_image"
]; ?>" class="d-block img-fluid" alt="Self Drive Car Rental In Bhubaneswar" loading="lazy">
          <div class="gallery-hover">
            <div class="gallery-text">
              <div class="icon-gallery"><i class="fa fa-search" aria-hidden="true"></i></div>
            </div>
          </div>
          </a> </li>
        <?php }
        } else {
            echo "Sorry No image found!!!";
        }
        ?>
      </ul>
    </div>
  </div>
  <?php include "includes1/site-footer.php"; ?>
</div>
<div id="r-to-top" class="r-to-top"><i class="fa fa-angle-up"></i></div>
<!-- JQUERY:: JQUERY.JS -->
<?php include "includes1/inc-js.php"; ?>


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
$ct1_picpoint = "";
$ct1_drppoint = "";
foreach ($get_city_location_data1 as $data1) {
    $picPoint = $data1["pickup_point"];
    $dropPoint = $data1["drop_point"];
    $ct1_picpoint .= "<option value='$picPoint' >$picPoint</option>";
    $ct1_drppoint .= "<option value='$dropPoint' >$dropPoint</option>";
}

$ct2_picpoint = "";
$ct2_drppoint = "";
foreach ($get_city_location_data2 as $data2) {
    $picPoint = $data2["pickup_point"];
    $dropPoint = $data2["drop_point"];
    $ct2_picpoint .= "<option value='$picPoint' >$picPoint</option>";
    $ct2_drppoint .= "<option value='$dropPoint' >$dropPoint</option>";
}

$ct3_picpoint = "";
$ct3_drppoint = "";
foreach ($get_city_location_data3 as $data3) {
    $picPoint = $data3["pickup_point"];
    $dropPoint = $data3["drop_point"];
    $ct3_picpoint .= "<option value='$picPoint' >$picPoint</option>";
    $ct3_drppoint .= "<option value='$dropPoint' >$dropPoint</option>";
}
?>
                $("#city").change(function () {

                    var city = $(this).val();
                    if (city == 1) {

                        //all-cars-for-self-drive-bhubaneswar.php
                        $("#pickuploc").html("<?= $ct1_picpoint ?>");
                        $("#droploc").html("<?= $ct1_drppoint ?>");
                    } else if (city == 2) {
                        $("#pickuploc").html("<?= $ct2_picpoint ?>");
                        $("#droploc").html("<?= $ct2_drppoint ?>");
                    }else if (city == 3) {
                        $("#pickuploc").html("<?= $ct3_picpoint ?>");
                        $("#droploc").html("<?= $ct3_drppoint ?>");
                    }

                });

            });


<?php
$get_hour_res = $dbObj->fetch_data("tbl_min_hour", "status = '1'");
$min_hour = $get_hour_res[0]["hours"];
?>
            function calculateTime(dropTime, pdate, ptime, ddate) {

                var pickTime = pdate + " " + ptime;

                var dropTimeh = ddate + " " + dropTime;

                if (dropTime != 0) {

                    dt1 = new Date(pickTime);

                    dt2 = new Date(dropTimeh);

                    var t = diff_hours(dt1, dt2);

                    if (t < <?= $min_hour ?>) {

                        alert("sorry you need to select more than <?= $min_hour ?> Hr.");

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


        </script>
        
        
        
        
        
   <style>
.icon-img {
  height: 70px;
  width: 70px;
}

.heading-white {
  color: #fff !important;
}


.btn-primary.eduxon-button {
  background: #6C0D12 !important;
  border-radius: 5px;
}
.black-text {
  color: #000;
}

.highlight-link {
  color: #6C0D12 !important;
  font-weight: bold !important;
}
.text-black {
  color: #000;
}
.custom-register-btn {
  background: #6C0D12 !important;
  border-radius: 5px;
  color: #fff;
}
.counter-bg {
  background: #6C0D12 !important;
}
.is-hidden {
  display: none;
}
.heading-black {
  color: #000 !important;
}
.text-center {
  text-align: center;
}
</style>
     
        
        
        
        
        
        
        
        
</body>
</html>