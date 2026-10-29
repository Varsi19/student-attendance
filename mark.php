
<?php
include "db.php";

$message = "";

// Fetch students
$students = $conn->query("SELECT id, name, roll_no FROM students");

// Save attendance
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST["student_id"];
    $date = $_POST["date"];
    $status = $_POST["status"];

    $sql = "INSERT INTO attendance
            (student_id, date, status)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $student_id, $date, $status);

    if ($stmt->execute()) {
        $message = "Attendance marked successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
</head>
<body>

    <h1>Student Attendance</h1>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <label>Select Student:</label>

        <select name="student_id" required>
            <option value="">Select Student</option>

            <?php while ($row = $students->fetch_assoc()) { ?>

                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['name'] . " - " . $row['roll_no']; ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <label>Date:</label>
        <input type="date" name="date" required>

        <br><br>

        <label>Status:</label>

        <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>

        <br><br>

        <button type="submit">Mark Attendance</button>

    </form>

</body>
</html>