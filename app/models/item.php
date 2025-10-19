<?php
require_once __DIR__ . '/../config/Database.php';

class Item {
    private $conn;
    private $table = 'items';
    
    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }
    
    public function getAll() {
        try {
            $query = "SELECT i.*, u.username 
                     FROM {$this->table} i 
                     LEFT JOIN users u ON i.user_id = u.id 
                     ORDER BY i.id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            error_log("Item GetAll Error: " . $e->getMessage());
            return [];
        }
    }
    
    public function getByUserId($userId) {
        try {
            $query = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            error_log("Item GetByUser Error: " . $e->getMessage());
            return [];
        }
    }
    
    public function findById($id) {
        try {
            $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':id' => $id]);
            
            return $stmt->fetch();
        } catch(PDOException $e) {
            error_log("Item Find Error: " . $e->getMessage());
            return null;
        }
    }
    
    public function create($name, $description, $price, $userId) {
        try {
            $query = "INSERT INTO {$this->table} (name, description, price, user_id) 
                     VALUES (:name, :description, :price, :user_id)";
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':user_id' => $userId
            ]);
            
            return $this->conn->lastInsertId();
        } catch(PDOException $e) {
            error_log("Item Create Error: " . $e->getMessage());
            return false;
        }
    }
    
    public function update($id, $name, $description, $price) {
        try {
            $query = "UPDATE {$this->table} 
                     SET name = :name, description = :description, price = :price 
                     WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':description' => $description,
                ':price' => $price
            ]);
        } catch(PDOException $e) {
            error_log("Item Update Error: " . $e->getMessage());
            return false;
        }
    }
    
    public function delete($id) {
        try {
            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute([':id' => $id]);
        } catch(PDOException $e) {
            error_log("Item Delete Error: " . $e->getMessage());
            return false;
        }
    }
    
    public function count() {
        try {
            $query = "SELECT COUNT(*) as total FROM {$this->table}";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch();
            
            return $result['total'] ?? 0;
        } catch(PDOException $e) {
            error_log("Item Count Error: " . $e->getMessage());
            return 0;
        }
    }
    
    public function search($keyword) {
        try {
            $query = "SELECT * FROM {$this->table} 
                     WHERE name LIKE :keyword OR description LIKE :keyword 
                     ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':keyword' => "%{$keyword}%"]);
            
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            error_log("Item Search Error: " . $e->getMessage());
            return [];
        }
    }
}
?>