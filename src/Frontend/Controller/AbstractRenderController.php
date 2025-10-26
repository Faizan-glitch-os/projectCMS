<?php

namespace App\Frontend\Controller;

use App\Repository\PageRepository;

abstract class AbstractRenderController
{
    public function __construct(private PageRepository $pageRepository) {}

    protected function render(string $view, array $params): void
    {
        extract($params);

        ob_start();

        require_once __DIR__ . '/../../../views/frontend/pages/' . $view . '.view.php';

        $contents = ob_get_clean();
        $navPages = $this->pageRepository->fetchPages();

        require_once __DIR__ . '/../../../views/frontend/layouts/main.view.php';
    }

    protected function error_404()
    {
        http_response_code(404);

        $this->render('notFound', []);
    }
}
