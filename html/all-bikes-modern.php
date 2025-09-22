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

$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

$date = date('Y-m-d H:i:s');

$pickuploc = isset($_GET['pickuploc']) ? filter($_GET['pickuploc'], $mysqli_conn) : '';
$droploc   = isset($_GET['droploc']) ? filter($_GET['droploc'], $mysqli_conn) : '';
$tdate     = isset($_GET['pdate']) ? filter($_GET['pdate'], $mysqli_conn) : '';
$ptime     = isset($_GET['ptime']) ? filter($_GET['ptime'], $mysqli_conn) : '';
$ddate     = isset($_GET['ddate']) ? filter($_GET['ddate'], $mysqli_conn) : '';
$dtime     = isset($_GET['dtime']) ? filter($_GET['dtime'], $mysqli_conn) : '';
$st_dte	   = $tdate." ".$ptime;
$end_dte   = $ddate." ".$dtime;
$act       = isset($_GET['act']) ? filter($_GET['act'], $mysqli_conn) : '';
$today	   = date("Y-m-d",strtotime($date));
$pdate = date("Y-m-d H:i",strtotime($date));
$city      = isset($_GET['city']) ? filter($_GET['city'], $mysqli_conn) : '';

// New filter parameters for bikes
$bike_type = isset($_GET['bike_type']) ? filter($_GET['bike_type'], $mysqli_conn) : '';
$fuel_type = isset($_GET['fuel_type']) ? filter($_GET['fuel_type'], $mysqli_conn) : '';
$price_range = isset($_GET['price_range']) ? filter($_GET['price_range'], $mysqli_conn) : '';

$from_dt_time = date("Y-m-d")." 6:00";
$to_dt_time = date("Y-m-d")." 12:00";

if($tdate!="" && $ptime!="" && $ddate!="" && $dtime){
  $from_dt_time = "$st_dte";
  $to_dt_time = "$end_dte";
}

?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>All Self Drive Bikes Bhubaneswar | Scooty, Motorcycle Rental BBSR | EduxonCabs</title>
<meta name="keywords" content="all self drive bikes Bhubaneswar, scooty rental Bhubaneswar, motorcycle rental Bhubaneswar, bike rental BBSR, self drive bikes Bhubaneswar, affordable bike rental Bhubaneswar, hourly bike rental Bhubaneswar, Activa rental Bhubaneswar, KTM rental Bhubaneswar" />
<meta name="description" content="Browse all self drive bikes in Bhubaneswar including scooty, motorcycles, sports bikes. Honda Activa, KTM, Pulsar available. Affordable hourly rental from ₹25/hour. Book online!"/>
<meta name="author" content="Eduxoncabs.com">
<!-- Canonical URL -->
<?php outputCanonicalTag('/all-bikes-modern.php'); ?>
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
<link rel="stylesheet" type="text/css" href="assets/css/modern-bikes-page.css">
<link rel="stylesheet" href="assets/css/footer-center-fix.css">
</head>
<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>

  <div role="main" class="main">
    <!-- Compact Filter Section -->
    <section class="compact-filter-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="compact-filter-card">
              <form method="GET" action="" id="filterForm" class="filter-form-horizontal">
                <div class="filter-row">
                  <div class="filter-item">
                    <label for="city">Select City</label>
                    <select name="city" id="city" class="compact-filter-control">
                      <option value="">All Cities</option>
                      <option value="Bhubaneswar" <?php echo ($city == 'Bhubaneswar') ? 'selected' : ''; ?>>Bhubaneswar</option>
                      <option value="Cuttack">Cuttack</option>
                      <option value="Puri">Puri</option>
                    </select>
                  </div>
                  
                  <div class="filter-item">
                    <label for="bike_type">Bike Type</label>
                    <select name="bike_type" id="bike_type" class="compact-filter-control">
                      <option value="">All Types</option>
                      <option value="Scooty" <?php echo ($bike_type == 'Scooty') ? 'selected' : ''; ?>>Scooty</option>
                      <option value="Motorcycle" <?php echo ($bike_type == 'Motorcycle') ? 'selected' : ''; ?>>Motorcycle</option>
                      <option value="Sports Bike" <?php echo ($bike_type == 'Sports Bike') ? 'selected' : ''; ?>>Sports Bike</option>
                    </select>
                  </div>
                  
                  <div class="filter-item">
                    <label for="fuel_type">Fuel Type</label>
                    <select name="fuel_type" id="fuel_type" class="compact-filter-control">
                      <option value="">All Fuels</option>
                      <option value="Petrol" <?php echo ($fuel_type == 'Petrol') ? 'selected' : ''; ?>>Petrol</option>
                      <option value="Electric" <?php echo ($fuel_type == 'Electric') ? 'selected' : ''; ?>>Electric</option>
                    </select>
                  </div>
                  
                  <div class="filter-item">
                    <label for="price_range">Price Range</label>
                    <select name="price_range" id="price_range" class="compact-filter-control">
                      <option value="">All Prices</option>
                      <option value="0-500" <?php echo ($price_range == '0-500') ? 'selected' : ''; ?>>₹0 - ₹500</option>
                      <option value="500-1000" <?php echo ($price_range == '500-1000') ? 'selected' : ''; ?>>₹500 - ₹1000</option>
                      <option value="1000-1500" <?php echo ($price_range == '1000-1500') ? 'selected' : ''; ?>>₹1000 - ₹1500</option>
                      <option value="1500+" <?php echo ($price_range == '1500+') ? 'selected' : ''; ?>>₹1500+</option>
                    </select>
                  </div>
                  
                  <div class="filter-item filter-actions">
                    <button type="submit" class="btn-compact-search">
                      <i class="fa fa-search"></i>
                      Search
                    </button>
                  </div>
                </div>
                
                <!-- Mobile Filter Toggle -->
                <div class="mobile-filter-toggle d-md-none">
                  <button type="button" class="btn-mobile-filter" onclick="toggleMobileFilters()">
                    <i class="fa fa-filter"></i>
                    Filters
                    <i class="fa fa-chevron-down"></i>
                  </button>
                </div>
                
                <!-- Mobile Filter Dropdown -->
                <div class="mobile-filter-dropdown" id="mobileFilters">
                  <div class="mobile-filter-grid">
                    <select name="city_mobile" class="compact-filter-control">
                      <option value="">All Cities</option>
                      <option value="Bhubaneswar">Bhubaneswar</option>
                    </select>
                    <select name="bike_type_mobile" class="compact-filter-control">
                      <option value="">All Types</option>
                      <option value="Scooty">Scooty</option>
                      <option value="Motorcycle">Motorcycle</option>
                      <option value="Sports Bike">Sports Bike</option>
                    </select>
                    <select name="fuel_type_mobile" class="compact-filter-control">
                      <option value="">All Fuels</option>
                      <option value="Petrol">Petrol</option>
                      <option value="Electric">Electric</option>
                    </select>
                    <button type="submit" class="btn-compact-search w-100">
                      <i class="fa fa-search"></i> Apply Filters
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bikes Grid Section -->
    <section class="modern-bikes-grid">
      <div class="container">
        <div class="bikes-section-header">
          <?php 
          // Build filter query
          $ad_qr = "";
          if(isset($city) && $city != ''){
            $ad_qr .= " AND city = '$city' ";
          }
          if(isset($fuel_type) && $fuel_type != ''){
            $ad_qr .= " AND fuel = '$fuel_type' ";
          }
          if(isset($bike_type) && $bike_type != ''){
            $ad_qr .= " AND bike_type = '$bike_type' ";
          }
          if(isset($price_range) && $price_range != ''){
            switch($price_range) {
              case '0-500':
                $ad_qr .= " AND cost BETWEEN 0 AND 500 ";
                break;
              case '500-1000':
                $ad_qr .= " AND cost BETWEEN 500 AND 1000 ";
                break;
              case '1000-1500':
                $ad_qr .= " AND cost BETWEEN 1000 AND 1500 ";
                break;
              case '1500+':
                $ad_qr .= " AND cost >= 1500 ";
                break;
            }
          }
          
          // Remove leading "AND" if present
          if(substr($ad_qr, 0, 4) == " AND"){
            $ad_qr = substr($ad_qr, 5);
          }

          $bike_data = $dbObj->fetch_data("tbl_bikes", "$ad_qr", "cost ASC");
          $count = $dbObj->countRec("tbl_bikes", "$ad_qr", "cost ASC");
          ?>
          
          <div class="section-title-row">
            <h1 class="section-title">Available Bikes for Rent</h1>
            <div class="results-count">
              <span class="count-badge"><?php echo $count; ?></span>
              <span class="count-text">bikes available</span>
            </div>
          </div>
          
          <?php if($count == 0): ?>
            <div class="no-results">
              <div class="no-results-icon">
                <i class="fa fa-motorcycle"></i>
              </div>
              <h3>No bikes found</h3>
              <p>Try adjusting your filters to see more options</p>
              <a href="all-bikes-bike-for-rental-bhubaneswar.php" class="btn btn-primary">
                <i class="fa fa-refresh"></i> Reset Filters
              </a>
            </div>
          <?php endif; ?>
        </div>

        <?php if($count > 0): ?>
        <div class="bikes-grid">
          <?php foreach($bike_data as $bike): ?>
            <div class="bike-card">
              <div class="bike-image-wrapper">
                <img src="uploadedDocument/bikes/<?php echo $bike['bike_image']; ?>" 
                     alt="<?php echo $bike['bike_name']; ?>" 
                     class="bike-image">
                <div class="bike-badges">
                  <span class="badge badge-fuel"><?php echo $bike['fuel']; ?></span>
                  <?php if(isset($bike['bike_type']) && $bike['bike_type']): ?>
                    <span class="badge badge-type"><?php echo $bike['bike_type']; ?></span>
                  <?php endif; ?>
                </div>
              </div>
              
              <div class="bike-content">
                <div class="bike-header">
                  <h3 class="bike-name"><?php echo $bike['bike_name']; ?></h3>
                  <div class="bike-price">
                    <span class="price-amount">₹<?php echo $bike['cost']; ?></span>
                    <span class="price-period">/24 Hours</span>
                  </div>
                </div>
                
                <div class="bike-features">
                  <div class="feature-item">
                    <i class="fa fa-motorcycle"></i>
                    <span><?php echo $bike['bike_name']; ?></span>
                  </div>
                  <div class="feature-item">
                    <i class="fa fa-tint"></i>
                    <span><?php echo $bike['fuel']; ?></span>
                  </div>
                  <div class="feature-item">
                    <i class="fa fa-road"></i>
                    <span>180 km limit</span>
                  </div>
                  <div class="feature-item">
                    <i class="fa fa-shield"></i>
                    <span>Insured</span>
                  </div>
                </div>
                
                <div class="bike-actions">
                  <?php 
                  $bike_id = $bike['id'];
                  $get_unavail = $dbObj->countRec("tbl_unavail_dtes","bike_id = $bike_id AND (('$from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$from_dt_time' AND '$to_dt_time' OR `unavail_dte_to` BETWEEN '$from_dt_time' AND '$to_dt_time'))");
                  
                  if($get_unavail > 0): ?>
                    <button class="btn-booked" disabled>
                      <i class="fa fa-check-circle"></i>
                      Bike Booked
                    </button>
                  <?php else: ?>
                    <form action="checkout_3.php" method="post" class="booking-form">
                      <input type='hidden' name='vehicle_id' value='<?= md5($bike["id"]); ?>' />
                      <input type='hidden' name='vehicle_type' value='2' />
                      <input type='hidden' name='from_dt_time' value='<?= $from_dt_time; ?>' />
                      <input type='hidden' name='to_dt_time' value='<?= $to_dt_time; ?>' />
                      
                      <button type="submit" name="book_bike" class="btn-book-now">
                        <i class="fa fa-calendar-check-o"></i>
                        Book Now
                      </button>
                    </form>
                  <?php endif; ?>
                  
                  <div class="bike-info-actions">
                    <button class="btn-info" onclick="showBikeDetails('<?php echo $bike['id']; ?>')">
                      <i class="fa fa-info-circle"></i>
                      Details
                    </button>
                    <button class="btn-call" onclick="window.open('tel:+919437144274')">
                      <i class="fa fa-phone"></i>
                      Call
                    </button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Additional Information Section -->
        <div class="bikes-info-section">
          <div class="row">
            <div class="col-md-12">
              <div class="info-content">
                <h3 class="info-title">All Bikes for Self Drive in Bhubaneswar – Eduxon Cabs</h3>
                <p class="info-description">
                  Explore all self-drive bike options in Bhubaneswar with Eduxon Cabs. Enjoy flexible, affordable, and hassle-free rentals for your journey! From scooty to premium motorcycles, we have the perfect two-wheeler for every need.
                </p>
                
                <div class="info-features">
                  <div class="row">
                    <div class="col-md-6">
                      <ul class="feature-list">
                        <li><i class="fa fa-check-circle"></i> Wide range of bikes including scooty and motorcycles</li>
                        <li><i class="fa fa-check-circle"></i> Competitive hourly and daily rental rates</li>
                        <li><i class="fa fa-check-circle"></i> Well-maintained and regularly serviced bikes</li>
                        <li><i class="fa fa-check-circle"></i> Free home delivery within city limits</li>
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <ul class="feature-list">
                        <li><i class="fa fa-check-circle"></i> 24/7 roadside assistance</li>
                        <li><i class="fa fa-check-circle"></i> Flexible booking and cancellation policy</li>
                        <li><i class="fa fa-check-circle"></i> No hidden charges or extra fees</li>
                        <li><i class="fa fa-check-circle"></i> Quick booking process with instant confirmation</li>
                      </ul>
                    </div>
                  </div>
                </div>
                
                <h5 class="sub-title">Why Choose EduxonCabs for Bike Rental in Bhubaneswar?</h5>
                <p class="sub-description">
                  Whether you need a comfortable scooty for city rides or a powerful motorcycle for longer journeys, EduxonCabs offers the best self-drive bike rental experience in Bhubaneswar. Book online and get your bike delivered to your doorstep!
                </p>
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
// Mobile filter toggle
function toggleMobileFilters() {
  const mobileFilters = document.getElementById('mobileFilters');
  const toggleBtn = document.querySelector('.btn-mobile-filter i.fa-chevron-down');
  
  if (mobileFilters.classList.contains('show')) {
    mobileFilters.classList.remove('show');
    if (toggleBtn) toggleBtn.style.transform = 'rotate(0deg)';
  } else {
    mobileFilters.classList.add('show');
    if (toggleBtn) toggleBtn.style.transform = 'rotate(180deg)';
  }
}

// Bike details modal (placeholder)
function showBikeDetails(bikeId) {
  // You can implement a modal or redirect to details page
  alert('Bike details for ID: ' + bikeId);
}

// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
  const filterForm = document.getElementById('filterForm');
  const filterControls = filterForm.querySelectorAll('.compact-filter-control');
  
  filterControls.forEach(control => {
    control.addEventListener('change', function() {
      // Add a slight delay to improve UX
      setTimeout(() => {
        filterForm.submit();
      }, 100);
    });
  });
});
</script>
</body>
</html>
