<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 



$newip = $_POST['ip'];
$id = $_POST['custid'];

$sql1 = "SELECT * FROM userinfo WHERE custid='$id'";
$row1 = mysqli_fetch_assoc($conn->query($sql1) );
$username = $row1['username'];


if (filter_var($newip, FILTER_VALIDATE_IP)) {

	$sql = "UPDATE userinfo SET ip='$newip' WHERE custid='$id' ";
	$conn->query($sql);

	$sql2 = "UPDATE radreply SET value='$newip' WHERE username='$username' AND  attribute='Framed-IP-Address' ";
	$conn->query($sql2);


if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "IP Change Successfully";
  header("Location: ../ipchange.php?id=$id"); 
} else {
  echo "Error updating record: " . $conn->error;
}

}else{

	  $_SESSION['error'] = "Invalid IP Address";
  header("Location: ../ipchange.php?id=$id"); 

}







?>