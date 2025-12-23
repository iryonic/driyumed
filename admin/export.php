<?php
// admin/export.php
require_once 'config.php';
requireLogin();

$conn = initializeDatabase();
$type = $_GET['type'] ?? 'csv';

// Get all subscribers
$result = $conn->query("SELECT email, subscribed_at, ip_address FROM subscribers ORDER BY subscribed_at DESC");
$subscribers = $result->fetch_all(MYSQLI_ASSOC);

if ($type === 'csv') {
    // Export as CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=driyum_subscribers_' . date('Y-m-d') . '.csv');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Email', 'Subscription Date', 'IP Address']);
    
    foreach ($subscribers as $subscriber) {
        fputcsv($output, [
            $subscriber['email'],
            $subscriber['subscribed_at'],
            $subscriber['ip_address']
        ]);
    }
    
    fclose($output);
    exit;
} else {
    // Redirect back if invalid type
    header('Location: subscribers.php');
    exit;
}