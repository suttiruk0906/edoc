<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
            background-color:rgb(118, 182, 245);
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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }
        .card {
            background:rgb(49, 16, 199);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background:rgb(161, 34, 20);
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background:rgb(147, 25, 11);
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
    👋 ยินดีต้อนรับ, <?php echo $_SESSION["username"]; ?>!
</div>

<div class="dashboard-container">
    <img src="png/E.png" alt="logo" width="150" height="150">
    <h3>เลือกระบบที่ต้องการ</h3>
    <div class="system-box">
        <?php if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "user") { ?>
            <div class="card"><a href="finance.php">💰 ระบบการเงิน</a></div>
        <?php } ?>
        <?php if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "user") { ?>
            <div class="card"><a href="loan.php">🏦 ระบบสินเชื่อ</a></div>
        <?php } ?>
        <?php if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "user") { ?>
            <div class="card"><a href="market.php">🛒 ระบบตลาด</a></div>
        <?php } ?>
        <?php if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "user") { ?>
            <div class="card"><a href="admin_office.php">📂 ระบบธุรการ</a></div>
        <?php } ?>
        
    </div>

    <a href="logout.php" class="logout-btn">🚪 ออกจากระบบ</a>
</div>

</body>
<div class="footer">
    <p>&copy; 2025 E_DOC_COOP | <a href="https://www.facebook.com/coop.pakpayun/">สหกรณ์การเกษตรปากพะยูน จำกัด</a></p>
</div>
</html>
