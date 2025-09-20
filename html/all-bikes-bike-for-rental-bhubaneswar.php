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

// New filter parameters for bikes
$pickup_date = isset($_GET['pickup_date']) ? filter($_GET['pickup_date'], $mysqli_conn) : '';
$pickup_time = isset($_GET['pickup_time']) ? filter($_GET['pickup_time'], $mysqli_conn) : '';
$dropoff_date = isset($_GET['dropoff_date']) ? filter($_GET['dropoff_date'], $mysqli_conn) : '';
$dropoff_time = isset($_GET['dropoff_time']) ? filter($_GET['dropoff_time'], $mysqli_conn) : '';
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
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
<link rel="stylesheet" type="text/css" href="assets/css/modern-bikes-page.css">
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
                    <label for="pickup_date">Pick-up Date</label>
                    <input type="date" name="pickup_date" id="pickup_date" class="compact-filter-control" value="<?php echo isset($_GET['pickup_date']) ? $_GET['pickup_date'] : ''; ?>">
                  </div>
                  
                  <div class="filter-item">
                    <label for="pickup_time">Pick-up Time</label>
                    <select name="pickup_time" id="pickup_time" class="compact-filter-control">
                      <option value="">Select Time</option>
                      <option value="06:00">06:00 AM</option>
                      <option value="07:00">07:00 AM</option>
                      <option value="08:00">08:00 AM</option>
                      <option value="09:00">09:00 AM</option>
                      <option value="10:00">10:00 AM</option>
                      <option value="11:00">11:00 AM</option>
                      <option value="12:00">12:00 PM</option>
                      <option value="13:00">01:00 PM</option>
                      <option value="14:00">02:00 PM</option>
                      <option value="15:00">03:00 PM</option>
                      <option value="16:00">04:00 PM</option>
                      <option value="17:00">05:00 PM</option>
                      <option value="18:00">06:00 PM</option>
                      <option value="19:00">07:00 PM</option>
                      <option value="20:00">08:00 PM</option>
                      <option value="21:00">09:00 PM</option>
                      <option value="22:00">10:00 PM</option>
                    </select>
                  </div>
                  
                  <div class="filter-item">
                    <label for="dropoff_date">Drop-off Dateeee</label>
                    <input type="date" name="dropoff_date" id="dropoff_date" class="compact-filter-control" value="<?php echo isset($_GET['dropoff_date']) ? $_GET['dropoff_date'] : ''; ?>">
                  </div>
                  
                  <div class="filter-item">
                    <label for="dropoff_time">Drop-off Time</label>
                    <select name="dropoff_time" id="dropoff_time" class="compact-filter-control">
                      <option value="">Select Time</option>
                      <option value="06:00">06:00 AM</option>
                      <option value="07:00">07:00 AM</option>
                      <option value="08:00">08:00 AM</option>
                      <option value="09:00">09:00 AM</option>
                      <option value="10:00">10:00 AM</option>
                      <option value="11:00">11:00 AM</option>
                      <option value="12:00">12:00 PM</option>
                      <option value="13:00">01:00 PM</option>
                      <option value="14:00">02:00 PM</option>
                      <option value="15:00">03:00 PM</option>
                      <option value="16:00">04:00 PM</option>
                      <option value="17:00">05:00 PM</option>
                      <option value="18:00">06:00 PM</option>
                      <option value="19:00">07:00 PM</option>
                      <option value="20:00">08:00 PM</option>
                      <option value="21:00">09:00 PM</option>
                      <option value="22:00">10:00 PM</option>
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
                  <div class="mobile-filter-item">
                    <label for="pickup_date_mobile" class="mobile-filter-label" style="display:block; text-align:left; font-weight:600; margin-bottom:6px;">Pick-up Date</label>
                    <input type="date" id="pickup_date_mobile" name="pickup_date" class="compact-filter-control" value="<?php echo isset($_GET['pickup_date']) ? $_GET['pickup_date'] : ''; ?>" min="<?php echo date('Y-m-d'); ?>">
                  </div>

                  <div class="mobile-filter-item">
                    <label for="pickup_time_mobile" class="mobile-filter-label" style="display:block; text-align:left; font-weight:600; margin-bottom:6px;">Pick-up Time</label>
                    <input type="time" id="pickup_time_mobile" name="pickup_time" class="compact-filter-control" value="<?php echo isset($_GET['pickup_time']) ? $_GET['pickup_time'] : ''; ?>">
                  </div>

                  <div class="mobile-filter-item">
                    <label for="dropoff_date_mobile" class="mobile-filter-label" style="display:block; text-align:left; font-weight:600; margin-bottom:6px;">Drop-off Date</label>
                    <input type="date" id="dropoff_date_mobile" name="dropoff_date" class="compact-filter-control" value="<?php echo isset($_GET['dropoff_date']) ? $_GET['dropoff_date'] : ''; ?>" min="<?php echo date('Y-m-d'); ?>">
                  </div>

                  <div class="mobile-filter-item">
                    <label for="dropoff_time_mobile" class="mobile-filter-label" style="display:block; text-align:left; font-weight:600; margin-bottom:6px;">Drop-off Time</label>
                    <input type="time" id="dropoff_time_mobile" name="dropoff_time" class="compact-filter-control" value="<?php echo isset($_GET['dropoff_time']) ? $_GET['dropoff_time'] : ''; ?>">
                  </div>
                  </div>

                  <button type="submit" class="btn-compact-search w-100" style="margin:16px auto 0; display:block; text-align:center;">
                  <i class="fa fa-search"></i> Apply Filters
                  </button>
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
          // City filter removed per user request
          // Fuel type filter removed per user request  
          // Bike type filter removed per user request
          
          // Build price range filter
          $price_filter = "";
          if(isset($price_range) && $price_range != ''){
            switch($price_range) {
              case '0-500':
                $price_filter = " AND cost BETWEEN 0 AND 500 ";
                break;
              case '500-1000':
                $price_filter = " AND cost BETWEEN 500 AND 1000 ";
                break;
              case '1000-1500':
                $price_filter = " AND cost BETWEEN 1000 AND 1500 ";
                break;
              case '1500+':
                $price_filter = " AND cost >= 1500 ";
                break;
            }
          }
          
          // Set up date/time filters for availability checking
          $filter_from_dt_time = '';
          $filter_to_dt_time = '';
          
          // Only apply availability filter if user has selected specific dates
          if(isset($pickup_date) && $pickup_date != '' && isset($pickup_time) && $pickup_time != '' && 
             isset($dropoff_date) && $dropoff_date != '' && isset($dropoff_time) && $dropoff_time != ''){
            $filter_from_dt_time = "$pickup_date $pickup_time";
            $filter_to_dt_time = "$dropoff_date $dropoff_time";
          }
          
          // For individual bike checks, use default values if no specific dates selected
          $display_from_dt_time = $filter_from_dt_time ?: $from_dt_time;
          $display_to_dt_time = $filter_to_dt_time ?: $to_dt_time;
          
          // Build availability filter for main query - only if dates are selected
          $availability_filter = "";
          if($filter_from_dt_time && $filter_to_dt_time) {
            $availability_filter = " AND id NOT IN (
              SELECT DISTINCT bike_id FROM tbl_unavail_dtes 
              WHERE bike_id IS NOT NULL AND bike_id > 0
              AND (('$filter_from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` 
                   OR '$filter_to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) 
                   OR (`unavail_dte` BETWEEN '$filter_from_dt_time' AND '$filter_to_dt_time' 
                   OR `unavail_dte_to` BETWEEN '$filter_from_dt_time' AND '$filter_to_dt_time'))
            )";
          }
          
          // Combine all filters into final WHERE clause
          $final_where = "status = 1" . $price_filter . $availability_filter;

          $bike_data = $dbObj->fetch_data("tbl_bikes", "$final_where ORDER BY cost ASC");
          $count = $dbObj->countRec("tbl_bikes", "$final_where");
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
                <?php 
                $bike_id = $bike['id'];
                $get_unavail = $dbObj->countRec("tbl_unavail_dtes","bike_id = $bike_id AND (('$display_from_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to` OR '$display_to_dt_time' BETWEEN `unavail_dte` AND `unavail_dte_to`) OR (`unavail_dte` BETWEEN '$display_from_dt_time' AND '$display_to_dt_time' OR `unavail_dte_to` BETWEEN '$display_from_dt_time' AND '$display_to_dt_time'))");
                ?>
                <?php if($get_unavail > 0): ?>
                  <div class="availability-badge booked">Booked</div>
                <?php else: ?>
                  <div class="availability-badge available">Available</div>
                <?php endif; ?>
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
                  <?php if($get_unavail > 0): ?>
                    <button class="btn-booked" disabled>
                      <i class="fa fa-check-circle"></i>
                      Bike Booked
                    </button>
                  <?php else: ?>
                    <a href="checkout.php?pdate=<?php echo !empty($pickup_date) ? $pickup_date : (!empty($tdate) ? $tdate : date('Y-m-d')); ?>&ptime=<?php echo !empty($pickup_time) ? $pickup_time : (!empty($ptime) ? $ptime : '6:00'); ?>&ddate=<?php echo !empty($dropoff_date) ? $dropoff_date : (!empty($ddate) ? $ddate : date('Y-m-d')); ?>&dtime=<?php echo !empty($dropoff_time) ? $dropoff_time : (!empty($dtime) ? $dtime : '12:00'); ?>&car=<?php echo md5($bike['bike_name']); ?>&cartype=<?php echo md5($bike['fuel']); ?>&cardta=<?php echo md5($bike['id']); ?>&vehicle_type=bike" class="btn-book-now">
                      <i class="fa fa-calendar mr-2"></i>Book Now
                    </a>
                  <?php endif; ?>
                  
                  <div class="bike-info-actions">
                    <a href="checkout.php?pdate=<?php echo !empty($pickup_date) ? $pickup_date : (!empty($tdate) ? $tdate : date('Y-m-d')); ?>&ptime=<?php echo !empty($pickup_time) ? $pickup_time : (!empty($ptime) ? $ptime : '6:00'); ?>&ddate=<?php echo !empty($dropoff_date) ? $dropoff_date : (!empty($ddate) ? $ddate : date('Y-m-d')); ?>&dtime=<?php echo !empty($dropoff_time) ? $dropoff_time : (!empty($dtime) ? $dtime : '12:00'); ?>&car=<?php echo md5($bike['bike_name']); ?>&cartype=<?php echo md5($bike['fuel']); ?>&cardta=<?php echo md5($bike['id']); ?>&vehicle_type=bike" class="btn-info">
                      <i class="fa fa-info-circle"></i>
                      Details
                    </a>
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

// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
  // Set minimum date to today for pickup and dropoff dates
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('pickup_date').min = today;
  document.getElementById('dropoff_date').min = today;
  
  // Auto-update dropoff date when pickup date changes
  document.getElementById('pickup_date').addEventListener('change', function() {
    const pickupDate = this.value;
    if (pickupDate) {
      document.getElementById('dropoff_date').min = pickupDate;
      // If dropoff date is before pickup date, update it
      const dropoffDate = document.getElementById('dropoff_date').value;
      if (dropoffDate && dropoffDate < pickupDate) {
        document.getElementById('dropoff_date').value = pickupDate;
      }
    }
  });
  
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
  
  console.log('All Bikes page loaded with date filters');
});
</script>
</body>
</html>
