<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



include '../inc/sessaion.php';
include '../inc/config.php';
require('../inc/api.php');
include '../inc/classes.php';


if (!isset($_SESSION['register_preview'])) {
    header("Location: ../adduser.php");
    exit;
}

$sec = $_SESSION['sec'];
$sesaionuser = $_SESSION['username'];
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d h:i a');





$sql10 = "SELECT * FROM profile WHERE sec='$sec'";
$row = mysqli_fetch_assoc($conn->query($sql10) );

$time = $row['expire_time'];
$custid = $_POST['custid'];
$fullname = $_POST['fullname'];
$userid = $_POST['userid'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$resellerchargs = $_POST['resellerchargs'];
$gender = $_POST['gender'];
$postcode = $_POST['postcode'];
$expiredate = $_POST['expiredate'];
$nid = $_POST['nid'];
$house = $_POST['house'];
$road = $_POST['road'];
$flat = $_POST['flat'];
$zone = $_POST['zone'];
$thana = $_POST['thana'];
$distric = $_POST['distric'];
$remark = $_POST['remark'];
$password = $_POST['password'];
$package = $_POST['package'];
$packageid = $_POST['packageid'];
$cycle = $_POST['cycle'];
$type = $_POST['type'];
$onumac = $_POST['onumac'];
$rent = $_POST['rent'];
$expiredatetime = $_POST['expire'];
$finalexpire = $expiredate.' '.$time;
// billing data insert
$otc = $_POST['otc'];
$daysbill = $_POST['daysbill'];
$daycount = $_POST['daycount'];
$discount = $_POST['discount'];
$depo = $_POST['depo'];
$recive = $_POST['recive'];
$gtotal = $_POST['gtotal'];
$due = '0';
$payment_methode = $_POST['payment_methode'];
$invoiceid = uniqid();




$dt = DateTime::createFromFormat('Y/m/d', $expiredatetime);


$expire = $dt->format('d/m/y');

$address = 'House-'.$house.', Road-'.$road.', Flat-'.$flat.',Thana-'.$thana.',Distric-'.$distric;

    
 $findmikrotik = "SELECT * FROM package WHERE id='$package'";
  $find_mikrotik = mysqli_fetch_assoc($conn->query($findmikrotik) );

  $routerid_find = $find_mikrotik['routerid'];
  $packname = $find_mikrotik['name'];

   $diupass = "SELECT * FROM nas WHERE id='$routerid_find'";
  $find_diupass = mysqli_fetch_assoc($conn->query($diupass) );


  $db->deductBalance($sec, $resellerchargs);










 $sql = "INSERT INTO userinfo (custid, username, firstname, email, mobilephone, city, zip, portalloginpassword, package,routerid, cycle, expire, zone, house, road, onumac, gender, amount, sec, thana) VALUES ('$custid', '$userid', '$fullname', '$email', '$mobile', '$distric', '$postcode', '$password', '$package','$routerid_find', '$cycle', '$expire', '$zone', '$house', '$road', '$onumac', '$gender', '$rent', '$sec','$thana')";

if ($conn->query($sql) === TRUE) {


  $notes = 'New Connection > '.$packname.' For '.$daycount.' days '.$daysbill.' tk > Exp Date: '.$finalexpire.' > OTC-'.$otc.' > Deposit-'.$depo.' tk > Discount-'.$discount.' tk,';

  $sql4 = "INSERT INTO payment (invoice_id, custid, username, receve_amount, total_amount, discount_ammount,  reciveby, type, notes, sec, remarks, datee) VALUES ('$invoiceid','$custid','$userid','$recive','$gtotal','$discount','$sesaionuser','$payment_methode','$notes','$sec','$remark','$date')";
  $conn->query($sql4);


  // send sms to database

  $sqlforsms = "SELECT * FROM sms_temp WHERE sec='$sec' AND msg_sec='welcome'";
    $sms_temp = mysqli_fetch_assoc($conn->query($sqlforsms) );

    if (empty($sms_temp['id'])) {
        

    }elseif ($sms_temp['status'] == 'Active') {
      
       include '../inc/sms_send.php';

    }else{

    }





              $API = new routeros_api();
              $API->debug = false;
              $API->port = $find_diupass['api'];
              if ($API->connect($find_diupass['nasname'] , $find_diupass['username'], $find_diupass['password'])) {



                   $API->comm("/ppp/secret/add", array(
          "name"     => $userid,
          "password" => $password,
          "profile"  => $find_mikrotik['profile'],
          "service"  => 'pppoe',
          "comment"  => $address,
        ));

                    }else{

                     $_SESSION['error'] = "User Added Without Mikrotik";

                    }



unset($_SESSION['register_preview']);

  $_SESSION['success'] = "User Added Successfully";
  header("Location: index.php"); 

} else {
  $_SESSION['error'] = "User Added Unsuccessfull";
  header("Location: index.php"); 
}




$conn->close();











?>