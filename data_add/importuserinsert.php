<?php

include '../inc/sessaion.php';
include '../inc/config.php';
require'../inc/api.php';

$sec = $_SESSION['sec'];
$sesaionuser = $_SESSION['username'];
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d h:i a');

$popname = $_POST['popname'] ?? '';
$deviceid = $_POST['deviceid'] ?? '';

// Check data
if(empty($popname) || empty($deviceid)){

      $_SESSION['error'] = "POP Name or Device ID missing!";
  header("Location: ../importuser.php"); 

    //die("POP Name or Device ID missing!");
}

// Ensure autocommit off
mysqli_autocommit($conn, FALSE);

$sql = "SELECT * FROM importuser";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        try {
            mysqli_begin_transaction($conn);

            $insertStmt = $conn->prepare("INSERT INTO userinfo 
                (custid, username, firstname,address, mobilephone, portalloginpassword, package, routerid, cycle, expire, amount, sec, thana, balance, distric, pop,userstatus,nid,area)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)");

            $deleteStmt = $conn->prepare("DELETE FROM importuser WHERE id=?");

            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $custid = $row['custid'];
                $username = $row['username'];
                $firstname = $row['name'];
                $address = $row['address'];
                $mobilephone = $row['mobilephone'];
                $password = $row['portalloginpassword'];
                $packageid = $row['packageid'];
                $amount = $row['amount'];
                $expire = $row['expire'];
                $balance = $row['balance'];
                $cycle = $row['cycle'];
                $area = $row['area'];
                $secid = $row['sec'];
                $nid = $row['nid'];
                $status = $row['status'];
                $routerid = $deviceid;
                $thana = 'SHAPORAN';
                $distric = 'DHAKA';

                // Bind parameters and execute insert
                $insertStmt->bind_param(
                    "ssssssssisissssssss", 
                    $custid, $username, $firstname, $address, $mobilephone, $password, $packageid,
                    $routerid, $cycle, $expire, $amount, $secid, $thana, $balance, $distric, $popname,$status,$nid,$area
                );

                if(!$insertStmt->execute()){
                    throw new Exception("Insert failed for ID $id: " . $insertStmt->error);
                }

                // Bind parameters and execute delete
                $deleteStmt->bind_param("i", $id);
                if(!$deleteStmt->execute()){
                    throw new Exception("Delete failed for ID $id: " . $deleteStmt->error);
                }
            }

            mysqli_commit($conn);
            $_SESSION['success'] = "All data migrated successfully.";
        header("Location: /index.php");

        } catch(Exception $e){
            mysqli_rollback($conn);
            echo "Transaction failed: " . $e->getMessage();
        }

    } else {
        echo "No data found in importuser.";
    }
} else {
    echo "Select query failed: " . mysqli_error($conn);
}

// Close statements and connection
$insertStmt->close();
$deleteStmt->close();
$conn->close();
?>
