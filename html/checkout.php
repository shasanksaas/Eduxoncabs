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

$mysqli_conn = new mysqli(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

$get_id = filter($_GET['cardta'],$mysqli_conn);

// Determine vehicle type (car or bike)
$vehicle_type = isset($_GET['vehicle_type']) ? filter($_GET['vehicle_type'], $mysqli_conn) : 'car';

// Fetch vehicle data based on type
if($vehicle_type == 'bike') {
    $get_vehicle_data = $dbObj->fetch_data("tbl_bikes", "md5(id) = '$get_id'");
    $vehicle_table = 'tbl_bikes';
    $vehicle_name_field = 'bike_name';
    $vehicle_image_field = 'bike_image';
    $vehicle_image_folder = 'bikes';
    $vehicle_type_display = 'Bike';
} else {
    $get_vehicle_data = $dbObj->fetch_data("tbl_cabs", "md5(id) = '$get_id'");
    $vehicle_table = 'tbl_cabs';
    $vehicle_name_field = 'car_nme';
    $vehicle_image_field = 'car_image';
    $vehicle_image_folder = 'cab';
    $vehicle_type_display = 'Car';
}

// Keep backward compatibility by setting $get_car_dta
$get_car_dta = $get_vehicle_data;


$pdate = filter($_GET['pdate'],$mysqli_conn);

$ptime = filter($_GET['ptime'],$mysqli_conn);

$ddate = filter($_GET['ddate'],$mysqli_conn);

$dtime = filter($_GET['dtime'],$mysqli_conn);

//$_SESSION['car_id'] = $get_car_dta[0]['id'];
//CSRF
$_SESSION["token"] = md5(uniqid(mt_rand(), true));


if ($pdate != '' || $ptime != '' || $ddate != '' || $dtime != '') {
   ?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Checkout - Complete Your <?php echo $vehicle_type_display; ?> Booking | EduxonCabs</title>
      <meta name="keywords" content="<?php echo strtolower($vehicle_type_display); ?> rental checkout, self drive booking, EduxonCabs payment" />
      <meta name="description" content="Complete your self-drive <?php echo strtolower($vehicle_type_display); ?> rental booking with EduxonCabs. Secure payment and instant confirmation.">
      <meta name="author" content="EduxonCabs">
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
      <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <!-- Modern Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
      
      <!-- Bootstrap 5 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      
      <!-- jQuery UI for Date Picker -->
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
      
      <?php include("includes/inc-css.php"); ?>
      
      <style>
      :root {
          --primary-color: #3b82f6;
          --primary-dark: #1e40af;
          --primary-light: #60a5fa;
          --accent-color: #10b981;
          --success-color: #059669;
          --warning-color: #f59e0b;
          --danger-color: #dc2626;
          --dark-color: #1f2937;
          --light-bg: #f8fafc;
          --border-color: #e5e7eb;
          --text-muted: #6b7280;
          --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
          --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
          --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      }

      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
      }

      body {
          font-family: 'Inter', sans-serif;
          line-height: 1.6;
          color: var(--dark-color);
          background: linear-gradient(135deg, #dbeafe 0%, #ecfdf5 100%);
          min-height: 100vh;
      }

      .checkout-container {
          background: white;
          border-radius: 20px;
          box-shadow: var(--shadow-lg);
          margin: 2rem auto;
          max-width: 1200px;
          overflow: hidden;
      }

      .checkout-header {
          background: linear-gradient(135deg, #60a5fa 0%, #34d399 100%);
          color: white;
          padding: 2rem;
          text-align: center;
          box-shadow: 0 4px 20px rgba(96, 165, 250, 0.3);
      }

      .checkout-header h1 {
          font-size: 2.5rem;
          font-weight: 700;
          margin-bottom: 0.5rem;
      }

      .checkout-header p {
          font-size: 1.1rem;
          opacity: 0.9;
      }

      .checkout-content {
          padding: 2rem;
      }

      .form-section {
          background: white;
          border-radius: 16px;
          padding: 2rem;
          margin-bottom: 2rem;
          border: 1px solid var(--border-color);
          box-shadow: var(--shadow-sm);
      }

      .section-title {
          font-size: 1.5rem;
          font-weight: 600;
          color: var(--dark-color);
          margin-bottom: 1.5rem;
          display: flex;
          align-items: center;
          gap: 0.75rem;
      }

      .section-icon {
          width: 40px;
          height: 40px;
          background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
          border-radius: 10px;
          display: flex;
          align-items: center;
          justify-content: center;
          color: white;
          font-size: 1.2rem;
      }

      .form-control-modern {
          border: 2px solid var(--border-color);
          border-radius: 12px;
          padding: 0.875rem 1rem;
          font-size: 1rem;
          transition: all 0.3s ease;
          background: white;
          width: 100%;
      }

      .form-control-modern:focus {
          border-color: var(--primary-color);
          box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.1);
          outline: none;
      }

      .form-label-modern {
          font-weight: 600;
          color: var(--dark-color);
          margin-bottom: 0.5rem;
          display: block;
      }

      .input-group-modern {
          position: relative;
          margin-bottom: 1.5rem;
      }

      .input-icon {
          position: absolute;
          left: 1rem;
          top: 50%;
          transform: translateY(-50%);
          color: var(--text-muted);
          z-index: 10;
      }

      .input-icon + .form-control-modern {
          padding-left: 3rem;
      }

      .btn-modern {
          padding: 0.875rem 2rem;
          border-radius: 12px;
          font-weight: 600;
          font-size: 1rem;
          border: none;
          transition: all 0.3s ease;
          cursor: pointer;
          text-decoration: none;
          display: inline-flex;
          align-items: center;
          gap: 0.5rem;
      }

      .btn-primary-modern {
          background: linear-gradient(135deg, var(--primary-light), var(--accent-color));
          color: white;
          border: none;
          box-shadow: 0 4px 15px rgba(96, 165, 250, 0.3);
      }

      .btn-primary-modern:hover {
          transform: translateY(-2px);
          box-shadow: 0 8px 25px rgba(96, 165, 250, 0.4);
          color: white;
          background: linear-gradient(135deg, #60a5fa, #059669);
      }

      .btn-success-modern {
          background: linear-gradient(135deg, var(--success-color), #047857);
          color: white;
      }

      .btn-success-modern:hover {
          transform: translateY(-2px);
          box-shadow: var(--shadow-lg);
          color: white;
      }

      .car-summary {
          background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
          border-radius: 16px;
          padding: 2rem;
          border: 1px solid var(--border-color);
          position: sticky;
          top: 2rem;
      }

      .car-image {
          width: 100%;
          border-radius: 12px;
          margin-bottom: 1.5rem;
          box-shadow: var(--shadow-md);
      }

      .car-title {
          font-size: 1.5rem;
          font-weight: 700;
          color: var(--dark-color);
          text-align: center;
          margin-bottom: 1.5rem;
      }

      .pricing-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 0.75rem 0;
          border-bottom: 1px solid var(--border-color);
      }

      .pricing-item:last-child {
          border-bottom: none;
          font-weight: 700;
          font-size: 1.1rem;
          color: var(--primary-color);
      }

      .pricing-label {
          color: var(--text-muted);
      }

      .pricing-value {
          font-weight: 600;
          color: var(--dark-color);
      }

      .alert-modern {
          border-radius: 12px;
          padding: 1rem 1.5rem;
          margin-bottom: 1.5rem;
          border: none;
          display: flex;
          align-items: center;
          gap: 0.75rem;
      }

      .alert-success-modern {
          background: #dcfce7;
          color: #166534;
      }

      .alert-danger-modern {
          background: #fef2f2;
          color: #991b1b;
      }

      .checkbox-modern {
          display: flex;
          align-items: flex-start;
          gap: 0.75rem;
          margin-bottom: 1.5rem;
          padding: 1rem;
          background: var(--light-bg);
          border-radius: 12px;
          border: 1px solid var(--border-color);
      }

      .checkbox-modern input[type="checkbox"] {
          margin-top: 0.25rem;
          transform: scale(1.2);
      }

      .coupon-section {
          background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
          border-radius: 12px;
          padding: 1.5rem;
          margin-bottom: 1.5rem;
      }

      .coupon-input-group {
          display: flex;
          gap: 0.75rem;
          margin-top: 1rem;
      }

      .security-payment-section {
          background: linear-gradient(135deg, #e0f2fe 0%, #b3e5fc 100%);
          border-radius: 12px;
          padding: 1.5rem;
          margin-bottom: 1.5rem;
      }

      .time-grid {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 1rem;
      }

      @media (max-width: 768px) {
          .checkout-container {
              margin: 1rem;
              border-radius: 16px;
          }
          
          .checkout-header {
              padding: 1.5rem;
          }
          
          .checkout-header h1 {
              font-size: 2rem;
          }
          
          .checkout-content {
              padding: 1rem;
          }
          
          .form-section {
              padding: 1.5rem;
          }
          
          .time-grid {
              grid-template-columns: 1fr;
          }
      }

      .progress-steps {
          display: flex;
          justify-content: center;
          margin-bottom: 2rem;
      }

      .step {
          display: flex;
          align-items: center;
          gap: 0.5rem;
          padding: 0.5rem 1rem;
          border-radius: 20px;
          background: var(--primary-color);
          color: white;
          font-weight: 600;
      }

      /* jQuery UI Datepicker Styling */
      .ui-datepicker {
          border-radius: 12px !important;
          border: 1px solid var(--border-color) !important;
          box-shadow: var(--shadow-lg) !important;
      }

      .ui-datepicker-header {
          background: var(--primary-color) !important;
          color: white !important;
          border-radius: 12px 12px 0 0 !important;
      }

      /* Terms & Conditions Modal Styles */
      .modal-overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.6);
          backdrop-filter: blur(5px);
          z-index: 10000;
          display: flex;
          align-items: center;
          justify-content: center;
          animation: fadeIn 0.3s ease-out;
      }

      .modal-content-modern {
          background: white;
          border-radius: 20px;
          max-width: 500px;
          width: 90%;
          max-height: 80vh;
          overflow: hidden;
          box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
          animation: slideUp 0.3s ease-out;
      }

      .modal-header-modern {
          background: linear-gradient(135deg, #60a5fa 0%, #34d399 100%);
          color: white;
          padding: 1.5rem 2rem;
          display: flex;
          justify-content: space-between;
          align-items: center;
      }

      .modal-header-modern h2 {
          margin: 0;
          font-size: 1.5rem;
          font-weight: 600;
      }

      .close-modal {
          background: none;
          border: none;
          color: white;
          font-size: 1.5rem;
          cursor: pointer;
          padding: 0.5rem;
          border-radius: 50%;
          transition: background-color 0.3s ease;
      }

      .close-modal:hover {
          background: rgba(255, 255, 255, 0.2);
      }

      .modal-body-modern {
          padding: 2rem;
      }

      .terms-options {
          display: grid;
          gap: 1rem;
      }

      .option-card {
          border: 2px solid var(--border-color);
          border-radius: 12px;
          padding: 1.5rem;
          cursor: pointer;
          transition: all 0.3s ease;
          text-align: center;
      }

      .option-card:hover {
          border-color: var(--primary-color);
          background: rgba(37, 99, 235, 0.05);
          transform: translateY(-2px);
          box-shadow: var(--shadow-md);
      }

      .option-card i {
          font-size: 2rem;
          color: var(--primary-color);
          margin-bottom: 1rem;
      }

      .option-card h3 {
          font-size: 1.1rem;
          font-weight: 600;
          margin-bottom: 0.5rem;
          color: var(--dark-color);
      }

      .option-card p {
          color: var(--text-muted);
          margin: 0;
          font-size: 0.9rem;
      }

      @keyframes fadeIn {
          from { opacity: 0; }
          to { opacity: 1; }
      }

      @keyframes slideUp {
          from {
              opacity: 0;
              transform: translateY(30px) scale(0.95);
          }
          to {
              opacity: 1;
              transform: translateY(0) scale(1);
          }
      }
      </style>
   </head>

   <body>
      <?php include("includes/site-header-inner.php"); ?>
      
      <div class="checkout-container">
         <!-- Header Section -->
         <div class="checkout-header">
            <div class="progress-steps">
               <div class="step">
                  <i class="fas fa-check-circle"></i>
                  Complete Your Booking
               </div>
            </div>
            <h1><i class="fas fa-car me-3"></i>Secure Checkout</h1>
            <p>Complete your booking details and secure your self-drive car rental</p>
         </div>

         <!-- Main Content -->
         <div class="checkout-content">
            <div class="row">
               <!-- Booking Form -->
               <div class="col-lg-8">
                  <form action="razorpayment.php" method="POST" enctype="multipart/form-data">
                     <!-- Hidden Fields -->
                     <input type="hidden" name="car_id" id="car_id" value="<?php echo $get_car_dta[0]['id']; ?>" />
                     <input type="hidden" name="csrf" value="<?php echo $_SESSION["token"]; ?>" />
                     <input type="hidden" name="totalAmt" id="totalAmt" value="" />
                     <input type="hidden" name="gvcode" id="gvcode" value="" />
                     <input type="hidden" name="gvamount" id="gvamount" value="0" />
                     <input type="hidden" name="wkdayshr" id="wkdayshr" value="0" />
                     <input type="hidden" name="wkendhr" id="wkendhr" value="0" />
                     <input type="hidden" name="wkdaysamnt" id="wkdaysamnt" value="0" />
                     <input type="hidden" name="wkendamnt" id="wkendamnt" value="0" />
                     <input type="hidden" name="carnme" id="carnme" value="<?php echo $get_car_dta[0][$vehicle_name_field]; ?>" />
                     <input type="hidden" id="securitymoneyprice" name='securitymoneyprice' value="<?php echo $get_car_dta[0]['security']; ?>" />

                     <!-- Personal Information Section -->
                     <div class="form-section">
                        <div class="section-title">
                           <div class="section-icon">
                              <i class="fas fa-user"></i>
                           </div>
                           Personal Information
                        </div>
                        
                        <div class="row">
                           <div class="col-md-12 mb-3">
                              <label class="form-label-modern">City</label>
                              <?php
                              $city_id = $get_car_dta[0]['city'];
                              $get_city_dta = $dbObj->fetch_data("location", "id = '$city_id'");
                              ?>
                              <div class="input-group-modern">
                                 <i class="fas fa-map-marker-alt input-icon"></i>
                                 <input type="text" value="<?= $get_city_dta[0]['city_location']; ?>" disabled class="form-control-modern" name="city" id="city" autocomplete="off" required>
                                 <input type="hidden" name="city1" value="<?php echo $get_city_dta[0]['city_location']; ?>" />
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Full Name *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-user input-icon"></i>
                                 <input type="text" value="<?php echo isset($_SESSION['booking_name']) ? $_SESSION['booking_name'] : ''; ?>" data-msg-required="Please enter your name." maxlength="100" class="form-control-modern" name="name" id="name" autocomplete="off" required placeholder="Enter your full name">
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Email Address *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-envelope input-icon"></i>
                                 <input type="email" value="<?php echo isset($_SESSION['booking_email']) ? $_SESSION['booking_email'] : ''; ?>" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." autocomplete="off" maxlength="100" class="form-control-modern" name="email" id="email" required placeholder="your@email.com">
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Mobile Number *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-phone input-icon"></i>
                                 <input type="number" value="<?php echo isset($_SESSION['booking_phone']) ? $_SESSION['booking_phone'] : ''; ?>" data-msg-required="Please enter mobile number." maxlength="10" class="form-control-modern" name="phone" autocomplete="off" id="phone" required placeholder="10-digit mobile number">
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Date of Birth (License) *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-calendar input-icon"></i>
                                 <input type="text" value="<?php echo isset($_SESSION['booking_dob']) ? $_SESSION['booking_dob'] : ''; ?>" data-msg-required="Please enter DOB." class="form-control-modern" name="dob" autocomplete="off" id="dob" placeholder="YYYY-MM-DD" required>
                              </div>
                           </div>
                           <div class="col-md-12 mb-3">
                              <label class="form-label-modern">Driving License Number *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-id-card input-icon"></i>
                                 <input type="text" class="form-control-modern" name="licenseNumber" autocomplete="off" id="licenseNumber" maxlength="18" required placeholder="Enter your driving license number" value="<?php echo isset($_SESSION['booking_license']) ? $_SESSION['booking_license'] : ''; ?>" />
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Location & Schedule Section -->
                     <div class="form-section">
                        <div class="section-title">
                           <div class="section-icon">
                              <i class="fas fa-map-marked-alt"></i>
                           </div>
                           Pickup & Drop-off Details
                        </div>
                        
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Pickup Location *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-map-pin input-icon"></i>
                                 <select class="form-control-modern" name="pickuploc" id="pickuploc" required>
                                    <?php
                                    $get_location_data1 = $dbObj->fetch_data("location", "id=" . $get_city_dta[0]['id']);
                                    foreach ($get_location_data1 as $data1) {
                                       ?>
                                       <option selected value="<?= $data1['id']; ?>">
                                          <?= $data1['pickup_point']; ?>
                                       </option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Drop-off Location *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-flag-checkered input-icon"></i>
                                 <select class="form-control-modern" name="droploc" id="droploc" required>
                                    <?php
                                    foreach ($get_location_data1 as $data1) {
                                       ?>
                                       <option selected value="<?= $data1['drop_point']; ?>">
                                          <?= $data1['drop_point']; ?>
                                       </option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Pickup Date *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-calendar-alt input-icon"></i>
                                 <input type="text" maxlength="100" class="form-control-modern" name="pdate" value="<?php echo $pdate; ?>" id="pdate" autocomplete="off" required onChange="return calculateTime($('#dtime').val(), this.value, $('#ptime').val(), $('#ddate').val());" placeholder="Select pickup date">
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Pickup Time *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-clock input-icon"></i>
                                 <select class="form-control-modern" name="ptime" id="ptime" required onChange="return calculateTime($('#dtime').val(), $('#pdate').val(), this.value, $('#ddate').val());">
                                    <option value="">Select Time</option>
                                    <?php
                                    for ($i = 6; $i < 24; $i++) {
                                       $num = $i > 23 ? $i - 24 : $i;
                                       $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                       if ($ptime == $num) {
                                          $sel = 'selected';
                                       } else {
                                          $sel = '';
                                       }
                                       echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Drop-off Date *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-calendar-check input-icon"></i>
                                 <input type="text" value="<?php echo $ddate; ?>" maxlength="100" class="form-control-modern" name="ddate" autocomplete="off" id="ddate" required onBlur="return calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), this.value);" placeholder="Select drop-off date">
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label-modern">Drop-off Time *</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-clock input-icon"></i>
                                 <select class="form-control-modern" name="dtime" id="dtime" required onChange="return calculateTime(this.value, $('#pdate').val(), $('#ptime').val(), $('#ddate').val());">
                                    <option value="">Select Time</option>
                                    <?php
                                    for ($i = 6; $i < 24; $i++) {
                                       $num = $i > 23 ? $i - 24 : $i;
                                       $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                       if ($dtime == $num) {
                                          $sel = 'selected';
                                       } else {
                                          $sel = '';
                                       }
                                       echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12 mb-3">
                              <label class="form-label-modern">Special Requirements or Message</label>
                              <div class="input-group-modern">
                                 <i class="fas fa-comment-alt input-icon"></i>
                                 <textarea maxlength="5000" data-msg-required="Please enter your message." rows="4" class="form-control-modern" name="message" id="message" placeholder="Any special requirements, pickup instructions, or additional notes..."><?php echo isset($_SESSION['booking_message']) ? $_SESSION['booking_message'] : ''; ?></textarea>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Coupon Section -->
                     <div class="coupon-section">
                        <h5><i class="fas fa-tag me-2"></i>Have a Coupon Code?</h5>
                        <p class="mb-0 text-muted">Apply your discount coupon below</p>
                        <div class="coupon-input-group">
                           <input type="text" data-msg-required="Invalid Coupon." class="form-control-modern" name="coupon" autocomplete="off" id="coupon" placeholder="Enter coupon code" />
                           <button type="button" name='checkgv' id='checkgv' class="btn btn-warning btn-modern">
                              <i class="fas fa-check"></i> Apply Coupon
                           </button>
                        </div>
                        <small id='cpnmsg' class="d-block mt-2"></small>
                     </div>

                     <!-- Security Payment Section -->
                     <div class="security-payment-section">
                        <h5><i class="fas fa-shield-alt me-2"></i>Security Payment Option</h5>
                        <p class="mb-3 text-muted">Choose how you want to pay the refundable security deposit</p>
                        <select class="form-control-modern" name='securityPayment' id="security-payment-type">
                           <option value="cash">Cash (Pay at Pickup Location)</option>
                        </select>
                     </div>

                     <!-- Terms & Conditions -->
                     <div class="checkbox-modern">
                        <input type="checkbox" required id="terms-checkbox">
                        <label for="terms-checkbox">
                           I have read and accepted all 
                           <a href="#" id="terms-link" style="color: var(--primary-color); font-weight: 600; text-decoration: underline;" onclick="openTermsModal()">Terms & Conditions</a>, 
                           payment policies, and booking guidelines. *
                        </label>
                     </div>

                     <!-- Terms & Conditions Modal -->
                     <div id="termsModal" class="modal-overlay" style="display: none;">
                        <div class="modal-content-modern">
                           <div class="modal-header-modern">
                              <h2><i class="fas fa-file-contract me-2"></i>Terms & Conditions</h2>
                              <button type="button" class="close-modal" onclick="closeTermsModal()">
                                 <i class="fas fa-times"></i>
                              </button>
                           </div>
                           <div class="modal-body-modern">
                              <div class="terms-options">
                                 <div class="option-card" onclick="openTermsInNewTab()">
                                    <i class="fas fa-external-link-alt"></i>
                                    <h3>View in New Tab</h3>
                                    <p>Open Terms & Conditions in a new browser tab</p>
                                 </div>
                                 <div class="option-card" onclick="redirectToTerms()">
                                    <i class="fas fa-arrow-right"></i>
                                    <h3>Go to FAQ Page</h3>
                                    <p>Navigate directly to our FAQ & Terms page</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Submit Button -->
                     <div class="text-center">
                        <button type="submit" id='book_now' name='reserve' class="btn btn-primary-modern btn-lg">
                           <i class="fas fa-lock me-2"></i>
                           Secure My Booking Now
                        </button>
                        <a href="razorpayment.php" id="reserve_with_razorpay" name="reserve" class="btn btn-success-modern btn-lg ms-3" style="display:none;">
                           <i class="fas fa-credit-card me-2"></i>
                           Pay with Razorpay
                        </a>
                     </div>
                  </form>
               </div>
               <!-- Car Summary -->
               <div class="col-lg-4">
                  <div class="car-summary">
                     <img src="uploadedDocument/<?php echo $vehicle_image_folder; ?>/<?php echo $get_car_dta[0][$vehicle_image_field]; ?>" class="car-image" alt="<?php echo $get_car_dta[0][$vehicle_name_field]; ?>">
                     
                     <h3 class="car-title"><?php echo $get_car_dta[0][$vehicle_name_field]; ?></h3>
                     
                     <div class="pricing-details">
                        <div class="pricing-item">
                           <span class="pricing-label">Regular Days</span>
                           <span class="pricing-value">₹<span id="price"><?php echo $get_car_dta[0]['cost']; ?></span> / 24 Hr</span>
                        </div>
                        
                        <div class="pricing-item">
                           <span class="pricing-label">Weekend Price</span>
                           <span class="pricing-value">₹<?php echo $get_car_dta[0]['weekend_cost']; ?> / 24 Hr</span>
                        </div>
                        
                        <div class="pricing-item">
                           <span class="pricing-label">Security Deposit</span>
                           <span class="pricing-value">₹<?php echo $get_car_dta[0]['security']; ?> (Refundable)</span>
                        </div>
                        
                        <div id='weekday' class="mt-3"></div>
                        <div id="wkendPrice" class="mt-2"></div>
                        <div id="discount" class="mt-2"></div>
                        
                        <hr class="my-3">
                        
                        <div class="pricing-item">
                           <span class="pricing-label"><strong>Total Amount</strong></span>
                           <span class="pricing-value" id="finalPrice">
                              <span class="text-primary fw-bold">Calculating...</span>
                           </span>
                        </div>
                     </div>
                     
                     <div class="mt-4 p-3 bg-light rounded">
                        <h6 class="fw-bold mb-2"><i class="fas fa-shield-alt text-success me-2"></i>Booking Benefits</h6>
                        <ul class="list-unstyled mb-0">
                           <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Free Cancellation</li>
                           <li class="mb-1"><i class="fas fa-check text-success me-2"></i>24/7 Customer Support</li>
                           <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Instant Confirmation</li>
                           <li><i class="fas fa-check text-success me-2"></i>Verified Cars</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <?php include("includes/site-footer.php"); ?>
      </div>
      
      <!-- Modern Scripts -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <?php include("includes/inc-js.php"); ?>
      
      
      
      <script>
         $(document).ready(function () {
        // Get the user's IP address using an external API
        $.get('https://api.ipify.org?format=json', function(data) {
            var userIp = data.ip;

            // Check if the user's IP matches the specific IP
            if (userIp === '124.253.128.203') {
                // Show the "Reserve Now With Razorpay" button if IP matches
                $('#reserve_with_razorpay').show();
            } else {
                // Hide the "Reserve Now With Razorpay" button if IP doesn't match
                $('#reserve_with_razorpay').hide();
            }
        });
    

            var date1 = new Date('<?php echo $pdate . " " . $ptime; ?>'.replace(/-/g, "/"));

            var date2 = new Date('<?php echo $ddate . " " . $dtime; ?>'.replace(/-/g, "/"));

            var totalHr = diff_hours(date1, date2);

            var perHr = <?php echo $get_car_dta[0]['cost'] / 24; ?>;

            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var dayName = days[date1.getDay()];
            if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
               actuyalprice = <?php echo $get_car_dta[0]['weekend_cost']; ?>;

            } else {
               actuyalprice = <?php echo $get_car_dta[0]['cost']; ?>;
            }

            if (totalHr <= 12) {
               actuyalprice = actuyalprice / 2;
            }

            //var totalAmt = calc_price(date1, date2);
            var totalAmt = (totalHr <= 12) ? actuyalprice : calc_price(date1, date2);


            $('#totalAmt').val(Math.round(totalAmt + <?php echo $get_car_dta[0]['security']; ?>));
            $('#finalPrice').html('<span class="fw-bold text-primary fs-5">₹' + Math.round(totalAmt) + '</span>');

            $("#security-payment-type").change(function () {
               var securityPaymentType = $(this).val();
               var totalpayable = $('#totalAmt').val();

               //if Gv applied then final price
               var gvrequiredAmount = Math.round(totalpayable - <?php echo $get_car_dta[0]['security']; ?>);
               var applycoupon = $('#gvcode').val();
               var discountprice = 0;
               if (gvrequiredAmount > 3500 && applycoupon == "successgv") {
                  discountprice = $('#gvamount').val();
               } else {
                  $('#discount').html('');
                  $('#gvcode').val("");
                  $('#cpnmsg').html("");
               }

               if (securityPaymentType == "cash") {
                  $('#finalPrice').html('<span class="fw-bold text-primary fs-5">₹' + Math.round(totalpayable - <?php echo $get_car_dta[0]['security']; ?> - discountprice) + '</span>');
               }
               if (securityPaymentType == "online") {
                  $('#finalPrice').html('<span class="fw-bold text-primary fs-5">₹' + Math.round(totalpayable - discountprice) + '</span>');
               }
            });



            $('#ptime').val('<?php echo $ptime; ?>');

            $('#dtime').val('<?php echo $dtime; ?>');


            $("#dob").datepicker({

               dateFormat: "yy-mm-dd",

               maxDate: '<?php echo $dat = date("Y-m-d", strtotime('-21 years')); ?>',

            });

            $("#pdate").datepicker({

               dateFormat: "yy-mm-dd",

               minDate: 0,

               onSelect: function (date) {

                  calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), $('#ddate').val());

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

                  calculateTime($('#dtime').val(), $('#pdate').val(), $('#ptime').val(), $('#ddate').val());

                  var dt1 = $('#pdate').datepicker('getDate');

                  var dt2 = $('#ddate').datepicker('getDate');

                  //check to prevent a user from entering a date below date of dt1

                  if (dt2 < dt1) {

                     var minDate = $('#ddate').datepicker('option', 'minDate');

                     $('#ddate').datepicker('setDate', minDate);

                  }

               }

            });
            $("#book_now").click(function (e) {
               // Validate required fields
               var name = $('#name').val();
               var email = $('#email').val();
               var phone = $('#phone').val();
               var dob = $('#dob').val();
               var licenseNumber = $('#licenseNumber').val();
               var pdate = $('#pdate').val();
               var ptime = $('#ptime').val();
               var ddate = $('#ddate').val();
               var dtime = $('#dtime').val();
               
               // Check if all required fields are filled
               if (!name || !email || !phone || !dob || !licenseNumber) {
                  e.preventDefault();
                  alert("Please fill in all required personal information fields.");
                  return false;
               }
               
               if (!pdate || !ptime || !ddate || !dtime) {
                  e.preventDefault();
                  alert("Please select pickup and drop-off dates and times.");
                  return false;
               }
               
               // Validate phone number (basic validation)
               if (!/^\d{10}$/.test(phone)) {
                  e.preventDefault();
                  alert("Please enter a valid 10-digit mobile number.");
                  return false;
               }
               
               // Run time calculation and validation
               var result = calculateTime(dtime, pdate, ptime, ddate);
               if (result === false) {
                  e.preventDefault();
                  return false;
               }
               
               // Check if terms are accepted
               if (!$('#terms-checkbox').is(':checked')) {
                  e.preventDefault();
                  alert("Please accept the Terms & Conditions to proceed.");
                  return false;
               }
               
               // All validations passed, allow form submission
               return true;
            });


            // Check Coupon code checkgv
            $("#checkgv").click(function () {
               var gvcoupon = $('#coupon').val();
               var phonenumber = $('#phone').val();
               var bookingAmount = $('#totalAmt').val() - $('#securitymoneyprice').val();

               $.post("checkgv.php", { phone: phonenumber, voucher: gvcoupon, bookAmont: bookingAmount }, function (data) {

                  var pay_type = "online";
                  var secure_price = <?php echo $get_car_dta[0]['security'] ?>;
                  if ($('#security-payment-type').val() == "cash") {
                     pay_type = "cash";
                     secure_price = 0;
                  }

                  if (data['status'] == 'success') {
                     $('#gvcode').val("successgv");
                     $('#discount').html('<div class="alert alert-success-modern mt-2"><i class="fas fa-tag me-2"></i>Discount Applied: ₹' + data['coupon_amount'] + '</div>');
                     $('#gvamount').val(data['coupon_amount']);
                     $('#cpnmsg').html('<span class="text-success fw-bold">' + data['msg'] + '</span>');
                     $('#security-payment-type').val(pay_type);

                     $('#finalPrice').html('<span class="fw-bold text-primary fs-5">₹' + Math.round(bookingAmount + secure_price - data['coupon_amount']) + '</span>');

                  } else {
                     $('#gvcode').val("");
                     $('#cpnmsg').html('<span class="text-danger fw-bold">' + data['msg'] + '</span>');
                     $('#discount').html('');
                     $('#gvamount').val(0);
                     $('#security-payment-type').val(pay_type);

                     $('#finalPrice').html('<span class="fw-bold text-primary fs-5">₹' + Math.round(bookingAmount + secure_price) + '</span>');
                  }
               }, "json");
            });



         });


         <?php
         $get_hour_res = $dbObj->fetch_data("tbl_min_hour", "status = '1'");
         $min_book_hour = $get_hour_res[0]['hours'];
         ?>
         function calculateTime(dropTime, pdate, ptime, ddate) {

            // Check if all required fields are provided
            if (!dropTime || !pdate || !ptime || !ddate || dropTime == "0" || dropTime == "") {
               return true; // Allow form submission if no times are selected yet
            }

            var pickTime = pdate + " " + ptime;
            var dropTimeh = ddate + " " + dropTime;

            try {
               var dt1 = new Date(pickTime.replace(/-/g, "/"));
               var dt2 = new Date(dropTimeh.replace(/-/g, "/"));

               // Check if dates are valid
               if (isNaN(dt1.getTime()) || isNaN(dt2.getTime())) {
                  alert("Please select valid pickup and drop-off dates and times.");
                  return false;
               }

               var t = diff_hours(dt1, dt2);

               if (t < <?= $min_book_hour; ?>) {
                  alert("Sorry, you need to select more than <?= $min_book_hour; ?> hours for booking.");
                  $('#ptime').val('');
                  $('#dtime').val('');
                  return false;
               }
               
               if (dt2 < dt1) {
                  alert("Sorry, drop-off time cannot be earlier than pickup time.");
                  $('#ptime').val('');
                  $('#dtime').val('');
                  return false;
               }

               var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
               var dayName = days[dt1.getDay()];
               if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
                  actuyalprice = <?php echo $get_car_dta[0]['weekend_cost']; ?>;
               } else {
                  actuyalprice = <?php echo $get_car_dta[0]['cost']; ?>;
               }
               if (t <= 12) {
                  actuyalprice = actuyalprice / 2;
               }

               var ct = actuyalprice / 24;
               var tot = (t <= 12) ? actuyalprice : calc_price(dt1, dt2);

               var applycoupon = $('#gvcode').val();
               var discountprice = 0;
               if (tot > 3500 && applycoupon == "successgv") {
                  discountprice = $('#gvamount').val();
               } else {
                  $('#discount').html('');
                  $('#gvcode').val("");
                  $('#cpnmsg').html("");
               }

               // check payment type and set price based on that
               var pay_type = "online";
               var secure_price = <?php echo $get_car_dta[0]['security'] ?>;
               if ($('#security-payment-type').val() == "cash") {
                  pay_type = "cash";
                  secure_price = 0;
               }

               $('#totalAmt').val(Math.round(tot + <?php echo $get_car_dta[0]['security']; ?>));
               $('#finalPrice').html('<span class="fw-bold text-primary fs-5">₹' + Math.round(tot + secure_price - discountprice) + '</span>');
               $('#security-payment-type').val(pay_type);

               return true; // Successful calculation
               
            } catch (error) {
               console.error('Error in calculateTime:', error);
               return true; // Allow form submission even if calculation fails
            }
         }

         function diff_hours(dt2, dt1) {



            var diff = (dt2.getTime() - dt1.getTime()) / 1000;

            diff /= (60 * 60);

            return Math.abs(Math.round(diff));


         }
         function calc_price(frmDate, toDate) {
            // MY CODE ***************
            var day_start_dt = new Date(frmDate); //new Date("2018-03-09 09:00");

            var day_start_date = new Date(frmDate); //new Date("2018-03-09 09:00");
            var day_end = new Date(toDate); //new Date("2018-03-12 10:00");

            //*************************

            var end_date_only = new Date(day_end.getFullYear() + "/" + (day_end.getMonth() + 1) + "/" + day_end.getDate());  // only date not time
            var start_date_only = new Date(day_start_date.getFullYear() + "/" + (day_start_date.getMonth() + 1) + "/" + day_start_date.getDate());  // only date not time

            //var total_days = (day_end - day_start_dt) / (1000 * 60 * 60 * 24);
            var total_day_hour = (day_end.getTime() - start_date_only.getTime()) / 1000;
            total_day_hour /= (60 * 60);
            total_day_hour = Math.round(total_day_hour);



            var no_of_loop = Math.ceil(total_day_hour / 24);

            if (total_day_hour % 24 == 0) {

               no_of_loop += 1;
            }


            var price = 0;
            var totalHourPerday = 0;
            var total_price = 0;
            var wkend_price = 0;
            var weekend_hour = 0;
            var wkday_price = 0;
            var weekday_hour = 0;

            for (var i = 0; i < no_of_loop; i++) {

               // getting day name from date
               var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
               var dayName = days[day_start_dt.getDay()];

               if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
                  price = <?php echo $get_car_dta[0]['weekend_cost']; ?>;

               } else {
                  price = <?php echo $get_car_dta[0]['cost']; ?>;
               }
               var perhour = price / 24;

               var newstartTime = new Date(day_start_date.setDate(day_start_dt.getDate() + 1)); // next day start is end of last date
               newstartTime = new Date(newstartTime.getFullYear() + "/" + (newstartTime.getMonth() + 1) + "/" + newstartTime.getDate() + " 00:00");  // next day start is end of last date

               //console.log(newstartTime);

               var cur_date = new Date(day_start_dt.getFullYear() + "/" + (day_start_dt.getMonth() + 1) + "/" + day_start_dt.getDate());  // only date not time
               var end_date = new Date(day_end.getFullYear() + "/" + (day_end.getMonth() + 1) + "/" + day_end.getDate());  // only date not time
               // Calculate total hour
               var current_day_start = newstartTime;

               // Total hour per day
               var diff = (newstartTime.getTime() - day_start_dt.getTime()) / 1000;
               diff /= (60 * 60);
               totalHourPerday = Math.round(diff);



               if ("'" + cur_date + "'" == "'" + end_date + "'") {
                  var diff = (day_end.getTime() - day_start_dt.getTime()) / 1000;
                  diff /= (60 * 60);
                  totalHourPerday = Math.round(diff);
                  total_price += Math.round(totalHourPerday * perhour);

                  console.log(cur_date + " : " + totalHourPerday + " : " + perhour + " : " + total_price);

               } else {

                  total_price += Math.round(totalHourPerday * perhour);

                  //console.log(totalHourPerday+" : "+total_price);
                  console.log(cur_date + " : " + totalHourPerday + " : " + perhour + " : " + total_price);
               }
               if (dayName == 'Saturday' || dayName == 'Sunday' || dayName == 'Friday') {
                  wkend_price += perhour * totalHourPerday;
                  weekend_hour += totalHourPerday;

               } else {
                  wkday_price += perhour * totalHourPerday;
                  weekday_hour += totalHourPerday;
               }

               day_start_dt = newstartTime;


            }
            if (wkend_price > 0) {

               $('#wkdayshr').val(weekday_hour);
               $('#wkendhr').val(weekend_hour);
               $('#wkdaysamnt').val(wkday_price);
               $('#wkendamnt').val(wkend_price);

               $("#wkendPrice").html("<div class='pricing-item'><span class='pricing-label'>Weekend Hours (" + weekend_hour + " hrs)</span><span class='pricing-value'>₹" + Math.round(wkend_price) + "</span></div>");

               $("#weekday").html("<div class='pricing-item'><span class='pricing-label'>Regular Hours (" + weekday_hour + " hrs)</span><span class='pricing-value'>₹" + Math.round(wkday_price) + "</span></div>");
            } else {
               $('#wkdayshr').val(weekday_hour);
               $('#wkdaysamnt').val(wkday_price);

               $("#wkendPrice").html("");

               $("#weekday").html("<div class='pricing-item'><span class='pricing-label'>Regular Hours (" + weekday_hour + " hrs)</span><span class='pricing-value'>₹" + Math.round(wkday_price) + "</span></div>");
            }
            return total_price;
         }

         // Terms & Conditions Modal Functions
         function openTermsModal() {
            $('#termsModal').fadeIn(300);
            $('body').css('overflow', 'hidden'); // Prevent background scrolling
         }

         function closeTermsModal() {
            $('#termsModal').fadeOut(300);
            $('body').css('overflow', 'auto'); // Restore scrolling
         }

         function openTermsInNewTab() {
            window.open('faq.php', '_blank');
            closeTermsModal();
         }

         function redirectToTerms() {
            window.location.href = 'faq.php';
         }

         // Close modal when clicking outside
         $(document).on('click', '.modal-overlay', function(e) {
            if (e.target === this) {
               closeTermsModal();
            }
         });

         // Close modal with ESC key
         $(document).keydown(function(e) {
            if (e.keyCode === 27) { // ESC key
               closeTermsModal();
            }
         });


      </script>
      
      <!-- Form Persistence Script -->
      <script type="text/javascript">
         // Form persistence functionality
         const FORM_STORAGE_KEY = 'eduxon_booking_form_data';
         
         // Save form data to localStorage
         function saveFormData() {
            const formData = {
               name: $('#name').val(),
               email: $('#email').val(),
               phone: $('#phone').val(),
               dob: $('#dob').val(),
               licenseNumber: $('#licenseNumber').val(),
               pickuploc: $('#pickuploc').val(),
               droploc: $('#droploc').val(),
               pdate: $('#pdate').val(),
               ptime: $('#ptime').val(),
               ddate: $('#ddate').val(),
               dtime: $('#dtime').val(),
               message: $('#message').val(),
               coupon: $('#coupon').val(),
               securityPayment: $('#security-payment-type').val(),
               timestamp: new Date().getTime()
            };
            
            try {
               localStorage.setItem(FORM_STORAGE_KEY, JSON.stringify(formData));
               console.log('Form data saved successfully');
            } catch (error) {
               console.error('Error saving form data:', error);
            }
         }
         
         // Restore form data from localStorage
         function restoreFormData() {
            try {
               const savedData = localStorage.getItem(FORM_STORAGE_KEY);
               if (savedData) {
                  const formData = JSON.parse(savedData);
                  
                  // Check if data is not too old (24 hours)
                  const currentTime = new Date().getTime();
                  const dataAge = currentTime - (formData.timestamp || 0);
                  const maxAge = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
                  
                  if (dataAge > maxAge) {
                     // Data is too old, clear it
                     localStorage.removeItem(FORM_STORAGE_KEY);
                     return;
                  }
                  
                  // Restore form fields (only if they're currently empty)
                  let restoredFields = [];
                  if (!$('#name').val() && formData.name) {
                     $('#name').val(formData.name);
                     restoredFields.push('Name');
                  }
                  if (!$('#email').val() && formData.email) {
                     $('#email').val(formData.email);
                     restoredFields.push('Email');
                  }
                  if (!$('#phone').val() && formData.phone) {
                     $('#phone').val(formData.phone);
                     restoredFields.push('Phone');
                  }
                  if (!$('#dob').val() && formData.dob) {
                     $('#dob').val(formData.dob);
                     restoredFields.push('Date of Birth');
                  }
                  if (!$('#licenseNumber').val() && formData.licenseNumber) {
                     $('#licenseNumber').val(formData.licenseNumber);
                     restoredFields.push('License Number');
                  }
                  if (!$('#message').val() && formData.message) {
                     $('#message').val(formData.message);
                     restoredFields.push('Message');
                  }
                  if (!$('#coupon').val() && formData.coupon) {
                     $('#coupon').val(formData.coupon);
                     restoredFields.push('Coupon');
                  }
                  
                  // Restore dropdowns
                  if (formData.pickuploc) $('#pickuploc').val(formData.pickuploc);
                  if (formData.droploc) $('#droploc').val(formData.droploc);
                  if (formData.securityPayment) $('#security-payment-type').val(formData.securityPayment);
                  
                  // Show notification if any fields were restored
                  if (restoredFields.length > 0) {
                     showRestoreNotification(restoredFields);
                  }
                  
                  console.log('Form data restored successfully');
               }
            } catch (error) {
               console.error('Error restoring form data:', error);
               // Clear corrupted data
               localStorage.removeItem(FORM_STORAGE_KEY);
            }
         }
         
         // Clear saved form data
         function clearSavedFormData() {
            localStorage.removeItem(FORM_STORAGE_KEY);
            console.log('Saved form data cleared');
         }
         
         // Show notification when form data is restored
         function showRestoreNotification(restoredFields) {
            const notification = $(`
               <div class="alert alert-info alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050; max-width: 350px;">
                  <i class="fas fa-info-circle me-2"></i>
                  <strong>Form Data Restored!</strong><br>
                  We've restored your previously entered: ${restoredFields.join(', ')}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            `);
            
            $('body').append(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
               notification.fadeOut(500, function() {
                  $(this).remove();
               });
            }, 5000);
         }
         
         $(document).ready(function() {
            // Restore form data on page load
            restoreFormData();
            
            // Save form data on input changes (with debouncing)
            let saveTimeout;
            const formFields = '#name, #email, #phone, #dob, #licenseNumber, #pickuploc, #droploc, #pdate, #ptime, #ddate, #dtime, #message, #coupon, #security-payment-type';
            
            $(document).on('input change', formFields, function() {
               clearTimeout(saveTimeout);
               saveTimeout = setTimeout(saveFormData, 1000); // Save after 1 second of inactivity
            });
            
            // Save form data before going to payment
            $('form').on('submit', function() {
               saveFormData();
               console.log('Form data saved before payment submission');
            });
            
            // Clear saved data when booking is successfully completed
            // This would typically be called from a success page
            window.clearBookingFormData = clearSavedFormData;
         });
         
         // Check for successful booking completion (if redirected back)
         $(window).on('load', function() {
            // If there's a success parameter in URL, clear the saved data
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('booking_success') === 'true') {
               clearSavedFormData();
            }
         });
      </script>
      
      <script type="text/javascript">
         $(document).ready(function () {
            //Disable cut copy paste
            $('body').bind('cut copy paste', function (e) {
               e.preventDefault();
            });
         
                Disable mouse right click
            $("body").on("contextmenu", function (e) {
               return false;
            });
         });
      </script>
   </body>

   </html>
   <?php
} else {

   header("location:index.php");
}
?>