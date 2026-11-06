<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live PPPoE User Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-3">Multi-Router PPPoE User Status (Live)</h3>
    <div id="userTable">Loading...</div>
</div>

<script>
function loadUserStatus() {
    $("#userTable").load("status.php");
}

// প্রথমবার লোড
loadUserStatus();

// প্রতি 10 সেকেন্ডে refresh
setInterval(loadUserStatus, 10000);
</script>
</body>
</html>
