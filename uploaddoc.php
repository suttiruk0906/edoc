<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edoc"; // ชื่อฐานข้อมูล

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// กำหนดค่าตัวแปรสำหรับการค้นหา
$search = isset($_GET['search']) ? $_GET['search'] : '';

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลเอกสาร
$sql = "SELECT id, order_number, title, announcement_date, document_type, file_path FROM documents WHERE title LIKE ? OR order_number LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// เก็บผลลัพธ์เป็นอาร์เรย์
$filteredFiles = [];
while ($row = $result->fetch_assoc()) {
    // Convert announcement_date to Buddhist Era
    $announcementDate = new DateTime($row['announcement_date']);
    $announcementDate->modify('+543 years'); // Convert to Buddhist Era
    $row['announcement_date_buddhist'] = $announcementDate->format('d-m-Y'); // Format date
    $filteredFiles[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบอัปโหลดและดาวน์โหลดไฟล์</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(105, 140, 189);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1, h2 {
            color: #2c3e50;
            text-align: center;
            font-weight: 600;
        }

        h1 {
            font-size: 32px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        button, a button {
            background-color: rgb(145, 10, 10);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        button:hover, a button:hover {
            background-color: rgb(96, 146, 30);
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type='text'] {
            padding: 10px;
            width: 80%;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: rgb(117, 17, 142);
            color: white;
        }

        tr:nth-child(even) {
            background-color: rgb(217, 228, 231);
        }

        a {
            color: rgb(184, 86, 6);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            color: rgb(0, 0, 0);
        }

        .footer a {
            color: rgb(255, 255, 255);
        }

        .footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>ระบบเอกสารออนไลน์</h1>

    <h2>ค้นหาไฟล์</h2>
    <form method="GET">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="พิมพ์เพื่อค้นหาเอกสาร...">
        <button type="submit">ค้นหา</button>
    </form>
    <a href="upload.php"><button>อัปโหลดไฟล์ใหม่</button></a>

    <h2>รายการเอกสารทั้งหมด</h2>
    <table>
        <tr>
            <th>ลำดับ</th>
            <th>เลขคำสั่ง</th>
            <th>ชื่อเรื่อง</th>
            <th>วันที่ประกาศ </th>
            <th>ประเภทหนังสือ</th>
            <th>ดาวน์โหลด</th>
        </tr>
        <?php
        if (!empty($filteredFiles)) {
            $index = 1;
            foreach ($filteredFiles as $file): ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo htmlspecialchars($file['order_number']); ?></td>
                    <td><?php echo htmlspecialchars($file['title']); ?></td>
                    <td><?php echo htmlspecialchars($file['announcement_date_buddhist']); ?></td>
                    <td><?php echo htmlspecialchars($file['document_type']); ?></td>
                    <td><a href="<?php echo htmlspecialchars($file['file_path']); ?>" download>ดาวน์โหลด</a></td>
                </tr>
            <?php
            endforeach;
        } else { ?>
            <tr>
                <td colspan="6" style="text-align: center; color: red;">ไม่พบเอกสารที่ตรงกับคำค้นหา</td>
            </tr>
        <?php } ?>
    </table>

    <a href="javascript:history.back()">
        <button class="back-button">ย้อนกลับ</button>
    </a>
</div>

<div class="footer">
    <p>&copy; 2025 E_DOC_COOP | <a href="https://www.facebook.com/coop.pakpayun/">สหกรณ์การเกษตรปากพะยูน จำกัด</a></p>
</div>

</body>
</html>
