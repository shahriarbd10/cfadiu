# DIU CSE Football Association Portal 🏆

A mini CSE Lab Project developed by **Shahriar Hossain (213-15-4589)**  
Department of CSE, Daffodil International University

---

## 📌 Project Overview

This is a full-stack PHP-MySQL portal designed to serve the **DIU CSE Footballers**.  
It allows students to register, log in, and manage their blogs through a personalized dashboard.

This project was submitted as part of the **CSE Lab Mini Project** under the supervision of **[Course Teacher's Name]**.

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
- XAMPP Server (Apache + MySQL)  

---

## 🛠️ How to Run the Project (using XAMPP)

### ✅ Step-by-step Instructions:

#### 🔹 Step 1: Install XAMPP  
Download and install XAMPP from:  
👉 https://www.apachefriends.org/

#### 🔹 Step 2: Clone or Download the Repository
```bash
git clone https://github.com/shahriarbd10/cfadiu.git
# Or manually download the ZIP and extract it
```

#### 🔹 Step 3: Move the Folder to XAMPP Directory
Move the project folder to:
```
C:\xampp\htdocs\
```

#### 🔹 Step 4: Import the SQL Database
1. Open **XAMPP Control Panel** and start **Apache** and **MySQL**  
2. Visit: http://localhost/phpmyadmin/  
3. Create a new database:
```
football_portal
```
4. Click **Import** and upload:
```
login_system_v1.sql
```

#### 🔹 Step 5: Configure Database Connection
Open `db_connect.php` or `db.php` and set:
```php
$host = "localhost";
$username = "root";
$password = "";
$database = "football_portal";
```

#### 🔹 Step 6: Run the Project in Browser  
Make sure XAMPP is running, then open:
```
http://localhost/cfadiu/index.html
```

---

## 📁 Project Structure

```
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
```

---

## 🌐 Live Demo

Try the hosted frontend demo here:  
👉 https://login-system-lz4dftimj-shahriars-projects-d70f6893.vercel.app/  {this contains only landing page v1 to check latest kindly run it in local system}

> _Note: The live demo does not include backend functionality. For full experience, run it locally using XAMPP._

---

## 🙋 Author

**Shahriar Hossain**  
Department of CSE, Daffodil International University

---

## 📄 License

This project is built for academic purposes and educational use only.
