<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];


$sql2 = "SELECT * FROM userinfo WHERE custid='$id'";
$row = mysqli_fetch_assoc($conn->query($sql2) );
$username =  $row['username'];




$sql1 = "UPDATE radcheck SET value='01 Jan 1980 12:00' WHERE username='$username' AND attribute='Expiration' ";
$conn->query($sql1);


	$sql = "UPDATE userinfo SET userstatus='10' WHERE custid='$id'";

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "User Disabled Successfully";
  header("Location: ../profile.php?id=$id"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>

