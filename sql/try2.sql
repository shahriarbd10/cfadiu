CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  full_name VARCHAR(100) NOT NULL,
  batch VARCHAR(50) NOT NULL,
  position VARCHAR(50) NOT NULL,
  jersey_number INT NOT NULL,
  email VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, full_name, batch, position, jersey_number, email)
VALUES (
  'Shahriar',
  'admin',
  'Shahriar Hossain',
  '48th',
  'Midfielder',
  10,
  'shahriarbd10@gmail.com'
);
