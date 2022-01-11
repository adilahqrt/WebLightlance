<?php
require_once 'lightlance_api/controller/user_controller.php';

$url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$userController = UserController::getInstance();

header('Content-Type: application/json');

switch (end($url)) {
    case 'topup':
        $response = [
            'status' => 'error',
            'message' => 'your request is not valid',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);

            $id = $body['id'];
            $nominal = $body['nominal'];

            $response = [
                'status' => 'success',
                'topupNominal' => $nominal,
                'balance' => $userController->topupBalance($id, $nominal),
            ];
        }

        echo json_encode($response);

        break;

    default:
        break;
}
