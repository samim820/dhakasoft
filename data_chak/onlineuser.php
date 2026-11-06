<?php

include '../inc/sessaion.php';
include '../inc/config.php'; 
include '../inc/api.php'; 

$sec = $_SESSION['sec'];


$result = $conn->query("select * from userinfo where userstatus='1' OR userstatus='2' OR userstatus='10' AND sec='$sec'");
$totaluser =$result->num_rows;



$result = $conn->query("SELECT * FROM radacct  WHERE acctstoptime  IS NULL AND acctupdatetime IN (SELECT  MAX(acctupdatetime) FROM radacct GROUP BY Username)");
$onlineuser=$result->num_rows;

$offlineuser = $totaluser-$onlineuser;




echo '    <div class="col-md-6">
   <div class="small-box bg-success">
<div class="inner" style="text-align: center;">
  <h4  id="onlineuse">'.$onlineuser.'</h4>
  <p>Total Online User</p>
</div>
</div>
</div>
      <div class="col-md-6">
   <div class="small-box bg-danger">
<div class="inner" style="text-align: center;">
  <h4  id="onlineuse">'.$offlineuser.'</h4>
  <p>Total Offline User</p>
</div>
</div>
</div>'



  




?>
