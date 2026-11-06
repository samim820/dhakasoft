<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 
include '../inc/api.php';

$id = $_GET['id'];

$sql1 = "SELECT * FROM nas WHERE id='$id'";
$router = mysqli_fetch_assoc($conn->query($sql1));

$ip       = $router['nasname'];
$username = $router['username'];
$pass     = $router['password'];
$apiport  = $router['api'];

$API = new routeros_api();
$API->debug = false;
$API->port = $apiport;

if ($API->connect($ip , $username, $pass)) {

    // ---------- System Resource ----------
    $resource = $API->comm('/system/resource/print');
    $res = $resource[0];

    $uptime     = $res['uptime'] ?? 'N/A';
    $version    = $res['version'] ?? 'N/A';
    $boardname  = $res['board-name'] ?? 'N/A';
    $arch       = $res['architecture-name'] ?? 'N/A';
    $cpu        = $res['cpu'] ?? 'N/A';
    $cpucount   = $res['cpu-count'] ?? 'N/A';
    $cpuLoad    = $res['cpu-load'] ?? 0;

    $totalMem   = $res['total-memory'] ?? 1;
    $freeMem    = $res['free-memory'] ?? 0;
    $usedMem    = $totalMem - $freeMem;
    $ramUsage   = round(($usedMem / $totalMem) * 100, 2);

    $hddTotal   = round(($res['total-hdd-space'] ?? 0) / 1048576, 2);
    $hddFree    = round(($res['free-hdd-space'] ?? 0) / 1048576, 2);
    $hddUsed    = $hddTotal - $hddFree;
    $hddUsage   = $hddTotal > 0 ? round(($hddUsed / $hddTotal) * 100, 2) : 0;

    // ---------- System Health ----------
    $health = $API->comm('/system/health/print');
    $health0 = $health[0];

    $voltage     = $health0['voltage'] ?? 'N/A';
    $temperature = $health0['temperature'] ?? 'N/A';
    $cpuTemp     = $health0['cpu-temperature'] ?? 'N/A';
    $fanSpeed1    = $health0['fan1-speed'] ?? 'N/A';
    $fanSpeed2    = $health0['fan2-speed'] ?? 'N/A';
    $power1    = $health0['psu1-state'] ?? 'N/A';
    $power2    = $health0['psu2-state'] ?? 'N/A';

    echo "
    <style>
    .status-table {
        border-radius: 2px;
        overflow: hidden;
    }
    .status-table td {
        vertical-align: middle;
        font-weight: 500;
        padding: 8px 12px;
    }
    .progress {
        height: 10px;
        border-radius: 50px;
        background: #f1f1f1;
    }
    .progress-bar {
        border-radius: 20px;
    }
    .badge {
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 50px;
    }
    </style>

    <table class='table table-striped status-table'>
    <tbody>
        <tr><td>🖥️ CPU Load</td><td><div class='progress'><div class='progress-bar bg-danger' style='width:$cpuLoad%'></div></div></td><td><span class='badge bg-danger'>{$cpuLoad}%</span></td></tr>
        <tr><td>💾 RAM Usage</td><td><div class='progress'><div class='progress-bar bg-warning' style='width:$ramUsage%'></div></div></td><td><span class='badge bg-warning'>{$ramUsage}%</span></td></tr>
        <tr><td>💽 HDD Usage</td><td><div class='progress'><div class='progress-bar bg-info' style='width:$hddUsage%'></div></div></td><td><span class='badge bg-info'>{$hddUsage}%</span></td></tr>
        <tr><td>🌡️ Board Temp</td><td></td><td><span class='badge bg-primary'>{$temperature}°C</span></td></tr>
        <tr><td>🔥 CPU Temp</td><td></td><td><span class='badge bg-success'>{$cpuTemp}°C</span></td></tr>
        <tr><td>🌀 Fan Speed 1</td><td></td><td><span class='badge bg-dark'>{$fanSpeed1} RPM</span></td></tr>
        <tr><td>🌀 Fan Speed 2</td><td></td><td><span class='badge bg-dark'>{$fanSpeed2} RPM</span></td></tr>
        <tr><td>⚡ Voltage</td><td></td><td><span class='badge bg-secondary'>{$voltage} V</span></td></tr>
        <tr><td>🔌 Power Supply 1</td><td></td><td><span class='badge bg-secondary'>{$power1}</span></td></tr>
        <tr><td>🔌 Power Supply 2</td><td></td><td><span class='badge bg-secondary'>{$power2}</span></td></tr>
        <tr><td>📟 RouterOS</td><td></td><td><span class='badge bg-light text-dark'>{$version}</span></td></tr>
        <tr><td>🔧 Board</td><td></td><td><span class='badge bg-light text-dark'>{$boardname} ({$arch})</span></td></tr>
        <tr><td>🕒 Uptime</td><td></td><td><span class='badge bg-light text-dark'>{$uptime}</span></td></tr>
    </tbody>
    </table>
    ";

    $API->disconnect();
} else {
    echo '<span class="text-danger">❌ Router Connection Error</span>';
}
?>
