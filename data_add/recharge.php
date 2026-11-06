<?php


include '../inc/sessaion.php';
include '../inc/config.php';
include '../inc/classes.php';

$sec = $_SESSION['sec'];
$sesaionuser = $_SESSION['username'];
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d h-i a');
$custid = $_POST['custid'];

$sql10 = "SELECT * FROM userinfo WHERE custid='$custid'";
$row = mysqli_fetch_assoc($conn->query($sql10) );
$payfor = 'recharge';
$routerid = $row['routerid'];

$amount = $row['amount'];
$userid = $row['username'];
$gtotal = $_POST['gtotal'];

$payment_methode = $_POST['methode'];

$remark = $_POST['remarks'];
$month = $_POST['month'];
$packname = $row['package'];
$cycle = $row['cycle'];
$pop = $row['zone'];
$discount = '0';




$packnameformsg = $userObj->getPackageById($row['package'])['name'];


  if ($row['billstatus'] == 'expire') {

   $billstatusupdate = "UPDATE userinfo SET billstatus='active', conn_status='A' WHERE custid='$custid'";
                        $conn->query($billstatusupdate);



$router = $userObj->getRouterById($routerid);
$newProfile = $db->fetchRow("package", "id", $packname);


$mikrotik_profile = $newProfile['profile'];

if($userObj->updatePPPoEProfile($router, $userid, $mikrotik_profile)) {

  $userObj->disconnectPPPoEUser($router, $userid);


    echo "Package updated successfully!";
} else {
    echo "Failed to update Package.";
}

}



$invoiceid = uniqid();


$now = DateTime::createFromFormat('d/m/y', date('d/m/y'));
$expDate = DateTime::createFromFormat('d/m/y', trim($row['expire']));

$days = floor(
    ($expDate->getTimestamp() - $now->getTimestamp())
    / (60 * 60 * 24)
);

if ($days > 0) {

    $expDate->modify("+{$month} month");
    $finalexpire = $expDate->format('d/m/y');

} else {

    $newDate = new DateTime();
    $newDate->modify("+{$month} month");
    $finalexpire = $newDate->format('d/m/y');

    $currentdate = date('d');

    $sql3 = "UPDATE userinfo SET cycle='$currentdate' WHERE custid='$custid'";
    $conn->query($sql3);
}

$sql4 = "SELECT * FROM profile WHERE sec='$sec'";
$row2 = mysqli_fetch_assoc($conn->query($sql4) );

$expiretime = $row2['expire_time'];

$dateObj = DateTime::createFromFormat('d/m/y', $finalexpire);
$expire = $dateObj->format('d M Y');



$Expiration = $expire.' '.$expiretime;



if ($payment_methode == 'Credit') {

  $receve = '0';
  $recit = 'portal';
  
     $sql3 = "UPDATE userinfo SET balance = balance - '$gtotal' WHERE custid='$custid'";
      $conn->query($sql3);

}else{

  $receve = $_POST['receve'];
  $recit = $_POST['recit'];



}


  $notes = 'Recharge > '.$packnameformsg.' For '.$month.' Month Bill '.$gtotal.' tk > New Exp Date: '.$finalexpire.'';

  $sql4 = "INSERT INTO payment (invoice_id, custid, username, receve_amount, discount_ammount, total_amount, reciveby, type, notes, sec, remarks, datee,receipt,payment_for) VALUES ('$invoiceid','$custid','$userid','$receve','$discount','$gtotal','$sesaionuser','$payment_methode','$notes','$sec','$remark','$date','$recit','$payfor')";

  


if ($conn->query($sql4) === TRUE) {


   $sql3 = "UPDATE userinfo SET expire='$finalexpire' WHERE custid='$custid'";
  $conn->query($sql3);


 $_SESSION['success'] = "Bill Recharge Successfully";
    header("Location: /profile.php?id=$custid");
    

} else {
  $_SESSION['error'] = "Bill Recharge Unsuccessfull";
  header("Location: /profile.php?id=$custid");
}

$conn->close();









?>