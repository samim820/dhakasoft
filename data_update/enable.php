<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];
$secid= $_SESSION['sec'];


$sql2 = "SELECT * FROM userinfo WHERE custid='$id'";
$row = mysqli_fetch_assoc($conn->query($sql2) );
$username =  $row['username'];
$expiredate =  $row['expire'];

$sql4 = "SELECT * FROM profile WHERE sec='$secid'";
$row2 = mysqli_fetch_assoc($conn->query($sql4) );

$expiretime = $row2['expire_time'];

$expire = date("d M Y", strtotime($expiredate));

$finalexpire = $expire.' '.$expiretime;




$sql1 = "UPDATE radcheck SET value='$finalexpire' WHERE username='$username' AND attribute='Expiration' ";
$conn->query($sql1);


	$sql = "UPDATE userinfo SET userstatus='1' WHERE custid='$id'";

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "User Enable Successfully";
  header("Location: ../profile.php?id=$id"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>

