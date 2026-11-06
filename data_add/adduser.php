<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];




$name = $_POST['name'];







$sql = "INSERT INTO area (name) VALUES ('$name')";
if ($conn->query($sql) === TRUE) {




	$_SESSION['success'] = "Area Added Successfully";
	header("Location: ../area.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../area.php"); 
}

$conn->close();




?>