<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "DELETE FROM package WHERE id='$id' ";
$conn->query($sql);





$_SESSION['success'] = "Package Delete Successfully";
header("Location: ../package.php"); 

$conn->close();



?>