<?php

include '../inc/sessaion.php';
include '../inc/classes.php';

$sec = $_SESSION['sec'];
$sesaionuser = $_SESSION['username'];
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d h:i a');
$custid = $_GET['custid'];
$newpass = $_POST['newpass'];

$sql10 = "SELECT * FROM userinfo WHERE custid='$custid'";
$row = mysqli_fetch_assoc($conn->query($sql10) );


$username = $row['username'];
$oldpass = $row['portalloginpassword'];
$routerid = $row['routerid'];


$router = $userObj->getRouterById($routerid);

if($userObj->updatePPPoEPassword($router, $username, $newpass)) {
    echo "Password updated successfully!";
} else {
    echo "Failed to update password.";
}

$sql3 = "UPDATE userinfo SET portalloginpassword='$newpass' WHERE custid='$custid'";
  $conn->query($sql3);

  $activity->log("Password Change", "Old Password-".$oldpass." -> New Password-".$newpass.".",$custid);// Action_type, Action

                $_SESSION['success'] = "Password Change Successfully";
  header("Location: ../profile.php?id=$custid"); 





$conn->close();











?>