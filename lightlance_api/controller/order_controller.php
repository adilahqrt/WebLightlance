<?php
require_once 'utils/connection.php';

class OrderController extends Connection {
    private static $instance = null;

    protected function __construct()
    {
        
    }

    public static function getInstance() {
        if (self::$instance == null) self::$instance = new OrderController();

        return self::$instance;
    }

    public function isDateOrderOverlap($dateOrder) {
        $sql = 'SELECT * FROM pemesanan WHERE tgl_pemesanan = :newDateOrder LIMIT 1';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':newDateOrder', $dateOrder);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

    public function checkUserBalance($userId, $packageId) {
        $sql = "SELECT paket.harga_paket, user.saldo, IF(user.saldo >= paket.harga_paket, TRUE, FALSE) AS 'isEnough' FROM paket, user WHERE paket.id_paket = :packageId AND user.id_user = :userId;";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':packageId', $packageId);
        $stmt->execute();
        
        $result = [];

        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $key => $value) {
            $result[$key] =  $key != 'isEnough' ? (int)$value : (bool)$value;
        }

        return $result;
    }

    public function insertOrder($dateOrder, $address, $userId, $packageId) {
        $sql = "INSERT INTO pemesanan (tgl_pemesanan, id_user, alamat, id_paket, status_pemesanan) VALUES  (:dateOrder, :userId, :address, :packageId, 'Pending')";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':dateOrder', $dateOrder);
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':packageId', $packageId);
        $stmt->execute();

        return (int)$this->getConnection()->lastInsertId();
    }

    public function payOrder($orderId, $userId) {
        $sql = "SELECT pemesanan.id_paket, user.saldo - paket.harga_paket AS 'remaining_balance' FROM pemesanan INNER JOIN user ON pemesanan.id_user = user.id_user INNER JOIN paket ON pemesanan.id_paket = paket.id_paket WHERE pemesanan.id_pemesanan = :orderId AND pemesanan.id_user = :userId";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':orderId', $orderId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderById($id) {
        $sql = 'SELECT id_pemesanan, tgl_pemesanan, alamat, status_pemesanan FROM pemesanan WHERE id_pemesanan = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateOrderStatus($orderId, $userId) {
        $sql = "UPDATE pemesanan SET status_pemesanan = 'Success' WHERE id_pemesanan = :orderId AND id_user = :userId";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':orderId', $orderId);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

    public function getUserOrders($userId) {
        $sql = 'SELECT * FROM pemesanan WHERE id_user = :userId';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}