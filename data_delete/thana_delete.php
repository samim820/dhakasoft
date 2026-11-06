<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "DELETE FROM thana WHERE id='$id' ";
$conn->query($sql);




$_SESSION['success'] = "Thana Delete Successfully";
header("Location: ../thana.php"); 

$conn->close();



?>