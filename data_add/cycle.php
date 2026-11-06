<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];




$name = $_POST['name'];
$day = $_POST['day'];
$status = $_POST['status'];






$sql = "INSERT INTO cycle (name, cycle, status, sec) VALUES ('$name','$day','$status','$sec')";
if ($conn->query($sql) === TRUE) {




	$_SESSION['success'] = "Cycle Added Successfully";
	header("Location: ../billingcycle.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../billingcycle.php"); 
}

$conn->close();




?>