<?php
require_once "../config/Connection.php";

class Sale {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    // --- CRUD METHODS ---

    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM Sales");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching sales: " . $e->getMessage();
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Sales WHERE sales_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching sale record: " . $e->getMessage();
            return false;
        }
    }

    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO Sales (sales_id, category_id, total_sales, monthly_sales, average_sales) 
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['sales_id'],
                $data['category_id'],
                $data['total_sales'],
                $data['monthly_sales'],
                $data['average_sales']
            ]);
        } catch (PDOException $e) {
            echo "Error creating sale record: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE Sales 
                SET category_id=?, total_sales=?, monthly_sales=?, average_sales=? 
                WHERE sales_id=?
            ");
            return $stmt->execute([
                $data['category_id'],
                $data['total_sales'],
                $data['monthly_sales'],
                $data['average_sales'],
                $id
            ]);
        } catch (PDOException $e) {
            echo "Error updating sale record: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Sales WHERE sales_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error deleting sale record: " . $e->getMessage();
            return false;
        }
    }

    public function getSalesPerProduct() {
        try {
            $stmt = $this->db->query("
                SELECT p.product_name, s.total_sales, s.monthly_sales
                FROM Sales s
                JOIN Products p ON s.product_id = p.product_id
            ");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching sales per product: " . $e->getMessage();
            return false;
        }
    }

    public function getRevenuePerCategory() {
        try {
            $stmt = $this->db->query("
                SELECT c.category_name, SUM(s.total_sales) as total_revenue
                FROM Sales s
                JOIN Products p ON s.product_id = p.product_id
                JOIN Categories c ON p.category_id = c.category_id
                GROUP BY c.category_name
            ");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching revenue data: " . $e->getMessage();
            return false;
        }
    }
}