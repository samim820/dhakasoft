<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];




$name = $_POST['provider'];
$senderid = $_POST['senderid'];
$api_secret = $_POST['api_secret'];
$api_url = $_POST['api_url'];







$sql = "INSERT INTO sms_gtw (name, api, sender_id, url, sec) VALUES ('$name','$api_secret','$senderid','$api_url','$sec')";
if ($conn->query($sql) === TRUE) { 




	$_SESSION['success'] = "SMS Api Added Successfully";
	header("Location: ../sms_api.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../sms_api.php"); 
}

$conn->close();




?>