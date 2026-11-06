<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$id = $_GET['id'];


$sql2 = "SELECT * FROM userinfo WHERE custid='$id'";
$row = mysqli_fetch_assoc($conn->query($sql2) );
$username =  $row['username'];



$sql1 = "DELETE FROM radcheck WHERE username='$username' ";
$conn->query($sql1);


	$sql = "UPDATE userinfo SET userstatus='0' WHERE custid='$id'";

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "User Left Successfully";
  header("Location: ../userlist.php"); 
} else {
  echo "Error updating record: " . $conn->error;
}




?>

