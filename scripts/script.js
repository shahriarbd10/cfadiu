// Toggle the Login modal visibility
function toggleLogin() {
    const loginModal = document.getElementById('loginModal');
    loginModal.style.display = loginModal.style.display === 'flex' ? 'none' : 'flex';
}

// Toggle the Sign Up modal visibility
function toggleSignup() {
    const signupModal = document.getElementById('signupModal');
    signupModal.style.display = signupModal.style.display === 'flex' ? 'none' : 'flex';
}

// @ts-ignore
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
