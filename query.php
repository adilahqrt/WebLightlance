<?php
    $query = "SELECT * FROM admin";
    $result = mysqli_query($koneksi, $query);
    $no = 1;

    class crud extends koneksi
    {
        public function lihatData() {
            $sql = "SELECT * FROM admin";
            $result = $this->koneksi->prepare($sql);
            $result->execute();
            return $result;
        }

        public function insertData($email, $pass, $name) {
            try {
                $sql = "INSERT INTO (user_email, user_password, user_fullname) VALUES (:email, :pass, :name)";
                $result = $this->koneksi->prepare($sql);
                $result->bindParam(":email, $email");
                $result->bindParam(":pass, $pass");
                $result->bindParam(":name, $name");
                $result->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>