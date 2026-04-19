CREATE TABLE Categories (
    category_id INT PRIMARY KEY,
    category_name VARCHAR(50)
);

CREATE TABLE Products (
    product_id INT PRIMARY KEY,
    product_name VARCHAR(50),
    product_price DECIMAL(10, 2),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

CREATE TABLE Sales (
    sales_id INT PRIMARY KEY,
    product_id INT,
    total_sales DECIMAL(10, 2),
    monthly_sales DECIMAL(10, 2),
    average_sales DECIMAL(10, 2),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

INSERT INTO Categories (category_id, category_name) 
VALUES
(1, 'DRINKS'),
(2, 'FOOD'),
(3, 'HYGIENE');

INSERT INTO Products (product_id, product_name, product_price, category_id) 
VALUES
--DRINKS
(1, 'Water', 10.00, 1),
(2, 'Orange Juice', 12.00, 1),
(3, 'Coke', 20.00, 1),
(4, 'Sprite', 20.00, 1),
(5, 'Rootbeer', 22.00, 1),

--FOOD
(6, 'Cookies', 7.00, 2),
(7, 'Muffins', 10.00, 2),
(8, 'Chips', 10.00, 2),
(9, 'Burgers', 20.00, 2),
(10, 'Hotdogs', 20.00, 2),

--HYGIENE
(11, 'Toothpaste', 12.00, 3),
(12, 'Soap', 15.00, 3),
(13, 'Shampoo', 9.00, 3),
(14, 'Nail cutter', 30.00, 3),
(15, 'Floss', 20.00, 3);

INSERT INTO Sales (sales_id, product_id, total_sales, monthly_sales, average_sales) 
VALUES
(1, 1, 1500.00, 300.00, 15.00),
(2, 6, 2200.00, 450.00, 12.50),
(3, 11, 800.00, 120.00, 18.00);