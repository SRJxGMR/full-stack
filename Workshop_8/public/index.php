<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/db.php';

use Jenssegers\Blade\Blade;

// Blade config
$views = __DIR__ . '/../app/views';
$cache = __DIR__ . '/../cache/views';
$blade = new Blade($views, $cache);

// Load MVC components
require __DIR__ . '/../app/models/Student.php';
require __DIR__ . '/../app/controller/StudentController.php';

$student = new Student($pdo);
$controller = new StudentController($student, $blade);

// Simple router
$page = $_GET['page'] ?? 'index';

switch ($page) {

    case 'index':
        $controller->index();
        break;

    case 'create':
        $controller->create();
        break;

    case 'store':
        $controller->store();
        break;

    case 'edit':
        $controller->edit($_GET['id']);
        break;

    case 'update':
        $controller->update($_GET['id']);
        break;

    case 'delete':
        $controller->delete($_GET['id']);
        break;

    default:
        echo "404 - Page Not Found";
}
