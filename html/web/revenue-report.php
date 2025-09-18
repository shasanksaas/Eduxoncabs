<?php
session_start();
require_once("../includes/settings.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("../includes/classes/DBquery.cls.php");
loginValidate();
$db = new SiteData();
$dbObj = new dbquery();
$_curpage = currentPage();
$_SESSION[SES]['curpage'] = currentURL();
$admin_type = $_SESSION[SES]['admin']['admin_type'];

$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

if($admin_type==1 || $admin_type==4){
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?=PAGE_TITLE?> :: CAR REVENUE REPORT</title>
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="css/no-more-tables.css" rel="stylesheet">
<script src="js/jquery.min.js"> </script>
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
<script src="js/demo.js"></script>
<script type='text/javascript' src='js/common.js'></script>
<script src="js/skycons.js"></script>
<script src="js/validation.js"></script>
<!--//skycons-icons-->
<style>
    /* PERFORMANCE OPTIMIZATIONS FOR SMOOTH SCROLLING */
    html {
        scroll-behavior: auto !important;
    }
    
    body {
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Disable animations and transitions for better performance */
    *, *::before, *::after {
        animation-duration: 0s !important;
        transition-duration: 0s !important;
    }
    
    /* Enable hardware acceleration */
    .car-revenue-card,
    .content-main,
    .pagination-controls {
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        will-change: auto;
    }
    
    /* Optimize table rendering */
    table { 
        width: 100%; 
        table-layout: fixed;
    }
    td, th {
        text-align: left; 
        white-space: nowrap;
        word-wrap: break-word;
        overflow: hidden;
    }
    .filter-container { 
        background: #f8f9fa; 
        padding: 20px; 
        margin-bottom: 20px; 
        border-radius: 5px; 
        border: 1px solid #dee2e6;
    }
    .revenue-summary {
        background: #e7f3ff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        border-left: 4px solid #007bff;
    }
    .revenue-summary .col-md-3 {
        text-align: center;
        padding: 10px;
    }
    .revenue-summary h5 {
        margin-bottom: 10px;
        font-weight: 600;
        color: #333;
    }
    .car-revenue-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .car-revenue-header {
        background: #007bff;
        color: white;
        padding: 15px;
        font-weight: bold;
    }
    .car-revenue-body {
        padding: 15px;
    }
    .btn-filter {
        margin: 5px;
    }
    .total-amount {
        font-size: 18px;
        font-weight: bold;
        color: #28a745;
    }
    .kpi-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        min-height: 140px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .kpi-value {
        font-size: 1.2em;
        font-weight: bold;
        margin: 10px 0;
        line-height: 1.2;
        word-wrap: break-word;
        hyphens: auto;
    }
    .kpi-label {
        font-size: 0.85em;
        opacity: 0.9;
        margin-bottom: 8px;
        font-weight: 500;
    }
    .kpi-subtitle {
        font-size: 0.75em;
        opacity: 0.8;
        margin-top: 5px;
        font-weight: normal;
    }
    .trend-up { color: #28a745; }
    .trend-down { color: #dc3545; }
    .performance-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
    }
    .performance-excellent { background: #28a745; color: white; }
    .performance-good { background: #ffc107; color: black; }
    .performance-average { background: #6c757d; color: white; }
    .performance-poor { background: #dc3545; color: white; }
    .chart-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .utilization-bar {
        height: 20px;
        background: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
        margin: 10px 0;
    }
    .utilization-fill {
        height: 100%;
        background: linear-gradient(90deg, #28a745, #20c997);
        transition: width 0.3s ease;
    }
    .insight-box {
        background: #f8f9fa;
        border-left: 4px solid #28a745;
        padding: 15px;
        margin: 15px 0;
        border-radius: 0 5px 5px 0;
    }
    .tab-content {
        background: white;
        padding: 20px;
        border-radius: 0 0 10px 10px;
    }
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }
    .nav-tabs .nav-link.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }
    
    /* Pagination styles */
    .pagination-controls {
        display: inline-block;
    }
    .pagination-controls .btn {
        margin: 0 2px;
        min-width: 35px;
    }
    .pagination-controls .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    /* Smooth scrolling for anchor links */
    html {
        scroll-behavior: smooth;
    }
    
    /* Highlight target sections briefly */
    /* Simplified car revenue cards - no animations */
    .car-revenue-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 20px;
        overflow: hidden;
        scroll-margin-top: 20px;
    }
    
    @media (max-width: 768px) {
        .pagination-controls .btn {
            padding: 5px 8px;
            font-size: 12px;
            min-width: 30px;
        }
        .pagination-controls {
            text-align: center;
        }
    }
        .kpi-card {
            margin-bottom: 15px;
            min-height: 120px;
            padding: 15px;
        }
        .kpi-value {
            font-size: 1em;
        }
        .kpi-label {
            font-size: 0.8em;
        }
        .revenue-summary .col-md-3 {
            margin-bottom: 15px;
        }
        .total-amount {
            font-size: 16px;
        }
    }
    
    @media (max-width: 480px) {
        .kpi-value {
            font-size: 0.9em;
        }
        .kpi-card {
            min-height: 100px;
            padding: 12px;
        }
    }
</style>

<script>
// Performance optimizations
document.addEventListener('DOMContentLoaded', function() {
    // Disable smooth scrolling if performance is poor
    if (window.innerHeight < 600 || window.innerWidth < 768) {
        document.documentElement.style.scrollBehavior = 'auto';
    }
    
    // Optimize table rendering
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        table.style.tableLayout = 'fixed';
    });
    
    // Add loading indicator for pagination clicks
    const paginationLinks = document.querySelectorAll('.pagination-controls a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Simple loading indicator
            this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';
            this.style.pointerEvents = 'none';
        });
    });
    
    // Lazy load images if any
    const images = document.querySelectorAll('img[data-src]');
    images.forEach(img => {
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
    });
});

// Emergency scroll fix
function forceScroll() {
    document.body.style.overflow = 'auto';
    document.documentElement.style.overflow = 'auto';
    window.scrollTo(0, 0);
}

// Call immediately and after 1 second if page seems stuck
forceScroll();
setTimeout(forceScroll, 1000);

// Add loading overlay for heavy operations
function showLoading() {
    const overlay = document.createElement('div');
    overlay.id = 'loading-overlay';
    overlay.innerHTML = '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.8); color: white; padding: 20px; border-radius: 5px; z-index: 9999;"><i class="fa fa-spinner fa-spin"></i> Loading...</div>';
    document.body.appendChild(overlay);
}

function hideLoading() {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        overlay.remove();
    }
}

// Show loading on form submit
document.addEventListener('submit', showLoading);
</script>
</head>
<body>
<div id="wrapper">
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.php"><img src="images/logo.png"  border="0" alt="Logo" title="EduxonCabs" height="98px"/></a></h1>         
             </div>
             <div class=" border-bottom">
                <div class="full-left">
                  <section class="full-top">
                    <button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
                </section>
                <div class="clearfix"> </div>
               </div>
        
               <!-- Brand and toggle get grouped for better mobile display -->
             
               <!-- Collect the nav links, forms, and other content for toggling -->
                <?php include("includes/header2.php");?><!-- /.navbar-collapse -->
                <div class="clearfix">
               
             </div>
              
                <?php include("includes/column_left2.php");?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
          <!--banner-->	
            <div class="banner">
               <h2>
                <a href="index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Car Revenue Report</span>
                </h2>
            </div>
        <!--//banner-->
        <!--content-->
        <div class="content-top">
            
            <div class="col-md-12 ">
                <div class="content-top-1">
                <div class="col-md-12 top-content">
                    <?php getMessage();?>
                    
                    <!-- Performance Notice -->
                    <div class="alert alert-info" style="margin-bottom: 15px;">
                        <i class="fa fa-info-circle"></i> 
                        <strong>Performance Optimized:</strong> 
                        Page shows 3 cars per page and 5 bookings per car for faster loading. 
                        Use filters to narrow down results for better performance.
                    </div>
                    
                    <!-- Filter Section -->
                    <div class="filter-container">
                        <h4><i class="fa fa-filter"></i> Filter Options</h4>
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Time Period:</label>
                                    <select name="period" class="form-control">
                                        <option value="1week" <?php echo (isset($_GET['period']) && $_GET['period'] == '1week') ? 'selected' : ''; ?>>Last 1 Week</option>
                                        <option value="1month" <?php echo (isset($_GET['period']) && $_GET['period'] == '1month') ? 'selected' : ''; ?>>Last 1 Month</option>
                                        <option value="1year" <?php echo (isset($_GET['period']) && $_GET['period'] == '1year') ? 'selected' : ''; ?>>Last 1 Year</option>
                                        <option value="all" <?php echo (!isset($_GET['period']) || $_GET['period'] == 'all') ? 'selected' : ''; ?>>All Time</option>
                                        <option value="custom" <?php echo (isset($_GET['period']) && $_GET['period'] == 'custom') ? 'selected' : ''; ?>>Custom Range</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="custom-dates" style="display: <?php echo (isset($_GET['period']) && $_GET['period'] == 'custom') ? 'block' : 'none'; ?>;">
                                    <label>From Date:</label>
                                    <input type="date" name="from_date" class="form-control" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>">
                                </div>
                                <div class="col-md-3" id="custom-dates-to" style="display: <?php echo (isset($_GET['period']) && $_GET['period'] == 'custom') ? 'block' : 'none'; ?>;">
                                    <label>To Date:</label>
                                    <input type="date" name="to_date" class="form-control" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Select Car:</label>
                                    <select name="car_id" class="form-control">
                                        <option value="">All Cars</option>
                                        <?php
                                        $cars = $dbObj->fetch_data("tbl_cabs", "status=1", "car_nme ASC");
                                        foreach($cars as $car) {
                                            $selected = (isset($_GET['car_id']) && $_GET['car_id'] == $car['id']) ? 'selected' : '';
                                            echo "<option value='".$car['id']."' $selected>".$car['car_nme']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-filter"><i class="fa fa-search"></i> Apply Filter</button>
                                    <a href="revenue-report.php" class="btn btn-default btn-filter"><i class="fa fa-refresh"></i> Reset</a>
                                    <button type="button" class="btn btn-success btn-filter" onclick="exportToExcel()"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php
                    // Build date filter
                    $dateFilter = "";
                    $period = isset($_GET['period']) ? $_GET['period'] : 'all'; // Default to 'all' instead of '1month'
                    
                    switch($period) {
                        case '1week':
                            $dateFilter = "AND o.submit_dte >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
                            break;
                        case '1month':
                            $dateFilter = "AND o.submit_dte >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                            break;
                        case '1year':
                            $dateFilter = "AND o.submit_dte >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
                            break;
                        case 'custom':
                            if(isset($_GET['from_date']) && isset($_GET['to_date']) && $_GET['from_date'] != '' && $_GET['to_date'] != '') {
                                $from_date = $_GET['from_date'];
                                $to_date = $_GET['to_date'];
                                $dateFilter = "AND DATE(o.submit_dte) BETWEEN '$from_date' AND '$to_date'";
                            }
                            break;
                        case 'all':
                        default:
                            $dateFilter = "";
                            break;
                    }
                    
                    // Build car filter
                    $carFilter = "";
                    if(isset($_GET['car_id']) && $_GET['car_id'] != '') {
                        $car_id = $_GET['car_id'];
                        $carFilter = "AND c.id = '$car_id'";
                    }
                    
                    // Build order date filter for WHERE clause
                    $orderDateFilter = "";
                    switch($period) {
                        case '1week':
                            $orderDateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
                            break;
                        case '1month':
                            $orderDateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                            break;
                        case '1year':
                            $orderDateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
                            break;
                        case 'custom':
                            if(isset($_GET['from_date']) && isset($_GET['to_date']) && $_GET['from_date'] != '' && $_GET['to_date'] != '') {
                                $from_date = $_GET['from_date'];
                                $to_date = $_GET['to_date'];
                                $orderDateFilter = "AND DATE(submit_dte) BETWEEN '$from_date' AND '$to_date'";
                            }
                            break;
                        case 'all':
                        default:
                            $orderDateFilter = "";
                            break;
                    }
                    
                    // Build car filter for orders
                    $orderCarFilter = "";
                    if(isset($_GET['car_id']) && $_GET['car_id'] != '') {
                        $car_id = $_GET['car_id'];
                        $orderCarFilter = "AND car_id = '$car_id'";
                    }
                    
                    // Get total revenue summary - Updated to include both Completed and Pending bookings
                    $whereCondition = "(status='Completed' OR status='Pending') $orderDateFilter $orderCarFilter";
                    $totalBookings = $dbObj->countRec("tbl_order", $whereCondition);
                    
                    // Get revenue data using custom query - Using only amount field (no separate security deposit column)
                    $totalRevenueQuery = "SELECT 
                        SUM(CAST(REPLACE(REPLACE(amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_revenue,
                        AVG(CAST(REPLACE(REPLACE(amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as avg_booking_amount,
                        COUNT(*) as record_count
                        FROM tbl_order 
                        WHERE $whereCondition";
                    
                    $revenueData = $db->getConnection()->selectRecords($totalRevenueQuery);
                    
                    $totalStats = array(
                        'total_bookings' => $totalBookings,
                        'total_revenue' => (isset($revenueData[0]['total_revenue']) && $revenueData[0]['total_revenue']) ? $revenueData[0]['total_revenue'] : 0,
                        'avg_booking_amount' => (isset($revenueData[0]['avg_booking_amount']) && $revenueData[0]['avg_booking_amount']) ? $revenueData[0]['avg_booking_amount'] : 0,
                        'record_count_from_query' => (isset($revenueData[0]['record_count']) && $revenueData[0]['record_count']) ? $revenueData[0]['record_count'] : 0
                    );
                    
                    ?>

                    <!-- Revenue Summary -->
                    <div class="revenue-summary">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Total Bookings</h5>
                                <div class="total-amount"><?php echo number_format($totalStats['total_bookings']); ?></div>
                            </div>
                            <div class="col-md-3">
                                <h5>Total Revenue</h5>
                                <div class="total-amount">₹<?php echo number_format($totalStats['total_revenue'], 2); ?></div>
                            </div>
                            <div class="col-md-3">
                                <h5>Average Booking</h5>
                                <div class="total-amount">₹<?php echo number_format($totalStats['avg_booking_amount'], 2); ?></div>
                            </div>
                            <div class="col-md-3">
                                <h5>Period</h5>
                                <div class="total-amount" style="font-size: 14px;"><?php 
                                    switch($period) {
                                        case '1week': echo 'Last 1 Week'; break;
                                        case '1month': echo 'Last 1 Month'; break;
                                        case '1year': echo 'Last 1 Year'; break;
                                        case 'custom': echo 'Custom Range'; break;
                                        default: echo 'All Time'; break;
                                    }
                                ?></div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Get top performers and insights from the full database (respecting current filters)
                    
                                        // 1. Most Booked Car
                    $topCarQuery = "SELECT 
                        c.car_nme, 
                        COUNT(o.id) as booking_count,
                        SUM(CAST(REPLACE(REPLACE(o.amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_revenue
                        FROM tbl_cabs c
                        INNER JOIN tbl_order o ON c.id = o.car_id 
                        WHERE c.status = 1 
                        AND (o.status='Completed' OR o.status='Pending')
                        $dateFilter $carFilter
                        GROUP BY c.id, c.car_nme
                        ORDER BY booking_count DESC 
                        LIMIT 1";
                    
                    $topCarResult = $db->getConnection()->selectRecords($topCarQuery);
                    
                    // 2. Highest Revenue Car
                    $topRevenueCarQuery = "SELECT 
                        c.car_nme, 
                        COUNT(o.id) as booking_count,
                        SUM(CAST(REPLACE(REPLACE(o.amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_revenue
                        FROM tbl_cabs c
                        INNER JOIN tbl_order o ON c.id = o.car_id 
                        WHERE c.status = 1 
                        AND (o.status='Completed' OR o.status='Pending')
                        $dateFilter $carFilter
                        GROUP BY c.id, c.car_nme
                        ORDER BY total_revenue DESC 
                        LIMIT 1";                    $topRevenueCarResult = $db->getConnection()->selectRecords($topRevenueCarQuery);
                    
                    // 3. Top Customer (most bookings)
                    $topCustomerQuery = "SELECT 
                        buyer_name, 
                        phone,
                        COUNT(id) as booking_count,
                        SUM(CAST(REPLACE(REPLACE(amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_spent
                        FROM tbl_order 
                        WHERE (status='Completed' OR status='Pending')
                        $orderDateFilter $orderCarFilter
                        GROUP BY buyer_name, phone
                        ORDER BY booking_count DESC 
                        LIMIT 1";
                    
                    $topCustomerResult = $db->getConnection()->selectRecords($topCustomerQuery);
                    
                    // 4. Highest Value Customer (most revenue)
                    $topValueCustomerQuery = "SELECT 
                        buyer_name, 
                        phone,
                        COUNT(id) as booking_count,
                        SUM(CAST(REPLACE(REPLACE(amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_spent
                        FROM tbl_order 
                        WHERE (status='Completed' OR status='Pending')
                        $orderDateFilter $orderCarFilter
                        GROUP BY buyer_name, phone
                        ORDER BY total_spent DESC 
                        LIMIT 1";
                    
                    $topValueCustomerResult = $db->getConnection()->selectRecords($topValueCustomerQuery);
                    
                    // 5. Payment Method Statistics
                    $paymentStatsQuery = "SELECT 
                        secur_pay_type,
                        COUNT(id) as booking_count,
                        SUM(CAST(REPLACE(REPLACE(amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_revenue
                        FROM tbl_order 
                        WHERE (status='Completed' OR status='Pending')
                        $orderDateFilter $orderCarFilter
                        GROUP BY secur_pay_type";
                    
                    $paymentStatsResult = $db->getConnection()->selectRecords($paymentStatsQuery);
                    
                    // 6. Monthly Growth (if showing all time or 1 year)
                    $showGrowth = ($period == 'all' || $period == '1year');
                    $growthData = null;
                    if($showGrowth) {
                        $growthQuery = "SELECT 
                            YEAR(submit_dte) as year,
                            MONTH(submit_dte) as month,
                            COUNT(id) as booking_count,
                            SUM(CAST(REPLACE(REPLACE(amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_revenue
                            FROM tbl_order 
                            WHERE (status='Completed' OR status='Pending')
                            $orderDateFilter $orderCarFilter
                            GROUP BY YEAR(submit_dte), MONTH(submit_dte)
                            ORDER BY year DESC, month DESC 
                            LIMIT 6";
                        
                        $growthData = $db->getConnection()->selectRecords($growthQuery);
                    }
                    ?>

                    <!-- Top Performers Dashboard -->
                    <div style="margin-bottom: 30px;">
                        <h4><i class="fa fa-trophy"></i> Top Performers & Key Insights</h4>
                        
                        <div class="row">
                            <!-- Most Booked Car -->
                            <div class="col-md-3">
                                <div class="kpi-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <div class="kpi-label">Most Booked Car</div>
                                    <div class="kpi-value">
                                        <?php 
                                        if($topCarResult && count($topCarResult) > 0) {
                                            // Break long car names into multiple lines
                                            $carName = $topCarResult[0]['car_nme'];
                                            if(strlen($carName) > 15) {
                                                $carName = wordwrap($carName, 15, "<br>", true);
                                            }
                                            echo $carName;
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
                                    <?php if($topCarResult && count($topCarResult) > 0) { ?>
                                    <div class="kpi-subtitle"><?php echo $topCarResult[0]['booking_count']; ?> bookings</div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <!-- Highest Revenue Car -->
                            <div class="col-md-3">
                                <div class="kpi-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                    <div class="kpi-label">Top Revenue Car</div>
                                    <div class="kpi-value">
                                        <?php 
                                        if($topRevenueCarResult && count($topRevenueCarResult) > 0) {
                                            // Break long car names into multiple lines
                                            $carName = $topRevenueCarResult[0]['car_nme'];
                                            if(strlen($carName) > 15) {
                                                $carName = wordwrap($carName, 15, "<br>", true);
                                            }
                                            echo $carName;
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
                                    <?php if($topRevenueCarResult && count($topRevenueCarResult) > 0) { ?>
                                    <div class="kpi-subtitle">₹<?php echo number_format($topRevenueCarResult[0]['total_revenue'], 0); ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <!-- Top Customer by Bookings -->
                            <div class="col-md-3">
                                <div class="kpi-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                    <div class="kpi-label">Top Customer (Bookings)</div>
                                    <div class="kpi-value">
                                        <?php 
                                        if($topCustomerResult && count($topCustomerResult) > 0) {
                                            $customerName = $topCustomerResult[0]['buyer_name'];
                                            if(strlen($customerName) > 15) {
                                                $customerName = wordwrap($customerName, 15, "<br>", true);
                                            }
                                            echo $customerName;
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
                                    <?php if($topCustomerResult && count($topCustomerResult) > 0) { ?>
                                    <div class="kpi-subtitle"><?php echo $topCustomerResult[0]['booking_count']; ?> bookings</div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <!-- Top Value Customer -->
                            <div class="col-md-3">
                                <div class="kpi-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                    <div class="kpi-label">Top Value Customer</div>
                                    <div class="kpi-value">
                                        <?php 
                                        if($topValueCustomerResult && count($topValueCustomerResult) > 0) {
                                            $customerName = $topValueCustomerResult[0]['buyer_name'];
                                            if(strlen($customerName) > 15) {
                                                $customerName = wordwrap($customerName, 15, "<br>", true);
                                            }
                                            echo $customerName;
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
                                    <?php if($topValueCustomerResult && count($topValueCustomerResult) > 0) { ?>
                                    <div class="kpi-subtitle">₹<?php echo number_format($topValueCustomerResult[0]['total_spent'], 0); ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 20px;">
                            <!-- Payment Method Breakdown -->
                            <div class="col-md-6">
                                <div class="chart-container">
                                    <h5><i class="fa fa-credit-card"></i> Payment Methods</h5>
                                    <?php
                                    if($paymentStatsResult && count($paymentStatsResult) > 0) {
                                        $totalPayments = array_sum(array_column($paymentStatsResult, 'booking_count'));
                                        foreach($paymentStatsResult as $payment) {
                                            $percentage = ($payment['booking_count'] / $totalPayments) * 100;
                                            $paymentType = ($payment['secur_pay_type'] == 1) ? 'Online Payments' : 'Cash Payments';
                                            $colorClass = ($payment['secur_pay_type'] == 1) ? '#28a745' : '#ffc107';
                                    ?>
                                        <div style="margin-bottom: 15px;">
                                            <div style="display: flex; justify-content: space-between;">
                                                <span><?php echo $paymentType; ?></span>
                                                <span><strong><?php echo $payment['booking_count']; ?> (<?php echo number_format($percentage, 1); ?>%)</strong></span>
                                            </div>
                                            <div class="utilization-bar">
                                                <div class="utilization-fill" style="width: <?php echo $percentage; ?>%; background: <?php echo $colorClass; ?>;"></div>
                                            </div>
                                            <small class="text-muted">Revenue: ₹<?php echo number_format($payment['total_revenue'], 2); ?></small>
                                        </div>
                                    <?php
                                        }
                                    } else {
                                        echo "<p class='text-muted'>No payment data available</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                            
                            <!-- Recent Growth Trend -->
                            <?php if($showGrowth && $growthData && count($growthData) > 0) { ?>
                            <div class="col-md-6">
                                <div class="chart-container">
                                    <h5><i class="fa fa-line-chart"></i> Recent Monthly Trends</h5>
                                    <?php
                                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                    foreach(array_reverse($growthData) as $index => $month) {
                                        $monthName = $months[$month['month'] - 1] . ' ' . $month['year'];
                                        $maxBookings = max(array_column($growthData, 'booking_count'));
                                        $percentage = ($month['booking_count'] / $maxBookings) * 100;
                                    ?>
                                        <div style="margin-bottom: 10px;">
                                            <div style="display: flex; justify-content: space-between;">
                                                <span><?php echo $monthName; ?></span>
                                                <span><strong><?php echo $month['booking_count']; ?> bookings</strong></span>
                                            </div>
                                            <div class="utilization-bar">
                                                <div class="utilization-fill" style="width: <?php echo $percentage; ?>%;"></div>
                                            </div>
                                            <small class="text-muted">₹<?php echo number_format($month['total_revenue'], 0); ?></small>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-6">
                                <div class="chart-container">
                                    <h5><i class="fa fa-info-circle"></i> Business Insights</h5>
                                    <div class="insight-box">
                                        <strong>📊 Data Coverage:</strong> 
                                        Showing results for <?php echo $period == 'all' ? 'all time' : $period; ?> period
                                        <?php if($totalStats['total_bookings'] > 0) { ?>
                                        <br><br>
                                        <strong>💡 Quick Stats:</strong><br>
                                        • Average booking value: ₹<?php echo number_format($totalStats['avg_booking_amount'], 0); ?><br>
                                        • Total bookings: <?php echo number_format($totalStats['total_bookings']); ?><br>
                                        • Total revenue: ₹<?php echo number_format($totalStats['total_revenue'], 0); ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    // Get car-wise revenue using corrected query with proper filtering
                    if($totalStats['total_bookings'] > 0) {
                        // Pagination for cars - Reduced for better performance
                        $carsPerPage = 3; // Reduced from 5 to 3 for better performance
                        $carPage = isset($_GET['car_page']) ? (int)$_GET['car_page'] : 1;
                        $carOffset = ($carPage - 1) * $carsPerPage;
                        
                        // Count total cars with bookings
                        $carCountQuery = "SELECT COUNT(DISTINCT c.id) as total_cars
                            FROM tbl_cabs c
                            INNER JOIN tbl_order o ON c.id = o.car_id 
                            WHERE c.status = 1 
                            AND (o.status='Completed' OR o.status='Pending')
                            $dateFilter $carFilter";
                        $carCountResult = $db->getConnection()->selectRecords($carCountQuery);
                        $totalCars = $carCountResult[0]['total_cars'];
                        $totalCarPages = ceil($totalCars / $carsPerPage);
                        
                        // Only run car revenue query if we have bookings in the filtered period
                        $carRevenueQuery = "SELECT 
                            c.id as car_id,
                            c.car_nme,
                            c.car_image,
                            COUNT(o.id) as booking_count,
                            SUM(CAST(REPLACE(REPLACE(o.amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as total_revenue,
                            AVG(CAST(REPLACE(REPLACE(o.amount, ',', ''), ' ', '') AS DECIMAL(10,2))) as avg_amount,
                            MIN(o.submit_dte) as first_booking,
                            MAX(o.submit_dte) as last_booking
                            FROM tbl_cabs c
                            INNER JOIN tbl_order o ON c.id = o.car_id 
                            WHERE c.status = 1 
                            AND (o.status='Completed' OR o.status='Pending')
                            $dateFilter $carFilter
                            GROUP BY c.id, c.car_nme, c.car_image
                            ORDER BY total_revenue DESC
                            LIMIT $carsPerPage OFFSET $carOffset";
                        
                        $carRevenueResult = $db->getConnection()->selectRecords($carRevenueQuery);
                        
                        // Car pagination controls
                        if($totalCarPages > 1) {
                            echo '<div class="row" style="margin-bottom: 20px;" id="car-pagination-top">';
                            echo '<div class="col-md-12">';
                            echo '<div class="alert alert-info">';
                            echo '<div class="row">';
                            echo '<div class="col-md-6">';
                            echo '<strong><i class="fa fa-info-circle"></i> Car Results:</strong> ';
                            echo 'Showing ' . ($carOffset + 1) . ' to ' . min($carOffset + $carsPerPage, $totalCars) . ' of ' . $totalCars . ' cars with bookings';
                            echo '</div>';
                            echo '<div class="col-md-6 text-right">';
                            echo '<div class="pagination-controls">';
                            if($carPage > 1) {
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['car_page' => $carPage - 1])) . '#car-pagination-top" class="btn btn-sm btn-default"><i class="fa fa-chevron-left"></i> Previous Cars</a> ';
                            }
                            echo '<span class="btn btn-sm btn-info">Page ' . $carPage . ' of ' . $totalCarPages . '</span> ';
                            if($carPage < $totalCarPages) {
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['car_page' => $carPage + 1])) . '#car-pagination-top" class="btn btn-sm btn-default">Next Cars <i class="fa fa-chevron-right"></i></a>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                        if($carRevenueResult && count($carRevenueResult) > 0) {
                            foreach($carRevenueResult as $carRevenue) {
                    ?>
                    
                    <!-- Car Revenue Card -->
                    <div class="car-revenue-card" id="car-<?php echo $carRevenue['car_id']; ?>">
                        <div class="car-revenue-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-car"></i> <?php echo $carRevenue['car_nme']; ?>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="total-amount">Total Revenue: ₹<?php echo number_format($carRevenue['total_revenue'], 2); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="car-revenue-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <strong>Total Bookings:</strong> <?php echo $carRevenue['booking_count']; ?>
                                </div>
                                <div class="col-md-3">
                                    <strong>Total Revenue:</strong> ₹<?php echo number_format($carRevenue['total_revenue'], 2); ?>
                                </div>
                                <div class="col-md-2">
                                    <strong>Average Amount:</strong> ₹<?php echo number_format($carRevenue['avg_amount'], 2); ?>
                                </div>
                                <div class="col-md-2">
                                    <strong>First Booking:</strong> <?php echo date('d M Y', strtotime($carRevenue['first_booking'])); ?>
                                </div>
                                <div class="col-md-3">
                                    <strong>Last Booking:</strong> <?php echo date('d M Y', strtotime($carRevenue['last_booking'])); ?>
                                </div>
                            </div>
                            
                            <!-- Individual Bookings for this car -->
                            <div style="margin-top: 20px;">
                                <h5><i class="fa fa-list"></i> Individual Bookings</h5>
                                <small class="text-muted">
                                    <i class="fa fa-info-circle"></i> 
                                    Booking IDs: System-generated IDs (order_xxx) for recent bookings, formatted IDs (EDX-xxxxxx) for older bookings
                                </small>
                                
                                <?php
                                // Pagination settings - Reduced for better performance
                                $recordsPerPage = 5; // Reduced from 10 to 5
                                $currentPage = isset($_GET['page_' . $carRevenue['car_id']]) ? (int)$_GET['page_' . $carRevenue['car_id']] : 1;
                                $offset = ($currentPage - 1) * $recordsPerPage;
                                
                                // Count total bookings for this car
                                $countQuery = "SELECT COUNT(*) as total_count
                                              FROM tbl_order 
                                              WHERE car_id = ".$carRevenue['car_id']." 
                                              AND (status='Completed' OR status='Pending')
                                              $orderDateFilter";
                                $countResult = $db->getConnection()->selectRecords($countQuery);
                                $totalRecords = $countResult[0]['total_count'];
                                $totalPages = ceil($totalRecords / $recordsPerPage);
                                
                                // Get individual bookings for this car with pagination
                                $individualBookingsQuery = "SELECT 
                                    id, order_id, buyer_name, phone, amount, submit_dte, 
                                    from_date, to_date, secur_pay_type, status
                                    FROM tbl_order 
                                    WHERE car_id = ".$carRevenue['car_id']." 
                                    AND (status='Completed' OR status='Pending')
                                    $orderDateFilter
                                    ORDER BY submit_dte DESC
                                    LIMIT $recordsPerPage OFFSET $offset";
                                ?>
                                
                                <!-- Pagination Info -->
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $recordsPerPage, $totalRecords); ?> of <?php echo $totalRecords; ?> bookings
                                        </small>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <?php if($totalPages > 1) { ?>
                                        <div class="pagination-controls">
                                            <?php if($currentPage > 1) { ?>
                                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page_' . $carRevenue['car_id'] => $currentPage - 1])); ?>#car-<?php echo $carRevenue['car_id']; ?>" class="btn btn-sm btn-default">
                                                    <i class="fa fa-chevron-left"></i> Previous
                                                </a>
                                            <?php } ?>
                                            
                                            <span class="btn btn-sm btn-info" style="margin: 0 5px;">
                                                Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
                                            </span>
                                            
                                            <?php if($currentPage < $totalPages) { ?>
                                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page_' . $carRevenue['car_id'] => $currentPage + 1])); ?>#car-<?php echo $carRevenue['car_id']; ?>" class="btn btn-sm btn-default">
                                                    Next <i class="fa fa-chevron-right"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Customer Name</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Booking Date</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Payment Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $individualResult = $db->getConnection()->selectRecords($individualBookingsQuery);
                                    
                                    if($individualResult && count($individualResult) > 0) {
                                        foreach($individualResult as $booking) {
                                            $paymentType = ($booking['secur_pay_type'] == 1) ? 'Online' : 'Cash';
                                    ?>
                                        <tr>
                                            <td><?php 
                                                // Show order_id if available, otherwise show a formatted booking ID
                                                echo !empty($booking['order_id']) ? $booking['order_id'] : 'EDX-' . str_pad($booking['id'], 6, '0', STR_PAD_LEFT);
                                            ?></td>
                                            <td><?php echo $booking['buyer_name']; ?></td>
                                            <td><?php echo $booking['phone']; ?></td>
                                            <td><strong>₹<?php echo number_format($booking['amount'], 2); ?></strong></td>
                                            <td><span class="label label-<?php echo ($booking['status'] == 'Completed') ? 'success' : 'info'; ?>"><?php echo $booking['status']; ?></span></td>
                                            <td><?php echo date('d M Y H:i', strtotime($booking['submit_dte'])); ?></td>
                                            <td><?php echo date('d M Y H:i', strtotime($booking['from_date'])); ?></td>
                                            <td><?php echo date('d M Y H:i', strtotime($booking['to_date'])); ?></td>
                                            <td><span class="label label-<?php echo ($booking['secur_pay_type'] == 1) ? 'success' : 'warning'; ?>"><?php echo $paymentType; ?></span></td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9' class='text-center'>No bookings found for this car in the selected period.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                
                                <!-- Bottom Pagination -->
                                <?php if($totalPages > 1) { ?>
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-md-12 text-center">
                                        <div class="pagination-controls">
                                            <?php if($currentPage > 1) { ?>
                                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page_' . $carRevenue['car_id'] => 1])); ?>#car-<?php echo $carRevenue['car_id']; ?>" class="btn btn-sm btn-default">
                                                    <i class="fa fa-fast-backward"></i> First
                                                </a>
                                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page_' . $carRevenue['car_id'] => $currentPage - 1])); ?>#car-<?php echo $carRevenue['car_id']; ?>" class="btn btn-sm btn-default">
                                                    <i class="fa fa-chevron-left"></i> Previous
                                                </a>
                                            <?php } ?>
                                            
                                            <?php
                                            // Show page numbers
                                            $startPage = max(1, $currentPage - 2);
                                            $endPage = min($totalPages, $currentPage + 2);
                                            
                                            for($i = $startPage; $i <= $endPage; $i++) {
                                                if($i == $currentPage) {
                                                    echo '<span class="btn btn-sm btn-primary" style="margin: 0 2px;">' . $i . '</span>';
                                                } else {
                                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_' . $carRevenue['car_id'] => $i])) . '#car-' . $carRevenue['car_id'] . '" class="btn btn-sm btn-default" style="margin: 0 2px;">' . $i . '</a>';
                                                }
                                            }
                                            ?>
                                            
                                            <?php if($currentPage < $totalPages) { ?>
                                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page_' . $carRevenue['car_id'] => $currentPage + 1])); ?>#car-<?php echo $carRevenue['car_id']; ?>" class="btn btn-sm btn-default">
                                                    Next <i class="fa fa-chevron-right"></i>
                                                </a>
                                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page_' . $carRevenue['car_id'] => $totalPages])); ?>#car-<?php echo $carRevenue['car_id']; ?>" class="btn btn-sm btn-default">
                                                    Last <i class="fa fa-fast-forward"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <small class="text-muted" style="display: block; margin-top: 10px;">
                                            Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?> (<?php echo $totalRecords; ?> total bookings)
                                        </small>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                            }
                            
                            // Bottom car pagination
                            if($totalCarPages > 1) {
                                echo '<div class="row" style="margin-top: 30px;" id="car-pagination-bottom">';
                                echo '<div class="col-md-12 text-center">';
                                echo '<div class="pagination-controls">';
                                if($carPage > 1) {
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['car_page' => 1])) . '#car-pagination-bottom" class="btn btn-default"><i class="fa fa-fast-backward"></i> First</a> ';
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['car_page' => $carPage - 1])) . '#car-pagination-bottom" class="btn btn-default"><i class="fa fa-chevron-left"></i> Previous</a> ';
                                }
                                
                                // Show page numbers for cars
                                $startPage = max(1, $carPage - 2);
                                $endPage = min($totalCarPages, $carPage + 2);
                                for($i = $startPage; $i <= $endPage; $i++) {
                                    if($i == $carPage) {
                                        echo '<span class="btn btn-primary" style="margin: 0 2px;">' . $i . '</span>';
                                    } else {
                                        echo '<a href="?' . http_build_query(array_merge($_GET, ['car_page' => $i])) . '#car-pagination-bottom" class="btn btn-default" style="margin: 0 2px;">' . $i . '</a>';
                                    }
                                }
                                
                                if($carPage < $totalCarPages) {
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['car_page' => $carPage + 1])) . '#car-pagination-bottom" class="btn btn-default">Next <i class="fa fa-chevron-right"></i></a> ';
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['car_page' => $totalCarPages])) . '#car-pagination-bottom" class="btn btn-default">Last <i class="fa fa-fast-forward"></i></a>';
                                }
                                echo '</div>';
                                echo '<small class="text-muted" style="display: block; margin-top: 10px;">Showing page ' . $carPage . ' of ' . $totalCarPages . ' (' . $totalCars . ' cars total)</small>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "<div class='alert alert-info'><i class='fa fa-info-circle'></i> No car bookings found for the selected filters.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-info'><i class='fa fa-info-circle'></i> No bookings available for the selected period.</div>";
                    }
                    ?>
                    
                </div>
                
                 <div class="clearfix"> </div>
                </div>
                
            </div>
            
        <div class="clearfix"> </div>
        </div>
        <!---->

        </div>
        <div class="clearfix"> </div>
       </div>
     </div>
<!---->

<script>
// Show/hide custom date inputs
$('select[name="period"]').change(function() {
    if($(this).val() == 'custom') {
        $('#custom-dates, #custom-dates-to').show();
    } else {
        $('#custom-dates, #custom-dates-to').hide();
    }
});

// Export to Excel function
function exportToExcel() {
    var currentUrl = window.location.href;
    var exportUrl = currentUrl + (currentUrl.indexOf('?') > -1 ? '&' : '?') + 'export=excel';
    window.location.href = exportUrl;
}

// Auto-submit form when period changes (optional)
$('select[name="period"], select[name="car_id"]').change(function() {
    // Uncomment the line below if you want auto-submit
    // $(this).closest('form').submit();
});

// Smooth scroll enhancement for pagination links
$(document).ready(function() {
    // If there's a hash in the URL, scroll to it smoothly after page load
    if(window.location.hash) {
        setTimeout(function() {
            var target = $(window.location.hash);
            if(target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        }, 500);
    }
    
    // Add loading indicators for pagination links
    $('.pagination-controls a').click(function() {
        var btn = $(this);
        var originalText = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
        btn.addClass('disabled');
        
        // Restore original text if navigation doesn't happen (fallback)
        setTimeout(function() {
            btn.html(originalText);
            btn.removeClass('disabled');
        }, 5000);
    });
});
</script>

<!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <script src="js/bootstrap.min.js"> </script>
</body>
</html>

<?php 

// Export to Excel functionality
if(isset($_GET['export']) && $_GET['export'] == 'excel') {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="car_revenue_report_'.date('Y-m-d').'.xls"');
    
    echo "<table border='1'>";
    echo "<tr><th>Car Name</th><th>Total Bookings</th><th>Total Revenue</th><th>Average Amount</th><th>First Booking</th><th>Last Booking</th></tr>";
    
    // Re-run the query for export
    $exportResult = $db->getConnection()->selectRecords($carRevenueQuery);
    if($exportResult && count($exportResult) > 0) {
        foreach($exportResult as $row) {
            if($row['booking_count'] > 0) {
                echo "<tr>";
                echo "<td>".$row['car_nme']."</td>";
                echo "<td>".$row['booking_count']."</td>";
                echo "<td>".$row['total_revenue']."</td>";
                echo "<td>".$row['avg_amount']."</td>";
                echo "<td>".date('d M Y', strtotime($row['first_booking']))."</td>";
                echo "<td>".date('d M Y', strtotime($row['last_booking']))."</td>";
                echo "</tr>";
            }
        }
    }
    echo "</table>";
    exit;
}

}else{
redirect("index.php");
 }?>
