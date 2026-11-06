<?php
include '../inc/sessaion.php';
include '../inc/config.php';


$sec = $_SESSION['sec'] ?? '';
$searchid = trim($_POST['searchid'] ?? '');

if ($searchid === '' || $sec === '') {
    exit;
}

$sql = "SELECT custid, username, expire, mobilephone, amount
        FROM userinfo
        WHERE sec = ?
          AND (
               custid LIKE ?
               OR mobilephone LIKE ?
               OR username LIKE ?
          )
        ORDER BY custid ASC
        LIMIT 10";

$stmt = mysqli_prepare($conn, $sql);

$keyword = "%{$searchid}%";

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $sec,
    $keyword,
    $keyword,
    $keyword
);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $custid = htmlspecialchars($row['custid']);
        $username = htmlspecialchars($row['username']);
        $mobile = htmlspecialchars($row['mobilephone']);
        $expire = htmlspecialchars($row['expire']);

        echo "
            <div class='search-item' data-id='{$custid}'>
                <strong>{$custid} - {$username}</strong>
                <small>Mobile: {$mobile} | Exp: {$expire}</small>
            </div>
        ";
    }
} else {
    echo "<div class='search-item no-result'>No data found</div>";
}

mysqli_stmt_close($stmt);