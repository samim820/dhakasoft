<?php

$sname= "localhost";
$unmae= "root";
$password = "Mylove82@@@";

$db_name = "s2_dhakasoft";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}

date_default_timezone_set('Asia/Dhaka');