<?php
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
$db = new SiteData();
?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>About EduxonCabs | Best Self Drive Car Rental Bhubaneswar Since 2018</title>
<meta name="keywords" content="about EduxonCabs, best self drive car rental Bhubaneswar, car rental company BBSR, reliable car rental Bhubaneswar, 24 hour car rental service, self drive cars Bhubaneswar, trusted car rental provider" />
<meta name="description" content="EduxonCabs - Leading self drive car rental Bhubaneswar since 2018. 30+ car models, 24/7 service, ₹35/hour. Trusted by 10,000+ customers for reliable car rental BBSR."/>
<meta name="author" content="Eduxoncabs.com">
<!-- Canonical URL -->
<!-- <link rel="canonical" href="https://www.eduxoncabs.com/about-us.php"> -->
<!-- Enhanced Open Graph Tags -->
<meta property="og:title" content="About EduxonCabs | Best Self Drive Car Rental Bhubaneswar Since 2018">
<meta property="og:description" content="EduxonCabs - Leading self drive car rental Bhubaneswar since 2018. 30+ car models, 24/7 service, ₹35/hour. Trusted by 10,000+ customers.">
<meta property="og:image" content="https://www.eduxoncabs.com/img/logo.png">
<meta property="og:url" content="https://www.eduxoncabs.com/about-us.php">
<meta property="og:type" content="website">
<!-- Twitter Card Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="About EduxonCabs | Best Self Drive Car Rental Bhubaneswar">
<meta name="twitter:description" content="Leading self drive car rental in Bhubaneswar since 2018. 30+ car models, 24/7 service, trusted by 10,000+ customers.">
<meta name="twitter:image" content="https://www.eduxoncabs.com/img/logo.png">
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
<link rel="stylesheet" href="assets/css/modern-about-page.css">
<link rel="stylesheet" href="assets/css/footer-center-fix.css">
<style>
body {
    /* Removed padding-top override to allow header spacing */
}
</style>
</head>
<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>
  
  <!-- Modern About Us Page -->
  <div role="main" class="main modern-about-page">
    
    <!-- Hero Section -->
    <section class="about-hero-section">
      <div class="container">
        <div class="row align-items-center min-vh-75">
          <div class="col-lg-6 col-md-12">
            <div class="about-hero-content">
              <div class="hero-badge">
                <i class="fa fa-star"></i>
                <span>Trusted Since 2018</span>
              </div>
              <h1 class="about-hero-title">
                Redefining 
                <span class="gradient-text">Self-Drive</span>
                Car Rentals
              </h1>
              <p class="about-hero-description">
                From a vision to transform India's transportation industry to becoming Bhubaneswar's most trusted self-drive car rental service - our journey is driven by innovation, reliability, and customer satisfaction.
              </p>
              <div class="hero-stats">
                <div class="stat-item">
                  <div class="stat-number">10,000+</div>
                  <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">50+</div>
                  <div class="stat-label">Pickup Locations</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">30+</div>
                  <div class="stat-label">Car Models</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="about-hero-image">
              <div class="hero-image-wrapper">
                <div class="floating-card card-1">
                  <i class="fa fa-clock-o"></i>
                  <span>24/7 Support</span>
                </div>
                <div class="floating-card card-2">
                  <i class="fa fa-shield"></i>
                  <span>100% Safe</span>
                </div>
                <div class="floating-card card-3">
                  <i class="fa fa-rupee"></i>
                  <span>₹35/Hour</span>
                </div>
                <div class="hero-car-image">
                  <div class="car-silhouette"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="mission-vision-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="mission-card">
              <div class="card-icon">
                <i class="fa fa-eye"></i>
              </div>
              <h3>Our Vision</h3>
              <p>To revolutionize India's transportation industry by providing organized, technology-driven, and customer-centric self-drive car rental solutions that set new standards for safety, reliability, and convenience.</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="mission-card">
              <div class="card-icon">
                <i class="fa fa-bullseye"></i>
              </div>
              <h3>Our Mission</h3>
              <p>To offer safe, reliable, and affordable self-drive car rental services while transforming the unorganized transportation sector into a structured, professional industry that serves every customer segment.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Story Section -->
    <section class="story-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-12">
            <div class="story-content">
              <h2 class="section-title">Our Journey</h2>
              <div class="story-timeline">
                <div class="timeline-item">
                  <div class="timeline-year">2018</div>
                  <div class="timeline-content">
                    <h4>The Beginning</h4>
                    <p>EduxonCabs was launched with a vision to provide safe and reliable <a href="https://www.eduxoncabs.com/" class="text-primary">self-drive car rental services in Bhubaneswar</a> with exceptional customer experience.</p>
                  </div>
                </div>
                <div class="timeline-item">
                  <div class="timeline-year">2020</div>
                  <div class="timeline-content">
                    <h4>Expansion</h4>
                    <p>Expanded our fleet to <a href="https://www.eduxoncabs.com/all-cars-for-self-drive-bhubaneswar.php" class="text-primary">30+ car models</a> and established 50+ pickup locations across Odisha for enhanced accessibility.</p>
                  </div>
                </div>
                <div class="timeline-item">
                  <div class="timeline-year">2023</div>
                  <div class="timeline-content">
                    <h4>Innovation</h4>
                    <p>Introduced <a href="https://www.eduxoncabs.com/contact-us.php" class="text-primary">24/7 customer support centers</a> and latest technology for seamless customer experience and instant assistance.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="story-image">
              <div class="achievement-cards">
                <div class="achievement-card">
                  <i class="fa fa-users"></i>
                  <h4>10,000+</h4>
                  <p>Satisfied Customers</p>
                </div>
                <div class="achievement-card">
                  <i class="fa fa-car"></i>
                  <h4>30+</h4>
                  <p>Car Models</p>
                </div>
                <div class="achievement-card">
                  <i class="fa fa-map-marker"></i>
                  <h4>50+</h4>
                  <p>Pickup Points</p>
                </div>
                <div class="achievement-card">
                  <i class="fa fa-clock-o"></i>
                  <h4>24/7</h4>
                  <p>Support</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="section-title">Why Choose EduxonCabs?</h2>
          <p class="section-subtitle">Experience the difference with our premium self-drive car rental services</p>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fa fa-shield"></i>
              </div>
              <h4>100% Safe & Secure</h4>
              <p>All our vehicles undergo rigorous safety checks and are fully insured for your peace of mind.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fa fa-rupee"></i>
              </div>
              <h4>Affordable Pricing</h4>
              <p>Starting at just ₹35/hour, enjoy premium car rental services without breaking the bank.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fa fa-clock-o"></i>
              </div>
              <h4>24/7 Road Assistance</h4>
              <p>Round-the-clock roadside assistance ensures you're never stranded during your journey.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fa fa-car"></i>
              </div>
              <h4>Wide Range of Cars</h4>
              <p>Choose from 30+ car models including hatchbacks, sedans, SUVs, and luxury vehicles.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fa fa-map-marker"></i>
              </div>
              <h4>50+ Pickup Locations</h4>
              <p>Convenient pickup points across Bhubaneswar and Odisha for easy accessibility.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fa fa-mobile"></i>
              </div>
              <h4>Easy Booking</h4>
              <p>Book your car in minutes through our user-friendly website or mobile app.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="cta-content">
              <h2>Ready to Experience the EduxonCabs Difference?</h2>
              <p>Join thousands of satisfied customers who trust us for their self-drive car rental needs</p>
              <div class="cta-buttons">
                <a href="all-cars-for-self-drive-bhubaneswar.php" class="btn btn-primary btn-lg">
                  <i class="fa fa-car"></i>
                  Book Now
                </a>
                <a href="contact-us.php" class="btn btn-outline-light btn-lg">
                  <i class="fa fa-phone"></i>
                  Contact Us
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  
  <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>

<script>
  // Smooth scrolling for internal links
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

  // Add scroll effect to navbar
  window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (header) {
      if (window.scrollY > 100) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    }
  });
</script>

</body>
</html>
