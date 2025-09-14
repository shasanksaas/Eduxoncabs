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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Contact EduxonCabs | Self Drive Car Rental Bhubaneswar | 24 Hour Support</title>
<meta name="keywords" content="contact EduxonCabs, self drive car rental Bhubaneswar contact, car rental BBSR phone number, 24 hour car rental support, book self drive car online Bhubaneswar, EduxonCabs customer care, self drive cars Bhubaneswar booking" />
<meta name="description" content="Contact EduxonCabs for self drive car rental Bhubaneswar. 24 hour support ☎ +91-9078212872. Book online or visit our office. Instant booking, doorstep delivery available."/>
<meta name="author" content="Eduxoncabs.com">
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
<link rel="stylesheet" href="assets/css/modern-contact-page.css">
</head>
<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>
  
  <!-- Modern Contact Page -->
  <div role="main" class="main modern-contact-page">
    
    <!-- Hero Section -->
    <section class="contact-hero-section">
      <div class="container">
        <div class="contact-hero-content">
          <div class="hero-badge">
            <i class="fa fa-phone"></i>
            <span>24/7 Support Available</span>
          </div>
          <h1 class="contact-hero-title">
            Get In <span class="gradient-text">Touch</span> With Us
          </h1>
          <p class="contact-hero-description">
            Ready to book your perfect self-drive car or need assistance? Our dedicated team is here to help you 24/7. Reach out to us through any of the channels below.
          </p>
        </div>
      </div>
    </section>

    <!-- Quick Contact Buttons -->
    <section class="quick-contact-section">
      <div class="container">
        <h2 class="quick-contact-title">Need Immediate Assistance?</h2>
        <p class="quick-contact-subtitle">Contact us directly through your preferred method</p>
        <div class="quick-contact-buttons">
          <a href="tel:+919437144274" class="quick-contact-btn btn-call">
            <i class="fa fa-phone"></i>
            Call Now
          </a>
          <a href="https://wa.me/919437144274" class="quick-contact-btn btn-whatsapp" target="_blank">
            <i class="fa fa-whatsapp"></i>
            WhatsApp
          </a>
          <a href="mailto:eduxontechnologies@gmail.com" class="quick-contact-btn btn-email">
            <i class="fa fa-envelope"></i>
            Email Us
          </a>
        </div>
      </div>
    </section>

    <!-- Main Contact Section -->
    <section class="contact-main-section">
      <div class="container">
        <div class="row">
          <!-- Contact Form -->
          <div class="col-lg-6 col-md-12">
            <div class="contact-form-card">
              <h3 class="contact-form-title">Send Us a Message</h3>
              
              <div class="modern-alert success hidden" id="contactSuccess">
                <strong>Success!</strong> Your message has been sent to us.
              </div>
              <div class="modern-alert error hidden" id="contactError">
                <strong>Error!</strong> There was an error sending your message.
                <span class="display-block mt-sm" id="mailErrorMessage"></span>
              </div>

              <form id="contactForm" action="php/contact-form.php" method="POST">
                <div class="row">
                  <div class="col-md-6">
                    <div class="modern-form-group">
                      <label for="name">Your Name *</label>
                      <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="modern-form-control" name="name" id="name" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="modern-form-group">
                      <label for="email">Email Address *</label>
                      <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="modern-form-control" name="email" id="email" required>
                    </div>
                  </div>
                </div>
                
                <div class="modern-form-group">
                  <label for="subject">Subject</label>
                  <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="modern-form-control" name="subject" id="subject" required>
                </div>
                
                <div class="modern-form-group">
                  <label for="message">Message *</label>
                  <textarea maxlength="5000" data-msg-required="Please enter your message." rows="6" class="modern-form-control textarea" name="message" id="message" required placeholder="Tell us how we can help you..."></textarea>
                </div>
                
                <button type="submit" class="modern-submit-btn" data-loading-text="Sending...">
                  <i class="fa fa-paper-plane"></i>
                  Send Message
                </button>
              </form>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="col-lg-6 col-md-12">
            <div class="contact-info-card">
              <h3 class="contact-info-title">Contact Information</h3>
              
              <ul class="contact-info-list">
                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <div class="contact-info-content">
                    <div class="contact-info-label">Airport Office</div>
                    <p class="contact-info-text">Parking Lot, Bharati Tower, Opposite SBI Bank, Forest Park, Aerodrome Area, Bhubaneswar, 751020, Odisha</p>
                  </div>
                </li>

                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <div class="contact-info-content">
                    <div class="contact-info-label">Support & Bookings</div>
                    <p class="contact-info-text">
                      <a href="tel:+919437144274">+91-9437144274</a><br>
                      <a href="tel:+919437144274">+91-9437144274</a>
                    </p>
                  </div>
                </li>

                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="fa fa-wrench"></i>
                  </div>
                  <div class="contact-info-content">
                    <div class="contact-info-label">Road-Side Assistance</div>
                    <p class="contact-info-text">
                      <a href="tel:+919439825591">+91-9439825591</a><br>
                      <a href="tel:+917873001464">+91-7873001464</a>
                    </p>
                  </div>
                </li>

                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="fa fa-car"></i>
                  </div>
                  <div class="contact-info-content">
                    <div class="contact-info-label">Vehicle PickUp/Drop</div>
                    <p class="contact-info-text">
                      <a href="tel:+919439825591">+91-9439825591</a><br>
                      <a href="tel:+917873001464">+91-7873001464</a>
                    </p>
                  </div>
                </li>

                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <div class="contact-info-content">
                    <div class="contact-info-label">Email Support</div>
                    <p class="contact-info-text">
                      <a href="mailto:eduxontechnologies@gmail.com">eduxontechnologies@gmail.com</a>
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
      <div class="container">
        <h2 class="map-title">Find Us on Map</h2>
        <div class="row">
          <div class="col-12">
            <div id="map" class="map-container"></div>
          </div>
        </div>
      </div>
    </section>

  </div>
  
  <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrCgJHlxTCi1hlc-QUwhouh7ssmntvh4g" type="text/javascript"></script>
<script type="text/javascript">
  // Initialize map
  var locations = [
    ['Parking Lot,Bharati Tower,Forest Park,Aerodrome Area,Bhubaneswar,751020,Odisha', 20.2559583, 85.8244547, 4],
    ['Iter Collage road,Ketuka Complex,Jagamara Square,Bhubaneswar,Odisha', 20.256961, 85.798743, 5]
  ];

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: new google.maps.LatLng(20.2559583, 85.8244547),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    styles: [
      {
        "featureType": "all",
        "elementType": "geometry.fill",
        "stylers": [{"weight": "2.00"}]
      },
      {
        "featureType": "all",
        "elementType": "geometry.stroke",
        "stylers": [{"color": "#9c9c9c"}]
      },
      {
        "featureType": "all",
        "elementType": "labels.text",
        "stylers": [{"visibility": "on"}]
      }
    ]
  });

  var infowindow = new google.maps.InfoWindow();
  var marker, i;

  for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map,
      icon: {
        url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 30 40"><path fill="#2563eb" d="M15 0C6.716 0 0 6.716 0 15c0 8.284 15 25 15 25s15-16.716 15-25C30 6.716 23.284 0 15 0zm0 20c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5z"/></svg>'),
        scaledSize: new google.maps.Size(30, 40)
      }
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent('<div style="padding:10px;"><strong>' + locations[i][0] + '</strong></div>');
        infowindow.open(map, marker);
      }
    })(marker, i));
  }

  // Form handling
  document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var submitBtn = this.querySelector('.modern-submit-btn');
    var originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sending...';
    submitBtn.disabled = true;
    
    // Hide previous alerts
    document.getElementById('contactSuccess').classList.add('hidden');
    document.getElementById('contactError').classList.add('hidden');
    
    // Simulate form submission (replace with actual form handling)
    setTimeout(function() {
      // Show success message
      document.getElementById('contactSuccess').classList.remove('hidden');
      
      // Reset form
      document.getElementById('contactForm').reset();
      
      // Reset button
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;
    }, 2000);
  });

  // Smooth scrolling for anchor links
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
</script>

</body>
</html>
