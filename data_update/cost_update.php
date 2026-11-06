<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 


$id = $_GET['id'];
$details = $_POST['details'];
$cost_cat = $_POST['cost_cat'];
$amount = $_POST['amount'];


$sql = "UPDATE cost SET category='$cost_cat', amount='$amount', details='$details'  WHERE id='$id'";
if ($conn->query($sql) === TRUE) {




	$_SESSION['success'] = "Cost Update Successfully";
	header("Location: ../cost.php"); 

} else {
 $_SESSION['error'] = "Somthing Wrong";
	header("Location: ../cost.php"); 
}

$conn->close();




?>