<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 


$secid= $_SESSION['sec'];

$status = $_POST['status'];
$msg = $_POST['msg'];
$before1 = $_POST['before1'];
$before2 = $_POST['before2'];
$before3 = $_POST['before3'];
$msg_sec = 'billalert';

$sql = "UPDATE sms_temp SET status='$status', msg='$msg',before1='$before1',before2='$before2',before3='$before3' WHERE sec='$secid' AND msg_sec='$msg_sec' ";
$conn->query($sql);

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "Data Update Successfully";
  header("Location: ../sms_setings.php"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>