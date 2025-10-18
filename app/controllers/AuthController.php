<?php
require_once __DIR__ . '/../models/user.php';

class AuthController {
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/dashboard');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $userModel = new User();
            $user = $userModel->verifyPassword($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header('Location: /webdemo_mvc/dashboard');
                exit;
            } else {
                $error = "Username atau password salah!";
            }
        }
        
        require __DIR__ . '/../views/auth/login.php';
    }
    
    public function register() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/dashboard');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if ($password !== $confirmPassword) {
                $error = "Password tidak cocok!";
            } else {
                $userModel = new User();
                $userId = $userModel->create($username, $email, $password);
                
                if ($userId) {
                    $success = "Registrasi berhasil! Silakan login.";
                } else {
                    $error = "Username atau email sudah digunakan!";
                }
            }
        }
        
        require __DIR__ . '/../views/auth/register.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: /webdemo_mvc/login');
        exit;
    }
}
?>