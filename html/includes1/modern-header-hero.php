<!-- Modern SaaS-style Header -->
<header class="modern-header">
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid px-4">
      <!-- Brand Logo -->
      <a class="navbar-brand" href="/">
        <img src="img/Eduxoncabs.png" alt="EduxonCabs - Self Drive Car Rental Bhubaneswar" height="45" class="d-inline-block align-top">
      </a>
      
      <!-- Mobile Toggle -->
      <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#modernNavbar" aria-controls="modernNavbar" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle font-weight-600 px-3" href="#" id="carsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              All Cars
            </a>
            <div class="dropdown-menu border-0 shadow" aria-labelledby="carsDropdown">
              <a class="dropdown-item" href="all-cars-for-self-drive-bhubaneswar.php">All Cars</a>
              <a class="dropdown-item" href="automatic.php">Automatic Cars</a>
              <a class="dropdown-item" href="self-drive-cars-rental.php">Rental Cars</a>
            </div>
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
  <div class="hero-bg">
    <div class="container">
      <div class="row align-items-center min-vh-100">
        
        <!-- Hero Content -->
        <div class="col-lg-6 col-md-12 hero-content">
          <div class="hero-text">
            <span class="badge badge-primary-light mb-3 px-3 py-2">
              <i class="fa fa-star text-warning mr-1"></i>
              30+ Car Types & Brands Available
            </span>
            
            <h1 class="hero-title mb-4">
              Self Drive Cars 
              <span class="text-primary">Bhubaneswar</span>
              <br>Starting at <span class="price-highlight">₹35/Hour</span>
            </h1>
            
            <p class="hero-subtitle mb-4">
              Premium self drive car rental in Bhubaneswar with 24-hour service. 
              Choose from sedan, SUV, luxury cars with unlimited km, doorstep delivery, 
              and airport pickup/drop. Perfect for temple tours and outstation travel.
            </p>
            
            <div class="hero-features mb-4">
              <div class="feature-item">
                <i class="fa fa-check-circle text-success mr-2"></i>
                <span>24/7 Support</span>
              </div>
              <div class="feature-item">
                <i class="fa fa-check-circle text-success mr-2"></i>
                <span>Unlimited KM</span>
              </div>
              <div class="feature-item">
                <i class="fa fa-check-circle text-success mr-2"></i>
                <span>Airport Pickup</span>
              </div>
            </div>
            
            <div class="hero-cta">
              <a href="#booking-form" class="btn btn-primary btn-lg px-5 py-3 mr-3 smooth-scroll">
                <i class="fa fa-car mr-2"></i>Book Now
              </a>
              <a href="all-cars-for-self-drive-bhubaneswar.php" class="btn btn-outline-primary btn-lg px-5 py-3">
                View All Cars
              </a>
            </div>
            
            <div class="hero-stats mt-5">
              <div class="row">
                <div class="col-4">
                  <div class="stat-item">
                    <h3 class="stat-number">10K+</h3>
                    <p class="stat-label">Happy Customers</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="stat-item">
                    <h3 class="stat-number">30+</h3>
                    <p class="stat-label">Car Models</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="stat-item">
                    <h3 class="stat-number">24/7</h3>
                    <p class="stat-label">Support</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Booking Form -->
        <div class="col-lg-6 col-md-12">
          <div class="booking-card" id="booking-form">
            <div class="card border-0 shadow-lg">
              <div class="card-header bg-primary text-white text-center py-4">
                <h4 class="mb-0 font-weight-bold">
                  <i class="fa fa-calendar-check mr-2"></i>Book Your Car Now
                </h4>
                <p class="mb-0 mt-2 opacity-90">Quick & Easy Booking</p>
              </div>
              
              <div class="card-body p-4">
                <form method="get" action="all-cars-for-self-drive-bhubaneswar.php" class="booking-form">
                  
                  <!-- Location Selection -->
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label font-weight-600">
                        <i class="fa fa-map-marker text-primary mr-2"></i>Pickup Location
                      </label>
                      <select class="form-control form-control-lg" name="pickuploc" id="pickuploc" required>
                        <option value="">Select pickup location</option>
                        <?php 
                        $get_location_data = $dbObj->fetch_data("location", "city_id = '1'");
                        foreach ($get_location_data as $data) {
                            $pick_Point = $data['pick_point'];
                        ?>
                        <option value="<?=$data['id'];?>"><?=$pick_Point;?></option>
                        <?php } ?>
                      </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                      <label class="form-label font-weight-600">
                        <i class="fa fa-map-marker text-danger mr-2"></i>Drop Location
                      </label>
                      <select class="form-control form-control-lg" name="droploc" id="droploc" required>
                        <option value="">Select drop location</option>
                        <?php 
                        $get_location_data1 = $dbObj->fetch_data("location", "city_id = '1'");
                        foreach ($get_location_data1 as $data1) {
                            $drp_Point = $data1['drop_point'];
                        ?>
                        <option value="<?=$data1['id'];?>"><?=$drp_Point;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <!-- Date & Time Selection -->
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label font-weight-600">
                        <i class="fa fa-calendar text-success mr-2"></i>Pickup Date
                      </label>
                      <input type="text" class="form-control form-control-lg" name="pdate" id="pdate" 
                             placeholder="Select date" required autocomplete="off"
                             onChange="return calculateTime($('#dtime').val(),this.value,$('#ptime').val(),$('#ddate').val());">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                      <label class="form-label font-weight-600">
                        <i class="fa fa-clock-o text-info mr-2"></i>Pickup Time
                      </label>
                      <select class="form-control form-control-lg" name="ptime" id="ptime" required
                              onChange="return calculateTime($('#dtime').val(),$('#pdate').val(),this.value,$('#ddate').val());">
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
                  
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label font-weight-600">
                        <i class="fa fa-calendar text-warning mr-2"></i>Drop Date
                      </label>
                      <input type="text" class="form-control form-control-lg" name="ddate" id="ddate" 
                             placeholder="Select date" required autocomplete="off"
                             onChange="return calculateTime($('#dtime').val(),$('#pdate').val(),$('#ptime').val(),this.value);">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                      <label class="form-label font-weight-600">
                        <i class="fa fa-clock-o text-secondary mr-2"></i>Drop Time
                      </label>
                      <select class="form-control form-control-lg" name="dtime" id="dtime" required
                              onChange="return calculateTime(this.value,$('#pdate').val(),$('#ptime').val(),$('#ddate').val());">
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
                  
                  <!-- Search Button -->
                  <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block py-3 font-weight-bold">
                      <i class="fa fa-search mr-2"></i>Search Available Cars
                    </button>
                  </div>
                  
                  <!-- Additional Info -->
                  <div class="booking-info mt-3">
                    <div class="row text-center">
                      <div class="col-4">
                        <small class="text-muted">
                          <i class="fa fa-shield text-success"></i><br>
                          Verified Cars
                        </small>
                      </div>
                      <div class="col-4">
                        <small class="text-muted">
                          <i class="fa fa-phone text-primary"></i><br>
                          Instant Support
                        </small>
                      </div>
                      <div class="col-4">
                        <small class="text-muted">
                          <i class="fa fa-money text-warning"></i><br>
                          Best Prices
                        </small>
                      </div>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
