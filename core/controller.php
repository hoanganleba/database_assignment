<?php
$controller = $_GET['controller'] ?? '';

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
    case 'createNewProductBid':
        require 'views/pages/createNewProductBid.php';
        break;
    case 'customers':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            require 'views/pages/admin/customers.php';
        } else {
            require 'views/pages/home.php';
        }
        break;
    default:
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            require 'views/pages/admin/dashboard.php';
        } else {
            require 'views/pages/home.php';
        }
        break;
}