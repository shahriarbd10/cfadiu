<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param("ss", $inputUsername, $inputPassword);

    if ($stmt->execute()) {
        $_SESSION['username'] = $inputUsername;
        echo "<script>alert('Registration successful! Welcome, $inputUsername');</script>";
        echo "<script>window.location.href = 'user_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error occurred while registering. Please try again.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
