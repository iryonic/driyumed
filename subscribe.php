<?php
// subscribe.php - Working newsletter subscription handler
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow requests from your domain

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'driyum_newsletter');
define('DB_USER', 'root');
define('DB_PASS', '');



//production


// // Database configuration
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'u167160735_driyum');
// define('DB_USER', 'u167160735_driyum');
// define('DB_PASS', 'Driyum@123');


// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get and validate email
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit;
}

// Create database connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check if database exists, create if not
    if ($conn->connect_error) {
        // Create database connection without database
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
        if ($conn->connect_error) {
            throw new Exception("Could not connect to MySQL");
        }
        
        // Create database
        $conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $conn->select_db(DB_NAME);
        
        // Create subscribers table
        $sql = "CREATE TABLE IF NOT EXISTS subscribers (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ip_address VARCHAR(45),
            user_agent TEXT,
            status ENUM('active', 'unsubscribed') DEFAULT 'active'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $conn->query($sql);
    }
    
    // Get user info
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    // Check if email already exists
    $check_sql = "SELECT id FROM subscribers WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows > 0) {
        $check_stmt->close();
        echo json_encode(['success' => false, 'message' => 'This email is already subscribed to our newsletter.']);
        exit;
    }
    $check_stmt->close();
    
    // Insert new subscriber
    $insert_sql = "INSERT INTO subscribers (email, ip_address, user_agent) VALUES (?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sss", $email, $ip_address, $user_agent);
    
    if ($insert_stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Thank you for subscribing to DRIYUM! You\'ll be the first to know about our launch and exclusive offers.'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Subscription failed. Please try again.']);
    }
    
    $insert_stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    // Log the error for debugging
    error_log("Newsletter subscription error: " . $e->getMessage());
    
    // Return a user-friendly error message
    echo json_encode([
        'success' => false, 
        'message' => 'We encountered a technical issue. Please try again later or contact support.'
    ]);
}