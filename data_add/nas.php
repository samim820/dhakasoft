<?php
session_start();
include '../inc/sessaion.php';
include '../inc/classes.php';

$sec = $_SESSION['sec'];

$db = new Database($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        "nasname"   => isset($_POST['ip']) ? trim($_POST['ip']) : '',
        "shortname" => isset($_POST['name']) ? trim($_POST['name']) : '',
        "type"      => 'Mikrotik',
        "api"       => isset($_POST['api']) ? trim($_POST['api']) : '',
        "username"  => isset($_POST['username']) ? trim($_POST['username']) : '',
        "sec"  =>  $sec,
        "password"  => isset($_POST['password']) ? trim($_POST['password']) : ''
    ];

    // Validation Rules
    $rules = [
        "nasname"   => "required",
        "shortname" => "required",
        "api"       => "required",
        "username"  => "required",
        "password"  => "required"
    ];

    // Validate if method exists
    if (method_exists($db, 'validate')) {
        $errors = $db->validate($data, $rules);
    } else {
        $errors = [];
    }

    if (empty($errors)) {
        if ($db->insert("nas", $data)) {
            $_SESSION['success'] = "NAS Added Successfully!";
        } else {
            $_SESSION['error'] = "Something went wrong while inserting!";
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
    }

    header("Location: ../nas.php");
    exit;
}
