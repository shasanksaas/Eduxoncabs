<?php
require_once "includes/settings.php";
require_once "includes/classes/db.cls.php"; // Load WADB class

// Create a database object
$db = new WADB(SYSTEM_DBHOST, SYSTEM_DBNAME, SYSTEM_DBUSER, SYSTEM_DBPWD);

 // Check if the connection is successful
// if ($db) {
//     echo "✅ Database connection successful!";
// } else {
//     echo "❌ Database connection failed!";
// }

$result = $db->selectRecords("SELECT * FROM tbl_cabs LIMIT 5");

if (!empty($result)) {
    echo "✅ Data fetched successfully!<br><pre>";
    print_r($result);
    echo "</pre>";
} else {
    echo "⚠️ No data found in the table!";
}
?>
