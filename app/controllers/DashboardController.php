<?php
require_once __DIR__ . '/../models/User.php';

class DashboardController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/login');
            exit;
        }
        
        $userModel = new User();
        $user = $userModel->findById($_SESSION['user_id']);
        
        require __DIR__ . '/../views/dashboard/index.php';
    }
}
?>