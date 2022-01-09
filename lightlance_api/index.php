<?php
$url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

if ($url[0] == 'lightlance') {
    array_splice($url, 0, 1);
}

if ($url[0] == 'api') {
    switch ($url[1]) {
        case 'auth':
            require 'api/auth.php';
            break;

        case 'user':
            require 'api/user.php';
            break;

        case 'servicing':
            require 'api/servicing.php';
            break;

        case 'order':
            require 'api/order.php';
            break;

        default:
            break;
    }
}
