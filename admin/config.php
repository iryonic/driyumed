<?php
// admin/config.php
session_start();

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'driyum_newsletter');
define('DB_USER', 'root');
define('DB_PASS', '');

// Admin Credentials
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'password');

// Site Configuration
define('SITE_NAME', 'DRIYUM Healthy Snacks');




// Production Database Configuration
//  define('DB_HOST', 'localhost');
// define('DB_NAME', 'u167160735_driyum');
// define('DB_USER', 'u167160735_driyum');
// define('DB_PASS', 'Driyum@123');




// Helper function to get database connection
function getDBConnection() {
    static $conn = null;
    
    if ($conn === null) {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if ($conn->connect_error) {
                // Try to create database if it doesn't exist
                $temp_conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
                if ($temp_conn->connect_error) {
                    throw new Exception("Could not connect to MySQL server");
                }
                
                // Create database
                $temp_conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $temp_conn->close();
                
                // Now connect to the database
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                if ($conn->connect_error) {
                    throw new Exception("Could not connect to database");
                }
            }
            
            $conn->set_charset("utf8mb4");
            
            // Create tables if they don't exist
            createTables($conn);
            
        } catch (Exception $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
    
    return $conn;
}

// Create necessary tables
function createTables($conn) {
    // Subscribers table
    $sql = "CREATE TABLE IF NOT EXISTS subscribers (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ip_address VARCHAR(45),
        user_agent TEXT,
        status ENUM('active', 'unsubscribed') DEFAULT 'active',
        INDEX idx_email (email),
        INDEX idx_status (status),
        INDEX idx_subscribed_at (subscribed_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $conn->query($sql);
    
    // Admin users table (optional - you can remove if using hardcoded login)
    $sql = "CREATE TABLE IF NOT EXISTS admin_users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $conn->query($sql);
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect to login if not authenticated
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Initialize database and return connection
function initializeDatabase() {
    $conn = getDBConnection();
    return $conn;
}