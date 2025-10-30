<?php

namespace App\Admin\Controller;

use App\Admin\Support\AuthService;
use App\Repository\PageRepository;

class PagesAdminController extends AbstractAdminController
{
    public function __construct(private PageRepository $pageRepository, protected AuthService $authService)
    {
        parent::__construct($authService);
    }

    public function index()
    {
        $entries = $this->pageRepository->getAllEntries();
        $this->render('pages/index', ['entries' => $entries]);
    }

    public function create()
    {
        $errors = [];

        if (!empty($_POST)) {
            $title = @(string) ($_POST['title'] ?? '');
            $slug = @(string) ($_POST['slug'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            $slug = strtolower($slug);
            $slug = str_replace([' ', '/', '.'], ['-', '-', '-'], $slug);
            $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);

            $errors = [];
            if (!empty($title) && !empty($slug) && !empty($content)) {
                $checkSlug = $this->pageRepository->checkSlug($slug);
                if (empty($checkSlug)) {
                    $this->pageRepository->createPage($title, $slug, $content);
                    header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
                    die;
                } else {
                    header('Location: index.php?' . http_build_query(['route' => 'admin/pages/create']));
                    $errors['duplicateSlug'] = "This slug ($slug) already exist";
                }
            } else {
                if (empty($_POST['title'])) {
                    $errors['emptyTitle'] = "Please enter the Title";
                }
                if (empty($_POST['slug'])) {
                    $errors['emptySlug'] = "Please enter the Slug";
                }
                if (empty($_POST['content'])) {
                    $errors['emptyContent'] = "Please enter the Content";
                }
            }
        }

        $this->render('pages/create', ['errors' => $errors]);
    }

    // delete a page
    public function delete()
    {
        var_dump($_POST);
        $id = @(int) ($_POST['id'] ?? 0);

        if (!empty($id)) {
            $this->pageRepository->deleteById($id);
        }

        header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
    }

    // edit a page
    public function edit()
    {
        $id = @(int) ($_GET['id'] ?? 0);
        $errors = [];


        if (!empty($_POST)) {
            $title = @(string) ($_POST['title'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            if (!empty($title)  && !empty($content)) {
                $this->pageRepository->editPage($title, $content, $id);
                header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
                return;
            } else {
                $errors = ['Please enter all the fields'];
            }
        }

        $toEdit = $this->pageRepository->fetchById($id);

        $this->render('pages/edit', ['toEdit' => $toEdit, 'errors' => $errors]);
    }
}
