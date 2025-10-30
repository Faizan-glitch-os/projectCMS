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

        $stmt = $this->pdo->prepare("SELECT `id`, `password` FROM `admin` WHERE `email` = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $hash = $result['password'];

        if ($hash == false) {
            return false;
        }

        if (password_verify($password, $hash)) {
            session_start();
            $_SESSION['adminId'] = $result['id'];
            session_regenerate_id(true);
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn()
    {
        session_start();
        return !empty($_SESSION['adminId']);
    }

    public function ensureLogin()
    {
        $success = $this->isLoggedIn();

        if (empty($success)) {
            header('Location: index.php?' . http_build_query(['route' => 'admin/login']));
            die;
        }
    }
}
