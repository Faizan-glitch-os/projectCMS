<?php

namespace App\Frontend\Controller;

abstract class AbstractRenderController
{
    protected function render(string $view, array $params): void
    {
        extract($params);

        ob_start();

        require_once __DIR__ . '/../../../views/frontend/pages/' . $view . '.view.php';

        $contents = ob_get_clean();

        require_once __DIR__ . '/../../../views/frontend/layouts/main.view.php';
    }
}
