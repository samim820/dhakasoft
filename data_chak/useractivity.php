<?php
header('Content-Type: application/json');
include '../inc/config.php';

// ❌ PHP এ timezone সেট কোরো না (UTC ডিফল্ট রাখো)

// Check DB connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'DB connection failed']));
}

// Last 1 hour timestamp (UTC হিসাবেই হবে)
$one_hour_ago = date("Y-m-d H:i", strtotime("-3 hour"));

// Prepare SQL → এখানে CONVERT_TZ বাদ দিয়ে সরাসরি UNIX_TIMESTAMP
$sql = "SELECT 
            online_user, 
            offline_user, 
            UNIX_TIMESTAMP(log_time)*1000 AS timestamp
        FROM user_activity
        WHERE log_time >= ?
        ORDER BY log_time ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $one_hour_ago);
$stmt->execute();
$result = $stmt->get_result();

// Prepare data arrays
$active_data = [];
$online_data = [];

while ($row = $result->fetch_assoc()) {
    $active_data[] = [(int)$row['timestamp'], (int)$row['offline_user']];
    $online_data[] = [(int)$row['timestamp'], (int)$row['online_user']];
}

// Output JSON
echo json_encode([
    'active' => $active_data,
    'online' => $online_data
]);

$stmt->close();
$conn->close();
