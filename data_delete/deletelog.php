<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "TRUNCATE TABLE radpostauth";
$conn->query($sql);




$_SESSION['success'] = "Data Delete Successfully";
header("Location: ../loginmsg.php"); 

$conn->close();



?>