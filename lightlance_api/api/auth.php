<?php
require_once 'controller/auth_controller.php';

$url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$authController = AuthController::getInstance();

header('Content-Type: application/json');


switch (end($url)) {
    case 'getUsers':
        $response = [
            'status' => 'error',
            'message' => 'your request is not valid',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $users = $authController->getUsers();

            $response = [
                'status' => 'success',
                'data' => $users,
            ];
        }

        echo json_encode($response);

        break;

    case 'login':
        $response = [
            'status' => 'error',
            'message' => 'your request is not valid',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);

            $email = $body['email'];
            $password = $body['password'];

            $loginResult = $authController->login($email, $password);

            if (is_array($loginResult)) {
                $response = [
                    'success' => true,
                    'message' => null,
                    'user' => $loginResult,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => $loginResult,
                    'user' => null,
                ];
            }
        }

        echo json_encode($response);

        break;

    case 'register':
        $response = [
            'status' => 'error',
            'message' => 'your request is not valid',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'model/user.php';

            $body = json_decode(file_get_contents('php://input'), true);

            $user = new User($body['email'], password_hash($body['password'], PASSWORD_DEFAULT), $body['fullname'], $body['gender'], $body['address'], $body['phone'], $body['balance']);

            $registerResult = $authController->register($user);

            if (is_bool($registerResult)) {
                $response = [
                    'status' => 'success',
                    'registered' => true,
                ];
            } else if (is_string($registerResult)) {
                $response = [
                    'status' => 'error',
                    'message' => $registerResult,
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'There is something wrong!',
                ];
            }
        }

        echo json_encode($response);

        break;

    case 'updateProfile':
        $response = [
            'success' => false,
            'message' => 'your request is invalid.'
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);

            $updatedUser = new User(
                $body['email'],
                null,
                $body['fullname'],
                $body['gender'],
                $body['address'],
                $body['phone'],
            );

            $result = $authController->updateProfile($body['id'], $updatedUser);

            if (is_bool($result)) {
                $response = [
                    'success' => true,
                    'message' => 'user data has been updated',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => $result
                ];
            }
        }

        echo json_encode($response);

        break;

    default:
        break;
}
