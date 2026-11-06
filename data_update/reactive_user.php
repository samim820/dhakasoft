<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];
$secid= $_SESSION['sec'];

$sql1 = "SELECT * FROM userinfo WHERE custid='$id'";
$row = mysqli_fetch_assoc($conn->query($sql1) );
$userid =  $row['username'];
$password =  $row['portalloginpassword'];
$expiredate =  $row['expire'];

$sql4 = "SELECT * FROM profile WHERE sec='$secid'";
$row2 = mysqli_fetch_assoc($conn->query($sql4) );

$expiretime = $row2['expire_time'];

$expire = date("d M Y", strtotime($expiredate));

$finalexpire = $expire.' '.$expiretime;






  $sql2 = "INSERT INTO radcheck (username, attribute, op, value, sec) VALUES ('$userid','Expiration',':=','$finalexpire','$sec')";
  $conn->query($sql2);
  $sql3 = "INSERT INTO radcheck (username, attribute, op, value, sec) VALUES ('$userid','Cleartext-Password',':=','$password','$sec')";
  $conn->query($sql3);


	$sql = "UPDATE userinfo SET userstatus='1' WHERE custid='$id'";

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "User Reactive Successfully";
  header("Location: ../profile.php?id=$id"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>