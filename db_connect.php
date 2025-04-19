<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = "";     // Default XAMPP password is empty
$dbname = "login_system";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql); // No echo/output here

// ✅ Now select the database
$conn->select_db($dbname);

// ⚠️ Don't close the connection here!
// Leave it open so files like view_user.php or dashboard.php can use it
?>
