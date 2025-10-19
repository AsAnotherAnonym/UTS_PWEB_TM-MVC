<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    private $conn;
    private $table = 'users';
    
    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }
    
    public function create($username, $email, $password) {
        try {
            $query = "SELECT id FROM {$this->table} WHERE username = :username OR email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email
            ]);
            
            if ($stmt->rowCount() > 0) {
                return false;
            }

            $query = "INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);
            
            return $this->conn->lastInsertId();
        } catch(PDOException $e) {
            error_log("User Create Error: " . $e->getMessage());
            return false;
        }
    }
    
    public function findByUsername($username) {
        try {
            $query = "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':username' => $username]);
            
            return $stmt->fetch();
        } catch(PDOException $e) {
            error_log("User Find Error: " . $e->getMessage());
            return null;
        }
    }
    
    public function findById($id) {
        try {
            $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':id' => $id]);
            
            return $stmt->fetch();
        } catch(PDOException $e) {
            error_log("User Find Error: " . $e->getMessage());
            return null;
        }
    }
    
    public function verifyPassword($username, $password) {
        $user = $this->findByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
    
    public function getAll() {
        try {
            $query = "SELECT id, username, email, created_at FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            error_log("User GetAll Error: " . $e->getMessage());
            return [];
        }
    }
    
    public function update($id, $username, $email) {
        try {
            $query = "UPDATE {$this->table} SET username = :username, email = :email WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute([
                ':id' => $id,
                ':username' => $username,
                ':email' => $email
            ]);
        } catch(PDOException $e) {
            error_log("User Update Error: " . $e->getMessage());
            return false;
        }
    }
    
    public function delete($id) {
        try {
            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute([':id' => $id]);
        } catch(PDOException $e) {
            error_log("User Delete Error: " . $e->getMessage());
            return false;
        }
    }
}
?>