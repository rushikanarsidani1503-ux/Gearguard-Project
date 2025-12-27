CREATE DATABASE gearguard;
USE gearguard;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    role ENUM('user','technician','manager')
);

INSERT INTO users VALUES
(1,'Rushika','user@gmail.com','1234','user'),
(2,'Isha','tech@gmail.com','1234','technician'),
(3,'Darshita','manager@gmail.com','1234','manager');

CREATE TABLE equipment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    maintenance_team VARCHAR(100),
    default_technician INT,
    is_scrapped BOOLEAN DEFAULT 0
);

INSERT INTO equipment VALUES
(1,'Office Printer','IT Support',2,0);

CREATE TABLE maintenance_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255),
    request_type ENUM('Corrective','Preventive'),
    equipment_id INT,
    technician_id INT,
    scheduled_date DATE,
    duration INT,
    stage ENUM('New','In Progress','Repaired','Scrap') DEFAULT 'New',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
