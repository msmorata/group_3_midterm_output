<?php
require_once "../config/Connection.php";

class Product {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM Products");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching products: " . $e->getMessage();
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Products WHERE product_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching product: " . $e->getMessage();
            return false;
        }
    }

    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO Products (product_id, product_name, product_price, category_id) 
                VALUES (?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['product_id'],
                $data['product_name'],
                $data['product_price'],
                $data['category_id']
            ]);
        } catch (PDOException $e) {
            echo "Error creating product: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE Products 
                SET product_name=?, product_price=?, category_id=? 
                WHERE product_id=?
            ");
            return $stmt->execute([
                $data['product_name'],
                $data['product_price'],
                $data['category_id'],
                $id
            ]);
        } catch (PDOException $e) {
            echo "Error updating product: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Products WHERE product_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
            return false;
        }
    }

    public function getProductsWithCategories() {
        try {
            $stmt = $this->db->query("
                SELECT p.product_id, p.product_name, p.product_price, c.category_name 
                FROM Products p
                LEFT JOIN Categories c ON p.category_id = c.category_id
            ");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching relationship data: " . $e->getMessage();
            return false;
        }
    }

    public function getTotalProducts() {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) as total_products FROM Products");
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching analytics data: " . $e->getMessage();
            return false;
        }
    }
}