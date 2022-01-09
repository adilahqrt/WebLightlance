<?php
require_once 'utils/connection.php';
require_once 'model/user.php';

class AuthController extends Connection
{

    private static $instance = null;

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) self::$instance = new AuthController();

        return self::$instance;
    }

    public function getUsers()
    {
        $sql = 'SELECT * FROM user';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($email, $password)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                return 'Wrong password!';
            }
        } else {
            return 'Email not found!';
        }
    }

    public function register(User $user)
    {
        $checkEmail = $this->isEmailRegistered($user->getEmail());

        if ($checkEmail) return 'Email is already registered!';

        $sql = 'INSERT INTO user (email, password, fullname, gender, alamat, no_telp, saldo) VALUES (:email, :password, :fullname, :gender, :address, :phone, :balance)';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':fullname', $user->getFullname());
        $stmt->bindValue(':gender', $user->getGender());
        $stmt->bindValue(':address', $user->getAddress());
        $stmt->bindValue(':phone', $user->getPhone());
        $stmt->bindValue(':balance', $user->getBalance());
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function isEmailRegistered($email) {
        $sql = 'SELECT email FROM user WHERE email = :email';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function updateProfile($id, User $user)
    {
        $sql= 'UPDATE user SET email = :email, fullname = :fullname, gender = :gender, alamat = :alamat, no_telp = :no_telp WHERE id_user =:id_user';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id_user', $id);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':fullname', $user->getFullname());
        $stmt->bindValue(':gender', $user->getGender());
        $stmt->bindValue(':alamat', $user->getAddress());
        $stmt->bindValue(':no_telp', $user->getPhone());
        $stmt->execute();

        if ($stmt->rowCount() == 1) return true;
        else return 'error with affected row ' . $stmt->rowCount();
    }
}

