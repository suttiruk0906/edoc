<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'edoc';

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// เพิ่มพัสดุใหม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {
    $item_name = $_POST['item_name'];
    $unit_price = $_POST['unit_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $unit = $_POST['unit'];

    $sql = "INSERT INTO items (item_name, unit_price, stock_quantity, unit) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdss", $item_name, $unit_price, $stock_quantity, $unit);
    $stmt->execute();
    echo "เพิ่มพัสดุใหม่สำเร็จ";
}

// อนุมัติการเบิกจ่าย
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_transaction'])) {
    $transaction_id = $_POST['transaction_id'];

    // เปลี่ยนสถานะการอนุมัติ (สถานะการอนุมัติสมมุติเป็น 1 คือ อนุมัติ)
    $sql = "UPDATE transactions SET status = 1 WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    echo "อนุมัติการเบิกจ่ายสำเร็จ";
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าสำหรับ Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        input, select {
            padding: 8px;
            margin: 5px;
            width: 100%;
            max-width: 300px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>หน้าสำหรับ Admin</h2>

<!-- ฟอร์มเพิ่มพัสดุใหม่ -->
<h3>เพิ่มพัสดุใหม่</h3>
<form method="POST">
    <label for="item_name">ชื่อพัสดุ:</label>
    <input type="text" name="item_name" id="item_name" required>
    
    <label for="unit_price">ราคาต่อหน่วย (บาท):</label>
    <input type="number" name="unit_price" id="unit_price" required>

    <label for="stock_quantity">จำนวนคงเหลือ:</label>
    <input type="number" name="stock_quantity" id="stock_quantity" required>

    <label for="unit">หน่วยนับ:</label>
    <input type="text" name="unit" id="unit" required>

    <button type="submit" name="add_item">เพิ่มพัสดุ</button>
</form>

<!-- ฟอร์มอนุมัติการเบิกจ่าย -->
<h3>รายการเบิกจ่ายพัสดุที่รอการอนุมัติ</h3>
<table>
    <tr>
        <th>ลำดับ</th>
        <th>รายการ</th>
        <th>จำนวนที่เบิก</th>
        <th>จำนวนเงิน</th>
        <th>หมายเหตุ</th>
        <th>วันที่เบิก</th>
        <th>อนุมัติ</th>
    </tr>
    <?php
    // ดึงรายการการเบิกจ่ายที่ยังไม่ได้รับการอนุมัติ
    $sql = "SELECT t.transaction_id, i.item_name, t.quantity, t.amount, t.remarks, t.transaction_date 
            FROM transactions t
            JOIN items i ON t.item_id = i.id
            WHERE t.status IS NULL";
    $result = $conn->query($sql);
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter++ . "</td>";
        echo "<td>" . $row['item_name'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['amount'] . "</td>";
        echo "<td>" . $row['remarks'] . "</td>";
        echo "<td>" . $row['transaction_date'] . "</td>";
        echo "<td>
                <form method='POST'>
                    <input type='hidden' name='transaction_id' value='" . $row['transaction_id'] . "'>
                    <button type='submit' name='approve_transaction'>อนุมัติ</button>
                </form>
              </td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
