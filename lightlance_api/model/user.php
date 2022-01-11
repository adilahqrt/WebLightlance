<?php
class User {
    private $email;
    private $password;
    private $fullname;
    private $gender;
    private $address;
    private $phone;
    private $balance;

    public function __construct($email, $password, $fullname, $gender, $address, $phone, $balance = 0)
    {
        $this->email = $email;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->gender = $gender;
        $this->address = $address;
        $this->phone = $phone;
        $this->balance = $balance;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getBalance() {
        return $this->balance;
    }
}