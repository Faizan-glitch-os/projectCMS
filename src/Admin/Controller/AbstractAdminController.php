<?php

namespace App\Admin\Controller;

abstract class AbstractAdminController
{
    public function __construct() {}

    protected function render(string $view, array $params): void
    {
        extract($params);

        ob_start();

        require_once __DIR__ . '/../../../views/admin/' . $view . '.view.php';

        $contents = ob_get_clean();

        require_once __DIR__ . '/../../../views/admin/layouts/main.view.php';
    }

    protected function error_404()
    {
        http_response_code(404);

        $this->render('notFound', []);
    }
}
