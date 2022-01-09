<?php
require_once 'controller/servicing_controller.php';

$url = explode('/', $_GET['cmd']);
$servicingController = ServicingController::getInstance();

header('Content-Type: application/json');

switch (end($url)) {
    case 'getCategories':
        $response = [
            'success' => false,
            'message' => 'your request is not valid',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $response = [
                'success' => true,
                'message' => 'success fetching all categories',
                'categories' => $servicingController->getCategories(),
            ];
        }

        echo json_encode($response);

        break;

    case 'getPackages':
        $response = [
            'success' => false,
            'message' => 'your request is not valid',
            'packages' => null,
        ];

        $categoryId = $_GET['categoryId'];

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($categoryId)) {
            $response = [
                'success' => true,
                'message' => 'success get packages',
                'category' => $servicingController->getCategoryById($categoryId),
                'packages' => $servicingController->getPackageByCategory($_GET['categoryId']),
            ];
        }

        echo json_encode($response);

        break;

    default:
        break;
}
