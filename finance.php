<?php
session_start();
if (!isset($_SESSION["username"]) || ($_SESSION["role"] != "admin" && $_SESSION["role"] != "user")) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ระบบการเงิน</title>
</head>
<body>
    <h2>ระบบการเงิน</h2>
    <p>แสดงข้อมูลการเงินที่นี่...</p>
    <a href="dashboard.php">กลับไปหน้าแรก</a>
</body>
</html>
