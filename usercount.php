<?php

include 'inc/sessaion.php';

$sec = $_SESSION['sec'];
error_reporting(0);
require_once 'inc/api.php'; 
include 'inc/config.php';  

// Fetch routers
$routers = [];
$sqlRouters = "SELECT shortname, nasname, username, password, api FROM nas WHERE sec='main'";
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
$sqlUsers = "SELECT username,routerid FROM userinfo where userstatus='active' AND sec='$sec' ORDER BY routerid ASC";
$resUsers = $conn->query($sqlUsers);
$dbUsers = [];
while($row=$resUsers->fetch_assoc()){
    $dbUsers[] = $row['username'];
}

// Check status from all routers
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
$onlineuser = $offlineuser = 0;
foreach($dbUsers as $username){
    if(isset($allUsers[$username])){
        if($allUsers[$username]=='Online') $onlineuser++;
        else $offlineuser++;
    } else $offlineuser++;
}

// Display small-box HTML
echo '<div class="col-md-6">
   <div class="small-box bg-success">
<div class="inner" style="text-align: center;">
  <h3 id="onlineuse">'.$onlineuser.'</h3>
  <p>Total Online User</p>
</div>
</div>
</div>
      <div class="col-md-6">
   <div class="small-box bg-danger">
<div class="inner" style="text-align: center;">
  <h3  id="onlineuse">'.$offlineuser.'</h3>
  <p>Total Offline User</p>
</div>
</div>
</div>';
?>
