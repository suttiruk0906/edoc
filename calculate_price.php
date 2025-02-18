<?php
session_start();
if (!isset($_SESSION["username"]) || ($_SESSION["role"] != "admin" && $_SESSION["role"] != "market")) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cost = $_POST["cost"];
    $profit = $_POST["profit"];
    $price = $cost + ($cost * ($profit / 100));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ระบบคำนวณราคาขาย</title>
</head>
<body>
    <h2>ระบบคำนวณราคาขาย</h2>
    <form method="POST">
        <input type="number" name="cost" placeholder="ต้นทุนสินค้า" required><br>
        <input type="number" name="profit" placeholder="กำไร (%)" required><br>
        <button type="submit">คำนวณ</button>
    </form>
    <?php if (isset($price)) { ?>
        <p>ราคาขายที่แนะนำ: <?php echo number_format($price, 2); ?> บาท</p>
    <?php } ?>
    <a href="market.php">กลับไประบบตลาด</a>
</body>
</html>
