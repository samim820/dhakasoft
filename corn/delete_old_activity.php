<?php
include __DIR__ . '/../inc/config.php'; // DB connection

// Set timezone to Dhaka
date_default_timezone_set('Asia/Dhaka');

// Delete old records older than 70 minutes
$sqlDelete = "DELETE FROM user_activity WHERE log_time < NOW() - INTERVAL 200 MINUTE";
if($conn->query($sqlDelete)){
    echo date('Y-m-d H:i:s') . " - Old records deleted successfully.\n";
} else {
    echo date('Y-m-d H:i:s') . " - Error: " . $conn->error . "\n";
}
?>