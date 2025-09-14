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
<title>Self Drive Cars Bhubaneswar | Car Rental BBSR Starting ₹35/Hour | 24 Hour Service</title>
<meta name="keywords" content="self drive cars Bhubaneswar, self drive car rental Bhubaneswar, car rental Bhubaneswar, self drive cars BBSR, self drive cars Bhubaneswar airport, car rental Bhubaneswar airport, 24 hour car rental Bhubaneswar, hourly car rental Bhubaneswar, unlimited km car rental Bhubaneswar, doorstep delivery car rental Bhubaneswar, cheap car rental Bhubaneswar, affordable self drive cars Bhubaneswar, sedan rental Bhubaneswar, SUV rental Bhubaneswar"/>
<meta name="description" content="Best self drive cars Bhubaneswar starting ₹35/hour. 24 hour car rental BBSR with unlimited km, doorstep delivery & airport pickup. Book sedan, SUV rental Bhubaneswar online. Affordable self drive car rental with no hidden charges."/>
<meta name="author" content="EduxonCabs - Self Drive Car Rental Bhubaneswar">
<meta property="product:brand" content="Self Drive Cars Bhubaneswar | EduxonCabs" />
<meta property="og:site_name" content="EduxonCabs - Self Drive Car Rental Bhubaneswar" />
<meta property="og:title" content="Self Drive Cars Bhubaneswar | Car Rental BBSR ₹35/Hour | EduxonCabs" />
<meta property="og:description" content="Best self drive cars Bhubaneswar starting ₹35/hour. 24 hour car rental BBSR with unlimited km, doorstep delivery & airport pickup. Book online now!" />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://www.eduxoncabs.com/" />
<meta property="og:image" content="https://www.eduxoncabs.com/img/logo.png" />
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
<!-- Modern Design CSS -->
<link href="assets/css/modern-design.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

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
  "@type": "LocalBusiness",
  "name": "EduxonCabs - Self Drive Car Rental Bhubaneswar",
  "description": "Best self drive cars Bhubaneswar starting ₹35/hour. 24 hour car rental BBSR with unlimited km, doorstep delivery & airport pickup.",
  "url": "https://www.eduxoncabs.com/",
  "telephone": "+91-9776614199",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Bhubaneswar",
    "addressRegion": "Odisha",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 20.2961,
    "longitude": 85.8245
  },
  "openingHours": "Mo-Su 00:00-23:59",
  "priceRange": "₹35-₹2000",
  "serviceArea": {
    "@type": "City",
    "name": "Bhubaneswar"
  },
  "hasOfferingCatalog": {
    "@type": "OfferingCatalog",
    "name": "Self Drive Car Rental Services",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Hourly Car Rental Bhubaneswar",
          "description": "Self drive cars starting ₹35/hour"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Daily Car Rental Bhubaneswar",
          "description": "24 hour car rental with unlimited km"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Airport Car Rental Bhubaneswar",
          "description": "Car rental Bhubaneswar airport pickup and drop"
        }
      }
    ]
  },
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.eduxoncabs.com/{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AutoRental",
  "name": "EduxonCabs Self Drive Car Rental",
  "description": "Self drive cars Bhubaneswar starting ₹35/hour. Sedan, SUV rental with unlimited km, doorstep delivery, airport pickup.",
  "provider": {
    "@type": "Organization",
    "name": "EduxonCabs",
    "url": "https://www.eduxoncabs.com"
  },
  "areaServed": {
    "@type": "City",
    "name": "Bhubaneswar",
    "addressRegion": "Odisha",
    "addressCountry": "IN"
  },
  "offers": [
    {
      "@type": "Offer",
      "name": "Hourly Car Rental Bhubaneswar",
      "description": "Self drive cars starting ₹35/hour",
      "price": "35",
      "priceCurrency": "INR",
      "availability": "https://schema.org/InStock"
    },
    {
      "@type": "Offer", 
      "name": "Daily Car Rental Bhubaneswar",
      "description": "24 hour car rental with unlimited km",
      "price": "1000",
      "priceCurrency": "INR",
      "availability": "https://schema.org/InStock"
    }
  ]
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
  <?php include "includes1/modern-header-hero.php"; ?>
  
  <!-- Mobile CTA Section - Only visible on mobile -->
  <section class="mobile-cta-section d-lg-none py-4" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white;">
    <div class="container text-center">
      <h4 class="mb-3 font-weight-bold">Book Your Car in 3 Easy Steps!</h4>
      <div class="row">
        <div class="col-4">
          <div class="cta-step">
            <div class="step-icon mb-2">
              <i class="fa fa-map-marker" style="font-size: 1.5rem;"></i>
            </div>
            <small class="font-weight-600">Choose Location</small>
          </div>
        </div>
        <div class="col-4">
          <div class="cta-step">
            <div class="step-icon mb-2">
              <i class="fa fa-calendar" style="font-size: 1.5rem;"></i>
            </div>
            <small class="font-weight-600">Select Date</small>
          </div>
        </div>
        <div class="col-4">
          <div class="cta-step">
            <div class="step-icon mb-2">
              <i class="fa fa-car" style="font-size: 1.5rem;"></i>
            </div>
            <small class="font-weight-600">Drive Away</small>
          </div>
        </div>
      </div>
      <div class="mt-3">
        <a href="#booking-form" class="btn btn-light btn-lg px-4 py-2 smooth-scroll" style="color: #007bff; font-weight: bold;">
          <i class="fa fa-arrow-up mr-2"></i>Book Now Above
        </a>
      </div>
    </div>
  </section>
  
  <!-- Modern Features Section -->
  <section class="modern-features-section section-padding">
    <div class="container">
      <div class="text-center mb-5">
        <div class="section-badge">
          <span class="badge-modern">Why Choose EduxonCabs</span>
        </div>
        <h2 class="section-title-modern">
          Premium Car Rental Services
          <span class="highlight-text">Starting ₹35/Hour</span>
        </h2>
        <p class="section-subtitle-modern">
          Experience the best self-drive car rental service in Bhubaneswar with our premium fleet, 
          24/7 support, and affordable rates. Unlimited kilometers, doorstep delivery, and instant booking.
        </p>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card-modern">
            <div class="feature-icon-modern">
              <i class="fa fa-headphones"></i>
            </div>
            <h3 class="feature-title-modern">24/7 Customer Support</h3>
            <p class="feature-description-modern">
              Round-the-clock assistance for seamless travel experience with instant support and guidance.
            </p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card-modern">
            <div class="feature-icon-modern">
              <i class="fa fa-shield"></i>
            </div>
            <h3 class="feature-title-modern">Verified & Clean Cars</h3>
            <p class="feature-description-modern">
              All vehicles are thoroughly sanitized, verified, and maintained for your safety and comfort.
            </p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card-modern">
            <div class="feature-icon-modern">
              <i class="fa fa-clock-o"></i>
            </div>
            <h3 class="feature-title-modern">Instant Booking</h3>
            <p class="feature-description-modern">
              Quick and easy booking process with instant confirmation and flexible pickup options.
            </p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card-modern">
            <div class="feature-icon-modern">
              <i class="fa fa-map-marker"></i>
            </div>
            <h3 class="feature-title-modern">Doorstep Delivery</h3>
            <p class="feature-description-modern">
              Convenient doorstep delivery and pickup service across Bhubaneswar for your comfort.
            </p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card-modern">
            <div class="feature-icon-modern">
              <i class="fa fa-inr"></i>
            </div>
            <h3 class="feature-title-modern">Best Price Guarantee</h3>
            <p class="feature-description-modern">
              Competitive pricing with no hidden charges and flexible payment options available.
            </p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card-modern">
            <div class="feature-icon-modern">
              <i class="fa fa-road"></i>
            </div>
            <h3 class="feature-title-modern">Unlimited Kilometers</h3>
            <p class="feature-description-modern">
              Drive anywhere without kilometer restrictions and explore Bhubaneswar freely.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Modern About Section -->
  <section class="section-padding" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="mb-4">
            <span class="badge badge-primary-light text-uppercase px-3 py-2 mb-3">Know More About Us</span>
            <h2 class="section-title text-left mb-4">About <span class="text-primary">EduxonCabs</span> – Best Self Drive Car Rental in Bhubaneswar</h2>
            <p class="mb-4">
              <a href="https://eduxoncabs.com/index.php" target="_blank" rel="noopener noreferrer">Eduxon Cabs</a>
              has been offering reliable self drive car rentals in Bhubaneswar since 2016. With over 5000+ satisfied customers and a fleet of 30+ vehicles, we deliver safe, flexible travel across the city and airport.
            </p>
            
            <div class="row mb-4">
              <div class="col-md-6">
                <ul class="list-unstyled">
                  <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> 5000+ happy customers</li>
                  <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> City & Airport pickup</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="list-unstyled">
                  <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Unlimited kilometers</li>
                  <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Zero hidden charges</li>
                </ul>
              </div>
            </div>
            
            <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" class="btn btn-primary btn-lg">
              View All Vehicles <i class="fa fa-arrow-right ml-2"></i>
            </a>
          </div>
        </div>
        
        <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="text-center p-4 bg-white rounded shadow-sm">
                <div class="stat-number text-primary">5000+</div>
                <p class="stat-label">Happy Customers</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="text-center p-4 bg-white rounded shadow-sm">
                <div class="stat-number text-success">30+</div>
                <p class="stat-label">Cars Available</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="text-center p-4 bg-white rounded shadow-sm">
                <div class="stat-number text-info">24/7</div>
                <p class="stat-label">Customer Support</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="text-center p-4 bg-white rounded shadow-sm">
                <div class="stat-number text-warning">₹35</div>
                <p class="stat-label">Starting Price/Hour</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Modern Car Showcase Section -->
  <section class="car-grid section-padding">
    <div class="container">
      <div class="text-center mb-5">
        <span class="badge badge-primary-light text-uppercase px-3 py-2 mb-3">Featured Cars</span>
        <h2 class="section-title">Our Best Offers</h2>
        <p class="section-subtitle">Choose from our premium fleet of self-drive cars in Bhubaneswar with competitive pricing and excellent service.</p>
      </div>
      
      <div class="row">
        <?php
        $cnt = $dbObj->countRec("tbl_cabs", "status = 1");
        if ($cnt > 0) {
            $getCar = $dbObj->fetch_data("tbl_cabs", "status = 1 LIMIT 6");
            foreach ($getCar as $key) {
                $id = $key["id"];
                $get_unavail = $dbObj->countRec(
                    "tbl_unavail_dtes",
                    "car_id = $id AND ('$pdate' BETWEEN `unavail_dte` AND `unavail_dte_to`)"
                );
                ?>
        <div class="col-lg-4 col-md-6">
          <div class="car-card">
            <div class="car-image">
              <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php">
                <img src="uploadedDocument/cab/<?php echo $key["car_image"]; ?>" 
                     class="img-fluid" 
                     alt="<?php echo $key["car_nme"]; ?> - Self Drive Car Rental Bhubaneswar">
              </a>
            </div>
            <div class="car-info">
              <h3 class="car-name">
                <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" class="text-decoration-none">
                  <?php echo $key["car_nme"]; ?>
                </a>
              </h3>
              <div class="car-price">₹<?php echo $key["cost"]; ?> <small class="text-muted">/24 Hr</small></div>
              
              <ul class="car-features">
                <li><i class="fa fa-car"></i> <?php echo $key["fuel"]; ?> Engine</li>
                <li><i class="fa fa-users"></i> <?php echo $key["no_of_seat"]; ?> Seater</li>
                <li><i class="fa fa-road"></i> Unlimited Kilometers</li>
                <li><i class="fa fa-shield"></i> 24x7 Support</li>
              </ul>
              
              <div class="mt-3">
                <?php if ($get_unavail > 0) { ?>
                <button class="btn btn-secondary btn-block" disabled>Currently Booked</button>
                <?php } else { ?>
                <a href="checkout.php?pdate=<?php echo date("Y-m-d"); ?>&ptime=6:00&ddate=<?php echo date("Y-m-d"); ?>&dtime=12:00&car=<?php echo md5($key["car_nme"]); ?>&cartype=<?php echo md5($key["fuel"]); ?>&cardta=<?php echo md5($key["id"]); ?>" 
                   class="btn btn-primary btn-block">Book Now</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <?php
            }
        } else {
            ?>
        <div class="col-12 text-center">
          <h4>Sorry! No cars available at the moment.</h4>
        </div>
        <?php
        }
        ?>
      </div>
      
      <div class="text-center mt-5">
        <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" class="btn btn-outline-primary btn-lg">
          View All Vehicles <i class="fa fa-arrow-right ml-2"></i>
        </a>
      </div>
    </div>
  </section>
    <!-- Modern Customer Reviews Section -->
  <section class="section-padding" style="background: #f8f9ff;">
    <div class="container">
      <div class="text-center mb-5">
        <span class="badge badge-primary-light text-uppercase px-3 py-2 mb-3">Customer Reviews</span>
        <h2 class="section-title">What Our Customers Say About EduxonCabs</h2>
        <p class="section-subtitle">
          Real feedback from our satisfied customers who have experienced our self drive car rental services in Bhubaneswar
        </p>
      </div>
      
      <div class="row">
        <!-- Review Card 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card h-100">
            <div class="testimonial-content">
              <div class="stars mb-3">
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
              </div>
              <p class="testimonial-text">
                "Eduxon Cabs made renting a self drive car in Bhubaneswar completely hassle-free. From booking to pickup, the process was fast and efficient. The car was spotless, mechanically sound, and ideal for local travel. I was impressed with their 24x7 customer support and clear pricing."
              </p>
            </div>
            <div class="testimonial-author">
              <div class="d-flex align-items-center">
                <img src="assets/images/user-04.png" alt="Ankit Jena" class="testimonial-avatar">
                <div class="ml-3">
                  <h5 class="mb-0 font-weight-bold">Ankit Jena</h5>
                  <small class="text-muted">Verified Customer</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Review Card 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card h-100">
            <div class="testimonial-content">
              <div class="stars mb-3">
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
              </div>
              <p class="testimonial-text">
                "The car rental service I experienced with Eduxon Cabs in Bhubaneswar for a self drive vehicle left no room for complaints. The booking process was straightforward while the car pickup destination stood nearby the airport. Their staff provided quick key delivery while the vehicle was immaculately clean."
              </p>
            </div>
            <div class="testimonial-author">
              <div class="d-flex align-items-center">
                <img src="assets/images/user-05.png" alt="Saurav Singh" class="testimonial-avatar">
                <div class="ml-3">
                  <h5 class="mb-0 font-weight-bold">Saurav Singh</h5>
                  <small class="text-muted">Business Traveler</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Review Card 3 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card h-100">
            <div class="testimonial-content">
              <div class="stars mb-3">
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
              </div>
              <p class="testimonial-text">
                "My time using Eduxon Cabs for self drive car rental in Bhubaneswar proved to be truly excellent from start to finish. The booking operation progressed swiftly and easily while staff members kept their professionalism during support activities. All paperwork was ready together with a clean vehicle."
              </p>
            </div>
            <div class="testimonial-author">
              <div class="d-flex align-items-center">
                <img src="assets/images/user-06.png" alt="Shashank Singh" class="testimonial-avatar">
                <div class="ml-3">
                  <h5 class="mb-0 font-weight-bold">Shashank Singh</h5>
                  <small class="text-muted">Tourist</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Trust Indicators -->
      <div class="row mt-5">
        <div class="col-md-3 col-6 text-center mb-4">
          <div class="trust-indicator">
            <i class="fa fa-star-o text-warning fa-2x mb-2"></i>
            <h4 class="font-weight-bold text-primary mb-1">4.8/5</h4>
            <p class="text-muted mb-0">Average Rating</p>
          </div>
        </div>
        <div class="col-md-3 col-6 text-center mb-4">
          <div class="trust-indicator">
            <i class="fa fa-users text-success fa-2x mb-2"></i>
            <h4 class="font-weight-bold text-primary mb-1">5000+</h4>
            <p class="text-muted mb-0">Happy Customers</p>
          </div>
        </div>
        <div class="col-md-3 col-6 text-center mb-4">
          <div class="trust-indicator">
            <i class="fa fa-thumbs-up text-info fa-2x mb-2"></i>
            <h4 class="font-weight-bold text-primary mb-1">98%</h4>
            <p class="text-muted mb-0">Satisfaction Rate</p>
          </div>
        </div>
        <div class="col-md-3 col-6 text-center mb-4">
          <div class="trust-indicator">
            <i class="fa fa-repeat text-purple fa-2x mb-2"></i>
            <h4 class="font-weight-bold text-primary mb-1">85%</h4>
            <p class="text-muted mb-0">Repeat Customers</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="r-newsletter-suscribe">
    <div class="r-newsletter-suscribe">
      <div class="container">
        <div class="r-newsletter-head"> 
       <picture>
        <source type="image/webp" srcset="assets/images/Eduxoncabs.webp">
       <img src="assets/images/Eduxoncabs.png" class="d-block img-fluid m-auto" alt="EduxonCabs - Self Drive Car Rental Bhubaneswar Logo">
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
            <div class="r-counter-icon"> <img src="assets/images/icon-happy-customer-white.png" alt="Happy Customers - Self Drive Car Rental Bhubaneswar" class="img-fluid"> </div>
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
            <div class="r-counter-icon"> <img src="assets/images/icon-total-km-white.png" alt="Unlimited KM Car Rental Bhubaneswar" class="img-fluid"> </div>
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
  <!-- Modern Gallery & News Section -->
  <section class="section-padding" style="background: #fff;">
    <div class="container">
      <div class="text-center mb-5">
        <span class="badge badge-primary-light text-uppercase px-3 py-2 mb-3">Gallery & Latest Updates</span>
        <h2 class="section-title">Explore Our Fleet & Latest News</h2>
        <p class="section-subtitle">
          Discover our premium self-drive cars and stay updated with the latest news from EduxonCabs Bhubaneswar
        </p>
      </div>
      
      <!-- Gallery Tabs -->
      <div class="gallery-tabs text-center mb-5">
        <ul class="nav nav-pills justify-content-center" id="galleryTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="cars-tab" data-toggle="pill" href="#cars-gallery" role="tab">
              <i class="fa fa-car mr-2"></i>Our Fleet
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="news-tab" data-toggle="pill" href="#news-gallery" role="tab">
              <i class="fa fa-newspaper-o mr-2"></i>Latest News
            </a>
          </li>
        </ul>
      </div>
      
      <!-- Gallery Content -->
      <div class="tab-content" id="galleryTabContent">
        <!-- Cars Gallery Tab -->
        <div class="tab-pane fade show active" id="cars-gallery" role="tabpanel">
          <div class="modern-gallery">
            <div class="row">
              <?php
              $get_all_img = $dbObj->fetch_data("tbl_banner", "", "banner_sequence ASC", "");
              $cnt = $dbObj->countRec("tbl_banner");
              
              if ($cnt > 0) {
                  $counter = 0;
                  foreach ($get_all_img as $key) { 
                      $counter++;
                      ?>
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="gallery-item">
                  <div class="gallery-image">
                    <img src="uploadedDocument/banner/<?php echo $key["banner_image"]; ?>" 
                         class="img-fluid" 
                         alt="Self Drive Car Rental In Bhubaneswar - Image <?php echo $counter; ?>" 
                         loading="lazy">
                    <div class="gallery-overlay">
                      <div class="gallery-content">
                        <a href="uploadedDocument/banner/<?php echo $key["banner_image"]; ?>" 
                           data-lightbox="gallery" 
                           class="gallery-zoom">
                          <i class="fa fa-search-plus"></i>
                        </a>
                        <h5 class="gallery-title">EduxonCabs Fleet</h5>
                        <p class="gallery-subtitle">Premium Self Drive Cars</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                  }
              } else {
                  echo '<div class="col-12 text-center"><p class="text-muted">No gallery images available at the moment.</p></div>';
              }
              ?>
            </div>
          </div>
        </div>
        
        <!-- News Gallery Tab -->
        <div class="tab-pane fade" id="news-gallery" role="tabpanel">
          <div class="row">
            <!-- News Article 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="news-card h-100">
                <div class="news-image">
                  <picture>
                    <source type="image/webp" srcset="assets/images/latest-news-01.webp">
                    <img src="assets/images/latest-news-01.jpg" class="img-fluid" alt="Self Drive Cars in Bhubaneswar">
                  </picture>
                  <div class="news-category">
                    <span class="badge badge-primary">Car Rental</span>
                  </div>
                </div>
                <div class="news-content">
                  <h4 class="news-title">
                    <a href="https://www.eduxoncabs.com/self-drive-car-hire.php">Self Drive Cars in Bhubaneswar</a>
                  </h4>
                  <p class="news-excerpt">
                    The daily commute in the city becomes so much simpler if anybody opts self drive car rental in Bhubaneswar. Get the flexibility to plan your journey with our premium fleet.
                  </p>
                  <div class="news-meta">
                    <span class="news-date"><i class="fa fa-calendar mr-2"></i>Latest Update</span>
                    <a href="https://www.eduxoncabs.com/self-drive-car-hire.php" class="news-read-more">
                      Read More <i class="fa fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- News Article 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="news-card h-100">
                <div class="news-image">
                  <picture>
                    <source type="image/webp" srcset="assets/images/latest-news-02 (1).webp">
                    <img src="assets/images/latest-news-02.jpg" class="img-fluid" alt="Self Drive Car Rental in Bhubaneswar">
                  </picture>
                  <div class="news-category">
                    <span class="badge badge-success">Tourism</span>
                  </div>
                </div>
                <div class="news-content">
                  <h4 class="news-title">
                    <a href="https://www.eduxoncabs.com/self-drive-car.php">Self Drive Car Rental in Bhubaneswar</a>
                  </h4>
                  <p class="news-excerpt">
                    The "Temple City" Bhubaneswar has many outing options and tourist attractions. With EduxonCabs, car hire can be arranged instantly with unlimited kilometers.
                  </p>
                  <div class="news-meta">
                    <span class="news-date"><i class="fa fa-calendar mr-2"></i>Latest Update</span>
                    <a href="https://www.eduxoncabs.com/self-drive-car.php" class="news-read-more">
                      Read More <i class="fa fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- News Article 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="news-card h-100">
                <div class="news-image">
                  <picture>
                    <source type="image/webp" srcset="assets/images/latest-news-03.webp">
                    <img src="assets/images/latest-news-03.jpg" class="img-fluid" alt="Best Car Rental in Bhubaneswar">
                  </picture>
                  <div class="news-category">
                    <span class="badge badge-info">Guide</span>
                  </div>
                </div>
                <div class="news-content">
                  <h4 class="news-title">
                    <a href="https://www.eduxoncabs.com/self-drive-cars-rental.php">Best Car Rental in Bhubaneswar</a>
                  </h4>
                  <p class="news-excerpt">
                    Car rental is an essential part of our lives. Choose affordable and convenient self-drive cars in Bhubaneswar from airport or railway station as per your needs.
                  </p>
                  <div class="news-meta">
                    <span class="news-date"><i class="fa fa-calendar mr-2"></i>Latest Update</span>
                    <a href="https://www.eduxoncabs.com/self-drive-cars-rental.php" class="news-read-more">
                      Read More <i class="fa fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include "includes/site-footer.php"; ?>
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

<!-- Modern JavaScript Enhancements -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add fade-in animation to feature cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
            }
        });
    }, observerOptions);

    // Observe feature cards and car cards
    document.querySelectorAll('.feature-card, .car-card').forEach(card => {
        observer.observe(card);
    });

    // Enhanced navbar scroll effect
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
        } else {
            navbar.style.background = 'rgba(255, 255, 255, 0.9)';
            navbar.style.boxShadow = 'none';
        }
        
        lastScrollTop = scrollTop;
    });

    // Loading states for buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function() {
            if (this.type === 'submit' || this.href) {
                const originalText = this.textContent;
                if (!this.disabled) {
                    this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);
                }
            }
        });
    });
});
</script>
     
        
<!-- Mobile Sticky Booking Button -->
<div class="mobile-sticky-booking d-lg-none">
  <div class="sticky-booking-content">
    <div class="d-flex align-items-center justify-content-between">
      <div class="booking-info">
        <small class="text-muted">Starting from</small>
        <div class="price-display">₹35<small>/hour</small></div>
      </div>
      <a href="#booking-form" class="btn btn-primary btn-lg px-4 py-2 smooth-scroll">
        <i class="fa fa-calendar mr-2"></i>Book Now
      </a>
    </div>
  </div>
</div>

<style>
.mobile-sticky-booking {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1050;
  background: white;
  border-top: 1px solid #e9ecef;
  box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
  padding: 15px;
}

.sticky-booking-content {
  max-width: 100%;
}

.booking-info .price-display {
  font-size: 1.2rem;
  font-weight: bold;
  color: #007bff;
}

.booking-info small {
  font-size: 0.75rem;
}

@media (max-width: 991px) {
  body {
    padding-bottom: 80px; /* Space for sticky button */
  }
}
</style>

</body>
</html>