<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 


$secid= $_SESSION['sec'];

$status = $_POST['status'];
$msg = $_POST['msg'];
$msg_sec = 'create_ticket';

$sql = "UPDATE sms_temp SET status='$status', msg='$msg' WHERE sec='$secid' AND msg_sec='$msg_sec' ";
$conn->query($sql);

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "Data Update Successfully";
  header("Location: ../sms_setings.php"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>