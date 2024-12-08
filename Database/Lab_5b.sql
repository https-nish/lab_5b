
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matric VARCHAR(20) NOT NULL,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    accessLevel ENUM('user', 'admin') NOT NULL
);
