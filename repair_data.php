<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแจ้งซ่อม</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .chart-container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

    <div class="chart-container" id="statistics">
        <h3>สถิติการแจ้งซ่อม</h3>
        <canvas id="repairChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('repairChart').getContext('2d');
        const repairChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['คอมพิวเตอร์', 'อินเทอร์เน็ต', 'กล้องวงจรปิด', 'เครื่องใช้สำนักงาน', 'อื่นๆ'],
                datasets: [{
                    label: 'จำนวนการแจ้งซ่อม',
                    data: [10, 5, 8, 6, 4], // ตัวอย่างข้อมูล
                    backgroundColor: 'rgba(102, 126, 234, 0.6)',
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
