<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];



$sql = "DELETE FROM importuser WHERE sec='$sec' ";
$conn->query($sql);




$_SESSION['success'] = "Delete Successfully";
header("Location: ../importuser.php"); 

$conn->close();



?>