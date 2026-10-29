
<?php
include "db.php";

$sql = "SELECT students.name, students.roll_no,
               students.department, attendance.date,
               attendance.status
        FROM attendance
        JOIN students
        ON attendance.student_id = students.id
        ORDER BY attendance.date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
</head>
<body>

    <h1>Attendance Records</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Roll Number</th>
            <th>Department</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['roll_no']); ?></td>
            <td><?php echo htmlspecialchars($row['department']); ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>

        <?php } ?>

    </table>

</body>
</html>