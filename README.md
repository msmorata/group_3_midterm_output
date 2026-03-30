# Group 3 - Inventory and Sales System RESTful API

## Project Overview
This project is a backend RESTful JSON API built with PHP Object-Oriented Programming (OOP) and PostgreSQL using PDO. It manages products, categories, and sales transactions, including relationship mapping and data analytics.

**Repository Name:** `group_3_midterm_output`

## Team Members & Roles
* **Member 1:** Payawal - Database Designer
* **Member 2:** Morata & Breis - Model Developer (PHP OOP)
* **Member 3:** Lucero - CRUD API Developer
* **Member 4:** Baricanosa - Relationship API Developer
* **Member 5:** Manaig - Data Analytics API Developer
* **Member 6:** Gecale - Documentation and Testing

---

## Setup Instructions
1. Open pgAdmin or your PostgreSQL command line and create a new database named `db_inventory_sales`.
2. Run the provided `database.sql` script to create the tables (`Categories`, `Products`, `Sales`) and insert the initial mock data. *(Note: Ensure you are using the updated SQL script where the Sales table references `product_id`).*
3. Place this project folder (`group_3_midterm_output`) inside your local server's document root (e.g., `htdocs` for XAMPP or `/var/www/html` for Apache).
4. Update the `$password` variable inside `config/Connection.php` if your local PostgreSQL password is not `admin`.
5. Start your local web server (Apache).

---

## API Documentation (Postman Testing Guide)
Use the following endpoints to test the system in Postman. 

*Note: Ensure your local server is running. The base URLs below assume you are using `localhost` and your folder is named `group_3_midterm_output`.*

### 1. Get All Products (CRUD)
* **Developer:** Lucero
* **Method:** `GET`
* **URL:** `http://localhost/group_3_midterm_output/analytics/get_products.php`
* **Description:** Returns a JSON list of all products in the database.

### 2. Create a Product (CRUD)
* **Developer:** Lucero
* **Method:** `POST`
* **URL:** `http://localhost/group_3_midterm_output/analytics/create_product.php`
* **Headers:** `Content-Type: application/json`

### 3. Update a Product (CRUD)
* **Developer:** Lucero
* **Method:** `PUT`
* **URL:** `http://localhost/group_3_midterm_output/analytics/update_product.php`
* **Headers:** `Content-Type: application/json`

### 4. Delete a Product (CRUD)
* **Developer:** Lucero
* **Method:** `DELETE`
* **URL:** `http://localhost/group_3_midterm_output/analytics/delete_product.php`
* **Headers:** `Content-Type: application/json`

### 5. Get Products with Categories (Relationship)
* **Developer:** Baricanosa
* **Method:** `GET`
* **URL:** `http://localhost/group_3_midterm_output/analytics/get_products_with_categories.php`
* **Description:** Returns products mapped to their respective category names using a SQL `JOIN`.

### 6. Get System Analytics (Analytics)
* **Developer:** Manaig
* **Method:** `GET`
* **URL:** `http://localhost/group_3_midterm_output/analytics/get_analytics.php`
* **Description:** Calculates and returns the total number of products, total sales per product, and the total revenue grouped by category.