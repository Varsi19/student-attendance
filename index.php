
<?php
include "db.php";

// Total students
$total_query = $conn->query("SELECT COUNT(*) AS total FROM students");
$total_students = $total_query->fetch_assoc()["total"];

// Today's present count
$present_query = $conn->query(
    "SELECT COUNT(*) AS total FROM attendance
     WHERE date = CURDATE() AND status = 'Present'"
);
$present = $present_query->fetch_assoc()["total"];

// Today's absent count
$absent_query = $conn->query(
    "SELECT COUNT(*) AS total FROM attendance
     WHERE date = CURDATE() AND status = 'Absent'"
);
$absent = $absent_query->fetch_assoc()["total"];

// Attendance percentage
$marked = $present + $absent;
$percentage = $marked > 0
    ? round(($present / $marked) * 100)
    : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0c3fc, #8ec5fc);
            min-height: 100vh;
        }

        header {
            background: #4b0082;
            color: white;
            text-align: center;
            padding: 25px;
        }

        header h1 {
            font-size: 28px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .welcome {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .stat-card h3 {
            color: #555;
            margin-bottom: 15px;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #4b0082;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .menu a {
            background: white;
            color: #4b0082;
            text-decoration: none;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0,0,0,0.12);
            transition: 0.3s;
        }

        .menu a:hover {
            transform: translateY(-5px);
            background: #4b0082;
            color: white;
        }

        footer {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>

<header>
    <h1>🎓 Student Attendance Management</h1>
    <p>Smart • Simple • Efficient</p>
</header>

<div class="container">

    <div class="welcome">
        <h2>Welcome to Dashboard 👋</h2>
        <p>Monitor your student attendance easily.</p>
    </div>

    <div class="stats">

        <div class="stat-card">
            <h3>👩‍🎓 Total Students</h3>
            <div class="number"><?php echo $total_students; ?></div>
        </div>

        <div class="stat-card">
            <h3>✅ Present Today</h3>
            <div class="number"><?php echo $present; ?></div>
        </div>

        <div class="stat-card">
            <h3>❌ Absent Today</h3>
            <div class="number"><?php echo $absent; ?></div>
        </div>

        <div class="stat-card">
            <h3>📊 Attendance Rate</h3>
            <div class="number"><?php echo $percentage; ?>%</div>
        </div>

    </div>

    <div class="menu">

        <a href="add.php">👩‍🎓 Add Student</a>

        <a href="mark.php">📝 Mark Attendance</a>

        <a href="view.php">📋 View Attendance</a>

    </div>

</div>

<footer>
    © 2026 Student Attendance Management System
</footer>

</body>
</html>