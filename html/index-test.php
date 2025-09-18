<?php
// Mock version for LCP testing - no database connections
session_start();

// Mock database data for testing
$mockCarData = [
    ['id' => 1, 'car_name' => 'Swift', 'per_hour' => 35, 'car_image' => 'img/swift.jpg'],
    ['id' => 2, 'car_name' => 'Verna', 'per_hour' => 45, 'car_image' => 'img/verna.jpg'],
    ['id' => 3, 'car_name' => 'Innova', 'per_hour' => 65, 'car_image' => 'img/innova.jpg'],
];

$mockBannerData = [
    ['banner_image' => 'img/banner1.jpg', 'banner_title' => 'Best Self Drive Cars'],
    ['banner_image' => 'img/banner2.jpg', 'banner_title' => 'Affordable Rates'],
];

$mockLocationData = [
    ['location_name' => 'Bhubaneswar Airport', 'id' => 1],
    ['location_name' => 'Railway Station', 'id' => 2],
    ['location_name' => 'City Center', 'id' => 3],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Preload critical resources for LCP optimization -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Google Fonts - Defer to prevent blocking LCP -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet"></noscript>

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

<!-- Canonical URL for SEO -->
<link rel="canonical" href="https://www.eduxoncabs.com/">

<!-- Enhanced Open Graph Tags -->
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="en_IN">

<!-- Twitter Card Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Self Drive Cars Bhubaneswar | Car Rental BBSR ₹35/Hour">
<meta name="twitter:description" content="Best self drive cars Bhubaneswar starting ₹35/hour. 24 hour service with unlimited km & doorstep delivery.">
<meta name="twitter:image" content="https://www.eduxoncabs.com/img/logo.png">

<!-- Additional SEO Meta Tags -->
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="theme-color" content="#007bff">

<!-- Optimized Analytics Loading for Core Web Vitals -->
<script>
// Load analytics after user interaction or page load
function loadAnalytics() {
  if (window.analyticsLoaded) return;
  window.analyticsLoaded = true;
  
  // Google Analytics
  const script = document.createElement('script');
  script.async = true;
  script.src = 'https://www.googletagmanager.com/gtag/js?id=G-R24JTT23LT';
  document.head.appendChild(script);
  
  script.onload = function() {
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-R24JTT23LT');
    gtag('config', 'G-J20L19B243');
    gtag('config', 'AW-11129753133');
    gtag('config', 'G-680DFSCXM6');
  };
}

// Load analytics on user interaction or after 3 seconds
window.addEventListener('scroll', loadAnalytics, { once: true });
window.addEventListener('click', loadAnalytics, { once: true });
window.addEventListener('touchstart', loadAnalytics, { once: true });
setTimeout(loadAnalytics, 3000);
</script>

<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<!-- Critical CSS - inline the most important styles -->
<style>
/* Critical above-the-fold styles */
body { font-family: 'Inter', Arial, sans-serif; margin: 0; padding: 0; }
.hero-section { min-height: 70vh; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; padding: 60px 20px; text-align: center; }
.hero-title { font-size: 3rem; font-weight: 800; margin-bottom: 20px; }
.hero-subtitle { font-size: 1.5rem; margin-bottom: 30px; opacity: 0.9; }
.cta-button { background: #28a745; color: white; padding: 15px 30px; font-size: 1.2rem; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; margin: 10px; }
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.cars-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 60px 0; }
.car-card { background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s; }
.car-card:hover { transform: translateY(-5px); }
.car-image { width: 100%; height: 200px; object-fit: cover; }
.car-details { padding: 20px; }
.car-name { font-size: 1.5rem; font-weight: 600; margin-bottom: 10px; }
.car-price { font-size: 1.3rem; color: #007bff; font-weight: bold; }
</style>

<!-- Structured Data -->
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
  }
}
</script>
</head>

<body>
<!-- Critical LCP Optimization - Immediate DOM prep -->
<script>
// Critical performance optimization for LCP
document.documentElement.style.visibility = 'visible';
</script>

<!-- Hero Section (LCP Element) -->
<section class="hero-section">
  <div class="container">
    <h1 class="hero-title">Best Self Drive Cars in Bhubaneswar</h1>
    <p class="hero-subtitle">Starting ₹35/Hour | 24x7 Service | Unlimited KM</p>
    <a href="#cars" class="cta-button">Book Now</a>
    <a href="tel:+919776614199" class="cta-button">Call: +91-9776614199</a>
  </div>
</section>

<!-- Cars Section -->
<section id="cars" class="container">
  <h2 style="text-align: center; font-size: 2.5rem; margin: 40px 0; color: #333;">Our Car Fleet</h2>
  <div class="cars-grid">
    <?php foreach($mockCarData as $car): ?>
    <div class="car-card">
      <img src="<?php echo $car['car_image']; ?>" alt="<?php echo $car['car_name']; ?>" class="car-image" loading="lazy">
      <div class="car-details">
        <h3 class="car-name"><?php echo $car['car_name']; ?></h3>
        <p class="car-price">₹<?php echo $car['per_hour']; ?>/Hour</p>
        <button class="cta-button" style="width: 100%; margin: 0;">Book Now</button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Features Section -->
<section style="background: #f8f9fa; padding: 60px 0;">
  <div class="container">
    <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 40px;">Why Choose EduxonCabs?</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
      <div style="text-align: center; padding: 20px;">
        <h3>🚗 Doorstep Delivery</h3>
        <p>We deliver the car to your location</p>
      </div>
      <div style="text-align: center; padding: 20px;">
        <h3>⏰ 24/7 Service</h3>
        <p>Round the clock customer support</p>
      </div>
      <div style="text-align: center; padding: 20px;">
        <h3>💰 Best Prices</h3>
        <p>Starting from just ₹35/hour</p>
      </div>
      <div style="text-align: center; padding: 20px;">
        <h3>📍 Airport Pickup</h3>
        <p>Direct pickup from Bhubaneswar Airport</p>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section style="background: #007bff; color: white; padding: 60px 0; text-align: center;">
  <div class="container">
    <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Ready to Book?</h2>
    <p style="font-size: 1.2rem; margin-bottom: 30px;">Call us now or book online for instant confirmation</p>
    <a href="tel:+919776614199" class="cta-button" style="background: #28a745; font-size: 1.3rem;">📞 Call: +91-9776614199</a>
  </div>
</section>

<!-- Deferred Scripts -->
<script>
// Performance monitoring
if ('web-vital' in window) {
  import('https://unpkg.com/web-vitals').then(({getCLS, getFID, getFCP, getLCP, getTTFB}) => {
    getCLS(console.log);
    getFID(console.log);
    getFCP(console.log);
    getLCP(console.log);
    getTTFB(console.log);
  });
}
</script>

</body>
</html>
