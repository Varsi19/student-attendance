
<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && $password === $admin["password"]) {
        $_SESSION["admin"] = $admin["username"];
        header("Location: index.php");
        exit();
    } else {
        $message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e0c3fc, #8ec5fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            padding: 35px;
            border-radius: 20px;
            width: 320px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h1 {
            text-align: center;
            color: #4b0082;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
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

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h1>🔐 Admin Login</h1>

    <p class="error"><?php echo htmlspecialchars($message); ?></p>

    <form method="POST">

        <input type="text" name="username"
               placeholder="Username" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <button type="submit">Login</button>

    </form>

</div>

</body>
</html>