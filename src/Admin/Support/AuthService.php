<?php

namespace App\Admin\Support;

use \PDO;

class AuthService
{

    public function __construct(private PDO $pdo) {}

    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            return false;
        }

        $stmt = $this->pdo->prepare("SELECT `password` FROM `admin` WHERE `email` = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $hash = $stmt->fetch(PDO::FETCH_ASSOC)['password'];

        var_dump($hash);

        if ($hash == false) {
            return false;
        }

        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}
