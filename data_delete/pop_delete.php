<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "DELETE FROM pop WHERE id='$id' ";
$conn->query($sql);




$_SESSION['success'] = "POP Delete Successfully";
header("Location: ../pop.php"); 

$conn->close();



?>