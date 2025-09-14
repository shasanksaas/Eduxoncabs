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

if($admin_type==1 || $admin_type==4){
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?=PAGE_TITLE?> :: ANALYTICS DASHBOARD</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<style>
    .dashboard-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-left: 4px solid #007bff;
    }
    .metric-card {
        text-align: center;
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .metric-value {
        font-size: 2.5em;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .chart-container {
        position: relative;
        height: 400px;
        margin: 20px 0;
    }
    .insight-card {
        background: #f8f9fa;
        border-left: 4px solid #28a745;
        padding: 15px;
        margin: 15px 0;
        border-radius: 0 5px 5px 0;
    }
    .trend-indicator {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
    }
    .trend-up { background: #28a745; color: white; }
    .trend-down { background: #dc3545; color: white; }
    .trend-stable { background: #6c757d; color: white; }
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
            <h1><a class="navbar-brand" href="index.php"><img src="images/logo.png" border="0" alt="Logo" title="EduxonCabs" height="98px"/></a></h1>         
        </div>
        <div class=" border-bottom">
            <div class="full-left">
                <section class="full-top">
                    <button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
                </section>
                <div class="clearfix"> </div>
            </div>
            <?php include("includes/header2.php");?>
            <div class="clearfix"></div>
            <?php include("includes/column_left2.php");?>
        </div>
    </nav>
    
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            <div class="banner">
                <h2>
                    <a href="index.php">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Analytics Dashboard</span>
                </h2>
            </div>
            
            <div class="content-top">
                <div class="col-md-12">
                    <div class="content-top-1">
                        <div class="col-md-12 top-content">
                            <?php getMessage();?>
                            
                            <?php
                            // Get comprehensive analytics data
                            $conn = $db->getConnection();
                            
                            // Today's metrics
                            $todayQuery = "SELECT 
                                COUNT(*) as today_bookings,
                                COALESCE(SUM(CAST(amount AS DECIMAL(10,2))), 0) as today_revenue,
                                AVG(CAST(amount AS DECIMAL(10,2))) as today_avg
                                FROM tbl_order 
                                WHERE DATE(submit_dte) = CURDATE() 
                                AND status='Completed' AND vehicle_type='1'";
                            $todayData = $conn->selectRecords($todayQuery);
                            $today = isset($todayData[0]) ? $todayData[0] : ['today_bookings' => 0, 'today_revenue' => 0, 'today_avg' => 0];
                            
                            // This month's metrics
                            $monthQuery = "SELECT 
                                COUNT(*) as month_bookings,
                                COALESCE(SUM(CAST(amount AS DECIMAL(10,2))), 0) as month_revenue,
                                AVG(CAST(amount AS DECIMAL(10,2))) as month_avg
                                FROM tbl_order 
                                WHERE MONTH(submit_dte) = MONTH(CURDATE()) 
                                AND YEAR(submit_dte) = YEAR(CURDATE())
                                AND status='Completed' AND vehicle_type='1'";
                            $monthData = $conn->selectRecords($monthQuery);
                            $month = isset($monthData[0]) ? $monthData[0] : ['month_bookings' => 0, 'month_revenue' => 0, 'month_avg' => 0];
                            
                            // Growth comparison (previous month)
                            $prevMonthQuery = "SELECT 
                                COUNT(*) as prev_bookings,
                                COALESCE(SUM(CAST(amount AS DECIMAL(10,2))), 0) as prev_revenue
                                FROM tbl_order 
                                WHERE MONTH(submit_dte) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                                AND YEAR(submit_dte) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                                AND status='Completed' AND vehicle_type='1'";
                            $prevMonthData = $conn->selectRecords($prevMonthQuery);
                            $prevMonth = isset($prevMonthData[0]) ? $prevMonthData[0] : ['prev_bookings' => 0, 'prev_revenue' => 0];
                            
                            // Calculate growth rates
                            $revenueGrowth = $prevMonth['prev_revenue'] > 0 ? 
                                (($month['month_revenue'] - $prevMonth['prev_revenue']) / $prevMonth['prev_revenue']) * 100 : 0;
                            $bookingGrowth = $prevMonth['prev_bookings'] > 0 ? 
                                (($month['month_bookings'] - $prevMonth['prev_bookings']) / $prevMonth['prev_bookings']) * 100 : 0;
                            ?>
                            
                            <!-- Key Metrics Row -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="metric-card">
                                        <div class="metric-value">₹<?php echo number_format($today['today_revenue']); ?></div>
                                        <div>Today's Revenue</div>
                                        <small><?php echo $today['today_bookings']; ?> bookings</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric-card">
                                        <div class="metric-value">₹<?php echo number_format($month['month_revenue']); ?></div>
                                        <div>This Month's Revenue</div>
                                        <span class="trend-indicator <?php echo ($revenueGrowth > 0) ? 'trend-up' : ($revenueGrowth < 0 ? 'trend-down' : 'trend-stable'); ?>">
                                            <?php echo ($revenueGrowth > 0 ? '+' : '') . number_format($revenueGrowth, 1); ?>%
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric-card">
                                        <div class="metric-value"><?php echo $month['month_bookings']; ?></div>
                                        <div>Monthly Bookings</div>
                                        <span class="trend-indicator <?php echo ($bookingGrowth > 0) ? 'trend-up' : ($bookingGrowth < 0 ? 'trend-down' : 'trend-stable'); ?>">
                                            <?php echo ($bookingGrowth > 0 ? '+' : '') . number_format($bookingGrowth, 1); ?>%
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric-card">
                                        <div class="metric-value">₹<?php echo number_format($month['month_avg']); ?></div>
                                        <div>Average Booking Value</div>
                                        <small>This month</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Charts Row -->
                            <div class="row">
                                <!-- Revenue Trend Chart -->
                                <div class="col-md-6">
                                    <div class="dashboard-card">
                                        <h4><i class="fa fa-line-chart"></i> Revenue Trend (Last 30 Days)</h4>
                                        <div class="chart-container">
                                            <canvas id="revenueChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Car Performance Chart -->
                                <div class="col-md-6">
                                    <div class="dashboard-card">
                                        <h4><i class="fa fa-pie-chart"></i> Car Revenue Distribution</h4>
                                        <div class="chart-container">
                                            <canvas id="carPerformanceChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Booking Patterns -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="dashboard-card">
                                        <h4><i class="fa fa-calendar"></i> Booking Patterns (Day of Week)</h4>
                                        <div class="chart-container">
                                            <canvas id="bookingPatternsChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Payment Methods -->
                                <div class="col-md-6">
                                    <div class="dashboard-card">
                                        <h4><i class="fa fa-credit-card"></i> Payment Methods</h4>
                                        <div class="chart-container">
                                            <canvas id="paymentMethodsChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                            // Get data for charts
                            
                            // Last 30 days revenue data
                            $last30DaysQuery = "SELECT 
                                DATE(submit_dte) as booking_date,
                                COALESCE(SUM(CAST(amount AS DECIMAL(10,2))), 0) as daily_revenue,
                                COUNT(*) as daily_bookings
                                FROM tbl_order 
                                WHERE submit_dte >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                                AND status='Completed' AND vehicle_type='1'
                                GROUP BY DATE(submit_dte)
                                ORDER BY booking_date";
                            $last30Days = $conn->selectRecords($last30DaysQuery);
                            
                            // Car revenue distribution
                            $carDistributionQuery = "SELECT 
                                c.car_nme,
                                COALESCE(SUM(CAST(o.amount AS DECIMAL(10,2))), 0) as car_revenue,
                                COUNT(o.id) as car_bookings
                                FROM tbl_cabs c
                                LEFT JOIN tbl_order o ON c.id = o.car_id 
                                WHERE c.status = 1 AND (o.status='Completed' OR o.status IS NULL)
                                AND (o.vehicle_type='1' OR o.vehicle_type IS NULL)
                                AND o.submit_dte >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                                GROUP BY c.id, c.car_nme
                                HAVING car_revenue > 0
                                ORDER BY car_revenue DESC
                                LIMIT 10";
                            $carDistribution = $conn->selectRecords($carDistributionQuery);
                            
                            // Booking patterns by day of week
                            $bookingPatternsQuery = "SELECT 
                                DAYNAME(submit_dte) as day_name,
                                DAYOFWEEK(submit_dte) as day_number,
                                COUNT(*) as booking_count,
                                SUM(CAST(amount AS DECIMAL(10,2))) as day_revenue
                                FROM tbl_order 
                                WHERE submit_dte >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                                AND status='Completed' AND vehicle_type='1'
                                GROUP BY DAYOFWEEK(submit_dte), DAYNAME(submit_dte)
                                ORDER BY day_number";
                            $bookingPatterns = $conn->selectRecords($bookingPatternsQuery);
                            
                            // Payment methods distribution
                            $paymentMethodsQuery = "SELECT 
                                secur_pay_type,
                                COUNT(*) as payment_count,
                                SUM(CAST(amount AS DECIMAL(10,2))) as payment_revenue
                                FROM tbl_order 
                                WHERE submit_dte >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                                AND status='Completed' AND vehicle_type='1'
                                GROUP BY secur_pay_type";
                            $paymentMethods = $conn->selectRecords($paymentMethodsQuery);
                            ?>
                            
                            <!-- Business Insights -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="dashboard-card">
                                        <h4><i class="fa fa-lightbulb-o"></i> Business Insights & Recommendations</h4>
                                        
                                        <div class="insight-card">
                                            <h5>📈 Revenue Performance</h5>
                                            <p>
                                                <?php if($revenueGrowth > 10): ?>
                                                    <strong>Excellent Growth:</strong> Revenue is up <?php echo number_format($revenueGrowth, 1); ?>% this month. Consider expanding your fleet or increasing marketing efforts.
                                                <?php elseif($revenueGrowth > 0): ?>
                                                    <strong>Positive Growth:</strong> Revenue increased by <?php echo number_format($revenueGrowth, 1); ?>%. Focus on customer retention and referral programs.
                                                <?php else: ?>
                                                    <strong>Attention Needed:</strong> Revenue declined by <?php echo abs(number_format($revenueGrowth, 1)); ?>%. Consider promotional campaigns or service improvements.
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                        
                                        <div class="insight-card">
                                            <h5>🚗 Fleet Optimization</h5>
                                            <p>
                                                <?php 
                                                $totalCars = count($dbObj->fetch_data("tbl_cabs", "status=1"));
                                                $activeCars = count($carDistribution);
                                                $utilizationRate = ($activeCars / $totalCars) * 100;
                                                ?>
                                                Fleet utilization: <?php echo number_format($utilizationRate, 1); ?>% (<?php echo $activeCars; ?> of <?php echo $totalCars; ?> cars active).
                                                <?php if($utilizationRate < 70): ?>
                                                    Consider promoting underutilized vehicles or removing inactive ones.
                                                <?php else: ?>
                                                    Good fleet utilization. Monitor top performers for fleet expansion decisions.
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                        
                                        <div class="insight-card">
                                            <h5>💳 Payment Trends</h5>
                                            <p>
                                                <?php 
                                                $onlinePayments = 0; $cashPayments = 0;
                                                foreach($paymentMethods as $payment) {
                                                    if($payment['secur_pay_type'] == 1) $onlinePayments = $payment['payment_count'];
                                                    else $cashPayments = $payment['payment_count'];
                                                }
                                                $totalPayments = $onlinePayments + $cashPayments;
                                                $onlinePercentage = $totalPayments > 0 ? ($onlinePayments / $totalPayments) * 100 : 0;
                                                ?>
                                                Online payments: <?php echo number_format($onlinePercentage, 1); ?>% of transactions.
                                                <?php if($onlinePercentage < 60): ?>
                                                    Consider incentivizing online payments to improve cash flow and reduce collection efforts.
                                                <?php else: ?>
                                                    Good digital adoption. Continue promoting online payment benefits.
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Prepare data for charts
const revenueData = {
    labels: [<?php 
        if($last30Days) {
            foreach($last30Days as $day) {
                echo "'" . date('M j', strtotime($day['booking_date'])) . "',";
            }
        }
    ?>],
    datasets: [{
        label: 'Daily Revenue',
        data: [<?php 
            if($last30Days) {
                foreach($last30Days as $day) {
                    echo $day['daily_revenue'] . ",";
                }
            }
        ?>],
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        tension: 0.1
    }]
};

const carPerformanceData = {
    labels: [<?php 
        if($carDistribution) {
            foreach($carDistribution as $car) {
                echo "'" . addslashes($car['car_nme']) . "',";
            }
        }
    ?>],
    datasets: [{
        data: [<?php 
            if($carDistribution) {
                foreach($carDistribution as $car) {
                    echo $car['car_revenue'] . ",";
                }
            }
        ?>],
        backgroundColor: [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
            '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF6384'
        ]
    }]
};

const bookingPatternsData = {
    labels: [<?php 
        if($bookingPatterns) {
            foreach($bookingPatterns as $pattern) {
                echo "'" . $pattern['day_name'] . "',";
            }
        }
    ?>],
    datasets: [{
        label: 'Bookings',
        data: [<?php 
            if($bookingPatterns) {
                foreach($bookingPatterns as $pattern) {
                    echo $pattern['booking_count'] . ",";
                }
            }
        ?>],
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }]
};

const paymentMethodsData = {
    labels: ['Online Payments', 'Cash Payments'],
    datasets: [{
        data: [
            <?php echo $onlinePayments; ?>,
            <?php echo $cashPayments; ?>
        ],
        backgroundColor: ['#28a745', '#ffc107']
    }]
};

// Initialize charts
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'line',
    data: revenueData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '₹' + value.toLocaleString();
                    }
                }
            }
        }
    }
});

const carPerformanceCtx = document.getElementById('carPerformanceChart').getContext('2d');
new Chart(carPerformanceCtx, {
    type: 'doughnut',
    data: carPerformanceData,
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

const bookingPatternsCtx = document.getElementById('bookingPatternsChart').getContext('2d');
new Chart(bookingPatternsCtx, {
    type: 'bar',
    data: bookingPatternsData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const paymentMethodsCtx = document.getElementById('paymentMethodsChart').getContext('2d');
new Chart(paymentMethodsCtx, {
    type: 'pie',
    data: paymentMethodsData,
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php 
}else{
    redirect("index.php");
}
?>
