<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // เข้ารหัสรหัสผ่านด้วย MD5

    // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "ชื่อผู้ใช้นี้ถูกใช้แล้ว!";
    } else {
        // เพิ่มผู้ใช้ใหม่ลงในฐานข้อมูล
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'role')";
        if ($conn->query($sql) === TRUE) {
            echo "สมัครสมาชิกสำเร็จ! <a href='login.php'>เข้าสู่ระบบ</a>";
        } else {
            echo "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }
}
?>
