<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบธุรการ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* สีพื้นหลังสบายตา */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #0056b3; /* สีฟ้าสำหรับ header */
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header h2 {
            font-size: 24px;
            font-weight: 700;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .system-box {
            width: 48%;
            margin-bottom: 20px;
        }
        .system-box .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .system-box .card:hover {
            transform: translateY(-5px); /* การยกการ์ดเมื่อ hover */
        }
        .system-box h2 {
            color: #333;
            font-size: 22px;
            font-weight: 600;
        }
        .system-box p {
            font-size: 16px;
            color: #555;
        }
        .system-box a {
            color: #0056b3;
            text-decoration: none;
            font-weight: 600;
        }
        .system-box a:hover {
            text-decoration: underline;
        }
        .logout-btn {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #218838;
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
    <h2>🗂️ ระบบธุรการ</h2>
</div>

<div class="dashboard-container">
    <div class="system-box">
        <div class="card">
            <h2>📊 ระบบจัดเก็บเอกสาร</h2>
            <p><a href="uploaddoc.php">📑 ประกาศ ระเบียบ คำสั่ง </a></p>
        </div>
    </div>
    <div class="system-box">
        <div class="card">
            <h2>📁 แบบฟอร์มหนังสือต่างๆ</h2>
            <p><a href="upload_form.php">📋 แบบฟอร์ม </a></p>
        </div>
    </div>
    <div class="system-box">
        <div class="card">
            <h2>💻 คอมพิวเตอร์และเทคโนโลยี</h2>
            <p><a href="repair.php">🛠️ ระบบแจ้งซ่อม </a></p>
        </div>
    </div>
    <div class="system-box">
        <div class="card">
            <h2>📦 พัสดุและครุภัณฑ์</h2>
            <p><a href="supplies.php">📦 ระบบเบิกจ่ายพัสดุ </a></p>
        </div>
    </div>
</div>
<a href="dashboard.php" class="logout-btn">⬅️ กลับไปหน้าหลัก</a>
</body>
<div class="footer">
    <p>&copy; 2025 E_DOC_COOP | <a href="https://www.facebook.com/coop.pakpayun/">สหกรณ์การเกษตรปากพะยูน จำกัด</a></p>
</div>
</html>
