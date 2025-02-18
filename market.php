<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// ตรวจสอบสิทธิ์
if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "user") {
    echo "คุณไม่มีสิทธิ์เข้าถึงหน้านี้";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ระบบตลาด</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;700&display=swap">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            text-align: center;
        }
        .header {
            background-color:rgb(93, 135, 177);
            padding: 20px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .dashboard-container {
            margin: 40px auto;
            width: 80%;
            max-width: 800px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .system-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 20px 0;
        }
        .card {
            background:rgb(128, 206, 254);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            width: 100%;
            max-width: 600px;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card h2 {
            color: white;
            margin-bottom: 15px;
        }
        .card p a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            display: block;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .card p a:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #e74c3c;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            color: rgb(0, 0, 0);
        }

        .footer a {
            color: rgb(42, 8, 152);
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="header">
    🛒 ระบบตลาด
</div>
<div class="dashboard-container">
    <div class="system-box">
        <div class="card">
            <h2>📊 กำหนดราคาขายสินค้า</h2>
            <p><a href="calculate_fertilizer.php">🌱 คำนวณราคาขายปุ๋ย</a></p>
            <p><a href="calculate_rice.php">🌾 คำนวณราคาขายข้าวสาร</a></p>
            <p><a href="calculate_food.php">🍛 คำนวณราคาขายอาหาร</a></p>
            <p><a href="calculate_suga.php">🍬 คำนวณราคาขายน้ำตาล</a></p>
            <p><a href="calculate_water.php">💧 คำนวณราคาขายน้ำดื่ม</a></p>
            <p><a href="calculate_egg.php">🥚 คำนวณราคาขายไข่ไก่</a></p>
        </div>
    </div>
    <a href="dashboard.php" class="logout-btn">⬅️ กลับไปหน้าหลัก</a>
</div>
</body>
<div class="footer">
    <p>&copy; 2025 E_DOC_COOP | <a href="https://www.facebook.com/coop.pakpayun/">สหกรณ์การเกษตรปากพะยูน จำกัด</a></p>
</div>
</html>
