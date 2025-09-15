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
<!-- Modern FAQ Section CSS -->
<link href="assets/css/modern-faq-section.css" rel="stylesheet">
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
  <!-- Modern SaaS FAQ Section -->
  <section id="modern-faq-section" class="section-padding">
    <div class="container">
      <!-- FAQ Header -->
      <div class="text-center mb-5">
        <div class="faq-badge">
          <span class="badge-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.1 3.89 23 5 23H19C20.1 23 21 22.1 21 21V9M19 9H14V4H5V21H19V9Z" fill="currentColor"/>
            </svg>
          </span>
          Support Center
        </div>
        <h2 class="faq-title">Frequently Asked <span class="gradient-text">Questions</span></h2>
        <p class="faq-subtitle">Find answers to common questions about our self-drive car rental services in Bhubaneswar</p>
      </div>

      <!-- FAQ Grid -->
      <div class="faq-grid">
        <div class="row">
          <div class="col-lg-6 mb-4">
            <div class="faq-card" data-aos="fade-up" data-aos-delay="100">
              <div class="faq-header" onclick="toggleFAQ(this)">
                <div class="faq-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" fill="currentColor"/>
                  </svg>
                </div>
                <h3 class="faq-question">What documents are required to rent a car?</h3>
                <div class="faq-toggle">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" fill="currentColor"/>
                  </svg>
                </div>
              </div>
              <div class="faq-content">
                <div class="faq-answer">
                  <ul class="faq-list">
                    <li><strong>Valid Driving License</strong> and additional ID proof (Aadhaar Card, Voter ID, PAN Card, or any government-issued ID)</li>
                    <li><strong>For Students/Local IDs:</strong> Job/College/Institution ID Card required for address proof</li>
                    <li><strong>Pre-verification:</strong> Email your documents to eduxonassociates@gmail.com</li>
                    <li><strong>Important:</strong> Without valid documents, booking will be cancelled with Rs.500/- deduction</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="faq-card" data-aos="fade-up" data-aos-delay="200">
              <div class="faq-header" onclick="toggleFAQ(this)">
                <div class="faq-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" fill="currentColor"/>
                  </svg>
                </div>
                <h3 class="faq-question">What is the minimum age requirement?</h3>
                <div class="faq-toggle">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" fill="currentColor"/>
                  </svg>
                </div>
              </div>
              <div class="faq-content">
                <div class="faq-answer">
                  <p class="highlight-answer">You must be <strong>minimum 21 years old</strong> to rent our vehicles. This applies to all standard vehicles in our fleet.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="faq-card" data-aos="fade-up" data-aos-delay="300">
              <div class="faq-header" onclick="toggleFAQ(this)">
                <div class="faq-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M3.05,13H1V11H3.05C3.5,6.83 6.83,3.5 11,3.05V1H13V3.05C17.17,3.5 20.5,6.83 20.95,11H23V13H20.95C20.5,17.17 17.17,20.5 13,20.95V23H11V20.95C6.83,20.5 3.5,17.17 3.05,13M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18Z" fill="currentColor"/>
                  </svg>
                </div>
                <h3 class="faq-question">What are the speeding charges?</h3>
                <div class="faq-toggle">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" fill="currentColor"/>
                  </svg>
                </div>
              </div>
              <div class="faq-content">
                <div class="faq-answer">
                  <div class="penalty-info">
                    <div class="penalty-item">
                      <span class="penalty-label">First Instance:</span>
                      <span class="penalty-amount">Rs. 200/-</span>
                    </div>
                    <div class="penalty-item">
                      <span class="penalty-label">Subsequent Violations:</span>
                      <span class="penalty-amount">Rs. 500/- each</span>
                    </div>
                    <p class="penalty-note">Speed limit: 80km/hour maximum</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="faq-card" data-aos="fade-up" data-aos-delay="400">
              <div class="faq-header" onclick="toggleFAQ(this)">
                <div class="faq-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M3.05,13H1V11H3.05C3.5,6.83 6.83,3.5 11,3.05V1H13V3.05C17.17,3.5 20.5,6.83 20.95,11H23V13H20.95C20.5,17.17 17.17,20.5 13,20.95V23H11V20.95C6.83,20.5 3.5,17.17 3.05,13M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18Z" fill="currentColor"/>
                  </svg>
                </div>
                <h3 class="faq-question">Are there kilometer limitations?</h3>
                <div class="faq-toggle">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" fill="currentColor"/>
                  </svg>
                </div>
              </div>
              <div class="faq-content">
                <div class="faq-answer">
                  <div class="km-limitations">
                    <div class="km-category">
                      <h4>Standard Vehicles</h4>
                      <p class="unlimited">✅ Unlimited Kilometers</p>
                    </div>
                    <div class="km-category">
                      <h4>Premium Vehicles (BMW, Mercedes, Audi)</h4>
                      <p>📍 180 KM per 24 hours</p>
                      <p class="extra-charge">Extra: Rs. 30/km beyond limit</p>
                    </div>
                    <p class="interstate-note">💡 Inform in advance for interstate travel</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="faq-card" data-aos="fade-up" data-aos-delay="500">
              <div class="faq-header" onclick="toggleFAQ(this)">
                <div class="faq-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" fill="currentColor"/>
                  </svg>
                </div>
                <h3 class="faq-question">What are the late return charges?</h3>
                <div class="faq-toggle">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" fill="currentColor"/>
                  </svg>
                </div>
              </div>
              <div class="faq-content">
                <div class="faq-answer">
                  <div class="late-charges">
                    <div class="warning-box">
                      <strong>⚠️ Late Return Penalty</strong>
                      <p>Without 6-hour advance notice:</p>
                    </div>
                    <div class="charge-breakdown">
                      <div class="charge-item">
                        <span>Late Fee:</span>
                        <span class="amount">Rs. 500/-</span>
                      </div>
                      <div class="charge-item">
                        <span>Per Hour Charge:</span>
                        <span class="amount">Rs. 200/hour</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="faq-card" data-aos="fade-up" data-aos-delay="600">
              <div class="faq-header" onclick="toggleFAQ(this)">
                <div class="faq-icon">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,3L2,12H5V20H19V12H22L12,3M12,8.75A2.25,2.25 0 0,1 14.25,11A2.25,2.25 0 0,1 12,13.25A2.25,2.25 0 0,1 9.75,11A2.25,2.25 0 0,1 12,8.75Z" fill="currentColor"/>
                  </svg>
                </div>
                <h3 class="faq-question">Do you provide home delivery?</h3>
                <div class="faq-toggle">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" fill="currentColor"/>
                  </svg>
                </div>
              </div>
              <div class="faq-content">
                <div class="faq-answer">
                  <div class="delivery-options">
                    <div class="delivery-item free">
                      <span class="delivery-icon">✈️</span>
                      <div class="delivery-info">
                        <h4>Airport Delivery</h4>
                        <p class="free-label">FREE (Only toll charges apply)</p>
                      </div>
                    </div>
                    <div class="delivery-item paid">
                      <span class="delivery-icon">🏠</span>
                      <div class="delivery-info">
                        <h4>Home Delivery</h4>
                        <p>Rs. 400/- (Pick-up & Drop within 20km radius)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Support -->
      <div class="faq-support-section">
        <div class="support-card">
          <div class="support-content">
            <h3>Still have questions?</h3>
            <p>Our support team is here to help you 24/7</p>
          </div>
          <div class="support-actions">
            <a href="contact-us.php" class="support-btn primary">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z" fill="currentColor"/>
              </svg>
              Contact Support
            </a>
            <a href="mailto:eduxonassociates@gmail.com" class="support-btn secondary">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" fill="currentColor"/>
              </svg>
              Email Us
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
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

// Modern FAQ Toggle Functionality
function toggleFAQ(element) {
    const faqCard = element.closest('.faq-card');
    const faqContent = faqCard.querySelector('.faq-content');
    const toggle = faqCard.querySelector('.faq-toggle');
    
    // Close all other FAQ cards
    document.querySelectorAll('.faq-card').forEach(card => {
        if (card !== faqCard && card.classList.contains('active')) {
            card.classList.remove('active');
            const otherContent = card.querySelector('.faq-content');
            const otherToggle = card.querySelector('.faq-toggle');
            otherContent.style.maxHeight = '0';
            otherToggle.style.transform = 'rotate(0deg)';
        }
    });
    
    // Toggle current FAQ card
    faqCard.classList.toggle('active');
    
    if (faqCard.classList.contains('active')) {
        faqContent.style.maxHeight = faqContent.scrollHeight + 'px';
        toggle.style.transform = 'rotate(180deg)';
        
        // Add a small delay to ensure smooth animation
        setTimeout(() => {
            faqContent.style.maxHeight = 'none';
        }, 300);
    } else {
        faqContent.style.maxHeight = faqContent.scrollHeight + 'px';
        toggle.style.transform = 'rotate(0deg)';
        
        // Force reflow and then set to 0
        setTimeout(() => {
            faqContent.style.maxHeight = '0';
        }, 10);
    }
}

// Initialize AOS (Animate On Scroll) if available
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Animation on scroll
    const faqCards = document.querySelectorAll('.faq-card');
    const faqObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    faqCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        faqObserver.observe(card);
    });

    // Support section animation
    const supportSection = document.querySelector('.faq-support-section');
    if (supportSection) {
        const supportObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const supportCard = entry.target.querySelector('.support-card');
                    supportCard.style.opacity = '1';
                    supportCard.style.transform = 'translateY(0) scale(1)';
                }
            });
        }, { threshold: 0.3 });

        const supportCard = supportSection.querySelector('.support-card');
        if (supportCard) {
            supportCard.style.opacity = '0';
            supportCard.style.transform = 'translateY(50px) scale(0.95)';
            supportCard.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        supportObserver.observe(supportSection);
    }
});
</script>
     
        


</body>
</html>