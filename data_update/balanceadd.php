<?php

include '../inc/sessaion.php';
include '../inc/config.php';

$sec = $_SESSION['sec'];
$sesaionuser = $_SESSION['username'];
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d h:i a');
$custid = $_POST['custid'];
$newbalance = $_POST['receive'];

$sql10 = "SELECT * FROM userinfo WHERE custid='$custid'";
$row = mysqli_fetch_assoc($conn->query($sql10) );


$userid = $row['username'];
$pop = $row['zone'];
$payment_methode = 'Cash';
$receipt = '0';
$remark = '';
$gtotal = '0';
$discount = '0';
$oldbalance = $row['balance'];

$grandbalance = $oldbalance+$newbalance;

$invoiceid = uniqid();




  $notes = 'Balance Add > Old Balance= '.$oldbalance.' +  New Balance= '.$newbalance.' > Total Balance = '.$grandbalance.' tk.';

  $sql1 = "INSERT INTO payment (invoice_id, custid, username, receve_amount, discount_ammount, total_amount, reciveby, type, notes, sec, remarks, datee,receipt) VALUES ('$invoiceid','$custid','$userid','$newbalance','$discount','$newbalance','$sesaionuser','$payment_methode','$notes','$sec','$remark','$date','$receipt')";
  


if ($conn->query($sql1) === TRUE) {

   $sql3 = "UPDATE userinfo SET balance=balance+'$newbalance' WHERE custid='$custid'";
  $conn->query($sql3);


  



  $_SESSION['success'] = "Balance Added Successfully";
  header("Location: ../profile.php?id=$custid"); 

} else {
  $_SESSION['error'] = "Balance Added Unsuccessfull";
  header("Location: ../profile.php?id=$custid"); 
}

$conn->close();









?>