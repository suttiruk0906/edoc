CREATE DATABASE edoc;
USE edoc;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'finance', 'loan', 'market', 'admin_office','user') NOT NULL
);

INSERT INTO users (username, password, role) VALUES
('admin', MD5('admin123'), 'admin'),
('finance_user', MD5('finance123'), 'finance'),
('loan_user', MD5('loan123'), 'loan'),
('market_user', MD5('market123'), 'market'),
('office_user', MD5('office123'), 'admin_office');
('test', MD5('test123'), 'user');

CREATE DATABASE fertilizer_db;
USE fertilizer_db;

CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_number VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    announcement_date DATE NOT NULL,
    document_type VARCHAR(50) NOT NULL,
    file_path VARCHAR(255) NOT NULL
);

CREATE TABLE usersregister (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
);
