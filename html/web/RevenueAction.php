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
$admin_type = $_SESSION[SES]['admin']['admin_type'];

// Get database connection using the existing method
$conn = $db->getConnection();

// Handle AJAX requests
if(isset($_POST['action'])) {
    
    switch($_POST['action']) {
        case 'get_car_bookings':
            $car_id = $_POST['car_id'];
            $period = $_POST['period'];
            $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
            $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
            
            // Build date filter
            $dateFilter = "";
            switch($period) {
                case '1week':
                    $dateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
                    break;
                case '1month':
                    $dateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                    break;
                case '1year':
                    $dateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
                    break;
                case 'custom':
                    if($from_date != '' && $to_date != '') {
                        $dateFilter = "AND DATE(submit_dte) BETWEEN '$from_date' AND '$to_date'";
                    }
                    break;
            }
            
            $query = "SELECT 
                        id, order_id, buyer_name, phone, email, amount, submit_dte, 
                        from_date, to_date, secur_pay_type, booked_car
                        FROM tbl_order 
                        WHERE car_id = '$car_id' 
                        AND status='Completed' AND vehicle_type='1'
                        $dateFilter
                        ORDER BY submit_dte DESC";
            
            $result = $conn->selectRecords($query);
            $bookings = [];
            
            if($result && count($result) > 0) {
                $bookings = $result;
            }
            
            header('Content-Type: application/json');
            echo json_encode($bookings);
            exit;
            break;
            
        case 'get_revenue_summary':
            $period = $_POST['period'];
            $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : '';
            $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
            $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
            
            // Build filters
            $dateFilter = "";
            switch($period) {
                case '1week':
                    $dateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
                    break;
                case '1month':
                    $dateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                    break;
                case '1year':
                    $dateFilter = "AND submit_dte >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
                    break;
                case 'custom':
                    if($from_date != '' && $to_date != '') {
                        $dateFilter = "AND DATE(submit_dte) BETWEEN '$from_date' AND '$to_date'";
                    }
                    break;
            }
            
            $carFilter = "";
            if($car_id != '') {
                $carFilter = "AND car_id = '$car_id'";
            }
            
            // Get summary data
            $summaryQuery = "SELECT 
                COUNT(*) as total_bookings,
                SUM(CAST(amount AS DECIMAL(10,2))) as total_revenue,
                AVG(CAST(amount AS DECIMAL(10,2))) as avg_booking_amount,
                MIN(submit_dte) as first_booking,
                MAX(submit_dte) as last_booking
                FROM tbl_order 
                WHERE status='Completed' AND vehicle_type='1' $dateFilter $carFilter";
            
            $result = $conn->selectRecords($summaryQuery);
            $summary = (isset($result[0])) ? $result[0] : [];
            
            // Get top performing cars
            $topCarsQuery = "SELECT 
                c.car_nme,
                COUNT(o.id) as booking_count,
                SUM(CAST(o.amount AS DECIMAL(10,2))) as total_revenue
                FROM tbl_cabs c
                JOIN tbl_order o ON c.id = o.car_id 
                WHERE o.status='Completed' AND o.vehicle_type='1' $dateFilter $carFilter
                GROUP BY c.id, c.car_nme
                ORDER BY total_revenue DESC
                LIMIT 5";
            
            $topCarsResult = $conn->selectRecords($topCarsQuery);
            $topCars = [];
            if($topCarsResult && count($topCarsResult) > 0) {
                $topCars = $topCarsResult;
            }
            
            $response = [
                'summary' => $summary,
                'top_cars' => $topCars
            ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
            break;
    }
}

// Handle CSV Export
if(isset($_GET['export']) && $_GET['export'] == 'csv') {
    $period = isset($_GET['period']) ? $_GET['period'] : 'all';
    $car_id = isset($_GET['car_id']) ? $_GET['car_id'] : '';
    $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
    $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
    
    // Build filters
    $dateFilter = "";
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
            if($from_date != '' && $to_date != '') {
                $dateFilter = "AND DATE(o.submit_dte) BETWEEN '$from_date' AND '$to_date'";
            }
            break;
    }
    
    $carFilter = "";
    if($car_id != '') {
        $carFilter = "AND o.car_id = '$car_id'";
    }
    
    $exportQuery = "SELECT 
        o.order_id,
        o.buyer_name,
        o.email,
        o.phone,
        c.car_nme,
        o.amount,
        o.submit_dte,
        o.from_date,
        o.to_date,
        CASE WHEN o.secur_pay_type = 1 THEN 'Online' ELSE 'Cash' END as payment_type,
        o.status
        FROM tbl_order o
        JOIN tbl_cabs c ON o.car_id = c.id
        WHERE o.status='Completed' AND o.vehicle_type='1' $dateFilter $carFilter
        ORDER BY o.submit_dte DESC";
    
    $result = $conn->selectRecords($exportQuery);
    
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="car_revenue_report_'.date('Y-m-d_H-i-s').'.csv"');
    
    $output = fopen('php://output', 'w');
    
    // Add CSV headers
    fputcsv($output, [
        'Order ID', 'Customer Name', 'Email', 'Phone', 'Car Name', 
        'Amount', 'Booking Date', 'From Date', 'To Date', 'Payment Type', 'Status'
    ]);
    
    // Add data rows
    if($result && count($result) > 0) {
        foreach($result as $row) {
            fputcsv($output, [
                $row['order_id'],
                $row['buyer_name'],
                $row['email'],
                $row['phone'],
                $row['car_nme'],
                $row['amount'],
                $row['submit_dte'],
                $row['from_date'],
                $row['to_date'],
                $row['payment_type'],
                $row['status']
            ]);
        }
    }    fclose($output);
    exit;
}
?>
