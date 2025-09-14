<?php
require_once "includes/settings.php";
require_once "includes/database.php";
require_once "includes/classes/db.cls.php";
require_once "includes/classes/sitedata.cls.php";
require_once "includes/functions/common.php";
require_once "includes/classes/DBquery.cls.php";

$db = new SiteData();
$dbObj = new dbquery();

echo "<h3>Testing Index.php Modern Header Fix</h3>";

// Include the modern header hero to test the dropdown generation
ob_start();
include "includes1/modern-header-hero.php";
$header_content = ob_get_contents();
ob_end_clean();

// Extract just the pickup and drop location selects
preg_match('/<select[^>]*name="pickuploc"[^>]*>.*?<\/select>/s', $header_content, $pickup_matches);
preg_match('/<select[^>]*name="droploc"[^>]*>.*?<\/select>/s', $header_content, $drop_matches);

echo "<h4>Pickup Location Dropdown:</h4>";
if (!empty($pickup_matches[0])) {
    echo htmlspecialchars($pickup_matches[0]);
} else {
    echo "No pickup dropdown found";
}

echo "<h4>Drop Location Dropdown:</h4>";
if (!empty($drop_matches[0])) {
    echo htmlspecialchars($drop_matches[0]);
} else {
    echo "No drop dropdown found";
}

echo "<h4>Expected vs Actual:</h4>";
echo "<strong>Before Fix:</strong> Option showed 'Bhubaneswar Airport'<br>";
echo "<strong>After Fix:</strong> Option should show 'BHARTI TOWERS,AIRPORT ROAD,FOREST PARK,BHUBANESWAR,ODISHA'<br>";
?>
