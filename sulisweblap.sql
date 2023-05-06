CREATE DATABASE sulisweblap;

USE sulisweblap;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user' NOT NULL
);

INSERT INTO users (firstname, lastname, username, email, password, role)
VALUES ('user', '1', 'user1', 'user1@example.com', 'password1', 'user'),
       ('admin', '1', 'admin1', 'admin1@example.com', 'adminpassword1', 'admin');