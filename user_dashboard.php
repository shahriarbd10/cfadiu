<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- Link to your custom styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            margin: 0 auto;
            padding-top: 50px;
        }

        h1 {
            font-size: 2rem;
            color: #2c3e50;
        }

        h2 {
            font-size: 1.5rem;
            color: #7f8c8d;
        }

        .dashboard-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .actions {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .action-btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: #2980b9;
        }

        .logout-btn {
            background-color: #e74c3c;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="dashboard-content">
            <h1>User Dashboard</h1>
            <h2>Welcome, <?php echo $username; ?>!</h2>

            <div class="actions">
                <a href="profile.php" class="action-btn">View Profile</a>
                <a href="edit_profile.php" class="action-btn">Edit Profile</a>
                <a href="logout.php" class="action-btn logout-btn">Logout</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>

</body>
</html>
