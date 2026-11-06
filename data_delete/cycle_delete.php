<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "DELETE FROM cycle WHERE id='$id' ";
$conn->query($sql);




$_SESSION['success'] = "cycle Delete Successfully";
header("Location: ../billingcycle.php"); 

$conn->close();



?>