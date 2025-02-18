<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแจ้งซ่อม</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #333;
            overflow: hidden;
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
        }

        .navbar a:hover {
            background: #555;
            border-radius: 5px;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        h3 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="repair.php">สถานะการซ่อม</a>
        <a href="repair_from.php">แจ้งปัญหา/แจ้งซ่อม</a>
        <a href="repair_data.php">สถิติการแจ้งซ่อม</a>
        <a href="repair_admin.php">สำหรับ Admin</a>
    </div>

    <div class="container">
        <h3>ตารางงานแจ้งซ่อม</h3>
        <table>
            <tr>
                <th>วันที่แจ้งซ่อม</th>
                <th>เลขที่แจ้งซ่อม</th>
                <th>ผู้แจ้งซ่อม</th>
                <th>สาขาที่แจ้งซ่อม</th>
                <th>รายการแจ้งซ่อม</th>
                <th>ผู้รับแจ้งซ่อม</th>
                <th>สถานะ</th>
                <th>รายละเอียด</th>
            </tr>
            <tr>
                <td>18/02/2025</td>
                <td>R-001</td>
                <td>สมชาย</td>
                <td>สำนักงานใหญ่</td>
                <td>คอมพิวเตอร์เสีย</td>
                <td>เจ้าหน้าที่ A</td>
                <td>กำลังดำเนินการ</td>
                <td>รออะไหล่</td>
            </tr>
        </table>
    </div>
</body>
</html>
