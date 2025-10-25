<?php

namespace App\Frontend\Controller;

use App\Repository\PageRepository;

class PagesController extends AbstractRenderController
{
    public function __construct(private PageRepository $pageRepository) {}

    public function showPage(string $page): void
    {
        $content = $this->pageRepository->fetchBySlug($page);
        $this->render($page, ['content' => $content]);
    }
}
