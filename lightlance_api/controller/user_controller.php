<?php
require_once 'lightlance_api/utils/connection.php';

class UserController extends Connection {
    private static $instance = null;

    protected function __construct()
    {
        
    }

    public static function getInstance() {
        if (self::$instance == null) self::$instance = new UserController();

        return self::$instance;
    }

    public function getUserById($id) {
        $sql = 'SELECT * FROM user WHERE id_user = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($user['password']);

        return $user;
    }

    public function topupBalance($id, $topupNominal) {
        $sql = 'UPDATE user SET saldo = saldo + :topupNominal WHERE id_user = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':topupNominal', (int) $topupNominal);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $this->getCurrentBalance($id);
    }

    public function getCurrentBalance($id) {
        $sql = 'SELECT saldo FROM user WHERE id_user = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['saldo'];
    }

    public function updateBalance($id, $newBalance) {
        $sql = 'UPDATE user SET saldo = :newBalance WHERE id_user = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':newBalance', $newBalance);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }
}