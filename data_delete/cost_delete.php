<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "DELETE FROM cost WHERE id='$id' ";
$conn->query($sql);




$_SESSION['success'] = "Cost Delete Successfully";
header("Location: ../cost.php"); 

$conn->close();



?>