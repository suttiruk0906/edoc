<?php
$uploadDir = 'uploads/';
require 'db.php'; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล
function thai_date($date) {
    $thai_months = [
        1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน", 5 => "พฤษภาคม",
        6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน", 10 => "ตุลาคม",
        11 => "พฤศจิกายน", 12 => "ธันวาคม"
    ];

    // แปลงวันที่เป็นปี พ.ศ.
    $timestamp = strtotime($date);
    $day = date("d", $timestamp);
    $month = date("n", $timestamp);
    $year = date("Y", $timestamp) + 543; // เพิ่ม 543 สำหรับปี พ.ศ.

    return "$day {$thai_months[$month]} $year";
}
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// ตรวจสอบสิทธิ์
if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "market") {
    echo "คุณไม่มีสิทธิ์เข้าถึงหน้านี้";
    exit();
}


// สร้างโฟลเดอร์สำหรับเก็บไฟล์ถ้ายังไม่มี
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $orderNumber = trim($_POST['order_number']);
    $title = trim($_POST['title']);
    $announcementDate = $_POST['announcement_date'];
    $documentType = $_POST['document_type'];

    // ตรวจสอบประเภทไฟล์ที่อนุญาต
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $fileMimeType = mime_content_type($_FILES['file']['tmp_name']);

    if (!in_array($fileMimeType, $allowedTypes)) {
        echo "<p style='color: red;'>ประเภทไฟล์ไม่ถูกต้อง (อัปโหลดได้เฉพาะ PDF หรือ Word เท่านั้น)</p>";
        exit();
    }

    // ตรวจสอบและสร้างโฟลเดอร์หากไม่มี
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // สร้างชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ
    $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = time() . '_' . uniqid() . '.' . $fileExt;
    $targetFile = $uploadDir . $fileName;

    // อัปโหลดไฟล์
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        // บันทึกข้อมูลลงฐานข้อมูล
        $stmt = $conn->prepare("INSERT INTO documents (order_number, title, announcement_date, document_type, file_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $orderNumber, $title, $announcementDate, $documentType, $targetFile);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>อัปโหลดไฟล์สำเร็จ: <a href='download.php?file=$fileName'>ดาวน์โหลด</a></p>";
        } else {
            echo "<p style='color: red;'>เกิดข้อผิดพลาดในการบันทึกข้อมูล</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color: red;'>อัปโหลดไฟล์ไม่สำเร็จ</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อัปโหลดไฟล์</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        header {
            background-color:rgb(21, 86, 130);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 24px;
            font-weight: 600;
        }

        .container {
            max-width: 700px;
            margin: 30px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="date"], input[type="file"], select {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f8f9fa;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .back-button {
            background-color:rgb(183, 25, 25);
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color:rgb(254, 115, 97);
        }

        a {
            text-decoration: none;
            color:rgb(60, 127, 199);
        }

        a:hover {
            text-decoration: underline;
        }

        /* Success/Failure message */
        .message {
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
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

<header>
    <h3>อัปโหลดไฟล์</h3>
</header>

<div class="container">
    <h2>กรอกข้อมูลเพื่ออัปโหลดไฟล์</h2>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="order_number">เลขคำสั่ง</label>
        <input type="text" name="order_number" id="order_number" required>

        <label for="title">ชื่อเรื่อง</label>
        <input type="text" name="title" id="title" required>

        <label for="announcement_date">วันที่ประกาศ</label>
        <input type="date" name="announcement_date" id="announcement_date" required>

        <label for="document_type">ประเภทหนังสือ</label>
        <select name="document_type" id="document_type" required>
            <option value="ประกาศ">ประกาศ</option>
            <option value="คำสั่ง">คำสั่ง</option>
            <option value="คำสั่ง">ระเบียบ</option>
        </select>

        <label for="file">เลือกไฟล์เพื่ออัปโหลด</label>
        <input type="file" name="file" id="file" required>

        <button type="submit">อัปโหลด</button>
    </form>

    <!-- ปุ่มย้อนกลับ -->
    <button class="back-button" onclick="window.history.back();">ย้อนกลับ</button>

    <?php if (isset($_POST['order_number']) && isset($fileName)): ?>
        <div class="message success">
            <p>อัปโหลดไฟล์สำเร็จ: <a href="download.php?file=<?php echo $fileName; ?>">ดาวน์โหลด</a></p>
            <p><strong>เลขคำสั่ง:</strong> <?php echo htmlspecialchars($orderNumber); ?></p>
            <p><strong>ชื่อเรื่อง:</strong> <?php echo htmlspecialchars($title); ?></p>
            <p><strong>วันที่ประกาศ:</strong> <?php echo htmlspecialchars($announcementDate); ?></p>
            <p><strong>ประเภทหนังสือ:</strong> <?php echo htmlspecialchars($documentType); ?></p>
        </div>
    <?php elseif (isset($_POST['order_number']) && !isset($fileName)): ?>
        <div class="message error">
            <p>อัปโหลดไฟล์ไม่สำเร็จ กรุณาลองใหม่อีกครั้ง</p>
        </div>
    <?php endif; ?>
</div>
<div class="footer">
    <p>&copy; 2025 E_DOC_COOP | <a href="https://www.facebook.com/coop.pakpayun/">สหกรณ์การเกษตรปากพะยูน จำกัด</a></p>
</div>
</body>
</html>
