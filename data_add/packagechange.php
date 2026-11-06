<?php

include '../inc/sessaion.php';
include '../inc/classes.php';

$sec = $_SESSION['sec'];
$sesaionuser = $_SESSION['username'];
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d h:i a');
$custid = $_POST['custid'];

$sql10 = "SELECT * FROM userinfo WHERE custid='$custid'";
$row = mysqli_fetch_assoc($conn->query($sql10) );


$userid = $row['username'];
$pop = $row['zone'];
$oldpackage = $_POST['oldpackage'];
$newpackage = $_POST['newpackage'];

$newProfile = $db->fetchRow("package", "id", $newpackage);
$oldProfile = $db->fetchRow("package", "id", $oldpackage);


$payment_methode = $_POST['methode'];
$receipt = $_POST['receipt'];
$remark = $_POST['remarks'];
$gtotal = $_POST['gtotal'];
$receve = $_POST['receve'];
$newprice = $newProfile['mbill'];
$discount = '0';
$invoiceid = uniqid();

$now = date('Y/m/d');
$exp = $row['expire'];

$date1 = strtotime($now);
$date2 = strtotime($exp);
$diff = $date2 - $date1;
$days = floor($diff / (60 * 60 * 24));

$payfore = 'package_change';


$routerid = $row['routerid'];


$router = $userObj->getRouterById($routerid);
$newProfile = $db->fetchRow("package", "id", $newpackage);


$mikrotik_profile = $newProfile['profile'];

if($userObj->updatePPPoEProfile($router, $userid, $mikrotik_profile)) {
    echo "Package updated successfully!";
} else {
    echo "Failed to update Package.";
}


  //$activity->log("Password Change", "Old Password-".$oldpass." -> New Password-".$newpass.".",$custid);// Action_type, Action

if ($payment_methode == 'Credit') {

$receve = '0';
  
     $sql3 = "UPDATE userinfo SET balance = balance - $gtotal WHERE custid = '$custid'";
  $conn->query($sql3);

}else{

    $receve = $_POST['receve'];

}


  $notes = 'Package Change > '.$oldProfile['name'].' to '.$newProfile['name'].' > Charg - ('.$gtotal.')tk.';

  $sql1 = "INSERT INTO payment (invoice_id, custid, username, receve_amount, discount_ammount, total_amount, reciveby, type, notes, sec, remarks, datee,receipt,payment_for) VALUES ('$invoiceid','$custid','$userid','$receve','$discount','$gtotal','$sesaionuser','$payment_methode','$notes','$sec','$remark','$date','$receipt','$payfore')";
  


if ($conn->query($sql1) === TRUE) {

   $sql3 = "UPDATE userinfo SET package='$newpackage', amount='$newprice' WHERE custid='$custid'";
  $conn->query($sql3);



  



  $_SESSION['success'] = "Package Change Successfully";
  header("Location: ../profile.php?id=$custid");  

} else {
  $_SESSION['error'] = "Package Change Unsuccessfull";
 header("Location: ../profile.php?id=$custid"); 
}

$conn->close();









?>