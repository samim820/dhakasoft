<?php
session_start();
include '../inc/classes.php';

$db = new Database($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $sec  = $_SESSION['sec'] ?? '';

    if ($name === '') {
        $_SESSION['error'] = "Name field is required!";
    } elseif ($sec === '') {
        $_SESSION['error'] = "Section not found!";
    } else {
        // একই section-এ একই area আগে আছে কি না
        $stmt = $conn->prepare(
            "SELECT id FROM area WHERE name = ? AND sec = ? LIMIT 1"
        );
        $stmt->bind_param("ss", $name, $sec);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "This area already exists in this section!";
        } else {
            $data = [
                "name" => $name,
                "sec"  => $sec
            ];

            if ($db->insert("area", $data)) {
                $_SESSION['success'] = "Area Added Successfully";
                $activity->log("Area Add", "New Area Added Name " . $name);
            } else {
                $_SESSION['error'] = "Something went wrong!";
            }
        }

        $stmt->close();
    }

    header("Location: ../area.php");
    exit;
}