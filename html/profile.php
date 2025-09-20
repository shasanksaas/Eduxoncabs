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

$msg = "";
$error_msg = "";
$show_profile_form = false;
$verified_phone = "";

// Handle phone number submission - direct access without OTP
if(!empty($_POST['phone_number'])) {
    $phone_input = trim($_POST['phone_number']);
    
    // Clean and validate phone number
    $phone = preg_replace('/[^0-9]/', '', $phone_input); // Remove all non-digits
    
    // Normalize phone number to 10-digit format
    if(strlen($phone) == 10) {
        // 10 digit number - perfect
        $mobile_number = $phone;
    } else if(strlen($phone) == 11 && substr($phone, 0, 1) == '0') {
        // 11 digit starting with 0 - remove 0
        $mobile_number = substr($phone, 1);
    } else if(strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
        // 12 digit starting with 91 - remove country code
        $mobile_number = substr($phone, 2);
    } else if(strlen($phone) == 13 && substr($phone, 0, 3) == '091') {
        // 13 digit starting with 091 - remove leading 0 and country code
        $mobile_number = substr($phone, 3);
    } else {
        $error_msg = "Please enter a valid Indian mobile number (10 digits). Example: 9692627257 or +91 9692627257";
        $mobile_number = null;
    }
    
    // Validate that it's a valid Indian mobile number (starts with 6,7,8,9)
    if($mobile_number && strlen($mobile_number) == 10) {
        $first_digit = substr($mobile_number, 0, 1);
        
        if(!in_array($first_digit, ['6', '7', '8', '9'])) {
            $error_msg = "Please enter a valid Indian mobile number starting with 6, 7, 8, or 9.";
            $mobile_number = null;
        }
    }
    
    if($mobile_number) {
        // Direct access - no OTP verification needed
        $verified_phone = $mobile_number;
        $show_profile_form = true;
        $msg = "Profile loaded successfully for +91 " . $mobile_number;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Profile | EduxonCabs - Self Drive Car Rental</title>
    <meta name="keywords" content="user profile, booking history, EduxonCabs, self drive car rental Bhubaneswar" />
    <meta name="description" content="Access your EduxonCabs profile to view booking history, manage reservations, and track your self-drive car rentals in Bhubaneswar."/>
    <meta name="author" content="EduxonCabs">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php include("includes/inc-css.php");?>
    <link rel="stylesheet" href="assets/css/footer-center-fix.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1f2937;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-bg: #f8fafc;
            --border-color: #e5e7eb;
            --text-muted: #6b7280;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--secondary-color);
            line-height: 1.6;
        }

        .modern-navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            padding: 1rem 0;
        }

        .profile-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2563eb 100%);
            color: white;
            padding: 4rem 0 2rem;
            margin-bottom: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .search-section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
        }

        .form-control-modern {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-modern {
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-modern {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary-modern:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.25);
            color: white;
        }

        .customer-info {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-icon {
            width: 20px;
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .info-label {
            font-weight: 600;
            color: var(--secondary-color);
            min-width: 80px;
        }

        .info-value {
            color: var(--text-muted);
        }

        .booking-table {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
        }

        .table-modern {
            margin-bottom: 0;
        }

        .table-modern thead th {
            background: var(--light-bg);
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            color: var(--secondary-color);
            padding: 1rem;
            border-top: none;
        }

        .table-modern tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-modern tbody tr:hover {
            background-color: #f8fafc;
        }

        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .amount-highlight {
            font-weight: 700;
            color: var(--success-color);
            font-size: 1.1rem;
        }

        .invoice-btn {
            background: var(--danger-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .invoice-btn:hover {
            background: #dc2626;
            color: white;
            transform: translateY(-1px);
        }

        .no-records {
            text-align: center;
            padding: 3rem;
            color: var(--text-muted);
        }

        .no-records i {
            font-size: 3rem;
            color: var(--border-color);
            margin-bottom: 1rem;
        }

        .alert-modern {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success-modern {
            background: #dcfce7;
            color: #166534;
            border-left: 4px solid var(--success-color);
        }

        .alert-danger-modern {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }

        .otp-input {
            font-family: 'Courier New', monospace;
            text-align: center;
            font-size: 1.5rem;
            letter-spacing: 0.5rem;
            font-weight: 700;
        }

        .verification-badge {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .countdown-timer {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: var(--warning-color);
        }

        .security-features {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid #0ea5e9;
        }

        .security-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .security-item:last-child {
            margin-bottom: 0;
        }

        .security-icon {
            color: #0ea5e9;
            margin-right: 0.75rem;
            width: 20px;
        }

        @media (max-width: 992px) {
            .profile-hero {
                padding: 2rem 0 1rem;
            }

            .search-section {
                padding: 1.5rem;
            }

            .table-responsive {
                border-radius: 16px;
            }

            .customer-info {
                padding: 1rem;
            }
            
            .input-group {
                justify-content: center !important;
            }
        }

        /* Force white text only inside profile hero */
        .profile-hero,
        .profile-hero h1,
        .profile-hero h2,
        .profile-hero h3,
        .profile-hero .display-5,
        .profile-hero .lead,
        .profile-hero p,
        .profile-hero a,
        .profile-hero i,
        .profile-hero .fa {
            color: #ffffff !important;
        }
    </style>
    </head>
<body>
    <?php include("includes/site-header-inner.php");?>

    <!-- Hero Section -->
    <section class="profile-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fa fa-user-circle me-3"></i>User Profile
                    </h1>
                    <p class="lead">View your booking history and manage your account</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                
                <!-- Success/Error Messages -->
                <?php if(!empty($msg)): ?>
                <div class="alert-modern alert-success-modern">
                    <i class="fa fa-check-circle me-2"></i><?php echo $msg; ?>
                </div>
                <?php endif; ?>

                <?php if(!empty($error_msg)): ?>
                <div class="alert-modern alert-danger-modern">
                    <i class="fa fa-exclamation-triangle me-2"></i><?php echo $error_msg; ?>
                </div>
                <?php endif; ?>

                <?php if(!$show_profile_form): ?>
                <!-- Phone Number Entry Section -->
                <div class="search-section">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="mb-3">
                                <i class="fa fa-search text-primary me-2"></i>Find Your Profile
                            </h3>
                            <p class="text-muted mb-0">Enter your registered Indian mobile number to view your booking </p>
                        </div>
                        <div class="col-lg-4">
                            <form action="" method="post" class="d-flex flex-column align-items-center gap-3">
                                <div class="input-group w-100 justify-content-center">
                                    <div class="w-100">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">+91</span>
                                            <input type="text" 
                                                   name="phone_number" 
                                                   class="form-control-modern text-center" 
                                                   placeholder="9692627257" 
                                                   pattern="[6-9][0-9]{9}" 
                                                   maxlength="10"
                                                   title="Enter 10-digit Indian mobile number starting with 6, 7, 8, or 9"
                                                   value="<?php echo isset($_POST['phone_number']) ? htmlspecialchars(preg_replace('/[^0-9]/', '', $_POST['phone_number'])) : ''; ?>"
                                                   required />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="search_profile" class="btn-modern btn-primary-modern w-75 text-center justify-content-center">
                                    <i class="fa fa-search"></i> View Profile
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($show_profile_form): ?>
                <!-- Results Section -->
                <?php
                if ($show_profile_form && !empty($verified_phone)) {
                    $phone = $verified_phone;

                    $customer = $dbObj->fetch_data("tbl_customer", "phone_number='$phone'", "");
                    
                    if (!empty($customer)) {
                        $customer = $customer[0]; // Get the first record
                        $cust_id = $customer['cust_id'];
                        
                        // Fetch booking history (all bookings regardless of status)
                        $getdta = $dbObj->fetch_data("tbl_order", "customer_id='$cust_id'", " submit_dte DESC");
                        $count = $dbObj->countRec("tbl_order", "phone='$phone'", " submit_dte DESC");                        if($count > 0) {
                ?>
                            <!-- Profile Found Banner -->
                            <div class="alert-modern alert-success-modern mb-4">
                                <i class="fa fa-user-check me-2"></i>
                                <strong>Profile Found</strong> - Showing details for <strong>+91 <?php echo $phone; ?></strong>
                                <a href="?" class="float-end text-success">
                                    <i class="fa fa-search me-1"></i>Search Again
                                </a>
                            </div>

                            <!-- Customer Information -->
                            <div class="profile-card mb-4">
                                <div class="customer-info">
                                    <h4 class="mb-3">
                                        <i class="fa fa-user text-primary me-2"></i>Customer Information
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-item">
                                                <i class="fa fa-user info-icon"></i>
                                                <span class="info-label">Name:</span>
                                                <span class="info-value"><?php echo htmlspecialchars($getdta[0]['buyer_name']); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item">
                                                <i class="fa fa-phone info-icon"></i>
                                                <span class="info-label">Phone:</span>
                                                <span class="info-value"><?php echo htmlspecialchars($getdta[0]['phone']); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item">
                                                <i class="fa fa-envelope info-icon"></i>
                                                <span class="info-label">Email:</span>
                                                <span class="info-value"><?php echo htmlspecialchars($getdta[0]['email']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking History -->
                            <div class="booking-table">
                                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                    <h4 class="mb-0">
                                        <i class="fa fa-history text-primary me-2"></i>Booking History
                                    </h4>
                                    <span class="badge bg-primary"><?php echo $count; ?> Booking<?php echo $count > 1 ? 's' : ''; ?></span>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-modern">
                                        <thead>
                                            <tr>
                                                <th><i class="fa fa-hashtag me-1"></i>S.N.</th>
                                                <th><i class="fa fa-car me-1"></i>Vehicle</th>
                                                <th><i class="fa fa-rupee-sign me-1"></i>Amount</th>
                                                <th><i class="fa fa-info-circle me-1"></i>Status</th>
                                                <th><i class="fa fa-calendar-plus me-1"></i>Pickup Date & Time</th>
                                                <th><i class="fa fa-calendar-minus me-1"></i>Drop Date & Time</th>
                                                <th><i class="fa fa-file-pdf me-1"></i>Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($getdta as $key) {
                                                $fileInv = 'invoice/'.$key['payment_id'].'.pdf';
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-car text-primary me-2"></i>
                                                            <span class="fw-semibold"><?php echo htmlspecialchars($key['booked_car']); ?></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="amount-highlight">₹<?php echo number_format($key['amount']); ?></span>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $status_class = ($key['status'] == 'Completed') ? 'status-completed' : 'status-pending';
                                                        ?>
                                                        <span class="status-badge <?php echo $status_class; ?>">
                                                            <?php echo htmlspecialchars($key['status']); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <i class="fa fa-calendar me-1 text-success"></i>
                                                            <?php echo date('d M Y', strtotime($key['booked_dte'])); ?>
                                                        </div>
                                                        <small class="text-muted">
                                                            <i class="fa fa-clock me-1"></i><?php echo $key['booked_tme']; ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <i class="fa fa-calendar me-1 text-warning"></i>
                                                            <?php echo date('d M Y', strtotime($key['returned_dte'])); ?>
                                                        </div>
                                                        <small class="text-muted">
                                                            <i class="fa fa-clock me-1"></i><?php echo $key['return_tme']; ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <?php if(file_exists($fileInv)): ?>
                                                            <a href="<?php echo $fileInv; ?>" target="_blank" class="invoice-btn">
                                                                <i class="fa fa-download"></i>
                                                                Download PDF
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-muted">
                                                                <i class="fa fa-exclamation-triangle me-1"></i>
                                                                Not Available
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php 
                        } else { 
                        ?>
                            <div class="profile-card">
                                <div class="no-records">
                                    <i class="fa fa-calendar-times"></i>
                                    <h4>No Bookings Found</h4>
                                    <p>You don't have any completed bookings yet.</p>
                                    <a href="all-cars-for-self-drive-bhubaneswar.php" class="btn-modern btn-primary-modern">
                                        <i class="fa fa-car"></i> Book Your First Car
                                    </a>
                                </div>
                            </div>
                        <?php 
                        }
                    } else {
                ?>
                        <div class="alert-modern alert-danger-modern">
                            <i class="fa fa-user-times me-2"></i>
                            <strong>Customer not found!</strong> Please check your phone number and try again.
                        </div>
                <?php
                    }
                }
                ?>
                <?php endif; ?>

                <!-- Simple Access Information -->
                <?php if(!$show_profile_form): ?>
                <div class="security-features">
                    <h5 class="mb-3">
                        <i class="fa fa-info-circle text-primary me-2"></i>How it Works
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="security-item">
                                <i class="fa fa-mobile-alt security-icon"></i>
                                <span>Enter your registered mobile number</span>
                            </div>
                            <div class="security-item">
                                <i class="fa fa-eye security-icon"></i>
                                <span>View your booking history instantly</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="security-item">
                                <i class="fa fa-file-pdf security-icon"></i>
                                <span>Download invoices and receipts</span>
                            </div>
                            <div class="security-item">
                                <i class="fa fa-clock security-icon"></i>
                                <span>Track your rental history</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <?php include("includes/site-footer.php");?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("includes/inc-js.php");?>
    
    <!-- Custom JavaScript -->
    <script>
        // Phone number validation for Indian mobile numbers
        document.querySelectorAll('input[name="phone_number"]').forEach(function(input) {
            input.addEventListener('input', function(e) {
                // Only allow numbers
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
                
                // Limit to 10 digits
                if (e.target.value.length > 10) {
                    e.target.value = e.target.value.slice(0, 10);
                }
                
                // Validate first digit (should be 6, 7, 8, or 9 for Indian mobile)
                if (e.target.value.length > 0) {
                    const firstDigit = e.target.value[0];
                    if (!['6', '7', '8', '9'].includes(firstDigit)) {
                        e.target.setCustomValidity('Indian mobile numbers start with 6, 7, 8, or 9');
                    } else {
                        e.target.setCustomValidity('');
                    }
                }
            });
            
            // Add validation on form submit
            input.closest('form').addEventListener('submit', function(e) {
                const phoneValue = input.value;
                if (phoneValue.length !== 10) {
                    e.preventDefault();
                    alert('Please enter exactly 10 digits for your mobile number');
                    input.focus();
                    return false;
                }
                
                const firstDigit = phoneValue[0];
                if (!['6', '7', '8', '9'].includes(firstDigit)) {
                    e.preventDefault();
                    alert('Please enter a valid Indian mobile number starting with 6, 7, 8, or 9');
                    input.focus();
                    return false;
                }
            });
        });

        // Add smooth scrolling
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        });

        // Form validation feedback
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Processing...';
                        
                        // Re-enable if form validation fails
                        setTimeout(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = submitBtn.dataset.originalText || submitBtn.innerHTML;
                        }, 3000);
                    }
                });
            });
        });
    </script>

</body>
</html>
