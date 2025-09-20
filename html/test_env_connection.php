<?php
echo "<h2>Testing Environment-based Database Connection</h2>";

try {
    // Include the centralized database connection
    require_once("includes/db_connection.php");
    
    echo "<p style='color: green;'>✓ Database connection successful!</p>";
    echo "<p><strong>Connected to:</strong> " . $_ENV['DB_NAME'] . " on " . $_ENV['DB_HOST'] . "</p>";
    echo "<p><strong>User:</strong> " . $_ENV['DB_USER'] . "</p>";
    
    // Test a simple query
    $result = $mysqli_conn->query("SELECT 1 as test");
    if ($result) {
        echo "<p style='color: green;'>✓ Database query test successful!</p>";
    } else {
        echo "<p style='color: red;'>✗ Database query test failed: " . $mysqli_conn->error . "</p>";
    }
    
    // Show environment variables loaded
    echo "<h3>Environment Variables Loaded:</h3>";
    echo "<ul>";
    foreach ($_ENV as $key => $value) {
        if (strpos($key, 'DB_') === 0) {
            // Hide password for security
            $displayValue = ($key === 'DB_PASSWORD') ? str_repeat('*', strlen($value)) : $value;
            echo "<li><strong>$key:</strong> $displayValue</li>";
        }
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Connection failed: " . $e->getMessage() . "</p>";
}

echo "<p><em>Test completed at " . date('Y-m-d H:i:s') . "</em></p>";
?>