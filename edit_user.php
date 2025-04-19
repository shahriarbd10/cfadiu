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

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Invalid request";
    exit();
}

// Update form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName     = $_POST['full_name'];
    $batch        = $_POST['batch'];
    $position     = $_POST['position'];
    $jerseyNumber = $_POST['jersey_number'];
    $email        = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET full_name=?, batch=?, position=?, jersey_number=?, email=? WHERE id=?");
    $stmt->bind_param("sssssi", $fullName, $batch, $position, $jerseyNumber, $email, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    exit();
}

// Fetch existing user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if (!$user) {
    echo "User not found";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5 p-4 bg-white rounded shadow-sm">
    <h3>Edit Player Info (<?= htmlspecialchars($user['username']) ?>)</h3>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Batch</label>
        <input type="text" name="batch" class="form-control" value="<?= htmlspecialchars($user['batch']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Position</label>
        <input type="text" name="position" class="form-control" value="<?= htmlspecialchars($user['position']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Jersey Number</label>
        <input type="number" name="jersey_number" class="form-control" value="<?= htmlspecialchars($user['jersey_number']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Save Changes</button>
      <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>

<?php $conn->close(); ?>
