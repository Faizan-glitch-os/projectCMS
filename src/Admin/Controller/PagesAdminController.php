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
}
