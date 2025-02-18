<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ดึงข้อมูลเอกสารจากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM documents WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $document = $result->fetch_assoc();

    if ($document) {
        $file_path = $document['file_path'];
        $file_name = basename($file_path);

        // ตรวจสอบว่าไฟล์มีอยู่จริง
        if (file_exists($file_path)) {
            // ตั้งค่าหัวข้อ HTTP สำหรับการดาวน์โหลด
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Length: ' . filesize($file_path));

            // อ่านและส่งไฟล์
            readfile($file_path);
            exit;
        } else {
            echo 'ไม่พบไฟล์';
        }
    } else {
        echo 'ไม่พบเอกสาร';
    }
}
?>
<?php
session_start();
include "db.php"; // เชื่อมต่อฐานข้อมูล

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM documents WHERE title LIKE ? OR description LIKE ?");
    $search_param = "%" . $search_query . "%";
    $stmt->bind_param("ss", $search_param, $search_param);
} else {
    $stmt = $conn->prepare("SELECT * FROM documents");
}
$stmt->execute();
$result = $stmt->get_result();
?>
