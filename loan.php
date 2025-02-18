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
    <title>ระบบสินเชื่อ</title>
</head>
<body>
    <h2>ระบบสินเชื่อ</h2>
    <p>แสดงข้อมูลสินเชื่อที่นี่...</p>
    <a href="dashboard.php">กลับไปหน้าแรก</a>
</body>
</html>
