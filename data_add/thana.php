<?php
include '../inc/sessaion.php';
include '../inc/config.php';

$sec  = $_SESSION['sec'] ?? '';
$name = trim($_POST['name'] ?? '');

if ($name === '' || $sec === '') {
    $_SESSION['error'] = "Name field is required!";
} else {
    // একই name একই section-এ আগে আছে কি না
    $check = $conn->prepare(
        "SELECT id FROM thana WHERE name = ? AND sec = ? LIMIT 1"
    );
    $check->bind_param("ss", $name, $sec);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "This thana already exists in this section!";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO thana (name, sec) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $name, $sec);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Thana Added Successfully";
        } else {
            $_SESSION['error'] = "Something went wrong!";
        }

        $stmt->close();
    }

    $check->close();
}

header("Location: ../thana.php");
$conn->close();
exit;
?>