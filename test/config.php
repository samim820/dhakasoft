

<?php
require 'routeros_api.class.php';

// Replace these variables with your MikroTik router information
$host = '103.137.162.252';
//$port = '5520';
$login = 'api';
$password = 'api';


$pppoeUsername = '<pppoe-ra@nafis>';

$API = new RouterosAPI();
$API->port = '5520';
if ($API->connect($host, $login, $password)) {
    // Fetch real-time traffic data (e.g., interface traffic)
    $API->write('/interface/print');
    $API->write('?name=' . $pppoeUsername);
    $trafficData = $API->read();

    // Disconnect from the MikroTik router
    $API->disconnect();

    // Output the traffic data as JSON
    echo json_encode($trafficData);
} else {
    // Unable to connect
    echo json_encode(['error' => 'Unable to connect to the router.']);
}
?>