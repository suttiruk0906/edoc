<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // ใช้ MD5 ในการเข้ารหัส

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ - E_DOC_COOP</title>
    <!-- ลิงก์ไปยังไฟล์ CSS ของ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- ลิงก์ไปยังไฟล์ CSS ของ Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- ลิงก์ไปยังไฟล์ CSS ของคุณ -->
    <link rel="style.css" href="style.css">
    <style>
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 38px;
            z-index: 2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center">
                    <img src="png/logo.png" alt="logo" class="img-fluid" width="250" height="200">
                </div>
                <h1 class="text-center">เข้าสู่ระบบ</h1>
                <h2 class="text-center">E_DOC_COOP</h2>
                <form method="POST">
                    <div class="form-group position-relative">
                        <label for="username">ชื่อผู้ใช้ (Username)</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="กรอกชื่อผู้ใช้" required>
                    </div>
                    <div class="form-group position-relative">
                        <label for="password">รหัสผ่าน (Password)</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="กรอกรหัสผ่าน" required>
                        <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                </form>
                <div class="text-center mt-3">
                    <a href="register.php">สมัครสมาชิก</a>
                </div>
                <div class="text-center mt-3">
                    <a href="#">ลืมรหัสผ่าน?</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ลิงก์ไปยังไฟล์ JavaScript ของ Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                // สลับประเภทของ input ระหว่าง password และ text
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // สลับไอคอนระหว่าง eye และ eye-slash
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>
</html>
