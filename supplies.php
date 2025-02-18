<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'edoc';

session_start();

if (!isset($_SESSION['username'])) {
    // ถ้ายังไม่ล็อกอิน ให้กลับไปที่หน้า login
    header("Location: login.php");
    exit();
}


// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// คำสั่ง SQL เพื่อดึงข้อมูลพัสดุ
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // เบิกจ่ายพัสดุ
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $remarks = $_POST['remarks'];

    // คำนวณจำนวนเงิน
    $stmt = $conn->prepare("SELECT unit_price, stock_quantity FROM items WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($unit_price, $stock_quantity);
    $stmt->fetch();

    $amount = $unit_price * $quantity;

    if ($quantity <= $stock_quantity) {
        // ลดสต็อก
        $new_stock = $stock_quantity - $quantity;
        $update_sql = "UPDATE items SET stock_quantity = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_stock, $item_id);
        $update_stmt->execute();

        // เพิ่มรายการเบิกจ่าย
        $insert_sql = "INSERT INTO transactions (item_id, quantity, amount, remarks) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iiis", $item_id, $quantity, $amount, $remarks);
        $insert_stmt->execute();
        
        echo "เบิกจ่ายสำเร็จ";
    } else {
        echo "จำนวนที่เบิกเกินกว่าคงเหลือ";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเบิกจ่ายพัสดุออนไลน์</title>
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

<h2>ระบบเบิกจ่ายพัสดุออนไลน์</h2>

<form method="POST">
    <label for="item_id">เลือกพัสดุ:</label>
    <select name="item_id" id="item_id">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <option value="<?= $row['id']; ?>"><?= $row['item_name']; ?> - <?= $row['unit']; ?> - ราคา <?= $row['unit_price']; ?> บาท</option>
        <?php } ?>
    </select>
    
    <label for="quantity">จำนวนที่เบิก:</label>
    <input type="number" name="quantity" id="quantity" required>

    <label for="remarks">หมายเหตุ:</label>
    <input type="text" name="remarks" id="remarks">

    <button type="submit">เบิกพัสดุ</button>
</form>

<h3>รายการพัสดุ</h3>
<table>
    <tr>
        <th>ลำดับ</th>
        <th>รายการ</th>
        <th>ราคาต่อหน่วย</th>
        <th>คงเหลือ</th>
        <th>หน่วยนับ</th>
    </tr>
    <?php
    $result = $conn->query($sql);
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter++ . "</td>";
        echo "<td>" . $row['item_name'] . "</td>";
        echo "<td>" . $row['unit_price'] . "</td>";
        echo "<td>" . $row['stock_quantity'] . "</td>";
        echo "<td>" . $row['unit'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<h3>รายการเบิกจ่ายพัสดุ</h3>
<table>
    <tr>
        <th>ลำดับ</th>
        <th>รายการ</th>
        <th>จำนวนที่เบิก</th>
        <th>จำนวนเงิน</th>
        <th>หมายเหตุ</th>
        <th>วันที่เบิก</th>
    </tr>
    <?php
    $transaction_sql = "SELECT t.transaction_id, i.item_name, t.quantity, t.amount, t.remarks, t.transaction_date 
                        FROM transactions t
                        JOIN items i ON t.item_id = i.id";
    $transaction_result = $conn->query($transaction_sql);
    $transaction_counter = 1;
    while ($row = $transaction_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $transaction_counter++ . "</td>";
        echo "<td>" . $row['item_name'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['amount'] . "</td>";
        echo "<td>" . $row['remarks'] . "</td>";
        echo "<td>" . $row['transaction_date'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
<?php if ($_SESSION['role'] === 'admin') { ?>
    <a href="supplies_admin.php">
        <button>ไปยังหน้า Admin</button>
    </a>
<?php } ?>
</body>
</html>

<?php
$conn->close();

?>