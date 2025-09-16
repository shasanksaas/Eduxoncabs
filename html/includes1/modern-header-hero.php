<!-- Modern SaaS-style Header -->
<style>
  /* Ensure header always stays on top */
  .modern-header .navbar {
    position: fixed !important;
    top: 0 !important;
    width: 100% !important;
    z-index: 9999 !important;
    background-color: white !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
  }
  
  /* Add body padding to prevent content from going under header */
  body {
    padding-top: 70px !important;
  }
  
  @media (max-width: 767px) {
    .mobile-centered-btn {
      text-align: center !important;
      display: block !important;
      width: 100% !important;
      margin-bottom: 10px !important;
    }
    
    /* Smaller padding for mobile */
    body {
      padding-top: 56px !important;
    }
  }
</style>
<header class="modern-header">
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm"
    
      <!-- Brand Logo -->
      <a class="navbar-brand me-auto" href="/">
        <img src="img/Eduxoncabs.png" alt="EduxonCabs - Self Drive Car Rental Bhubaneswar" class="d-inline-block align-top" fetchpriority="high" loading="eager">
      </a>
      
      <!-- Mobile Toggle Button -->
      <button class="navbar-toggler header-btn-collapse-nav ms-auto" type="button" data-toggle="collapse" data-target="#modernNavbar" aria-controls="modernNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>
      
      <!-- Navigation Menu -->
      <div class="collapse navbar-collapse justify-content-center" id="modernNavbar">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="about-us.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="all-cars-for-self-drive-bhubaneswar.php">All Cars</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="all-bikes-bike-for-rental-bhubaneswar.php">All Bikes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="contact-us.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="faq.php">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="profile.php">User Profile</a>
          </li>
        </ul>
        
        <!-- Pay Now Button -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="https://razorpay.me/@eduxoncars" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill font-weight-600">
              Pay Now
            </a>
          </li>
        </ul>
      </div>
      </div>
    
  </nav>
</header>

<!-- Modern Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center min-vh-100">
      
      <!-- Hero Content - Shows First on Desktop -->
      <div class="col-lg-6 col-md-12 order-2 order-lg-1">
        <div class="hero-content">
          <div class="hero-badge mb-4">
            <span class="badge-modern">
              <i class="fa fa-star mr-2"></i>Premium Car Rental Service
            </span>
          </div>
          
          <h1 class="hero-title mb-4">
            Self Drive Car
            <span class="highlight-text" style="margin-bottom: -20px; ">Rental</span>
            <br style="margin-top: -5px; line-height: 0.8;">in Bhubaneswar
          </h1>
          
          <p class="hero-subtitle mb-4">
            Experience the freedom of self-drive car rentals with our premium fleet. 
            Clean, verified vehicles with 24/7 support for your comfortable journey.
          </p>
          
          <div class="hero-features mb-4">
            <div class="feature-item-modern">
              <i class="fa fa-check-circle"></i>
              <span>Best Car Rental in Bhubaneswar</span>
            </div>
            <div class="feature-item-modern">
              <i class="fa fa-check-circle"></i>
              <span>Starting @ Rs. 35/hour with Unlimited Kilometers</span>
            </div>
            <div class="feature-item-modern">
              <i class="fa fa-check-circle"></i>
              <span>24x7 Emergency Assistance</span>
            </div>
          </div>
          
          <div class="hero-cta">
            <a href="all-cars-for-self-drive-bhubaneswar.php" class="btn-modern-primary mobile-centered-btn">
              Book Your Car Now
            </a>
            <a href="all-cars-for-self-drive-bhubaneswar.php" class="btn-modern-outline mobile-centered-btn">
              View All Cars
            </a>
          </div>
        </div>
      </div>
      
      <!-- Booking Form - Shows First on Mobile -->
      <div class="col-lg-6 col-md-12 order-1 order-lg-2 mb-5 mb-lg-0">
        <div class="booking-card-modern" id="booking-form">          
          <div class="booking-form-container">
            <h3 class="booking-title">Book Your Perfect Car</h3>
            <p class="booking-subtitle">Choose from our premium fleet</p>
            
            <form method="get" action="all-cars-for-self-drive-bhubaneswar.php" class="modern-booking-form">
              
              <!-- Location & Date Selection -->
              <div class="form-group-modern mb-4">
                <label class="form-label-modern">
                  <i class="fa fa-map-marker mr-2"></i>Pickup Location
                </label>
                <div class="input-group-modern">
                  <select class="form-control-modern" name="pickuploc" id="pickuploc" required style="color: #000000 !important; background-color: #ffffff !important;">
                    <option value="" style="color: #666666 !important;">Choose pickup location</option>
                    <?php
                    // Get location data for Bhubaneswar (city_id = 1)
                    if (isset($dbObj)) {
                        $get_pickup_locations = $dbObj->fetch_data("location", "city_id = '1'");
                        foreach ($get_pickup_locations as $location) {
                            echo '<option value="' . $location['id'] . '" style="color: #000000 !important; background-color: #ffffff !important;">' . $location['pickup_point'] . '</option>';
                        }
                    }
                    ?>
                  </select>
                  <i class="fa fa-chevron-down dropdown-icon"></i>
                </div>
              </div>
              
              <div class="form-group-modern mb-4">
                <label class="form-label-modern">
                  <i class="fa fa-map-marker mr-2"></i>Drop Location
                </label>
                <div class="input-group-modern">
                  <select class="form-control-modern" name="droploc" id="droploc" required style="color: #000000 !important; background-color: #ffffff !important;">
                    <option value="" style="color: #666666 !important;">Choose drop location</option>
                    <?php
                    // Use the same location data for drop-off points
                    if (isset($dbObj) && isset($get_pickup_locations)) {
                        foreach ($get_pickup_locations as $location) {
                            echo '<option value="' . $location['id'] . '" style="color: #000000 !important; background-color: #ffffff !important;">' . $location['drop_point'] . '</option>';
                        }
                    }
                    ?>
                  </select>
                  <i class="fa fa-chevron-down dropdown-icon"></i>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group-modern mb-4">
                    <label class="form-label-modern">
                      <i class="fa fa-calendar mr-2"></i>Pickup Date
                    </label>
                    <input type="text" class="form-control-modern" name="pdate" id="pdate" 
                           placeholder="Select date" required autocomplete="off">
                  </div>
                </div>
                
                <div class="col-sm-6">
                  <div class="form-group-modern mb-4">
                    <label class="form-label-modern">
                      <i class="fa fa-clock-o mr-2"></i>Pickup Time
                    </label>
                    <select class="form-control-modern" name="ptime" id="ptime" required>
                      <option value="">Select time</option>
                      <?php
                      for ($i = 6; $i < 24; $i++) {
                          $num = $i > 23 ? $i - 24 : $i;
                          $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                          echo "<option value=\"$num:00\"> $num:00 $ampm</option>\n";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group-modern mb-4">
                    <label class="form-label-modern">
                      <i class="fa fa-calendar mr-2"></i>Drop Date
                    </label>
                    <input type="text" class="form-control-modern" name="ddate" id="ddate" 
                           placeholder="Select date" required autocomplete="off">
                  </div>
                </div>
                
                <div class="col-sm-6">
                  <div class="form-group-modern mb-4">
                    <label class="form-label-modern">
                      <i class="fa fa-clock-o mr-2"></i>Drop Time
                    </label>
                    <select class="form-control-modern" name="dtime" id="dtime" required>
                      <option value="">Select time</option>
                      <?php
                      for ($i = 6; $i < 24; $i++) {
                          $num = $i > 23 ? $i - 24 : $i;
                          $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                          echo "<option value=\"$num:00\"> $num:00 $ampm</option>\n";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              
              <!-- Search Button -->
              <button type="submit" class="btn-search-modern">
                <i class="fa fa-search mr-2"></i>Search 
              </button>
              
            </form>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</section>

<script>
// Ensure header never gets hidden
document.addEventListener('DOMContentLoaded', function() {
  const header = document.querySelector('.modern-header .navbar');
  if (header) {
    // Force fixed positioning and visibility
    header.style.position = 'fixed';
    header.style.top = '0';
    header.style.width = '100%';
    header.style.zIndex = '9999';
    header.style.display = 'block';
    header.style.visibility = 'visible';
    
    // Monitor for any attempts to hide the header
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.type === 'attributes') {
          if (header.style.display === 'none' || 
              header.style.visibility === 'hidden' || 
              header.style.top !== '0px' ||
              header.style.position !== 'fixed') {
            header.style.position = 'fixed';
            header.style.top = '0';
            header.style.display = 'block';
            header.style.visibility = 'visible';
            header.style.zIndex = '9999';
          }
        }
      });
    });
    
    observer.observe(header, {
      attributes: true,
      attributeFilter: ['style', 'class']
    });
  }
});
</script>
