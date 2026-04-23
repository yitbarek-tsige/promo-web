CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    phone VARCHAR(20),
    city VARCHAR(50),
    address TEXT,
    package VARCHAR(50),
    status VARCHAR(20) DEFAULT 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);