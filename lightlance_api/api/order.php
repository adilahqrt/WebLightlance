<?php
require_once 'lightlance_api/controller/order_controller.php';
require_once 'lightlance_api/controller/user_controller.php';
require_once 'lightlance_api/controller/servicing_controller.php';

$url = explode('/', $_GET['cmd']);

$orderController = OrderController::getInstance();
$userController = UserController::getInstance();
$servicingController = ServicingController::getInstance();

header('Content-Type: application/json');

switch (end($url)) {
    case 'sendOrder':
        $response = [
            'success' => false,
            'message' => 'your request is not valid',
            'idTransaction' => null,
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);
            $dateOrder = $body['dateOrder'];
            $address = $body['address'];
            $userId = $body['userId'];
            $packageId = $body['packageId'];

            if ($orderController->isDateOrderOverlap($dateOrder)) {
                $response = [
                    'success' => false,
                    'message' => 'Proses pemesanan gagal, karena tanggal tersebut telah penuh',
                    'idTransaction' => null,
                ];
            } else if (!$orderController->checkUserBalance($userId, $packageId)['isEnough']) {
                $response = [
                    'success' => false,
                    'message' => 'Saldo Anda tidak mencukupi.',
                    'idTransaction' => null,
                ];
            } else {
                $orderHasInserted = $orderController->insertOrder($dateOrder, $address, $userId, $packageId);

                $response = [
                    'success' => true,
                    'message' => 'Pesanan berhasil diproses',
                    'idTransaction' => $orderHasInserted,
                ];
            }
        }

        echo json_encode($response);

        break;

    case 'payOrder':
        $response = [
            'success' => false,
            'message' => 'your request is not valid',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);
            $orderId = $body['orderId'];
            $userId = $body['userId'];

            $payRes = $orderController->payOrder($orderId, $userId);

            $packageId = $payRes['id_paket'];
            $remainingBalance = $payRes['remaining_balance'];

            if (isset($remainingBalance)) {
                $isUpdated = $userController->updateBalance($userId, $remainingBalance);
                $statusUpdated = $orderController->updateOrderStatus($orderId, $userId);

                if ($isUpdated && $statusUpdated) {
                    $receipt = $orderController->getOrderById($orderId);
                    $receipt['user'] = $userController->getUserById($userId);
                    $receipt['paket'] = $servicingController->getPackageById($packageId);

                    $response = [
                        'success' => true,
                        'message' => 'payment success',
                        'receipt' => $receipt,
                    ];
                }
            }
        }

        echo json_encode($response);

        break;

    case 'getOrders':
        $response = [
            'success' => false,
            'message' => 'your request is not valid',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['userId'])) {
            $userId = $_GET['userId'];

            $orderList = $orderController->getUserOrders($userId);
            $response = [];

            foreach ($orderList as $order) {
                $packageId = $order['id_paket'];
                $package = $servicingController->getPackageById($packageId);

                $categoryId = $package['id_kategori'];
                $category = $servicingController->getCategoryById($categoryId);

                $order['package'] = $package;
                $order['category'] = $category;

                unset($order['id_user']);
                unset($order['id_paket']);

                array_push($response, $order);
            }

            $response = [
                'success' => true,
                'message' => 'success get order list',
                'orders' => $response,
            ];
        }

        echo json_encode($response);

        break;

    default:
        break;
}
