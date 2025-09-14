<?php
// Simple test to check if dropdown works
require_once "includes/settings.php";
require_once "includes/database.php";
require_once "includes/classes/db.cls.php";
require_once "includes/classes/sitedata.cls.php";
require_once "includes/classes/DBquery.cls.php";

$db = new SiteData();
$dbObj = new dbquery();

echo "<h2>Dropdown Test</h2>";

// Test 1: Simple hardcoded dropdown
echo "<h3>Test 1: Hardcoded Options</h3>";
echo '<select id="test1" style="color: black; background: white; padding: 10px; border: 1px solid black;">';
echo '<option value="">Choose location</option>';
echo '<option value="1">Bhubaneswar Airport</option>';
echo '<option value="2">Railway Station</option>';
echo '<option value="3">City Center</option>';
echo '</select>';

// Test 2: Database-driven dropdown
echo "<h3>Test 2: Database Options</h3>";
echo '<select id="test2" style="color: black; background: white; padding: 10px; border: 1px solid black;">';
echo '<option value="">Choose location</option>';

try {
    $get_location_data = $dbObj->fetch_data("location", "city_id = '1'");
    if ($get_location_data && count($get_location_data) > 0) {
        foreach ($get_location_data as $data) {
            $pick_Point = $data['pick_point'];
            echo '<option value="'.$data['id'].'">'.$pick_Point.'</option>';
        }
        echo "</select>";
        echo "<p>Found " . count($get_location_data) . " locations in database.</p>";
    } else {
        echo '<option value="1">No database data - using fallback</option>';
        echo "</select>";
        echo "<p>No data found in database.</p>";
    }
} catch (Exception $e) {
    echo '<option value="1">Database error - using fallback</option>';
    echo "</select>";
    echo "<p>Database error: " . $e->getMessage() . "</p>";
}

// Test 3: Check database connection
echo "<h3>Test 3: Database Connection</h3>";
$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    echo "Connection failed: " . $mysqli_conn->connect_error;
} else {
    echo "Database connected successfully!";
    
    // Check if location table exists
    $result = $mysqli_conn->query("SHOW TABLES LIKE 'location'");
    if ($result->num_rows > 0) {
        echo "<br>Location table exists.";
        
        // Check location table contents
        $result = $mysqli_conn->query("SELECT COUNT(*) as count FROM location WHERE city_id = '1'");
        $row = $result->fetch_assoc();
        echo "<br>Found " . $row['count'] . " locations with city_id = 1";
        
        // Show actual data
        $result = $mysqli_conn->query("SELECT id, pick_point FROM location WHERE city_id = '1' LIMIT 5");
        echo "<br>Sample data:";
        while ($row = $result->fetch_assoc()) {
            echo "<br>ID: " . $row['id'] . " - " . $row['pick_point'];
        }
    } else {
        echo "<br>Location table does not exist.";
    }
}
?>
