<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "DELETE FROM distric WHERE id='$id' ";
$conn->query($sql);




$_SESSION['success'] = "Distric Delete Successfully";
header("Location: ../distric.php"); 

$conn->close();



?>