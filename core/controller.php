<?php
if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
} else {
    $controller = '';
}

switch ($controller) {
    case 'register':
        require 'views/pages/register.php';
        break;
    case 'login':
        require 'views/pages/login.php';
        break;
    case 'logout':
        require 'views/pages/logout.php';
        break;
    default:
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            require 'views/pages/admin/dashboard.php';
        } else {
            require 'views/pages/home.php';
        }
        break;
}