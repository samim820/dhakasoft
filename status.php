<?php

include 'inc/sessaion.php';

$sec = $_SESSION['sec'];
require_once 'inc/api.php'; 
include 'inc/config.php';  

// 1. Fetch routers from database
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

// 2. Fetch DB users with custid
$sqlUsers = "SELECT custid, username FROM userinfo WHERE userstatus='active' AND sec='$sec'";
$resUsers = $conn->query($sqlUsers);
$dbUsers = [];
while($row = $resUsers->fetch_assoc()){
    // store as associative array for easier lookup
    $dbUsers[$row['username']] = $row['custid'];
}

// Function to format uptime
function formatUptime($uptime){
    $days=$hours=$minutes=$seconds=0;
    if(preg_match('/(\d+)d/',$uptime,$m)) $days=$m[1];
    if(preg_match('/(\d+)h/',$uptime,$m)) $hours=$m[1];
    if(preg_match('/(\d+)m/',$uptime,$m)) $minutes=$m[1];
    if(preg_match('/(\d+)s/',$uptime,$m)) $seconds=$m[1];
    return $days>0?sprintf("%dd %02d:%02d:%02d",$days,$hours,$minutes,$seconds):sprintf("%02d:%02d:%02d",$hours,$minutes,$seconds);
}

// 3. Fetch user status from routers
$allUsers = [];
foreach($routers as $r){
    $API = new routeros_api();
    $API->debug=false;
    $API->port=$r['port'];

    if($API->connect($r['ip'],$r['user'],$r['pass'])){
        $identityInfo = $API->comm("/system/identity/print");
        $identity = $identityInfo[0]['name'] ?? $r['router_name'];

        $active = $API->comm("/ppp/active/print");
        $activeUsernames = array_column($active,'name');

        $secrets = $API->comm("/ppp/secret/print");

        foreach($secrets as $s){
            $username = $s['name'];

            if(!isset($dbUsers[$username])) continue;

            if(in_array($username,$activeUsernames)){
                $allUsers[$username] = [
                    'status'=>'Online',
                    'uptime'=>formatUptime($active[array_search($username,array_column($active,'name'))]['uptime']),
                    'ip'=>$active[array_search($username,array_column($active,'name'))]['address'] ?? '-',
                    'router'=>$identity
                ];
            } else {
                $allUsers[$username] = [
                    'status'=>'Offline',
                    'uptime'=>$s['last-login'] ?? '-',
                    'ip'=>'-',
                    'router'=>$identity
                ];
            }
        }

        $API->disconnect();
    }
}

// 4. Count online/offline
$onlineCount=$offlineCount=0;
foreach($dbUsers as $username => $custid){
    if(isset($allUsers[$username])){
        if($allUsers[$username]['status']=='Online') $onlineCount++;
        else $offlineCount++;
    } else $offlineCount++;
}

// 5. Display online/offline count
echo "<div class='mb-3'>
        <span class='badge bg-success'>Online Users: $onlineCount</span>
        <span class='badge bg-danger'>Offline Users: $offlineCount</span>
      </div>";

// 6. Include DataTables CSS & JS
echo '
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
';

// 7. Display table with custid column
echo '<table id="userStatusTable" class="table table-bordered table-hover table-striped align-middle">
<thead class="table-dark">
<tr>
<th>CustID</th>
<th>Username</th>
<th>Status</th>
<th>IP Address</th>
<th>Uptime / Last Logout</th>
<th>Router</th>
</tr>
</thead>
<tbody>';

foreach($dbUsers as $username => $custid){
    $info = $allUsers[$username] ?? ['status'=>'Offline','uptime'=>'-','ip'=>'-','router'=>'-'];
    $statusBadge = $info['status']=='Online'? "<span class='badge bg-success'>Online</span>":"<span class='badge bg-danger'>Offline</span>";
    echo "<tr>
            <td><a href='profile.php?id=$custid'>$custid</a></td>
            <td>$username</td>
            <td>$statusBadge</td>
            <td>{$info['ip']}</td>
            <td>{$info['uptime']}</td>
            <td>{$info['router']}</td>
          </tr>";
}

echo '</tbody></table>';

// 8. Initialize DataTables
echo '
<script>
$(document).ready(function() {
    $("#userStatusTable").DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    });
});
</script>
';
