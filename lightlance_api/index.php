<?php

$url = explode('/', $_GET['cmd']);

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
} else {

    unset($_GET['cmd']);
    header('Location: index.php');
}
