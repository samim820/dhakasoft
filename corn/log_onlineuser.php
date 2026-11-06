<?php
include __DIR__ . '/../inc/config.php';
require_once __DIR__ . '/../inc/api.php';

// Fetch routers
$routers = [];
$sqlRouters = "SELECT shortname, nasname, username, password, api FROM nas";
$resRouters = $conn->query($sqlRouters);
while($r = $resRouters->fetch_assoc()){
    $routers[] = [
        'router_name' => $r['shortname'],
        'ip' => $r['nasname'],
        'user' => $r['username'],
        'pass' => $r['password'],
        'port' => $r['api']
    ];
}

// Fetch DB users
$sqlUsers = "SELECT username FROM userinfo";
$resUsers = $conn->query($sqlUsers);
$dbUsers = [];
while($row=$resUsers->fetch_assoc()){
    $dbUsers[] = $row['username'];
}

// Count users
$allUsers = [];
foreach($routers as $r){
    $API = new routeros_api();
    $API->debug=false;
    $API->port=$r['port'];

    if($API->connect($r['ip'],$r['user'],$r['pass'])){
        $active = $API->comm("/ppp/active/print");
        $activeUsernames = array_column($active,'name');

        foreach($dbUsers as $username){
            if(in_array($username,$activeUsernames)){
                $allUsers[$username] = 'Online';
            } elseif(!isset($allUsers[$username])) {
                $allUsers[$username] = 'Offline';
            }
        }

        $API->disconnect();
    }
}

// Count online/offline
$online=$offline=0;
foreach($dbUsers as $username){
    if(isset($allUsers[$username])){
        if($allUsers[$username]=='Online') $online++;
        else $offline++;
    } else $offline++;
}

// Insert log into user_activity table safely
$now = date('Y-m-d H:i'); // minute precision

// Check if already logged for this minute
$sqlCheck = "SELECT id FROM user_activity WHERE log_time='$now' LIMIT 1";
$resCheck = $conn->query($sqlCheck);

if($resCheck->num_rows == 0){
    $sqlInsert = "INSERT INTO user_activity (log_time, online_user, offline_user) VALUES ('$now', $online, $offline)";
    $conn->query($sqlInsert);
}
?>
