<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edoc";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ดึงข้อมูลสินค้าทั้งหมด
$sql = "SELECT id, product_code, product_details FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                box-shadow: 0 2px 3px rgba(0,0,0,0.1);
            }
            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
                color: #333;
            }
            tr:hover {
                background-color: #f5f5f5;
            }
            a {
                color: #007BFF;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
          </style>";
    echo "<table>
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["product_code"] . "</td>
                <td>" . $row["product_details"] . "</td>
                <td><a href='edit_product.php?id=" . $row["id"] . "'>แก้ไข</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "ไม่พบข้อมูลสินค้า";
}
$conn->close();
?>

