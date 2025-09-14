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
    table { width: 100%; }
    td, th {text-align: left; white-space: nowrap;}
    td.numeric, th.numeric { text-align: right; }
    .filter-container { 
        background: #f8f9fa; 
        padding: 20px; 
        margin-bottom: 20px; 
        border-radius: 5px; 
        border: 1px solid #dee2e6;
    }
    .revenue-summary {
        background: #e7f3ff;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        border-left: 4px solid #007bff;
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
    }
    .kpi-value {
        font-size: 2.5em;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .kpi-label {
        font-size: 0.9em;
        opacity: 0.9;
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
</style>
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
                    
                    // Get total revenue summary
                    $whereCondition = "status='Completed' AND vehicle_type='1' $orderDateFilter $orderCarFilter";
                    $totalBookings = $dbObj->countRec("tbl_order", $whereCondition);
                    
                    // Get revenue data using custom query
                    $totalRevenueQuery = "SELECT 
                        SUM(CAST(amount AS DECIMAL(10,2))) as total_revenue,
                        AVG(CAST(amount AS DECIMAL(10,2))) as avg_booking_amount
                        FROM tbl_order 
                        WHERE $whereCondition";
                    
                    $revenueData = $db->getConnection()->selectRecords($totalRevenueQuery);
                    
                    $totalStats = array(
                        'total_bookings' => $totalBookings,
                        'total_revenue' => (isset($revenueData[0]['total_revenue']) && $revenueData[0]['total_revenue']) ? $revenueData[0]['total_revenue'] : 0,
                        'avg_booking_amount' => (isset($revenueData[0]['avg_booking_amount']) && $revenueData[0]['avg_booking_amount']) ? $revenueData[0]['avg_booking_amount'] : 0
                    );
                    
                    // Debug output to verify filters
                    if(isset($_GET['debug'])) {
                        echo "<div class='alert alert-info'>";
                        echo "<h5>🔍 DEBUG INFO:</h5>";
                        echo "<strong>Current Date:</strong> " . date('Y-m-d H:i:s') . "<br>";
                        echo "<strong>Applied Period:</strong> " . $period . "<br>";
                        echo "<strong>Applied Car ID:</strong> " . (isset($_GET['car_id']) ? $_GET['car_id'] : 'All Cars') . "<br>";
                        echo "<strong>Date Filter (for JOINs):</strong> " . ($dateFilter ? $dateFilter : 'No date filter') . "<br>";
                        echo "<strong>Order Date Filter (for WHERE):</strong> " . ($orderDateFilter ? $orderDateFilter : 'No date filter') . "<br>";
                        echo "<strong>Car Filter:</strong> " . ($orderCarFilter ? $orderCarFilter : 'No car filter') . "<br>";
                        echo "<strong>Complete WHERE Condition:</strong> " . $whereCondition . "<br>";
                        echo "<strong>Total Revenue Query:</strong> " . $totalRevenueQuery . "<br>";
                        
                        // Show what the date calculations are
                        echo "<strong>Date Calculations:</strong><br>";
                        echo "- 1 week ago: " . date('Y-m-d H:i:s', strtotime('-1 week')) . "<br>";
                        echo "- 1 month ago: " . date('Y-m-d H:i:s', strtotime('-1 month')) . "<br>";
                        echo "- 1 year ago: " . date('Y-m-d H:i:s', strtotime('-1 year')) . "<br>";
                        echo "</div>";
                    }
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
                                <h5>Average Booking Amount</h5>
                                <div class="total-amount">₹<?php echo number_format($totalStats['avg_booking_amount'], 2); ?></div>
                            </div>
                            <div class="col-md-3">
                                <h5>Period</h5>
                                <div class="total-amount">
                                    <?php 
                                    switch($period) {
                                        case '1week': echo 'Last 1 Week'; break;
                                        case '1month': echo 'Last 1 Month'; break;
                                        case '1year': echo 'Last 1 Year'; break;
                                        case 'custom': echo 'Custom Range'; break;
                                        default: echo 'All Time'; break;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Get top performers and insights from the full database (respecting current filters)
                    
                    // 1. Most Booked Car
                    $topCarQuery = "SELECT 
                        c.car_nme, 
                        COUNT(o.id) as booking_count,
                        SUM(CAST(o.amount AS DECIMAL(10,2))) as total_revenue
                        FROM tbl_cabs c
                        INNER JOIN tbl_order o ON c.id = o.car_id 
                        WHERE c.status = 1 
                        AND o.status='Completed' 
                        AND o.vehicle_type='1'
                        $dateFilter $carFilter
                        GROUP BY c.id, c.car_nme
                        ORDER BY booking_count DESC 
                        LIMIT 1";
                    
                    $topCarResult = $db->getConnection()->selectRecords($topCarQuery);
                    
                    // 2. Highest Revenue Car
                    $topRevenueCarQuery = "SELECT 
                        c.car_nme, 
                        COUNT(o.id) as booking_count,
                        SUM(CAST(o.amount AS DECIMAL(10,2))) as total_revenue
                        FROM tbl_cabs c
                        INNER JOIN tbl_order o ON c.id = o.car_id 
                        WHERE c.status = 1 
                        AND o.status='Completed' 
                        AND o.vehicle_type='1'
                        $dateFilter $carFilter
                        GROUP BY c.id, c.car_nme
                        ORDER BY total_revenue DESC 
                        LIMIT 1";
                    
                    $topRevenueCarResult = $db->getConnection()->selectRecords($topRevenueCarQuery);
                    
                    // 3. Top Customer (most bookings)
                    $topCustomerQuery = "SELECT 
                        buyer_name, 
                        phone,
                        COUNT(id) as booking_count,
                        SUM(CAST(amount AS DECIMAL(10,2))) as total_spent
                        FROM tbl_order 
                        WHERE status='Completed' 
                        AND vehicle_type='1'
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
                        SUM(CAST(amount AS DECIMAL(10,2))) as total_spent
                        FROM tbl_order 
                        WHERE status='Completed' 
                        AND vehicle_type='1'
                        $orderDateFilter $orderCarFilter
                        GROUP BY buyer_name, phone
                        ORDER BY total_spent DESC 
                        LIMIT 1";
                    
                    $topValueCustomerResult = $db->getConnection()->selectRecords($topValueCustomerQuery);
                    
                    // 5. Payment Method Statistics
                    $paymentStatsQuery = "SELECT 
                        secur_pay_type,
                        COUNT(id) as booking_count,
                        SUM(CAST(amount AS DECIMAL(10,2))) as total_revenue
                        FROM tbl_order 
                        WHERE status='Completed' 
                        AND vehicle_type='1'
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
                            SUM(CAST(amount AS DECIMAL(10,2))) as total_revenue
                            FROM tbl_order 
                            WHERE status='Completed' 
                            AND vehicle_type='1'
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
                                    <div class="kpi-value" style="font-size: 1.5em;">
                                        <?php 
                                        if($topCarResult && count($topCarResult) > 0) {
                                            echo $topCarResult[0]['car_nme'];
                                            echo "<br><small style='font-size: 0.5em;'>" . $topCarResult[0]['booking_count'] . " bookings</small>";
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Highest Revenue Car -->
                            <div class="col-md-3">
                                <div class="kpi-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                    <div class="kpi-label">Top Revenue Car</div>
                                    <div class="kpi-value" style="font-size: 1.5em;">
                                        <?php 
                                        if($topRevenueCarResult && count($topRevenueCarResult) > 0) {
                                            echo $topRevenueCarResult[0]['car_nme'];
                                            echo "<br><small style='font-size: 0.5em;'>₹" . number_format($topRevenueCarResult[0]['total_revenue'], 0) . "</small>";
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Top Customer by Bookings -->
                            <div class="col-md-3">
                                <div class="kpi-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                    <div class="kpi-label">Top Customer (Bookings)</div>
                                    <div class="kpi-value" style="font-size: 1.5em;">
                                        <?php 
                                        if($topCustomerResult && count($topCustomerResult) > 0) {
                                            echo substr($topCustomerResult[0]['buyer_name'], 0, 15) . (strlen($topCustomerResult[0]['buyer_name']) > 15 ? '...' : '');
                                            echo "<br><small style='font-size: 0.5em;'>" . $topCustomerResult[0]['booking_count'] . " bookings</small>";
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Top Value Customer -->
                            <div class="col-md-3">
                                <div class="kpi-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                    <div class="kpi-label">Top Value Customer</div>
                                    <div class="kpi-value" style="font-size: 1.5em;">
                                        <?php 
                                        if($topValueCustomerResult && count($topValueCustomerResult) > 0) {
                                            echo substr($topValueCustomerResult[0]['buyer_name'], 0, 15) . (strlen($topValueCustomerResult[0]['buyer_name']) > 15 ? '...' : '');
                                            echo "<br><small style='font-size: 0.5em;'>₹" . number_format($topValueCustomerResult[0]['total_spent'], 0) . "</small>";
                                        } else {
                                            echo "No data";
                                        }
                                        ?>
                                    </div>
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
                        // Only run car revenue query if we have bookings in the filtered period
                        $carRevenueQuery = "SELECT 
                            c.id as car_id,
                            c.car_nme,
                            c.car_image,
                            COUNT(o.id) as booking_count,
                            SUM(CAST(o.amount AS DECIMAL(10,2))) as total_revenue,
                            AVG(CAST(o.amount AS DECIMAL(10,2))) as avg_amount,
                            MIN(o.submit_dte) as first_booking,
                            MAX(o.submit_dte) as last_booking
                            FROM tbl_cabs c
                            INNER JOIN tbl_order o ON c.id = o.car_id 
                            WHERE c.status = 1 
                            AND o.status='Completed' 
                            AND o.vehicle_type='1'
                            $dateFilter $carFilter
                            GROUP BY c.id, c.car_nme, c.car_image
                            ORDER BY total_revenue DESC";
                        
                        if(isset($_GET['debug'])) {
                            echo "<div class='alert alert-warning'>";
                            echo "<strong>Car Revenue Query:</strong> " . $carRevenueQuery . "<br>";
                            echo "</div>";
                        }
                        
                        $carRevenueResult = $db->getConnection()->selectRecords($carRevenueQuery);
                        
                        if($carRevenueResult && count($carRevenueResult) > 0) {
                            foreach($carRevenueResult as $carRevenue) {
                    ?>
                    
                    <!-- Car Revenue Card -->
                    <div class="car-revenue-card">
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
                                <div class="col-md-3">
                                    <strong>Total Bookings:</strong> <?php echo $carRevenue['booking_count']; ?>
                                </div>
                                <div class="col-md-3">
                                    <strong>Average Amount:</strong> ₹<?php echo number_format($carRevenue['avg_amount'], 2); ?>
                                </div>
                                <div class="col-md-3">
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
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Customer Name</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Booking Date</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Payment Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Get individual bookings for this car
                                    $individualBookingsQuery = "SELECT 
                                        id, order_id, buyer_name, phone, amount, submit_dte, 
                                        from_date, to_date, secur_pay_type
                                        FROM tbl_order 
                                        WHERE car_id = ".$carRevenue['car_id']." 
                                        AND status='Completed' AND vehicle_type='1'
                                        $orderDateFilter
                                        ORDER BY submit_dte DESC";
                                    
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
                                            <td>₹<?php echo number_format($booking['amount'], 2); ?></td>
                                            <td><?php echo date('d M Y H:i', strtotime($booking['submit_dte'])); ?></td>
                                            <td><?php echo date('d M Y H:i', strtotime($booking['from_date'])); ?></td>
                                            <td><?php echo date('d M Y H:i', strtotime($booking['to_date'])); ?></td>
                                            <td><span class="label label-<?php echo ($booking['secur_pay_type'] == 1) ? 'success' : 'warning'; ?>"><?php echo $paymentType; ?></span></td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No bookings found for this car in the selected period.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php
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
