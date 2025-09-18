<?php
session_start();

require_once "includes/settings.php";
require_once "includes/database.php";
require_once "includes/classes/db.cls.php";
require_once "includes/classes/sitedata.cls.php";
require_once "includes/functions/common.php";
require_once "includes/classes/DBquery.cls.php";

$db = new SiteData();
$dbObj = new dbquery();
$mysqli_conn = $db->getConnection();

// Handle form submission - Direct WhatsApp redirect
if (isset($_POST["act"]) && $_POST["act"] == "tour_enquiry") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $pickup_location = $_POST["pickup_location"];
    $travel_start_date = $_POST["travel_start_date"];
    $travel_end_date = $_POST["travel_end_date"];
    $travelers = $_POST["travelers"];
    $vehicle_type = $_POST["vehicle_type"];
    $package_interest = $_POST["package_interest"];
    $special_requests = $_POST["special_requests"];
    
    // Create WhatsApp message
    $whatsapp_message = "Hi, I am interested in your Odisha tour package.\n\n";
    $whatsapp_message .= "Details:\n";
    $whatsapp_message .= "Name: $name\n";
    $whatsapp_message .= "Phone: $phone\n";
    $whatsapp_message .= "Email: $email\n";
    if ($pickup_location) $whatsapp_message .= "Pickup: $pickup_location\n";
    if ($travel_start_date && $travel_end_date) $whatsapp_message .= "Travel Dates: $travel_start_date to $travel_end_date\n";
    if ($travelers) $whatsapp_message .= "Travelers: $travelers\n";
    if ($vehicle_type) $whatsapp_message .= "Vehicle: $vehicle_type\n";
    if ($package_interest) $whatsapp_message .= "Package Interest: $package_interest\n";
    if ($special_requests) $whatsapp_message .= "Special Requests: $special_requests\n";
    
    $whatsapp_url = "https://wa.me/919437144274?text=" . urlencode($whatsapp_message);
    
    // Direct redirect to WhatsApp
    header("Location: " . $whatsapp_url);
    exit();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<title>Odisha Tour Packages | Bhubaneswar Puri Konark Chilika Tours | EduxonCabs</title>
<meta name="keywords" content="Odisha tour packages, Bhubaneswar tour packages, Puri Konark tour, Chilika Lake tour, Satapada tour, Odisha heritage tour, temple tour Odisha, Odisha travel packages"/>
<meta name="description" content="Explore Odisha with our customized tour packages. Visit Bhubaneswar, Puri, Konark, Chilika Lake, Satapada with comfortable vehicles and expert drivers. Book your Odisha tour today!"/>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Site CSS -->
<?php include("includes/inc-css.php");?>
<link rel="stylesheet" href="assets/css/footer-center-fix.css">

<style>
* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

body {
    margin: 0;
    padding: 0;
    background-color: #f8fafc;
    color: #1e293b;
    line-height: 1.6;
}

/* Modern Hero Section */
.hero-banner {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.9), rgba(59, 130, 246, 0.8)),
                url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=2000') center/cover;
    min-height: 60vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.hero-content {
    text-align: center;
    color: white;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.25rem;
    font-weight: 400;
    margin-bottom: 2rem;
    opacity: 0.95;
    text-align: center !important;
    width: 100%;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.btn-hero {
    background: white;
    color: #2563eb;
    padding: 16px 32px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255,255,255,0.3);
}

.btn-hero:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,255,255,0.4);
    color: #1d4ed8;
    text-decoration: none;
}

/* Package Cards */
.package-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid #e2e8f0;
}

.package-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(37, 99, 235, 0.15);
}

.package-image {
    height: 220px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.package-badge {
    position: absolute;
    top: 16px;
    right: 16px;
    background: #2563eb;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.package-content {
    padding: 24px;
}

.package-title {
    font-size: 1.375rem;
    font-weight: 600;
    margin-bottom: 12px;
    color: #1e293b;
}

.package-duration {
    color: #64748b;
    font-size: 0.875rem;
    margin-bottom: 16px;
}

.package-highlights {
    margin-bottom: 20px;
}

.highlight-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    font-size: 0.9rem;
    color: #475569;
}

.highlight-item i {
    color: #22c55e;
    margin-right: 8px;
    width: 16px;
}

.btn-package {
    background: #2563eb;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    width: 100%;
    text-align: center;
}

.btn-package:hover {
    background: #1d4ed8;
    color: white;
    text-decoration: none;
}

/* Itinerary Section */
.itinerary-day {
    background: white;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-left: 4px solid #2563eb;
}

.day-number {
    background: #2563eb;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-bottom: 16px;
}

.day-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 12px;
    color: #1e293b;
}

.day-activities {
    color: #64748b;
    line-height: 1.7;
}

/* Form Styles */
.enquiry-form {
    background: white;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
}

.form-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #1e293b;
    text-align: center;
}

.form-subtitle {
    color: #64748b;
    text-align: center;
    margin-bottom: 32px;
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
}

/* Date Input Specific Styles */
input[type="date"].form-control {
    position: relative;
    cursor: pointer;
    background: white;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

input[type="date"].form-control::-webkit-calendar-picker-indicator {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    color: transparent;
    background: transparent;
    cursor: pointer;
    opacity: 0;
}

input[type="date"].form-control::-webkit-datetime-edit {
    padding: 0;
    color: #374151;
}

input[type="date"].form-control::-webkit-datetime-edit-fields-wrapper {
    padding: 0;
}

input[type="date"].form-control::-webkit-datetime-edit-text {
    color: #374151;
    padding: 0 2px;
}

input[type="date"].form-control::-webkit-datetime-edit-month-field,
input[type="date"].form-control::-webkit-datetime-edit-day-field,
input[type="date"].form-control::-webkit-datetime-edit-year-field {
    color: #374151;
    padding: 0 2px;
}

/* Add calendar icon overlay */
input[type="date"].form-control::before {
    content: "\f073";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    pointer-events: none;
    z-index: 1;
}

/* Mobile responsiveness for date inputs */
@media (max-width: 768px) {
    input[type="date"].form-control {
        padding: 14px 16px;
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

.btn-submit {
    background: #2563eb;
    color: white;
    padding: 16px 32px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    width: 100%;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

/* WhatsApp Button */
.whatsapp-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #25D366;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    text-decoration: none;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    z-index: 1000;
    transition: all 0.3s ease;
}

.whatsapp-btn:hover {
    transform: scale(1.1);
    color: white;
    text-decoration: none;
}

/* Gallery */
.gallery-item {
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.gallery-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

/* Testimonial */
.testimonial-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-align: center;
    margin-bottom: 20px;
}

.testimonial-text {
    font-style: italic;
    color: #64748b;
    margin-bottom: 16px;
    line-height: 1.7;
}

.testimonial-author {
    font-weight: 600;
    color: #1e293b;
}

.stars {
    color: #fbbf24;
    margin-bottom: 16px;
}

/* Success Message */
.success-alert {
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    color: #166534;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .package-content {
        padding: 20px;
    }
    
    .enquiry-form {
        padding: 24px;
    }
}

/* Section Spacing */
.section {
    padding: 80px 0;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 16px;
    color: #1e293b;
}

.section-subtitle {
    text-align: center;
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 48px;
}

/* Inclusions/Exclusions */
.inclusion-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.inclusion-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 16px;
    color: #1e293b;
}

.inclusion-list {
    list-style: none;
    padding: 0;
}

.inclusion-list li {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    color: #475569;
}

.inclusion-list li i {
    margin-right: 8px;
    width: 16px;
}

.included i {
    color: #22c55e;
}

.excluded i {
    color: #ef4444;
}
</style>
</head>

<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>
  
  <!-- Tour Packages Main Content -->
  <div role="main" class="main">

<!-- Hero Banner -->
<section class="hero-banner">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Discover Odisha</h1>
            <p class="hero-subtitle">Bhubaneswar • Puri • Konark • Chilika • Satapada<br>
            Premium Tour Packages with Comfortable Travel & Expert Drivers</p>
            <a href="#packages" class="btn-hero">Explore Packages</a>
        </div>
    </div>
</section>

<!-- Tour Packages Section -->
<section class="section" id="packages">
    <div class="container">
        <h2 class="section-title">Featured Tour Packages</h2>
        <p class="section-subtitle">Carefully crafted experiences showcasing the best of Odisha</p>
        
        <div class="row">
            <!-- Package 1: Heritage Tour -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-card">
                      <div class="package-image"style="background-image: url('./assets/images/tour_packages_temple.webp');">
                        <div class="package-badge">3N/4D</div>
                    </div>
                    <div class="package-content">
                        <h3 class="package-title">Odisha Heritage Tour</h3>
                        <p class="package-duration">3 Nights / 4 Days</p>
                        <div class="package-highlights">
                            <div class="highlight-item">
                                <i class="fas fa-map-marker-alt"></i>
                                Bhubaneswar • Puri • Konark
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-car"></i>
                                AC Vehicle with Driver
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-bed"></i>
                                3-Star Hotel Stay
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-utensils"></i>
                                Breakfast Included
                            </div>
                        </div>
                        <a href="#enquiry" class="btn-package">Book Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Package 2: Nature & Wildlife -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-card">
                    <div class="package-image"style="background-image: url('./assets/images/tour_packages_birds.jpg');">
                        <div class="package-badge">4N/5D</div>
                    </div>
                    <div class="package-content">
                        <h3 class="package-title">Chilika Lake & Nature Tour</h3>
                        <p class="package-duration">4 Nights / 5 Days</p>
                        <div class="package-highlights">
                            <div class="highlight-item">
                                <i class="fas fa-map-marker-alt"></i>
                                Chilika • Satapada • Gopalpur
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-ship"></i>
                                Boat Safari Included
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-camera"></i>
                                Dolphin Spotting
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-utensils"></i>
                                All Meals Included
                            </div>
                        </div>
                        <a href="#enquiry" class="btn-package">Book Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Package 3: Complete Odisha -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-card">
                    <div class="package-image" style="background-image: url('./assets/images/tour_packages.jpeg');">
                        <div class="package-badge">6N/7D</div>
                    </div>
                    <div class="package-content">
                        <h3 class="package-title">Complete Odisha Experience</h3>
                        <p class="package-duration">6 Nights / 7 Days</p>
                        <div class="package-highlights">
                            <div class="highlight-item">
                                <i class="fas fa-map-marker-alt"></i>
                                All Major Destinations
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-star"></i>
                                Luxury Hotels
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-user-tie"></i>
                                Tour Guide Included
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-utensils"></i>
                                All Meals & Transfers
                            </div>
                        </div>
                        <a href="#enquiry" class="btn-package">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sample Itinerary -->
<section class="section" style="background: white;">
    <div class="container">
        <h2 class="section-title">Sample Itinerary</h2>
        <p class="section-subtitle">Heritage Tour - 3 Nights / 4 Days</p>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="itinerary-day">
                    <div class="day-number">1</div>
                    <h4 class="day-title">Arrival in Bhubaneswar</h4>
                    <p class="day-activities">
                        Pickup from Airport/Railway Station. Check-in to hotel. Visit Lingaraj Temple, 
                        Mukteshwar Temple, and Khandagiri Caves. Evening at leisure. Overnight in Bhubaneswar.
                    </p>
                </div>
                
                <div class="itinerary-day">
                    <div class="day-number">2</div>
                    <h4 class="day-title">Bhubaneswar to Puri</h4>
                    <p class="day-activities">
                        After breakfast, drive to Puri. En route visit Konark Sun Temple (UNESCO World Heritage Site). 
                        Check-in to Puri hotel. Evening visit to Jagannath Temple and Puri Beach. Overnight in Puri.
                    </p>
                </div>
                
                <div class="itinerary-day">
                    <div class="day-number">3</div>
                    <h4 class="day-title">Chilika Lake Excursion</h4>
                    <p class="day-activities">
                        Full day excursion to Chilika Lake (Asia's largest brackish water lagoon). 
                        Boat ride to Satapada for dolphin spotting. Visit Kalijai Temple. Return to Puri. Overnight in Puri.
                    </p>
                </div>
                
                <div class="itinerary-day">
                    <div class="day-number">4</div>
                    <h4 class="day-title">Departure</h4>
                    <p class="day-activities">
                        After breakfast, check-out from hotel. Drive back to Bhubaneswar. 
                        Drop at Airport/Railway Station for onward journey.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enquiry Form -->
<section class="section" id="enquiry">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="enquiry-form">
                    <h3 class="form-title">Plan Your Perfect Odisha Tour</h3>
                    <p class="form-subtitle">Fill in your details and we'll create a customized package for you</p>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="act" value="tour_enquiry">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" name="phone" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Pickup Location</label>
                                    <select class="form-control" name="pickup_location">
                                        <option value="">Select pickup location</option>
                                        <option value="Bhubaneswar Airport">Bhubaneswar Airport</option>
                                        <option value="Bhubaneswar Railway Station">Bhubaneswar Railway Station</option>
                                        <option value="Bhubaneswar City">Bhubaneswar City</option>
                                        <option value="Puri">Puri</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Travel Start Date</label>
                                    <input type="date" class="form-control" name="travel_start_date" min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Travel End Date</label>
                                    <input type="date" class="form-control" name="travel_end_date" min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Number of Travelers</label>
                                    <select class="form-control" name="travelers">
                                        <option value="">Select number of travelers</option>
                                        <option value="1-2">1-2 People</option>
                                        <option value="3-4">3-4 People</option>
                                        <option value="5-6">5-6 People</option>
                                        <option value="7+">7+ People</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Preferred Vehicle</label>
                                    <select class="form-control" name="vehicle_type">
                                        <option value="">Select vehicle type</option>
                                        <option value="Sedan">Sedan (4 seater)</option>
                                        <option value="SUV">SUV (6-7 seater)</option>
                                        <option value="Tempo Traveller">Tempo Traveller (10+ seater)</option>
                                        <option value="Bus">Bus (20+ seater)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Package Interest</label>
                            <select class="form-control" name="package_interest">
                                <option value="">Select package type</option>
                                <option value="Heritage Tour">Heritage Tour (3N/4D)</option>
                                <option value="Nature Tour">Chilika Lake & Nature Tour (4N/5D)</option>
                                <option value="Complete Tour">Complete Odisha Experience (6N/7D)</option>
                                <option value="Custom">Custom Package</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Special Requests</label>
                            <textarea class="form-control" name="special_requests" rows="4" placeholder="Any special requirements, dietary preferences, accessibility needs, etc."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Send Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="section" style="background: white;">
    <div class="container">
        <h2 class="section-title">Discover Odisha's Beauty</h2>
        <p class="section-subtitle">Glimpses of the incredible destinations you'll visit</p>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=600" alt="Konark Sun Temple">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?q=80&w=600" alt="Chilika Lake">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1545558014-8692077e9b5c?q=80&w=600" alt="Puri Beach">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section">
    <div class="container">
        <h2 class="section-title">What Our Travelers Say</h2>
        <p class="section-subtitle">Real experiences from our satisfied customers</p>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Amazing tour! The driver was very knowledgeable and the vehicle was comfortable. 
                        Highly recommend for anyone wanting to explore Odisha."
                    </p>
                    <div class="testimonial-author">Rajesh Kumar, Delhi</div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Perfect family trip! The itinerary was well-planned and we covered all major attractions. 
                        The dolphin spotting at Chilika was unforgettable."
                    </p>
                    <div class="testimonial-author">Priya Sharma, Mumbai</div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Excellent service from EduxonCabs! Professional drivers, clean vehicles, 
                        and great customer support. Will definitely book again."
                    </p>
                    <div class="testimonial-author">Amit Patel, Bangalore</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inclusions/Exclusions -->
<section class="section" style="background: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="inclusion-card">
                    <h4 class="inclusion-title">Package Inclusions</h4>
                    <ul class="inclusion-list">
                        <li class="included"><i class="fas fa-check"></i> AC Vehicle with experienced driver</li>
                        <li class="included"><i class="fas fa-check"></i> Fuel, toll, and parking charges</li>
                        <li class="included"><i class="fas fa-check"></i> Hotel accommodation (as per package)</li>
                        <li class="included"><i class="fas fa-check"></i> Breakfast (as per package)</li>
                        <li class="included"><i class="fas fa-check"></i> Sightseeing as per itinerary</li>
                        <li class="included"><i class="fas fa-check"></i> 24/7 customer support</li>
                        <li class="included"><i class="fas fa-check"></i> GST included</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="inclusion-card">
                    <h4 class="inclusion-title">Package Exclusions</h4>
                    <ul class="inclusion-list">
                        <li class="excluded"><i class="fas fa-times"></i> Entry fees to monuments/temples</li>
                        <li class="excluded"><i class="fas fa-times"></i> Lunch and dinner (unless specified)</li>
                        <li class="excluded"><i class="fas fa-times"></i> Personal expenses</li>
                        <li class="excluded"><i class="fas fa-times"></i> Guide charges</li>
                        <li class="excluded"><i class="fas fa-times"></i> Camera fees</li>
                        <li class="excluded"><i class="fas fa-times"></i> Tips and gratuities</li>
                        <li class="excluded"><i class="fas fa-times"></i> Travel insurance</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

  </div> <!-- End main -->

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/919437144274?text=Hi, I'm interested in your Odisha tour packages. Please send me more details." 
   class="whatsapp-btn" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Footer -->
  <?php include("includes/site-footer.php");?>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
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

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.style.borderColor = '#ef4444';
        } else {
            field.style.borderColor = '#e2e8f0';
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
    }
});
</script>

</body>
</html>
