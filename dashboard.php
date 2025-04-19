<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Shahriar') {
    header("Location: index.php");
    exit();
}

$admin_username = $_SESSION['username'];
$conn = new mysqli("localhost", "root", "", "login_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$users = $conn->query("SELECT * FROM users WHERE username != 'Shahriar'");
$blogs = $conn->query("SELECT blogs.*, users.full_name FROM blogs JOIN users ON blogs.user_id = users.id ORDER BY blogs.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f0f4f8;
      font-family: 'Segoe UI', sans-serif;
    }
    .dashboard-header {
      background-color: #0d1b2a;
      padding: 1rem 2rem;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .dashboard-content {
      padding: 2rem;
    }
    .footer {
      background-color: #0d1b2a;
      color: white;
      padding: 1rem;
      text-align: center;
      margin-top: 2rem;
    }
    .accordion-button:not(.collapsed) {
      background-color: #0d6efd;
      color: white;
    }
    .scrollable-accordion {
      max-height: 400px;
      overflow-y: auto;
      border: 1px solid #dee2e6;
      border-radius: 6px;
      padding: 1rem;
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="dashboard-header">
  <h2><i class="bi bi-trophy-fill text-warning"></i> Admin Dashboard</h2>
  <div>
    <span class="me-3"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($admin_username); ?></span>
    <a href="logout.php" class="btn btn-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</header>

<!-- Dashboard Content -->
<main class="dashboard-content container bg-white rounded shadow-sm">

  <!-- Player List -->
  <h3 class="mb-4"><i class="bi bi-people-fill text-primary"></i> Registered Players</h3>
  <table class="table table-hover table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th><i class="bi bi-hash"></i></th>
        <th><i class="bi bi-person"></i> Username</th>
        <th><i class="bi bi-person-lines-fill"></i> Full Name</th>
        <th><i class="bi bi-award-fill"></i> Batch</th>
        <th><i class="bi bi-dribbble"></i> Position</th>
        <th><i class="bi bi-123"></i> Jersey</th>
        <th><i class="bi bi-envelope-at-fill"></i> Email</th>
        <th><i class="bi bi-gear-fill"></i> Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $users->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id']; ?></td>
          <td><?= htmlspecialchars($row['username']); ?></td>
          <td><?= htmlspecialchars($row['full_name']); ?></td>
          <td><?= htmlspecialchars($row['batch']); ?></td>
          <td><?= htmlspecialchars($row['position']); ?></td>
          <td><?= htmlspecialchars($row['jersey_number']); ?></td>
          <td><?= htmlspecialchars($row['email']); ?></td>
          <td class="d-flex justify-content-center gap-2">
            <a href="view_user.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">
              <i class="bi bi-eye-fill"></i> View
            </a>
            <a href="edit_user.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil-square"></i> Edit
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Blog Management -->
  <section class="mt-5">
    <h3 class="mb-4"><i class="bi bi-journal-text text-success"></i> Player Blogs</h3>
    <div class="scrollable-accordion">
      <div class="accordion" id="adminBlogAccordion">
        <?php $count = 0; while ($blog = $blogs->fetch_assoc()): $count++; ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading<?= $blog['id'] ?>">
              <button class="accordion-button <?= $count > 1 ? 'collapsed' : '' ?>" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse<?= $blog['id'] ?>">
                <?= htmlspecialchars($blog['title']) ?>
                <small class="ms-3 text-muted">(by <?= htmlspecialchars($blog['full_name']) ?>)</small>
              </button>
            </h2>
            <div id="collapse<?= $blog['id'] ?>" class="accordion-collapse collapse <?= $count === 1 ? 'show' : '' ?>"
                 data-bs-parent="#adminBlogAccordion">
              <div class="accordion-body">
                <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
                <div class="d-flex justify-content-end">
                  <a href="delete_blog.php?id=<?= $blog['id'] ?>" onclick="return confirm('Delete this blog?');"
                     class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Delete
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
        <?php if ($count === 0): ?>
          <p class="text-muted">No blogs submitted yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>

<!-- Footer -->
<footer class="footer">
  &copy; <?= date('Y') ?> DIU CSE Football Association. Admin Panel.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
