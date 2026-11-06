<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];

$status = $_POST['status'];






	$sql = "UPDATE cycle SET status='$status' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "Cycle Update Successfully";
  header("Location: ../billingcycle.php"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>