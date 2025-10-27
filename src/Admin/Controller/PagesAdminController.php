<?php

namespace App\Admin\Controller;

use App\Repository\PageRepository;

class PagesAdminController extends AbstractAdminController
{
    public function __construct(private PageRepository $pageRepository) {}

    public function index()
    {
        $entries = $this->pageRepository->getAllEntries();
        $this->render('index', ['entries' => $entries]);
    }

    public function create()
    {
        if (!empty($_POST)) {
            $title = @(string) ($_POST['title'] ?? '');
            $slug = @(string) ($_POST['slug'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            if (!empty($this) && !empty($slug) && !empty($content)) {
                $this->pageRepository->createPage($title, $slug, $content);
            }
        }

        $this->render('create', []);
    }
}
