
<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $roll_no = trim($_POST["roll_no"]);
    $department = trim($_POST["department"]);
    $year = (int) $_POST["year"];
    $email = trim($_POST["email"]);

    $sql = "INSERT INTO students
            (name, roll_no, department, year, email)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssis",
        $name,
        $roll_no,
        $department,
        $year,
        $email
    );

    if ($stmt->execute()) {
        $message = "Student added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e0c3fc, #8ec5fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            background: white;
            padding: 35px;
            border-radius: 20px;
            width: 350px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        h1 {
            text-align: center;
            color: #4b0082;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4b0082;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #7b2cbf;
        }

        .message {
            text-align: center;
            color: green;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="form-box">

    <h1>👩‍🎓 Add Student</h1>

    <p class="message"><?php echo htmlspecialchars($message); ?></p>

    <form method="POST">

        <label>Student Name</label>
        <input type="text" name="name" required>

        <label>Roll Number</label>
        <input type="text" name="roll_no" required>

        <label>Department</label>
        <input type="text" name="department" required>

        <label>Year</label>
        <input type="number" name="year" min="1" max="5" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <button type="submit">Add Student</button>

    </form>

    <a href="index.php">← Back to Dashboard</a>

</div>

</body>
</html>