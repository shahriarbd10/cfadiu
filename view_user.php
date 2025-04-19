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

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    exit("Player not found.");
}

$blogs = $conn->prepare("SELECT * FROM blogs WHERE user_id = ? ORDER BY created_at DESC");
$blogs->bind_param("i", $user_id);
$blogs->execute();
$blog_result = $blogs->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Player</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body style="background-color:#f4f6f9; font-family: 'Segoe UI', sans-serif;">

<div class="container mt-5">
  <a href="dashboard.php" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>

  <div class="card mb-4 p-4 shadow">
    <h4><i class="bi bi-person-circle"></i> Player Information</h4>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></li>
      <li class="list-group-item"><strong>Full Name:</strong> <?= htmlspecialchars($user['full_name']) ?></li>
      <li class="list-group-item"><strong>Batch:</strong> <?= htmlspecialchars($user['batch']) ?></li>
      <li class="list-group-item"><strong>Position:</strong> <?= htmlspecialchars($user['position']) ?></li>
      <li class="list-group-item"><strong>Jersey No:</strong> <?= htmlspecialchars($user['jersey_number']) ?></li>
      <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
    </ul>
  </div>

  <div class="card p-4 shadow">
    <h4><i class="bi bi-journals"></i> Player Blogs</h4>
    <div class="accordion mt-3" id="playerBlogAccordion">
      <?php $count = 0; while ($blog = $blog_result->fetch_assoc()): $count++; ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading<?= $blog['id'] ?>">
            <button class="accordion-button <?= $count > 1 ? 'collapsed' : '' ?>" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse<?= $blog['id'] ?>">
              <?= htmlspecialchars($blog['title']) ?>
            </button>
          </h2>
          <div id="collapse<?= $blog['id'] ?>" class="accordion-collapse collapse <?= $count === 1 ? 'show' : '' ?>"
               data-bs-parent="#playerBlogAccordion">
            <div class="accordion-body">
              <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
              <div class="d-flex justify-content-end">
                <a href="delete_blog.php?id=<?= $blog['id'] ?>&from=user&id_user=<?= $user_id ?>"
                   onclick="return confirm('Delete this blog?');"
                   class="btn btn-sm btn-danger">
                  <i class="bi bi-trash"></i> Delete
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
      <?php if ($count === 0): ?>
        <p class="text-muted">This user hasn't written any blogs yet.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
