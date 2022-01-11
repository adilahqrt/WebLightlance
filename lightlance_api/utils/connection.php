<?php

abstract class Connection {
    private $connection = null;

    public function getConnection() : PDO
    {
        if ($this->connection == null) {
            $host = 'ws-tif.com';
            $dbname = 'u1694897_c_reg_4_db';
            $user = 'u1694897_c_reg_4';
            $password = 'jtipolije';

            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        }

        return $this->connection;
    }
}