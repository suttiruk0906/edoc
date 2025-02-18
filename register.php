<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก - E_DOC_COOP</title>
    <!-- ลิงก์ไปยังไฟล์ CSS ของ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- ลิงก์ไปยังไอคอนของ Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            margin-top: 50px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card h1, .card h2 {
            color: #0056b3;
        }
        .input-group-text {
            cursor: pointer;
        }
        .form-control {
            border-radius: 0.375rem;
        }
        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-primary:hover {
            background-color: #003d80;
            border-color: #003d80;
        }
        .text-center a {
            color: #0056b3;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="text-center">
                        <img src="png/logo.png" alt="logo" class="img-fluid" width="150" height="150">
                    </div>
                    <h1 class="text-center">สมัครสมาชิก</h1>
                    <h2 class="text-center">E_DOC_COOP</h2>
                    <form method="POST" action="register_process.php">
                        <!-- ช่องกรอกชื่อ -->
                        <div class="form-group">
                            <label for="firstName">ชื่อ</label>
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="กรอกชื่อ" required>
                        </div>
                        <!-- ช่องกรอกนามสกุล -->
                        <div class="form-group">
                            <label for="lastName">นามสกุล</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="กรอกนามสกุล" required>
                        </div>
                        <!-- ช่องกรอกชื่อผู้ใช้ -->
                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้ (User name)</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="กรอกชื่อผู้ใช้" required>
                        </div>
                        <!-- ช่องกรอกรหัสผ่าน -->
                        <div class="form-group">
                            <label for="password">รหัสผ่าน (Password)</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="กรอกรหัสผ่าน" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- ปุ่มสมัครสมาชิก -->
                        <button type="submit" class="btn btn-primary btn-block">สมัครสมาชิก</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="login.php">เข้าสู่ระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ลิงก์ไปยังไฟล์ JavaScript ของ Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
