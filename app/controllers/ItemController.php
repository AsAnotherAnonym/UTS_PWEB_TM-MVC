<?php
require_once __DIR__ . '/../models/Item.php';

class ItemController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/login');
            exit;
        }
        
        $itemModel = new Item();
        $items = $itemModel->getAll();
        
        require __DIR__ . '/../views/items/index.php';
    }
    
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/login');
            exit;
        }
        
        require __DIR__ . '/../views/items/create.php';
    }
    
    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            
            $itemModel = new Item();
            $itemModel->create($name, $description, $price, $_SESSION['user_id']);
            
            header('Location: /webdemo_mvc/items');
            exit;
        }
    }
    
    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/login');
            exit;
        }
        
        $itemModel = new Item();
        $item = $itemModel->findById($id);
        
        if (!$item) {
            header('Location: /webdemo_mvc/items');
            exit;
        }
        
        require __DIR__ . '/../views/items/edit.php';
    }
    
    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /webdemo_mvc/login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            
            $itemModel = new Item();
            $itemModel->update($id, $name, $description, $price);
            
            header('Location: /webdemo_mvc/items');
            exit;
        }
    }
    
    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false]);
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            
            $itemModel = new Item();
            $result = $itemModel->delete($id);
            
            echo json_encode(['success' => $result]);
            exit;
        }
    }
}
?>