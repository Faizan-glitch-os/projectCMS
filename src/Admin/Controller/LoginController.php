<?php

namespace App\Admin\Controller;

use App\Admin\Support\AuthService;

class LoginController extends AbstractAdminController
{

    public function __construct(private AuthService $authService) {}

    public function handleLogin()
    {
        if ($this->authService->isLoggedIn()) {
            header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
            return;
        }
        $errors = [];

        if (!empty($_POST)) {
            $email = (string) e(($_POST['email'] ?? ''));
            $password = (string) ($_POST['password'] ?? '');

            if (!empty($email) && !empty($password)) {
                $success = $this->authService->login($email, $password);

                if ($success === true) {
                    header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
                    return;
                } else {
                    $errors = ['Email or Password is incorrect, Please try again'];
                }
            } else {
                $errors = ['Please enter Email and Password'];
            }
        }

        $this->render('login/login', ['errors' => $errors]);
    }
}
