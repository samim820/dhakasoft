	<?php
include '../inc/sessaion.php';
include '../inc/config.php';

$sec = $_SESSION['sec'];
$id = $_GET['id'];

$sql = "SELECT * FROM userinfo WHERE custid='$id'";
$row = mysqli_fetch_assoc($conn->query($sql) );

$username = $row['username'];

$sql1 = "SELECT * FROM radacct  WHERE username='$username' AND  acctupdatetime IN (SELECT  MAX(acctupdatetime) FROM radacct GROUP BY username)";
 $row1 = mysqli_fetch_assoc($conn->query($sql1) );

 	$nasip = $row1['nasipaddress'];

 $sql2 = "SELECT * FROM nas WHERE nasname='$nasip'";
$row2 = mysqli_fetch_assoc($conn->query($sql2) );

$radius_server = $nasip;
$radius_secret = $row2['secret'];
$radius_port = $row2['ports'];
$user = $row2['username'];
$pass = $row2['password'];
$apiport = $row2['api'];



#Build the radclient command
$command = "echo 'User-Name=$username' | radclient -x $radius_server:$radius_port disconnect $radius_secret";
#Execute the command
shell_exec($command);
     $_SESSION['success'] = "Disconnect Succesfull";
    header("Location: ../profile.php?id=$id"); 




?>





