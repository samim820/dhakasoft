<?php

include __DIR__ . '/../inc/config.php';
include __DIR__ . '/../inc/classes.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

 $expiredUsers = new ExpiredUsers($conn);
 $result = $expiredUsers->getUsers();


// $result = $expiredUsers->getUsers();

// while ($row = $result->fetch_assoc()) {

//     echo "<pre>";
//     print_r($row);
//     echo "</pre>";

// }



while ($row = $result->fetch_assoc()) {

    $username = $row['username'];
    $routerid = $row['routerid'];

    // Router তথ্য আনো
    $router = $userObj->getRouterById($routerid);

    if (!$router) {
        echo "Router not found for {$username}<br>";
        continue;
    }

    // PPPoE Profile Expire করো
    $profileUpdated = $userObj->updatePPPoEProfile(
        $router,
        $username,
        'Expire'
    );

    if (!$profileUpdated) {
        echo "Profile update failed: {$username}<br>";
        continue;
    }

    // Active Session Disconnect
    $userObj->disconnectPPPoEUser(
        $router,
        $username
    );

    // Database Update
    $stmt = $conn->prepare("
        UPDATE userinfo
        SET conn_status = 'E'
        WHERE id = ?
    ");

    $stmt->bind_param("i", $row['id']);
    $stmt->execute();

    echo "Processed: {$username}<br>";
}

?>

