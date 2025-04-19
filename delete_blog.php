<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Shahriar') {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "login_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$redirect_back = isset($_GET['from']) && $_GET['from'] === 'user' ? "view_user.php?id=" . intval($_GET['id_user']) : "dashboard.php";

$stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: $redirect_back");
exit();
