<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 


$secid= $_SESSION['sec'];

$status = $_POST['status'];
$msg = $_POST['msg'];
$msg_sec = 'welcome';




$sql = "INSERT INTO sms_temp (status, msg, msg_sec, sec) VALUES ('$status','$msg','$msg_sec','$secid')";

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "Data Update Successfully";
  header("Location: ../sms_setings.php"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>