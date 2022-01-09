<?php
abstract class Connection {
    private $connection = null;

    public function getConnection() : PDO
    {
        if ($this->connection == null) {
            $host = 'localhost';
            $dbname = 'lightlance';
            $user = 'root';
            $password = null;

            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        }

        return $this->connection;
    }
}