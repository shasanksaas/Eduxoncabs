<?php
/**
 * Centralized Database Connection
 * This file establishes a single mysqli connection for the entire application
 * using credentials from .env file
 * If connection fails, the script will terminate with error message
 */

// Function to load environment variables from .env file
function loadEnvFile($filePath) {
    if (!file_exists($filePath)) {
        die("Environment file (.env) not found at: " . $filePath);
    }
    
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!array_key_exists($name, $_ENV)) {
            $_ENV[$name] = $value;
        }
    }
}

// Load environment variables
loadEnvFile(__DIR__ . '/../.env');

// Get database credentials from environment
$db_host = $_ENV['DB_HOST'] ?? 'localhost';
$db_user = $_ENV['DB_USER'] ?? '';
$db_password = $_ENV['DB_PASSWORD'] ?? '';
$db_name = $_ENV['DB_NAME'] ?? '';

// Create the database connection as a global variable
global $mysqli_conn;
$mysqli_conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection and die if failed
if ($mysqli_conn->connect_error) {
    // Log the error for debugging
    error_log("Database Connection Failed: " . $mysqli_conn->connect_error);
    
    // Display user-friendly error message and die
    die("Database connection failed. Please try again later or contact support.");
}

// Set charset to utf8 for proper character encoding
$mysqli_conn->set_charset("utf8");

// Optional: Set timezone if needed
// $mysqli_conn->query("SET time_zone = '+05:30'"); // For Indian timezone

?>