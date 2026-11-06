<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];
$user = $_SESSION['username'];
$details = $_POST['details'];
$cost_cat = $_POST['cost_cat'];
$amount = $_POST['amount'];

date_default_timezone_set('Asia/Dhaka');
$date_time = date('Y-m-d h:i a');







$sql = "INSERT INTO cost(category,details,amount,user,date_time,sec) VALUES ('$cost_cat','$details','$amount','$user','$date_time','$sec')";
if ($conn->query($sql) === TRUE) {




	$_SESSION['success'] = "Cost Added Successfully";
	header("Location: ../cost.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../cost.php"); 
}

$conn->close();




?>