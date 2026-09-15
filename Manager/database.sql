CREATE DATABASE IF NOT EXISTS restaurant_manager;
USE restaurant_manager;

CREATE TABLE IF NOT EXISTS food_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    status ENUM('Active','Inactive') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_code VARCHAR(20) NOT NULL UNIQUE,
    customer VARCHAR(100) NOT NULL,
    items_count INT NOT NULL DEFAULT 1,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('Pending','Preparing','Ready','Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO food_items (food_name, category, price, status) VALUES
('Chicken Burger', 'Burger', 4.50, 'Active'),
('Margherita Pizza', 'Pizza', 8.00, 'Active'),
('Chicken Biryani', 'Biryani', 6.00, 'Active'),
('French Fries', 'Snacks', 2.50, 'Active'),
('Cold Coffee', 'Drinks', 2.50, 'Active');

INSERT INTO orders (order_code, customer, items_count, amount, status, created_at) VALUES
('1001', 'John Doe', 2, 14.50, 'Pending', NOW()),
('1002', 'Sarah Khan', 3, 23.00, 'Preparing', NOW()),
('1003', 'Mike Smith', 1, 8.00, 'Ready', NOW()),
('1004', 'David Lee', 2, 16.00, 'Completed', NOW());
