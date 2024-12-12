<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIU CSE Football Association</title>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/14bbef59d9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles/bbstyle.css">
</head>
<body>
    <header class="header">
        <nav>
            <h2 class="nav-title">DIU CSE Football Association</h2>
            <ul class="nav-option">
                <li>Home</li>
                <li>About</li>
                <li>Contact Us</li>
                <li class="login-press" onclick="toggleLogin()">Login</li>
            </ul>
        </nav>
        <div class="banner">
            <h1>Welcome to the Family of CSE Footballers</h1>
        </div>
    </header>

    <!-- Login Modal -->
    <div id="loginModal" class="login-modal" style="display: none;">
        <div class="login-container">
            <span class="close-btn" onclick="toggleLogin()">×</span>
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>All rights reserved &copy; 2023 DIU CSE Football Association</p>
    </footer>

    <!-- JavaScript -->
    <script src="scripts/script.js"></script>
</body>
</html>
