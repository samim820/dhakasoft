<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];

$sql = "SELECT * FROM userinfo WHERE custid='$id'";
$row = mysqli_fetch_assoc($conn->query($sql) );
$userid = $row['username'];

// All Payment Delete for this user

$sql1 = "DELETE FROM radusergroup WHERE username='$userid' ";
$conn->query($sql1);



$sql2 = "DELETE FROM userinfo WHERE custid='$id' ";
$conn->query($sql2);




$_SESSION['success'] = "User Permanently Delete Successfully";
header("Location: ../userlist.php"); 

$conn->close();



?>