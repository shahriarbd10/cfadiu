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
    $inputUsername    = $_POST['username'];
    $inputPassword    = $_POST['password'];
    $fullName         = $_POST['full_name'];
    $batch            = $_POST['batch'];
    $position         = $_POST['position'];
    $jerseyNumber     = $_POST['jersey_number'];
    $email            = $_POST['email'];

    // Insert into DB (all fields)
    $sql = "INSERT INTO users (username, password, full_name, batch, position, jersey_number, email)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssis", $inputUsername, $inputPassword, $fullName, $batch, $position, $jerseyNumber, $email);

    if ($stmt->execute()) {
        $_SESSION['username'] = $inputUsername;
        echo "<script>alert('Registration successful! Welcome, $inputUsername');</script>";
        echo "<script>window.location.href = 'user_dashboard.php';</script>";
    } else {
        echo "<script>alert('Registration failed: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
