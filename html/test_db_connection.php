<?php
/**
 * Test file to verify centralized database connection works
 */

// Include the centralized database connection
require_once("includes/db_connection.php");

// Test 1: Check if connection exists
if (isset($mysqli_conn) && $mysqli_conn instanceof mysqli) {
    echo "✅ Database connection object exists and is of correct type (mysqli)<br>";
} else {
    echo "❌ Database connection object is missing or wrong type<br>";
    exit;
}

// Test 2: Check if connection is active
if (!$mysqli_conn->connect_error) {
    echo "✅ Database connection is active (no connection errors)<br>";
} else {
    echo "❌ Database connection has errors: " . $mysqli_conn->connect_error . "<br>";
    exit;
}

// Test 3: Try a simple query
$result = $mysqli_conn->query("SELECT 1 as test_value");
if ($result) {
    $row = $result->fetch_assoc();
    if ($row['test_value'] == 1) {
        echo "✅ Database query test successful<br>";
    } else {
        echo "❌ Database query returned unexpected result<br>";
    }
    $result->free();
} else {
    echo "❌ Database query test failed: " . $mysqli_conn->error . "<br>";
}

// Test 4: Check database name
$result = $mysqli_conn->query("SELECT DATABASE() as db_name");
if ($result) {
    $row = $result->fetch_assoc();
    echo "✅ Connected to database: " . ($row['db_name'] ?? 'NULL') . "<br>";
    $result->free();
} else {
    echo "❌ Could not check database name: " . $mysqli_conn->error . "<br>";
}

// Test 5: Try including and using DBquery class
try {
    require_once("includes/classes/DBquery.cls.php");
    $dbObj = new dbquery();
    echo "✅ DBquery class instantiated successfully<br>";
    
    // Test a simple count query
    $count = $dbObj->countRec("tbl_cabs", "1=1");
    echo "✅ DBquery test successful - Found " . $count . " records in tbl_cabs<br>";
} catch (Exception $e) {
    echo "❌ DBquery class test failed: " . $e->getMessage() . "<br>";
}

echo "<br><strong>Centralized Database Connection Test Complete!</strong><br>";
echo "<small>If all tests passed (✅), the centralized connection is working properly.</small>";
?>