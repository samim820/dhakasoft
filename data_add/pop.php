<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];




$name = $_POST['name'];
$mikrotik = $_POST['mikrotik'];
$popid = uniqid();







$sql = "INSERT INTO pop (name, mikrotik,popid,sec) VALUES ('$name','$mikrotik','$popid','$sec')";
if ($conn->query($sql) === TRUE) {




	$_SESSION['success'] = "POP Added Successfully";
	header("Location: ../pop.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../pop.php"); 
}

$conn->close();




?>