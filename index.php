<?php
session_start();
$conn = new mysqli("localhost", "root", "", "login_system");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$blogs = $conn->query("SELECT blogs.*, users.full_name FROM blogs JOIN users ON blogs.user_id = users.id ORDER BY blogs.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Software Project VI</title>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/14bbef59d9.js" crossorigin="anonymous"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles/bbstyle.css" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="styles/blog.css">
</head>

<body>
  <!-- Header -->
  <header class="header">
    <nav>
      <h2 class="nav-title">DIU CSE Football Association</h2>
      <ul class="nav-option">
        <a href="4589SRS.pdf" download="4589SRS.pdf">
          <button class="download-btn">Download SRS</button>
        </a>
        <li class="bigsize">Home</li>
        <li>About</li>
        <li>Contact Us</li>
        <li class="login-press" onclick="toggleLogin()">Login</li>
        <li class="signup-press" onclick="toggleSignup()">Sign Up</li>
      </ul>
    </nav>

    <div class="banner">
      <div class="banner-container">
        <h1 class="banner-title">Welcome to<br />the Family of CSE Footballers</h1>
        <p class="banner-description">
          There are many variations of passages of Lorem Ipsum available, but the
          majority have suffered alteration in <br />some form, by injected humour,
          or randomised words which don't look even
        </p>
        <button class="btn-primary">
          <i class="bi bi-1-circle-fill"></i> Explore More
        </button>
      </div>
      <img class="banner-image" src="images/banner.png" alt="Banner Image" />
    </div>
  </header>

  <!-- Login Modal -->
  <div id="loginModal" class="login-modal">
    <div class="login-container">
      <span class="close-btn" onclick="toggleLogin()">×</span>
      <h2>Login</h2>
      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <button type="submit" class="login-btn">Login</button>
        <a href="#" class="forgot-password">Forgot Password?</a>
        <p>
          Don't have an account?
          <a href="javascript:void(0);" onclick="toggleSignup(); toggleLogin();">Sign Up</a>
        </p>
      </form>
    </div>
  </div>

  <!-- Sign Up Modal -->
  <div id="signupModal" class="login-modal">
    <div class="login-container">
      <span class="close-btn" onclick="toggleSignup()">×</span>
      <h2>Sign Up</h2>
      <form action="register.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>

        <!-- Additional Player Bio Fields -->
        <div class="form-group">
          <label for="full_name">Full Name</label>
          <input type="text" id="full_name" name="full_name" required />
        </div>
        <div class="form-group">
          <label for="batch">Batch</label>
          <input type="text" id="batch" name="batch" placeholder="e.g. 49th" required />
        </div>
        <div class="form-group">
          <label for="position">Position</label>
          <input type="text" id="position" name="position" placeholder="e.g. Forward" required />
        </div>
        <div class="form-group">
          <label for="jersey_number">Jersey Number</label>
          <input type="number" id="jersey_number" name="jersey_number" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </div>

        <button type="submit" class="signup-btn">Sign Up</button>
      </form>
    </div>
  </div>

  <!-- Main Section -->
  <main>
    <!-- Blog Section -->
    <section class="blog-section" style="width:1200px; height:700px; margin:3rem auto; padding:2rem; background-color:#f8f9fa; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); overflow:hidden; display:flex; flex-direction:column;">
      <h3 class="mb-4 text-center"><i class="bi bi-journal-text text-primary"></i> Recent Blogs</h3>

      <div id="blog-container" class="mt-4" style="flex-grow:1; overflow-y:auto; padding-right:10px;">
        <!-- Blogs will appear dynamically -->
      </div>

      <div class="text-center mt-3">
        <button class="btn btn-primary btn-lg me-2" onclick="prevBlog()"><i class="bi bi-chevron-left"></i> Previous</button>
        <button class="btn btn-primary btn-lg" onclick="nextBlog()">Next <i class="bi bi-chevron-right"></i></button>
      </div>
    </section>


    <!--Blog Script-->
    <script>
      const blogs = <?= json_encode($blogs->fetch_all(MYSQLI_ASSOC)); ?>;
      let currentIndex = 0;
      const blogsPerPage = 2;
      const container = document.getElementById('blog-container');

      function displayBlogs() {
        container.innerHTML = '';

        if (blogs.length === 0) {
          container.innerHTML = '<p class="text-center text-muted">No blogs available at the moment.</p>';
          return;
        }

        for (let i = currentIndex; i < currentIndex + blogsPerPage && i < blogs.length; i++) {
          const blog = blogs[i];
          const blogCard = document.createElement('div');
          blogCard.className = 'blog-card';
          blogCard.style.cssText = 'background-color:#fff; padding:1.5rem; margin-bottom:1.5rem; border-radius:10px; box-shadow:0 3px 6px rgba(0,0,0,0.1);';

          blogCard.innerHTML = `
        <h4 style="color:#0d6efd;">${blog.title}</h4>
        <small style="color:gray;">By ${blog.full_name} on ${new Date(blog.created_at).toLocaleDateString()}</small>
        <p class="mt-2">${blog.content.replace(/\n/g, '<br>')}</p>
      `;
          container.appendChild(blogCard);
        }
      }

      function nextBlog() {
        currentIndex += blogsPerPage;
        if (currentIndex >= blogs.length) currentIndex = 0;
        displayBlogs();
      }

      function prevBlog() {
        currentIndex -= blogsPerPage;
        if (currentIndex < 0) currentIndex = Math.max(blogs.length - blogsPerPage, 0);
        displayBlogs();
      }

      document.addEventListener('DOMContentLoaded', displayBlogs);
    </script>

    <!-- Feature Section -->
    <section class="features">
      <div class="feature">
        <div class="feature-image"><img src="images/team1.png" alt="" /></div>
        <div class="feature-image"><img src="images/team2.png" alt="" /></div>
        <div class="feature-image"><img src="images/team3.png" alt="" /></div>
        <div class="feature-image"><img src="images/team4.png" alt="" /></div>
      </div>
      <div class="feature-detail">
        <h2 class="feature-list-title">
          <span class="quick-list">Our key players</span> of CFA<br /><span class="primary-color">Shinning</span>
        </h2>
        <p class="feature-description">
          <span class="secondary-color">Shahriar, Akram, Siam, Soumik all these
            players are doing remarkable with their performances and all achievement</span>
        </p>
        <button class="btn-primary"><i class="bi bi-2-square-fill"></i> Know More</button>
      </div>
    </section>

    <!-- Special Feature Section -->
    <section class="special-features">
      <div class="special-features-left">
        <div class="special-feature-head">
          <h2 class="special-feature-title"><span class="special-text">Our fresh mind</span><br /><span
              class="special-text">Talent and Class</span></h2>
          <p class="special-feature-description">Players from all batches are joining CFA to have a tremendous journey
            in their university football career. Here is an example</p>
        </div>
        <!-- Feature Boxes -->
        <div class="special-feature-box">
          <h2 class="special-feature-box-heading">Dedication</h2>
          <p class="special-feature-box-description">Lorem Ipsum content here...</p>
        </div>
        <div class="special-feature-box">
          <h2 class="special-feature-box-heading">Passion</h2>
          <p class="special-feature-box-description">Lorem Ipsum content here...</p>
        </div>
        <div class="special-feature-box">
          <h2 class="special-feature-box-heading">Attention</h2>
          <p class="special-feature-box-description">Lorem Ipsum content here...</p>
        </div>
        <div class="special-feature-box">
          <h2 class="special-feature-box-heading">Discipline</h2>
          <p class="special-feature-box-description">Lorem Ipsum content here...</p>
        </div>
      </div>
      <div class="special-features-img">
        <img class="special-features-image" src="images/architect.png" alt="Architect Image" />
      </div>
    </section>

    <!-- Button -->
    <div id="positioning-button">
      <button class="btn-special">
        <span class="button-special-text">2nd Year Student</span><br /><span class="normal">Fresher in CFA</span>
      </button>
    </div>

    <!-- Facts Section -->
    <section class="fact-list">
      <div class="fact-info">
        <h2 class="fact-title">Some Facts</h2>
        <p class="fact-description">There are many variations of passages of Lorem Ipsum available, but the
          majority have suffered alteration.</p>
      </div>
      <div class="fact-container">
        <div class="fact">
          <img class="fact-image" src="images/icons/ribon.png" alt="" />
          <p class="fact-title">54</p>
          <p class="fact-detail">Awards Winnings</p>
        </div>
        <div class="fact">
          <img class="fact-image" src="images/icons/projects.png" alt="" />
          <p class="fact-title">1458</p>
          <p class="fact-detail">Total Registration</p>
        </div>
        <div class="fact">
          <img class="fact-image" src="images/icons/customers.png" alt="" />
          <p class="fact-title">590</p>
          <p class="fact-detail">Players Registered</p>
        </div>
        <div class="fact">
          <img class="fact-image" src="images/icons/email.png" alt="" />
          <p class="fact-title">278</p>
          <p class="fact-detail">Active Players</p>
        </div>
      </div>
    </section>




    <!-- About Myself -->
    <section class="about-myself">
      <div>
        <h3 class="myself-title">Hey, This is Shahriar</h3>
        <p class="myself-description">
          Currently I am studying CSE at Daffodil International University.<br /><br />
          Currently CEO at DIU CFA<br />
          living with dreams
        </p>
        <h4 class="web-ambition">Ambition on CFA</h4>
        <h5 class="ambition-point"><i class="fa-solid fa-chevron-right"></i> Networking</h5>
        <h5 class="ambition-point"><i class="fa-solid fa-chevron-right"></i> Gaining skills</h5>
        <h5 class="ambition-point"><i class="fa-solid fa-chevron-right"></i> Building Community</h5>
        <h5 class="link-me">Connect With Me</h5>
        <a class="link-icon" href="https://www.facebook.com/shahriarbd10/"><img src="images/icons/fb.png" alt="" /></a>
        <a class="link-icon" href="#"><img src="images/icons/twitter.png" alt="" /></a>
      </div>
      <img class="my-image" src="images/shahriarpng.png" alt="my photo" />
    </section>

    <!-- Sponsors -->
    <section class="sponsors">
      <div class="sponsor-info">
        <h2 class="sponsor-title">Our Sponsors</h2>
        <p class="sponsor-description">
          There are many variations of passages of Lorem Ipsum available,
          but<br />the majority have suffered alteration.
        </p>
      </div>
      <div class="sponsor-img">
        <div class="sponsor"><img src="images/sponsors/spotify.png" alt="" /></div>
        <div class="sponsor"><img src="images/sponsors/amazon.png" alt="" /></div>
        <div class="sponsor"><img src="images/sponsors/google.png" alt="" /></div>
        <div class="sponsor"><img src="images/sponsors/telerama.png" alt="" /></div>
        <div class="sponsor"><img src="images/sponsors/figma.png" alt="" /></div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <p class="footer-text">All rights reserved copyright © <?= date("Y") ?> DIU CFA</p>
  </footer>

  <!-- JS -->
  <script src="scripts/script.js"></script>

</body>

</html>
