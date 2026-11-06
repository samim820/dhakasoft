<?php
include __DIR__ . '/../inc/config.php';

// মেয়াদোত্তীর্ণ Paid ইউজার সিলেক্ট করা
$sql = "
    UPDATE userinfo
    SET billstatus = 'expire',
        conn_status = 'A'
    WHERE STR_TO_DATE(TRIM(expire), '%d/%m/%y') <= CURDATE()
      AND user_type = 'Paid' AND billstatus='Active'
";

if ($conn->query($sql) === TRUE) {
    echo "Expired users updated successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
