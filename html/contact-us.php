
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
<title>Contact Us | Eduxon Cars</title>
<meta name="keywords" content="Eduxoncabs.com" />
<meta name="description" content="Contact Eduxon Cabs for reliable self-drive car rentals in Bhubaneswar. Call us at +91-9078212872 or email at eduxontechnologies@gmail.com for bookings and support."/>
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
   
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-success hidden mt-lg" id="contactSuccess"> <strong>Success!</strong> Your message has been sent to us. </div>
          <div class="alert alert-danger hidden mt-lg" id="contactError"> <strong>Error!</strong> There was an error sending your message. <span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span> </div>
          <h1 class="mb-sm mt-sm"><strong>Contact</strong> Us</h1>
          <form id="contactForm" action="php/contact-form.php" method="POST">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label>Your name *</label>
                  <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                </div>
                <div class="col-md-6">
                  <label>Your email address *</label>
                  <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-12">
                  <label>Subject</label>
                  <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-12">
                  <label>Message *</label>
                  <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message" required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="submit" value="Send Message" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          
          <h4 class="heading-primary"><strong>Contact Us</strong></h4>
          <ul class="list list-icons list-icons-style-3 mt-xlg">
            <li><i class="fa fa-map-marker"></i> <strong>Airport Address:</strong> Parking Lot,Bharati Tower,Opposite of SBI Bank,Forest Park,Aerodrome Area,Bhubaneswar,751020,Odisha</li>
              <li><i class="fa fa-phone"></i> <strong>Support/Queries/Bookings:</strong>+91-9437144274,+91-9437144274</li>
              <li><i class="fa fa-phone"></i> <strong>Road-Side Assistance:</strong>+91-9439825591,+91-7873001464</li>
              <li><i class="fa fa-phone"></i> <strong>Vehicle PickUp/Drop :</strong>+91-9439825591,+91-7873001464
            <li><i class="fa fa-envelope"></i> <strong>Email:</strong> eduxontechnologies@gmail.com</li>
          </ul>
         
        </div>
      </div>
    </div>
    
    
    <div class="container">
      <div class="row">
      <div class="col-md-12">
      <div id="map" class="map-container"></div>
      </div>
      </div>
      </div>
    
  </div>
  
   <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrCgJHlxTCi1hlc-QUwhouh7ssmntvh4g"  type="text/javascript"></script>
<script type="text/javascript">
    var locations = [
      ['Parking Lot,Bharati Tower,Forest Park,Aerodrome Area,Bhubaneswar,751020,Odisha', 20.2559583, 85.8244547, 4],
      ['Iter Collage road,Ketuka Complex,Jagamara Square,Bhubaneswar,Odisha', 20.256961, 85.798743, 5]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: new google.maps.LatLng(20.2559583, 85.8244547),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
  <style>
  .map-container {
  width: 100%;
  height: 400px;
  }
  </style>
</body>
</html>