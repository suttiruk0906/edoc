<?php
$host = "localhost";
$user = "root"; // ใส่ชื่อ user ของฐานข้อมูล
$pass = ""; // ใส่รหัสผ่านของฐานข้อมูล
$dbname = "edoc";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


