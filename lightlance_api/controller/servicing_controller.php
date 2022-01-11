<?php
require_once 'lightlance_api/utils/connection.php';

class ServicingController extends Connection {
    private static $instance = null;

    protected function __construct()
    {
        
    }

    public static function getInstance() {
        if (self::$instance == null) self::$instance = new ServicingController();

        return self::$instance;
    }

    public function getCategories() {
        $sql = 'SELECT * FROM kategori';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $sql = 'SELECT * FROM kategori WHERE id_kategori = :id LIMIT 1';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPackageByCategory($categoryId) {
        $sql = 'SELECT * FROM paket WHERE id_kategori = :categoryId';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':categoryId', $categoryId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPackageById($id) {
        $sql = 'SELECT * FROM paket WHERE id_paket = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}