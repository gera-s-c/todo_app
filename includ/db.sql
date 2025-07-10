CREATE DATABASE todo_app CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE todo_app;

CREATE TABLE crud (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    descripcion TEXT,
    due_date DATE NOT NULL,
    is_completado TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);
