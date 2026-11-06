<?php
include '../inc/sessaion.php';
include '../inc/config.php';
include '../inc/classes.php';


$getid = $_GET['custid'] ?? null;

if (!$getid) {
    $_SESSION['error'] = "Invalid request!";
    header("Location: ../profile.php");
    exit;
}

// ----------------- Fetch user info -----------------
$getuserinfo = $db->fetchRow("userinfo", "custid", $getid);

if (!$getuserinfo) {
    $_SESSION['error'] = "User not found!";
    header("Location: ../profile.php");
    exit;
}

$getmikrotik_profile = $db->fetchRow("package", "id", $getuserinfo['package']);
$RT_INFO             = $db->fetchRow("nas", "id", $getuserinfo['routerid']);

if (!$getmikrotik_profile || !$RT_INFO) {
    $_SESSION['error'] = "Profile or Router info not found!";
    header("Location: ../profile.php?id=$getid");
    exit;
}

// ----------------- Mikrotik API -----------------
$API = new routeros_api();
$API->debug = false;
$API->port  = $RT_INFO['api'];

if ($API->connect($RT_INFO['nasname'], $RT_INFO['username'], $RT_INFO['password'])) {
    
    // 🔎 Step 1: Check profile exists
    $profiles = $API->comm("/ppp/profile/print", [
        ".proplist" => "name",
        "?name" => $getmikrotik_profile['profile']
    ]);

    if (count($profiles) > 0) {
        // Profile exists → Add PPP Secret
        $API->comm("/ppp/secret/add", array(
            "name"     => $getuserinfo['username'],
            "password" => $getuserinfo['portalloginpassword'],
            "profile"  => $getmikrotik_profile['profile'],
            "service"  => 'pppoe',
            "comment"  => $getuserinfo['address'],
        ));

        // Log activity
        $activity->log("User Readded", $getuserinfo['username']." -> Readded to Server -> ".$RT_INFO['nasname']."/".$RT_INFO['shortname']);

        $_SESSION['success'] = "User readded successfully";

    } else {
        // Profile not found
        $_SESSION['error'] = "Profile not found in !! MikroTik Router !!";
    }

} else {
    $_SESSION['error'] = "Mikrotik Device login failed!";
}

header("Location: ../profile.php?id=$getid");
exit;
