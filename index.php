<?php


require __DIR__ . '/inc/all.inc.php';

$page = (string) ($_GET['page'] ?? 'index');

if ($page == 'index') {
    $PageRepository = new \App\Repository\PageRepository($pdo);
    $PagesController = new \App\Frontend\Controller\PagesController($PageRepository);

    $PagesController->showPage($page);
} else {
    $NotFoundController = new \App\Frontend\Controller\NotFoundController;
    $NotFoundController->error_404();
}
