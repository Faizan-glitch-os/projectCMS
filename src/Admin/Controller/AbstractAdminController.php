<?php

namespace App\Admin\Controller;

use App\Admin\Support\AuthService;

abstract class AbstractAdminController
{
    public function __construct(protected AuthService $authService) {}

    protected function render(string $view, array $params): void
    {
        extract($params);

        ob_start();

        require_once __DIR__ . '/../../../views/admin/' . $view . '.view.php';

        $contents = ob_get_clean();
        $loggedIn = $this->authService->isLoggedIn();

        require_once __DIR__ . '/../../../views/admin/layouts/main.view.php';
    }

    protected function error_404()
    {
        http_response_code(404);

        $this->render('notFound', []);
    }
}
