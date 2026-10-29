
<?php
$servername = "localhost";
$username = "root";
$password = "2006";
$dbname = "attendance_db";
$port = 3307;

// Connect to MySQL
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname,
    $port
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Database Connected Successfully!";
?>