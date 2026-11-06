<?php

include '../inc/sessaion.php';
include '../inc/config.php';

$sec = $_SESSION['sec'];
$sesaionuser = $_SESSION['username'];
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d h:i a');
$custid = $_POST['custid'];

$sql10 = "SELECT * FROM userinfo WHERE custid='$custid'";
$row10 = mysqli_fetch_assoc($conn->query($sql10) );


$userid = $row10['username'];
$pop = $row10['zone'];
$packname = $row['package'];
$gtotal = $_POST['gtotal'];
$newexpire = $_POST['newexpire'];
$oldexpire = $_POST['oldexpire'];
$daycount = $_POST['days'];
$payment_methode = $_POST['methode'];
$receipt = $_POST['receipt'];
$remark = $_POST['remarks'];
$cycle = $_POST['newcycle'];;
$discount = '0';

$payfor = 'cycle_change';



$sql09 = "SELECT * FROM profile WHERE sec='$sec'";
$row = mysqli_fetch_assoc($conn->query($sql09) );

$time = $row['expire_time'];

$finalexpire = $newexpire;

$invoiceid = uniqid();

$now = date('Y/m/d');
$exp = $row['expire'];

$date1 = strtotime($now);
$date2 = strtotime($exp);
$diff = $date2 - $date1;
$days = floor($diff / (60 * 60 * 24));



$expire = date("d M Y", strtotime($finalexpire));

$Expiration = $expire.' '.$time;


if ($days > 0) {


}else{





if ($payment_methode == 'Credit') {

  $receve = '0';
}else{

  $receve = $_POST['receve'];
}






$notes = 'Cycle Change > '.$oldexpire.' to '.$finalexpire.' > Charg - '.$gtotal.'tk.';

  $sql1 = "INSERT INTO payment (invoice_id, custid, username, receve_amount, discount_ammount, total_amount, reciveby, type, notes, sec, remarks, datee,receipt,payment_for) VALUES ('$invoiceid','$custid','$userid','$receve','$discount','$gtotal','$sesaionuser','$payment_methode','$notes','$sec','$remark','$date','$receipt','$payfor')";
  


if ($conn->query($sql1) === TRUE) {

  
   $sql3 = "UPDATE userinfo SET expire='$finalexpire', cycle='$cycle' WHERE custid='$custid'";
  $conn->query($sql3);


  



  $_SESSION['success'] = "Cycle Change Successfully";
  header("Location: ../profile.php?id=$custid");  

} else {
  $_SESSION['error'] = "Cycle Change Unsuccessfull";
  header("Location: ../profile.php?id=$custid"); 
}

$conn->close();

}







?>