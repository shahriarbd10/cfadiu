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

// Get user info
$userStmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$userStmt->bind_param("s", $username);
$userStmt->execute();
$user = $userStmt->get_result()->fetch_assoc();
$user_id = $user['id'];
$userStmt->close();

// Add new blog
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_blog'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if ($title && $content && strlen($content) <= 2000) {
        $stmt = $conn->prepare("INSERT INTO blogs (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $content);
        $stmt->execute();
        $stmt->close();
    }
}

// Delete blog
if (isset($_GET['delete'])) {
    $blogId = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $blogId, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch blogs
$blogs = $conn->query("SELECT * FROM blogs WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
    .dashboard-header { background: #004080; color: white; padding: 1rem 2rem; }
    .accordion-button:not(.collapsed) { background-color: #0d6efd; color: white; }
    .footer { background: #004080; color: white; padding: 1rem; margin-top: 3rem; text-align: center; }
  </style>
</head>
<body>

<header class="dashboard-header d-flex justify-content-between align-items-center">
  <h3><i class="bi bi-person-bounding-box me-2"></i> Welcome, <?= htmlspecialchars($user['full_name']) ?></h3>
  <a href="logout.php" class="btn btn-light btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
</header>

<div class="container my-5">

  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-journal-plus"></i> Add New Blog</h5>
    <form method="POST">
      <input type="hidden" name="new_blog" value="1" />
      <div class="mb-3">
        <input type="text" name="title" class="form-control" maxlength="100" placeholder="Blog Title" required>
      </div>
      <div class="mb-3">
        <textarea name="content" rows="5" class="form-control" maxlength="2000" placeholder="Write your blog here (max 300 words)" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Post Blog</button>
    </form>
  </div>

  <div class="card p-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-journal-text"></i> Your Blogs</h5>

    <div class="accordion" id="blogAccordion">
      <?php $count = 0; while ($row = $blogs->fetch_assoc()): $count++; ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading<?= $row['id'] ?>">
            <button class="accordion-button <?= $count > 1 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $row['id'] ?>">
              <?= htmlspecialchars($row['title']) ?>
            </button>
          </h2>
          <div id="collapse<?= $row['id'] ?>" class="accordion-collapse collapse <?= $count === 1 ? 'show' : '' ?>" data-bs-parent="#blogAccordion">
            <div class="accordion-body">
              <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
              <div class="d-flex justify-content-end">
                <a href="edit_blog.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-2"><i class="bi bi-pencil-square"></i> Edit</a>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this blog?');" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
      <?php if ($count === 0): ?>
        <p class="text-muted">You haven't posted any blogs yet.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<footer class="footer">&copy; <?= date("Y") ?> DIU CSE Football Association | Player Dashboard</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
