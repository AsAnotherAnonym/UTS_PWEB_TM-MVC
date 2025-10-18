<?php
class User {
    private $dataFile = __DIR__ . '/../../data/users.json';
    
    public function __construct() {
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([]));
        }
    }
    
    private function getData() {
        return json_decode(file_get_contents($this->dataFile), true) ?? [];
    }
    
    private function saveData($data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
    
    public function create($username, $email, $password) {
        $users = $this->getData();
        
        // Cek username sudah ada
        foreach ($users as $user) {
            if ($user['username'] === $username || $user['email'] === $email) {
                return false;
            }
        }
        
        $newUser = [
            'id' => count($users) + 1,
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $users[] = $newUser;
        $this->saveData($users);
        return $newUser['id'];
    }
    
    public function findByUsername($username) {
        $users = $this->getData();
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                return $user;
            }
        }
        return null;
    }
    
    public function findById($id) {
        $users = $this->getData();
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }
    
    public function verifyPassword($username, $password) {
        $user = $this->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>