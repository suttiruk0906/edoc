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

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        label {
            font-weight: bold;
        }

        input, select, textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #667eea;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #5563d6;
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
        <h3>แจ้งปัญหา/แจ้งซ่อม</h3>
        <form action="repair_form.php" method="POST">
            <label for="name">ชื่อผู้แจ้ง:</label>
            <input type="text" name="name" id="name" required>

            <label for="contact">เบอร์โทรศัพท์:</label>
            <input type="text" name="contact" id="contact" required>

            <label for="branch">สาขาที่แจ้งซ่อม:</label>
            <select name="branch" id="branch" required>
                <option value="สำนักงานใหญ่">สำนักงานใหญ่</option>
                <option value="สาขาป่าบอน">สาขาป่าบอน</option>
                <option value="สาขาหารเทา">สาขาหารเทา</option>
                <option value="สาขาควนแสวง">สาขาควนแสวง</option>
            </select>

            <label for="device">ประเภทอุปกรณ์ที่ต้องการซ่อม:</label>
            <select name="device" id="device" required>
                <option value="คอมพิวเตอร์">คอมพิวเตอร์</option>
                <option value="อินเทอร์เน็ต">อินเทอร์เน็ต</option>
                <option value="กล้องวงจรปิด">กล้องวงจรปิด</option>
                <option value="เครื่องใช้สำนักงาน">เครื่องใช้สำนักงาน</option>
                <option value="อื่นๆ">อื่นๆ</option>
            </select>

            <label for="issue_date">วันที่พบปัญหา:</label>
            <input type="date" name="issue_date" id="issue_date" required>

            <label for="issue_description">คำอธิบายปัญหา:</label>
            <textarea name="issue_description" rows="4" required></textarea>

            <button type="submit">แจ้งซ่อม</button>
        </form>
    </div>
</body>
</html>
