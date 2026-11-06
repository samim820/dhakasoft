<?php

include '../inc/sessaion.php';
include '../inc/config.php';
include '../inc/api.php'; 

$sec = $_SESSION['sec'];




$result = $conn->query("select * from ppp_active where sts='Disconected' AND sec='$sec'");
$count=$result->num_rows;

echo $count;

die;





?>
