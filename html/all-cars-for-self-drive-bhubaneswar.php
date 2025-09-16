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
//print_r($_REQUEST);

$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

 $date = date('Y-m-d H:i:s');
 //$date = date('Y-m-d H:i:s',strtotime($date)+19800);

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

// New filter parameters
$car_type = isset($_GET['car_type']) ? filter($_GET['car_type'], $mysqli_conn) : '';
$fuel_type = isset($_GET['fuel_type']) ? filter($_GET['fuel_type'], $mysqli_conn) : '';
$price_range = isset($_GET['price_range']) ? filter($_GET['price_range'], $mysqli_conn) : '';


$from_dt_time = date("Y-m-d")." 6:00";
$to_dt_time = date("Y-m-d")." 12:00";
$nxt6hr = date('Y-m-d H:i:s',strtotime($date ."+6 hour"));

$nxt18hr = date('Y-m-d H:i:s',strtotime($date ."+18 hour"));

if($tdate!="" && $ptime!="" && $ddate!="" && $dtime){
$from_dt_time = "$st_dte";
$to_dt_time = "$end_dte";
$nxt6hr = date('Y-m-d H:i:s',strtotime($st_dte ."+6 hour"));

$nxt18hr = date('Y-m-d H:i:s',strtotime($st_dte ."+18 hour"));
}

?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>All Self Drive Cars Bhubaneswar | Sedan, SUV Rental BBSR | EduxonCabs</title>
<meta name="keywords" content="all self drive cars Bhubaneswar, sedan rental Bhubaneswar, SUV rental Bhubaneswar, Maruti Dzire rental Bhubaneswar, luxury car rental Bhubaneswar, self drive cars BBSR, car rental Bhubaneswar, affordable self drive cars Bhubaneswar, unlimited km car rental Bhubaneswar, hourly car rental Bhubaneswar" />
<meta name="description" content="Browse all self drive cars Bhubaneswar including sedan, SUV, luxury cars. Maruti Dzire, Hyundai Creta, Honda City available. Unlimited km, hourly rental from ₹35/hour. Book online!"/>
<meta name="author" content="Eduxoncabs.com">
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
<link rel="stylesheet" type="text/css" href="assets/css/modern-cars-page.css">
<link rel="stylesheet" href="assets/css/footer-center-fix.css">
<style>
body {
    padding-top: 0px !important;
}
</style>
</head>
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
                    <label for="car_type">Car Type</label>
                    <select name="car_type" id="car_type" class="compact-filter-control">
                      <option value="">All Types</option>
                      <option value="Hatchback">Hatchback</option>
                      <option value="Sedan">Sedan</option>
                      <option value="SUV">SUV</option>
                      <option value="Luxury">Luxury</option>
                    </select>
                  </div>
                  
                  <div class="filter-item">
                    <label for="fuel_type">Fuel Type</label>
                    <select name="fuel_type" id="fuel_type" class="compact-filter-control">
                      <option value="">All Fuels</option>
                      <option value="Petrol">Petrol</option>
                      <option value="Diesel">Diesel</option>
                      <option value="CNG">CNG</option>
                    </select>
                  </div>
                  
                  <div class="filter-item">
                    <label for="price_range">Price Range</label>
                    <select name="price_range" id="price_range" class="compact-filter-control">
                      <option value="">All Prices</option>
                      <option value="0-1000">₹0 - ₹1000</option>
                      <option value="1000-2000">₹1000 - ₹2000</option>
                      <option value="2000-3000">₹2000 - ₹3000</option>
                      <option value="3000+">₹3000+</option>
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
                    <select name="car_type_mobile" class="compact-filter-control">
                      <option value="">All Types</option>
                      <option value="Hatchback">Hatchback</option>
                      <option value="Sedan">Sedan</option>
                      <option value="SUV">SUV</option>
                    </select>
                    <select name="fuel_type_mobile" class="compact-filter-control">
                      <option value="">All Fuels</option>
                      <option value="Petrol">Petrol</option>
                      <option value="Diesel">Diesel</option>
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
    </section>    <!-- Cars Grid Section -->
    <section class="modern-cars-grid">
      <div class="container">
        <div class="cars-section-header">
          <?php 
          // Build filter query
          $ad_qr = "";
          if(isset($city) && $city != ''){
            $ad_qr .= " AND city = '$city' ";
          }
          if(isset($fuel_type) && $fuel_type != ''){
            $ad_qr .= " AND fuel = '$fuel_type' ";
          }
          if(isset($car_type) && $car_type != ''){
            $ad_qr .= " AND car_type = '$car_type' ";
          }
          if(isset($price_range) && $price_range != ''){
            switch($price_range) {
              case '0-1000':
                $ad_qr .= " AND cost BETWEEN 0 AND 1000 ";
                break;
              case '1000-2000':
                $ad_qr .= " AND cost BETWEEN 1000 AND 2000 ";
                break;
              case '2000-3000':
                $ad_qr .= " AND cost BETWEEN 2000 AND 3000 ";
                break;
              case '3000+':
                $ad_qr .= " AND cost > 3000 ";
                break;
            }
          }
          
          $total_cars = $dbObj->countRec("tbl_cabs","status = 1 $ad_qr ORDER BY cost ASC");
          ?>
          <div class="cars-count-badge"><?php echo $total_cars; ?> Cars Available</div>
          <h2 class="cars-section-title">Available Self-Drive Cars</h2>
          <p class="cars-section-subtitle">Choose from our wide range of well-maintained vehicles with transparent pricing and instant booking</p>
        </div>
        
        <div class="row" id="carsGrid">
          <?php 
          $cnt = $dbObj->countRec("tbl_cabs","status = 1 $ad_qr ORDER BY cost ASC");
          if($cnt > 0){
            $getCar = $dbObj->fetch_data("tbl_cabs","status = 1 $ad_qr ORDER BY cost ASC");
            foreach($getCar as $key){
              $id = $key['id'];
              $get_unavail = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$from_dt_time' AND '$to_dt_time' OR `unavail_dte_to` BETWEEN '$from_dt_time' AND '$to_dt_time'))");
              $get_unavail_next6hr = $dbObj->countRec("tbl_unavail_dtes","car_id = $id AND (('$nxt6hr' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$nxt18hr' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$nxt6hr' AND '$nxt18hr' OR `unavail_dte_to` BETWEEN '$nxt6hr' AND '$nxt18hr'))");
          ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="modern-car-card">
              <div class="car-image-container">
                <img src="uploadedDocument/cab/<?php echo $key['car_image'];?>" alt="<?php echo $key['car_nme'];?>" class="car-image">
                <?php if($get_unavail > 0): ?>
                  <?php if($get_unavail_next6hr == 0): ?>
                    <div class="availability-badge available-soon">Available Soon</div>
                  <?php else: ?>
                    <div class="availability-badge booked">Booked</div>
                  <?php endif; ?>
                <?php else: ?>
                  <div class="availability-badge available">Available</div>
                <?php endif; ?>
              </div>
              
              <div class="car-details">
                <h3 class="car-name"><?php echo $key['car_nme'];?></h3>
                
                <div class="car-features">
                  <div class="car-feature">
                    <i class="fa fa-users"></i>
                    <span><?php echo $key['no_of_seat'];?> Seater</span>
                  </div>
                  <div class="car-feature">
                    <i class="fa fa-tachometer"></i>
                    <span><?php echo $key['fuel'];?></span>
                  </div>
                  <div class="car-feature">
                    <i class="fa fa-road"></i>
                    <span>Unlimited KM</span>
                  </div>
                  <div class="car-feature">
                    <i class="fa fa-shield"></i>
                    <span>24x7 Support</span>
                  </div>
                </div>
                
                <div class="car-pricing">
                  <div>
                    <div class="price-main">₹<?php echo $key['cost'];?></div>
                    <div class="price-duration">per 24 hours</div>
                  </div>
                </div>
                
                <?php if(!empty($key['offers']) && $key['offers'] != 'NO'): ?>
                <div class="car-notes">
                  <i class="fa fa-info-circle mr-1"></i>
                  <strong>Note:</strong> <?php echo $key['offers']; ?>
                </div>
                <?php endif; ?>
                
                <div class="car-actions">
                  <?php if($get_unavail > 0): ?>
                    <?php if($get_unavail_next6hr == 0): ?>
                      <?php 
                      $count = $dbObj->countRec("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$date' AND '$nxt6hr')");
                      if($count > 0) {
                        $getres = $dbObj->fetch_data("tbl_unavail_dtes","car_id=$id AND (`unavail_dte_to` BETWEEN '$date' AND '$nxt6hr')");
                        $enddt = $getres[0]['unavail_dte_to'];
                        $totalhr = round((strtotime($enddt) - strtotime($date))/3600);
                        if($totalhr == 0) $totalhr = 1;
                      ?>
                      <div class="btn-car-booked">Available in <?php echo $totalhr; ?> hour<?php echo $totalhr > 1 ? 's' : ''; ?></div>
                      <?php } else { ?>
                      <div class="btn-car-booked">Available Soon</div>
                      <?php } ?>
                    <?php else: ?>
                      <div class="btn-car-booked">Car Booked</div>
                    <?php endif; ?>
                  <?php else: ?>
                    <a href="checkout.php?pdate=<?php echo !empty($tdate) ? $tdate : date('Y-m-d'); ?>&ptime=<?php echo !empty($ptime) ? $ptime : '6:00'; ?>&ddate=<?php echo !empty($ddate) ? $ddate : date('Y-m-d'); ?>&dtime=<?php echo !empty($dtime) ? $dtime : '12:00'; ?>&car=<?php echo md5($key['car_nme']); ?>&cartype=<?php echo md5($key['fuel']); ?>&cardta=<?php echo md5($key['id']); ?>" class="btn-book-now">
                      <i class="fa fa-calendar mr-2"></i>Book Now
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php 
            }
          } else {
          ?>
          <div class="col-12">
            <div class="no-results">
              <div class="no-results-icon">
                <i class="fa fa-car"></i>
              </div>
              <h3 class="no-results-title">No Cars Found</h3>
              <p class="no-results-subtitle">Sorry, we couldn't find any cars matching your criteria. Please try adjusting your filters.</p>
              <button class="btn-filter-search" onclick="resetFilters()">Reset Filters</button>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    
    <!-- Content Section -->
    <section style="background: #f8fafc; padding: 60px 0;">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h3 class="all-cars-text-heading">All Cars - Explore a Wide Range of Self-Drive Cars in Bhubaneswar</h3>
            <p class="all-cars-text-para">At <strong>Eduxon Cabs,</strong> we offer a wide selection of self-drive cars in Bhubaneswar, providing you with the flexibility and convenience to travel at your own pace. Whether you need a compact hatchback for city commuting, a comfortable sedan for business trips, an SUV for long drives, or a luxury car for a premium experience, we have the perfect vehicle for every need.</p>
            <p class="all-cars-text-para">Our self-drive car rental in Bhubaneswar is designed to give you a seamless experience with easy booking, transparent pricing, and no hidden charges. We also provide self-drive car rental services at Bhubaneswar Airport, ensuring you can pick up your car right after landing.</p>
          </div>
          <div class="col-lg-4">
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
              <h4 style="color: #1f2937; margin-bottom: 20px;">Why Choose Our Service?</h4>
              <ul class="all-cars-text-list" style="margin: 0; padding: 0;">
                <li style="margin-bottom: 10px; display: flex; align-items: center;">
                  <i class="fa fa-check-circle" style="color: #10b981; margin-right: 10px;"></i>
                  Multiple car options – hatchbacks, sedans, SUVs & luxury cars
                </li>
                <li style="margin-bottom: 10px; display: flex; align-items: center;">
                  <i class="fa fa-check-circle" style="color: #10b981; margin-right: 10px;"></i>
                  Hassle-free booking with no hidden charges
                </li>
                <li style="margin-bottom: 10px; display: flex; align-items: center;">
                  <i class="fa fa-check-circle" style="color: #10b981; margin-right: 10px;"></i>
                  Unlimited kilometers for long, worry-free trips
                </li>
                <li style="margin-bottom: 10px; display: flex; align-items: center;">
                  <i class="fa fa-check-circle" style="color: #10b981; margin-right: 10px;"></i>
                  Affordable pricing with competitive rates
                </li>
                <li style="margin-bottom: 10px; display: flex; align-items: center;">
                  <i class="fa fa-check-circle" style="color: #10b981; margin-right: 10px;"></i>
                  Pickup & drop-off services, including at Bhubaneswar Airport
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  <?php include("includes/site-footer.php");?>
</div>

<!-- Filter JavaScript -->
<script>
function resetFilters() {
  document.getElementById('city').value = '';
  document.getElementById('car_type').value = '';
  document.getElementById('fuel_type').value = '';
  document.getElementById('price_range').value = '';
  
  // Remove active class from quick filter tags
  document.querySelectorAll('.quick-filter-tag').forEach(tag => {
    tag.classList.remove('active');
  });
  
  // Submit form to show all cars
  document.getElementById('filterForm').submit();
}

function setQuickFilter(type, value) {
  // Remove active class from all tags
  document.querySelectorAll('.quick-filter-tag').forEach(tag => {
    tag.classList.remove('active');
  });
  
  // Add active class to clicked tag
  event.target.classList.add('active');
  
  // Set filter values based on type
  switch(type) {
    case 'fuel':
      document.getElementById('fuel_type').value = value;
      break;
    case 'price':
      document.getElementById('price_range').value = value;
      break;
    case 'type':
      document.getElementById('car_type').value = value;
      break;
    case 'available':
      // This would require additional backend logic
      break;
  }
  
  // Auto submit form
  setTimeout(() => {
    document.getElementById('filterForm').submit();
  }, 300);
}

// Enhance form submission with loading state
document.getElementById('filterForm').addEventListener('submit', function() {
  const submitBtn = document.querySelector('.btn-filter-search');
  const originalText = submitBtn.innerHTML;
  submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i>Searching...';
  submitBtn.disabled = true;
  
  // Re-enable after a delay (in case of slow loading)
  setTimeout(() => {
    submitBtn.innerHTML = originalText;
    submitBtn.disabled = false;
  }, 3000);
});

// Add smooth scrolling to results
function scrollToResults() {
  document.querySelector('.modern-cars-grid').scrollIntoView({
    behavior: 'smooth'
  });
}

// Auto-scroll to results after form submission if there are URL parameters
if (window.location.search) {
  setTimeout(scrollToResults, 500);
}
</script>

<style>
h3.all-cars-text-heading {
    font-size: 1.8em;
    font-weight: 600;
    letter-spacing: normal;
    line-height: 28px;
    margin-bottom: 20px;
    color: #1f2937;
    font-family: 'Montserrat', sans-serif;
}

p.all-cars-text-para {
    color: #374151;
    line-height: 26px;
    margin-bottom: 20px;
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
}

ul.all-cars-text-list {
    list-style: none;
    margin: 0;
    padding: 0;
    font-family: 'Montserrat', sans-serif;
}

ul.all-cars-text-list li {
    padding: 8px 0;
    color: #374151;
    font-size: 0.95rem;
}
</style>

<?php include("includes/inc-js.php");
 if(isset($_GET['ermsg']) && $_GET['ermsg']==1){
?>
<script>
   alert("Sorry!!! Some problem occur while booking");
</script>
<?php  } 
if(isset($_GET['ermsg']) && $_GET['ermsg']==2){
?>
<script>
   alert("Sorry!!! You entered Invalid date ");
</script>
<?php  } ?>

  <script>
  // Mobile Filter Toggle
  function toggleMobileFilter() {
    const dropdown = document.querySelector('.mobile-filter-dropdown');
    const isVisible = dropdown.classList.contains('show');
    
    if (isVisible) {
      dropdown.classList.remove('show');
    } else {
      dropdown.classList.add('show');
    }
  }
  
  // Smooth scrolling for car section
  function scrollToCars() {
    document.querySelector('.cars-grid-section').scrollIntoView({ 
      behavior: 'smooth' 
    });
  }
  
  // Initialize page
  document.addEventListener('DOMContentLoaded', function() {
    // Add any initialization code here
    console.log('All Cars page loaded');
  });
  </script>
  </body>
</html>