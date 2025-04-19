<?php
// Start session
session_start();

// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "login_system";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Check if the user is Shahriar with admin password
    if ($inputUsername === 'Shahriar' && $inputPassword === 'admin') {
        // Set session for admin
        $_SESSION['username'] = $inputUsername;
        header("Location: dashboard.php"); // Redirect to admin dashboard
        exit();
    }

    // Prepare SQL query to check other users
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Check if the query was prepared correctly
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error); // Display the error if query preparation fails
    }

    // Bind parameters
    $stmt->bind_param("ss", $inputUsername, $inputPassword);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any user is found
    if ($result->num_rows > 0) {
        // Successful login for regular user
        $_SESSION['username'] = $inputUsername;
        header("Location: user_dashboard.php"); // Redirect to user dashboard
        exit();
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid username or password. Please try again.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
