<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];


$id = $_GET['id'];

$name = $_POST['name'];
$ip = $_POST['ip'];
$api = $_POST['api'];
$username = $_POST['username'];
$password = $_POST['password'];
$type = 'Mikrotik';


$sql = "UPDATE nas SET nasname='$ip', shortname='$name', api='$api', username='$username', password='$password' WHERE id='$id' ";

if ($conn->query($sql) === TRUE) {



	$_SESSION['success'] = "NAS Update Successfully";
	header("Location: ../nas.php"); 

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();




?>