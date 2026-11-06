<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];




$name = $_POST['provider'];
$senderid = $_POST['senderid'];
$api_secret = $_POST['api_secret'];
$api_url = $_POST['api_url'];






$sql = "UPDATE sms_gtw SET name='$name', api='$api_secret', sender_id='$senderid', url='$api_url' WHERE sec='$sec'";
if ($conn->query($sql) === TRUE) { 




	$_SESSION['success'] = "SMS Api Update Successfully";
	header("Location: ../sms_api.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../sms_api.php"); 
}

$conn->close();




?>