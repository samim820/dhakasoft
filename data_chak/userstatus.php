 <?php

include '../inc/sessaion.php';
include '../inc/config.php'; 
include'../inc/api.php';

 $id = $_GET['id'];


  function formatBytes($size, $precision = 0){
    $unit = ['Byte','Kb','Mb','Gb','Tb','PB','EB','ZB','YB'];

    for($i = 0; $size >= 1024 && $i < count($unit)-1; $i++){
        $size /= 1024;
    }

    return round($size, $precision).' '.$unit[$i];
}

 $sql = "SELECT * FROM userinfo WHERE custid='$id'";
 $row = mysqli_fetch_assoc($conn->query($sql) );

 $zone = $row['zone'];
 $userid = $row['username'];
 $routerid = $row['routerid'];

 $sql1 = "SELECT * FROM nas WHERE id='$routerid'";
 $router = mysqli_fetch_assoc($conn->query($sql1) );
$ip = $router['nasname'];
$username = $router['username'];
$pass = $router['password'];
$apiport = $router['api'];

  $API = new routeros_api();
              $API->debug = false;
              $API->port = $apiport;

     if ($API->connect($ip , $username, $pass)){



    

     




    $ARRAY2=$API->comm("/ppp/secret/getall",
                array(
                "?name" => $userid,
                ));
    $ARRAY1=$API->comm("/ppp/active/print",
                array(
                "?name" => $userid,
                ));

$ARRAY3 = $API->comm("/interface/monitor-traffic", array(
      "interface" =>"<pppoe-$userid>",
      "once" => "",
      ));






if (empty($ARRAY2[0]['name'])) {
  $userid = '-- --- --';
$profile = '-- --- --';
$uptime = '-- --- --';
$address = '-- --- --';
$mac = '-- --- --';
$lastlogout = '-- --- --';
$bindmac = '-- --- --';
$tx = '-- --- --';
  $rx = '-- --- --';
$status = '<span class="badge badge-info">User not Found in Router</span>';

}else{

$userid = $ARRAY2[0]['name'];
$profile = '-- --';
$uptime = '-- --';
$address = '-- --';
$mac = '-- --';
$lastlogout = $ARRAY2[0]['last-logged-out'];
$bindmac = '-- --';
$tx = '-- --';
  $rx = '-- --';

  if (empty($ARRAY1[0]['uptime'])) {
    $status = '<span class="badge badge-danger">Disconnected</span>';
  }else{
$uptime = $ARRAY1[0]['uptime'];
$profile = $ARRAY2[0]['profile'];
$address = $ARRAY1[0]['address'];
$mac = $ARRAY1[0]['caller-id'];
$lastlogout = $ARRAY2[0]['last-logged-out'];
$bindmac = $ARRAY2[0]['caller-id'];
$tx = formatBytes($ARRAY3[0]['tx-bits-per-second'], 2);;
  $rx = formatBytes($ARRAY3[0]['rx-bits-per-second'], 2);;
    $status = '<span class="badge badge-success">Connected</span>';
  }


}















echo '<li class="list-group-item">
                    <b>User ID:</b> <a  class="float-right">'.$userid.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Package:</b> <a class="float-right">'.$profile.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>DW/UP:</b> <a class="float-right">'.$tx.'/'.$rx.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Last Logout:</b> <a class="float-right">'.$lastlogout.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Bind MAC:</b> <a class="float-right">'.$bindmac.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Active MAC:</b> <a class="float-right">'.$mac.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>IP Address:</b> <a class="float-right">'.$address.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Uptime:</b> <a id="username" class="float-right">'.$uptime.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status:</b> <a  class="float-right"></span>'.$status.'</a>
                  </li>';
die;

 }else{

  echo '<span class="text-danger">Router Connection Error Please Check</span>';
 }






?>
