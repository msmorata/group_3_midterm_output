<?php
require_once "../config/Connection.php";

class Category {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM Categories");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching categories: " . $e->getMessage();
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Categories WHERE category_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching category: " . $e->getMessage();
            return false;
        }
    }

    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO Categories (category_id, category_name) 
                VALUES (?, ?)
            ");
            return $stmt->execute([
                $data['category_id'],
                $data['category_name']
            ]);
        } catch (PDOException $e) {
            echo "Error creating category: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE Categories 
                SET category_name=? 
                WHERE category_id=?
            ");
            return $stmt->execute([
                $data['category_name'],
                $id
            ]);
        } catch (PDOException $e) {
            echo "Error updating category: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Categories WHERE category_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error deleting category: " . $e->getMessage();
            return false;
        }
    }
}