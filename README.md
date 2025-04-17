# DIU CSE Football Association Portal 🏆

A mini CSE Lab Project developed by **Shahriar Hossain (213-15-4589)**  
Department of CSE, Daffodil International University

---

## 📌 Project Overview

This is a full-stack PHP-MySQL portal designed to serve the **DIU CSE Footballers**. It allows students to register, login, and manage their blogs through a dashboard. This project was submitted as part of the **CSE Lab Mini Project** under the supervision of [Course Teacher's Name].

---

## ✨ Key Features

- 🔐 User Login & Registration
- 🖼️ Dashboard with Blog Management (Create, Edit, Delete)
- 📊 Responsive Frontend UI (Bootstrap)
- 🗃️ MySQL Integration
- ⚙️ Secure Session Management

---

## ⚙️ Technologies Used

- PHP 8.x
- MySQL
- HTML5, CSS3, Bootstrap 5
- FontAwesome Icons
- XAMPP Server

---

## 🛠️ How to Run the Project (using XAMPP)

### ✅ Step-by-step Instructions:

#### Step 1: Install XAMPP
Download and install XAMPP from:  
👉 [https://www.apachefriends.org/](https://www.apachefriends.org/)

#### Step 2: Clone or Download the Repository
```bash
git clone https://github.com/shahriarbd10/cfadiu.git

Or manually download and extract the ZIP.


Step 3: Move the Folder to XAMPP Directory
Move the project folder to:

C:\xampp\htdocs\ (or your xampp location's htdocs folder)

Step 4: Import the SQL Database
Open XAMPP Control Panel and start Apache and MySQL.

Go to http://localhost/phpmyadmin/

Create a new database
login_system


Click Import, and upload the file:

login_system_v1.sql


Step 5: Configure Database Connection

Make sure db_connect.php or db.php includes:

$host = "localhost";
$username = "root";
$password = "";
$database = "football_portal";


Step 6: Run the Project in Browser (keep xampp on)

http://localhost/cfadiu/index.html


📁 Project Structure

cfadiu/
├── index.html
├── login.php
├── register.php
├── logout.php
├── user_dashboard.php
├── edit_blog.php
├── delete_blog.php
├── dashboard.php
├── db_connect.php
├── db.php
├── login_system_v1.sql
├── writings/
│   └── README.md
├── styles/
│   └── bbstyle.css
└── images/






Shahriar Hossain
Dept. of CSE, Daffodil International University










live demo link:

https://login-system-lz4dftimj-shahriars-projects-d70f6893.vercel.app/
