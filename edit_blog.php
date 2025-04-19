<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$conn = new mysqli("localhost", "root", "", "login_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    exit("User not found.");
}
$user_id = $result->fetch_assoc()['id'];
$stmt->close();

// Get blog ID from URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch blog to edit
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $blog_id, $user_id);
$stmt->execute();
$blog = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$blog) {
    exit("Blog not found or access denied.");
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content && strlen($content) <= 2000) {
        $stmt = $conn->prepare("UPDATE blogs SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssii", $title, $content, $blog_id, $user_id);
        if ($stmt->execute()) {
            header("Location: user_dashboard.php");
            exit();
        } else {
            echo "Error updating blog.";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Title/content missing or too long.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body style="background-color:#f4f6f9; font-family: 'Segoe UI', sans-serif;">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Blog</h4>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" maxlength="100" value="<?= htmlspecialchars($blog['title']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="8" maxlength="2000" required><?= htmlspecialchars($blog['content']) ?></textarea>
      </div>
      <div class="d-flex justify-content-between">
        <a href="user_dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save2"></i> Save Changes</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
