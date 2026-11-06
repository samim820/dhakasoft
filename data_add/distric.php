<?php
include '../inc/sessaion.php';
include '../inc/config.php';

$sec  = $_SESSION['sec'];
$name = trim($_POST['name']);

// Duplicate check
$check = $conn->prepare("SELECT id FROM distric WHERE sec = ? AND name = ?");
$check->bind_param("ss", $sec, $name);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "This district already exists";
    header("Location: ../distric.php");
    exit;
}

$stmt = $conn->prepare("INSERT INTO distric (name, sec) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $sec);

if ($stmt->execute()) {
    $_SESSION['success'] = "District Added Successfully";
} else {
    $_SESSION['error'] = "Something Wrong";
}

header("Location: ../distric.php");
exit;
?>