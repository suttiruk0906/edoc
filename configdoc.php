<?php
$servername = "localhost"; // หรือ 127.0.0.1
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน (ค่าเริ่มต้นของ XAMPP จะเป็นค่าว่าง)
$dbname = "edoc"; // ชื่อฐานข้อมูลของคุณ

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>