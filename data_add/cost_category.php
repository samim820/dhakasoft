<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];




$name = $_POST['name'];






$sql = "INSERT INTO cost_category (name,sec) VALUES ('$name','$sec')";
if ($conn->query($sql) === TRUE) {




	$_SESSION['success'] = "Category Added Successfully";
	header("Location: ../cost_category.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../cost_category.php"); 
}

$conn->close();




?>