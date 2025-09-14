<?php
// Revenue Dashboard Widget
// Include this in your main dashboard

$conn = $db->getConnection();

// Get today's revenue
$todayRevenue = "SELECT 
    COUNT(*) as today_bookings,
    COALESCE(SUM(CAST(amount AS DECIMAL(10,2))), 0) as today_revenue
    FROM tbl_order 
    WHERE DATE(submit_dte) = CURDATE() 
    AND status='Completed' AND vehicle_type='1'";

$todayResult = $conn->selectRecords($todayRevenue);
$todayStats = (isset($todayResult[0])) ? $todayResult[0] : ['today_bookings' => 0, 'today_revenue' => 0];

// Get this month's revenue
$monthRevenue = "SELECT 
    COUNT(*) as month_bookings,
    COALESCE(SUM(CAST(amount AS DECIMAL(10,2))), 0) as month_revenue
    FROM tbl_order 
    WHERE MONTH(submit_dte) = MONTH(CURDATE()) 
    AND YEAR(submit_dte) = YEAR(CURDATE())
    AND status='Completed' AND vehicle_type='1'";

$monthResult = $conn->selectRecords($monthRevenue);
$monthStats = (isset($monthResult[0])) ? $monthResult[0] : ['month_bookings' => 0, 'month_revenue' => 0];

// Get top performing car this month
$topCarQuery = "SELECT 
    c.car_nme,
    COUNT(o.id) as bookings,
    SUM(CAST(o.amount AS DECIMAL(10,2))) as revenue
    FROM tbl_cabs c
    JOIN tbl_order o ON c.id = o.car_id 
    WHERE MONTH(o.submit_dte) = MONTH(CURDATE()) 
    AND YEAR(o.submit_dte) = YEAR(CURDATE())
    AND o.status='Completed' AND o.vehicle_type='1'
    GROUP BY c.id, c.car_nme
    ORDER BY revenue DESC
    LIMIT 1";

$topCarResult = $conn->selectRecords($topCarQuery);
$topCar = (isset($topCarResult[0])) ? $topCarResult[0] : null;
?>

<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4><i class="fa fa-bar-chart"></i> Revenue Summary</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-panel text-center">
                            <div class="stat-cell">
                                <i class="fa fa-calendar text-success" style="font-size: 30px;"></i>
                                <h4>Today</h4>
                                <span class="text-success" style="font-size: 18px; font-weight: bold;">
                                    ₹<?php echo number_format($todayStats['today_revenue'], 2); ?>
                                </span>
                                <br>
                                <small><?php echo $todayStats['today_bookings']; ?> Bookings</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-panel text-center">
                            <div class="stat-cell">
                                <i class="fa fa-calendar-o text-info" style="font-size: 30px;"></i>
                                <h4>This Month</h4>
                                <span class="text-info" style="font-size: 18px; font-weight: bold;">
                                    ₹<?php echo number_format($monthStats['month_revenue'], 2); ?>
                                </span>
                                <br>
                                <small><?php echo $monthStats['month_bookings']; ?> Bookings</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-panel text-center">
                            <div class="stat-cell">
                                <i class="fa fa-trophy text-warning" style="font-size: 30px;"></i>
                                <h4>Top Car</h4>
                                <span class="text-warning" style="font-size: 14px; font-weight: bold;">
                                    <?php echo $topCar ? substr($topCar['car_nme'], 0, 20) : 'N/A'; ?>
                                </span>
                                <br>
                                <small><?php echo $topCar ? '₹'.number_format($topCar['revenue'], 2) : 'No data'; ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-panel text-center">
                            <div class="stat-cell">
                                <i class="fa fa-bar-chart text-primary" style="font-size: 30px;"></i>
                                <h4>View Reports</h4>
                                <a href="revenue-report.php" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> Detailed Report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-panel {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
    border: 1px solid #dee2e6;
    height: 120px;
}
.stat-cell {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
</style>
