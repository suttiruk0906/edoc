<?php
session_start();  // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['form_data'] = $_POST;
    // รับค่าจากฟอร์ม
    $product_codes = $_POST['product_code'];
    $product_details = $_POST['product_details'];
    $stock_quantities = $_POST['stock_quantity'];
    $purchase_quantities = $_POST['purchase_quantity'];
    $units = $_POST['unit'];
    $purchase_prices = $_POST['purchase_price'];
    $shipping_costs = $_POST['shipping_cost'];
    $discounts = $_POST['discount'];
    $original_prices = $_POST['original_price']; // รับข้อมูลราคาขายเดิม

    $thai_days = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
    $thai_months = array(
        1 => "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
        "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
    );
    $day_of_week = date('w'); // ค่าวันในสัปดาห์ (0 = อาทิตย์, 6 = เสาร์)
    $day = date('j'); // วันที่
    $month = date('n'); // เดือน (1-12)
    $year = date('Y') + 543; // ปีพุทธศักราช
    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if (!empty($product_codes)) {
        echo "<center><h2><span style='color: black;'>สหกรณ์การเกษตรปากพะยูน จำกัด</span></h2></center>";
        echo "<center><h2><span style='color: black;'>ตารางแสดงราคาขาย</span></h2></center>";
        date_default_timezone_set('Asia/Bangkok');
        echo "<center><h4><span style='color: black;'>วัน " . $thai_days[$day_of_week] . " ที่ " . $day . " เดือน " . $thai_months[$month] . " พ.ศ. " . $year . "</h4></center>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: center;'>";
        echo "<thead>";
        echo "<tr>
                <th rowspan='4'>ลำดับ</th>
                <th rowspan='4'>รหัสสินค้า</th>
                <th rowspan='4'>ชื่อสินค้า</th>
                <th rowspan='4'>จำนวนคงเหลือ</th>
                <th rowspan='4'>จำนวนซื้อเข้า</th>
                <th rowspan='4'>หน่วยนับ</th>
                <th colspan='3'>ราคาทุน</th>
                <th  rowspan='4'>ราคาเดิม (บาท)</th>
                <th colspan='4'>ราคาขาย</th>
              </tr>";
        echo "<tr>
                <th>ราคาซื้อ (บาท)</th>
                <th>ค่าขนส่ง (บาท)</th>
                <th>ส่วนลด (บาท)</th>
                
                <th>ต้นทุน (บาท)</th>
                
                <th>เงินสด (บาท)</th>
                <th>เงินเชื่อ 1 (บาท)</th>
                <th>เงินเชื่อ 2 (บาท)</th>
                <th>เงินเชื่อ 3 (บาท)</th>
                <th>เงินเชื่อ 4 (บาท)</th>
                <th>เงินเชื่อ 5 (บาท)</th>
                <th>เงินเชื่อ 6 (บาท)</th>
                
              </tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<style>
        @media print {
            button, a {
                display: none;
            }
        }
        </style>";
    

        // วนลูปเพื่อประมวลผลแต่ละรายการ
        foreach ($product_codes as $index => $product_code) {
            $product_detail = $product_details[$index];
            $stock_quantity = (int)$stock_quantities[$index];
            $purchase_quantity = (int)$purchase_quantities[$index];
            $unit = $units[$index];
            $purchase_price = (float)$purchase_prices[$index];
            $shipping_cost = (float)$shipping_costs[$index];
            $discount = (float)$discounts[$index];
            $original_price = (float)$original_prices[$index]; // รับราคาเดิม

            // คำนวณราคาต้นทุน
            $cost_price = $purchase_price + $shipping_cost + $discount;

            // คำนวณราคาเงินสด (เพิ่มขึ้น 3% จากราคาต้นทุน)
            $cash_price = $cost_price * 1.03;

            // คำนวณราคาเงินเชื่อ 1 และ 2
            $credit_price1 = round($cash_price * 1.01, 2);
            $credit_price2 = round($cash_price * 1.02, 2);
            $credit_price3 = round($credit_price1 * 1.02, 2);
            $credit_price4 = round($credit_price2 * 1.02, 2);
            $credit_price5 = round($credit_price3 * 1.02, 2);
            $credit_price6 = round($credit_price4 * 1.02, 2);

            // ตรวจสอบราคาขายกับราคาเดิม ถ้าไม่เท่ากันให้แสดงแถบสีเหลือง
            $row_style = (round($cash_price) != round($original_price)) ? "background-color: yellow;" : "";

            // แสดงผลลัพธ์ในรูปแบบตาราง
            echo "<tr style='$row_style'>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>$product_code</td>";
            echo "<td>$product_detail</td>";
            echo "<td>$stock_quantity</td>";
            echo "<td>$purchase_quantity</td>";
            echo "<td>$unit</td>";
            echo "<td>" . number_format($purchase_price, 2) . "</td>";
            echo "<td>" . number_format(round($shipping_cost)) . "</td>";
            echo "<td>" . number_format(round($discount)) . "</td>";
            echo "<td>" . number_format(round($original_price)) . "</td>";
            echo "<td>" . number_format(round($cost_price)) . "</td>";
            echo "<td>" . number_format(round($cash_price)) . "</td>";
            echo "<td>" . number_format(round($credit_price1)) . "</td>";
            echo "<td>" . number_format(round($credit_price2)) . "</td>";
            echo "<td>" . number_format(round($credit_price3)) . "</td>";
            echo "<td>" . number_format(round($credit_price4)) . "</td>";
            echo "<td>" . number_format(round($credit_price5)) . "</td>";
            echo "<td>" . number_format(round($credit_price6)) . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "ไม่มีข้อมูลสินค้า";
    }
    echo "<div style='text-align: right;'><h4>....................................ผู้จัดทำ</h4></div>";
    echo "<div style='text-align: right;'><h4>....................................ผู้อนุมัติ</h4></div>";
    echo "<br><center><button onclick='window.print()' style='font-size: 18px; text-decoration: none; padding: 10px 20px; background-color: green; color: white; border: none; border-radius: 5px;'>พิมพ์</button></center>";
    echo "<br><center><a href='javascript:history.back()' style='font-size: 18px; text-decoration: none; color: #fff; background-color:rgb(176, 97, 8); padding: 10px 20px; border-radius: 5px;'>ย้อนกลับ</a></center>";
}

$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];