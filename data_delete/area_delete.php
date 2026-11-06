<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];



$sql = "DELETE FROM area WHERE id='$id' ";
$conn->query($sql);




$_SESSION['success'] = "Area Delete Successfully";
header("Location: ../area.php"); 

$conn->close();



?>