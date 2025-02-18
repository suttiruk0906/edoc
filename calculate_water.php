<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>คำนวณราคาขายน้ำดื่ม</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(249, 249, 249);
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 16px;
            color:rgb(44, 127, 217);
            font-size: 1.5em;
        }

        form {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgb(249, 249, 249);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            background-color: rgb(100, 185, 255);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color:rgb(55, 120, 224);
            color: white;
            font-size: 16px;
        }

        td input {
            padding: 8px;
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
            text-align: right;
        }

        td input[type="number"] {
            width: 100%;
        }

        td input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        input[type="submit"] {
            background-color:rgb(53, 194, 22);
            color: white;
            padding: 12px 12px;
            border: none;
            border-radius: 4px;
            width: 15%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block; /* ทำให้ปุ่มเป็นบล็อกเพื่อให้สามารถใช้ margin auto */
            margin: 20px auto; /* จัดกึ่งกลางปุ่มในแนวนอนและเพิ่มระยะห่างด้านบน */
        }

        input[type="submit"]:hover {
            background-color:rgb(167, 222, 70);
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 14px;
            }

            input[type="submit"] {
                font-size: 14px;
                padding: 10px 15px;
            }

            table {
                font-size: 14px;
            }
        } 
        button#addRowBtn {
        background-color: rgb(92, 71, 170); /* สีพื้นหลังเดียวกับปุ่มส่งฟอร์ม */
        color: white; /* สีตัวอักษร */
        padding: 12px 12px; /* ขนาดพื้นที่ภายในปุ่ม */
        border: none; /* ไม่มีขอบ */
        border-radius: 4px; /* มุมโค้ง */
        width: 10%; /* ความกว้างของปุ่ม */
        font-size: 16px; /* ขนาดตัวอักษร */
        cursor: pointer; /* เปลี่ยนเคอร์เซอร์เมื่อวางเมาส์เหนือปุ่ม */
        transition: background-color 0.3s; /* เอฟเฟกต์การเปลี่ยนสีพื้นหลังเมื่อโฮเวอร์ */
        display: block; /* แสดงเป็นบล็อกเพื่อให้จัดกึ่งกลางได้ */
        margin: 20px 0; /* จัดกึ่งกลางปุ่มและเพิ่มระยะห่างด้านบนและล่าง */
    }
    
    button#addRowBtn:hover {
        background-color: rgb(167, 222, 70); /* สีพื้นหลังเมื่อโฮเวอร์ */
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    
    <form action="process_water.php" method="post">
        
    <h2><i class="fas fa-calculator"></i> คำนวณราคาขายน้ำดื่ม</h2>
        <table id="productTable">
            <thead>
            <th rowspan="2">ลำดับ</th>
            <th rowspan="8">รหัสสินค้า</th>
            <th rowspan="8">ชื่อสินค้า</th>
            <th rowspan="2">จำนวนคงเหลือ</th>
            <th rowspan="2">จำนวนซื้อเข้า</th>
            <th rowspan="2">หน่วยนับ</th>
            <!-- หัวข้อหลักสำหรับราคาทุน -->
            <th colspan="3">ราคาทุน</th>
            <!-- หัวข้อหลักสำหรับราคาขาย -->
            <th rowspan="2">ราคาเดิม (บาท)</th> 
            <th colspan="7">ราคาขาย</th> 
        </tr>
        <tr>
            <!-- รายการย่อยภายใต้ราคาทุน -->
            <th>ราคาซื้อ (บาท)</th>
            <th>ค่าขนส่ง (บาท)</th>
            <th>ส่วนลด (บาท)</th>
            <!-- รายการย่อยภายใต้ราคาขาย -->
            <th>ต้นทุน (บาท)</th>
            <th>ราคาเงินสด (บาท)</th>
            <th>เงินเชื่อ 1 (บาท)</th>
            
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td><input type="text" name="product_code[]" required></td>
        <td><input type="text" name="product_details[]" required></td>
        <td><input type="number" name="stock_quantity[]" min="0" required></td>
        <td><input type="number" name="purchase_quantity[]" min="0" required></td>
        <td>
            <select name="unit[]" required>
                <option value="โหล">โหล</option>
            </select>
        </td>
        <td><input type="number" name="purchase_price[]" min="0" step="0.01" required></td>
        <td>
            <select name="shipping_cost[]" required>
                <option value="o">0</option>
                <option value="10">10</option>
            </select>
        </td>
        <td>
            <select name="discount[]" required>
                <option value="o">0</option>
                <option value="3">3</option>
            </select>
        </td>
        <td><input type="number" name="original_price[]" min="0" step="0.01" required></td>
    </tr>
</tbody>

        </table>
        <br>
        <button type="button" id="addRowBtn"><i class="fas fa-plus"></i> เพิ่มรายการ</button>

        <br><br>
        <input type="submit" value="กดปุ่มคำนวณราคา">
        <a href="javascript:history.back();" style="font-size: 16px; text-decoration: none; color: #fff; background-color:rgb(176, 97, 8); padding: 10px 20px; border-radius: 5px;">
    ⬅️ ย้อนกลับ
    </a>

    </form>

    
    <script>
    
    document.getElementById('addRowBtn').addEventListener('click', function() {
        var table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
        var rowCount = table.rows.length + 1; // กำหนดลำดับแถวใหม่
        var newRow = table.insertRow();
        
        newRow.innerHTML = ` 
            <td>${rowCount}</td>
            <td><input type="text" name="product_code[]" required></td>
            <td><input type="text" name="product_details[]" required></td>
            <td><input type="number" name="stock_quantity[]" min="0" required></td>
            <td><input type="number" name="purchase_quantity[]" min="0" required></td>
            <td>
                <select name="unit[]" required>
                    <option value="ถุง">ถุง</option>
                    <option value="กระสอบ">กระสอบ</option>
                </select>
            </td>
            <td><input type="number" name="purchase_price[]" min="0" step="0.01" required></td>
            <td>
                        <select name="shipping_cost[]" required>
                            <option value="o">0</option>
                            <option value="1o">10</option>
                        </select>
                    </td>
                    <td>
                    <select name="discount[]" required>
                            <option value="o">0</option>
                            <option value="3">3</option>
                    </select>
                    </td>
            <td><input type="number" name="original_price[]" min="0" step="0.01" required></td> 
        `;
    });
</script>
</body>
<div class="footer">
    <p>&copy; 2025 E_DOC_COOP | <a href="https://www.facebook.com/coop.pakpayun/">สหกรณ์การเกษตรปากพะยูน จำกัด</a></p>
</div>
</html>
