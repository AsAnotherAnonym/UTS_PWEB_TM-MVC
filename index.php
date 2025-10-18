<?php
session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/webdemo_mvc', '', $request);
$request = strtok($request, '?');

switch ($request) {
    case '/':
    case '':
        if (isset($_SESSION['user_id'])) {
            require 'app/controllers/DashboardController.php';
            $controller = new DashboardController();
            $controller->index();
        } else {
            header('Location: /webdemo_mvc/login');
        }
        break;
    
    case '/login':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
    
    case '/register':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
        break;
    
    case '/logout':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;
    
    case '/dashboard':
        require 'app/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
    
    case '/items':
        require 'app/controllers/ItemController.php';
        $controller = new ItemController();
        $controller->index();
        break;
    
    case '/items/create':
        require 'app/controllers/ItemController.php';
        $controller = new ItemController();
        $controller->create();
        break;
    
    case '/items/store':
        require 'app/controllers/ItemController.php';
        $controller = new ItemController();
        $controller->store();
        break;
    
    case (preg_match('/\/items\/edit\/(\d+)/', $request, $matches) ? true : false):
        require 'app/controllers/ItemController.php';
        $controller = new ItemController();
        $controller->edit($matches[1]);
        break;
    
    case '/items/update':
        require 'app/controllers/ItemController.php';
        $controller = new ItemController();
        $controller->update();
        break;
    
    case '/items/delete':
        require 'app/controllers/ItemController.php';
        $controller = new ItemController();
        $controller->delete();
        break;
    
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>