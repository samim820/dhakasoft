<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 






$name = $_POST['name'];
$routerid = $_POST['nas'];
$profile = $_POST['profile'];
$mbill = $_POST['mbill'];
$rbill = $_POST['rbill'];
$vat = $_POST['vat'];
$sec = $_SESSION['sec'];





$sql = "INSERT INTO package (name, profile, mbill, resrat, vat, routerid, sec) VALUES ('$name','$profile','$mbill','$rbill','$vat','$routerid', '$sec')";
if ($conn->query($sql) === TRUE) {


	$_SESSION['success'] = "Package Added Successfully";
	header("Location: ../package.php"); 

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();




?>