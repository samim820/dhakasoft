<?php


include '../inc/sessaion.php';
include '../inc/config.php';
include '../inc/classes.php';


$custid = $_GET['id'];
$invoiceid = $_GET['inv'];

$userinfo = $db->fetchRow("userinfo","custid",$custid);
$paymentinfo = $db->fetchRow("payment","invoice_id",$invoiceid);



if ($paymentinfo['payment_for'] == 'package_change') {
	
	 $_SESSION['error'] = "Package Change Can't Return";
    header("Location: /profile.php?id=$custid");

}elseif($paymentinfo['payment_for'] == 'cycle_change'){

 $_SESSION['success'] = "Cycle Change Can't Return";
    header("Location: /profile.php?id=$custid");

}elseif($paymentinfo['payment_for'] == 'recharge'){

	echo 'Please wait we are working ..';



}






