CREATE DATABASE sulisweblap;

USE sulisweblap;

CREATE TABLE users (
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

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    users_username VARCHAR(255) NOT NULL,
    made_by VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    color VARCHAR(255) NOT NULL,
    engine_size FLOAT NOT NULL,
    fuel_type ENUM('gasoline', 'diesel', 'electric', 'hybrid') NOT NULL,
    description TEXT,
    FOREIGN KEY (users_username) REFERENCES users(username)
);
/*id: az autó egyedi azonosítója
users_username: a tulajdonos felhasználóneve, ami a users táblához kapcsolódik
made_by: az autó gyártója
model: az autó modellje
year: az autó gyártási éve
color: az autó színe
engine_size: a motor mérete literben
fuel_type: az üzemanyag típusa (benzin, dízel, elektromos vagy hibrid)
description: egy leírás az autóról*/