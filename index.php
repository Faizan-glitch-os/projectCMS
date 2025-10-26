<?php


require __DIR__ . '/inc/all.inc.php';

$Container = new \App\Support\Container;

$Container->bind('pdo', function () {
    return require_once __DIR__ . '/inc/db-connect.inc.php';
});

$Container->bind('pageRepository', function () use ($Container) {
    $pdo = $Container->get('pdo');
    return new \App\Repository\PageRepository($pdo);
});

$Container->bind('pagesController', function () use ($Container) {
    $pageRepository = $Container->get('pageRepository');
    return new \App\Frontend\Controller\PagesController($pageRepository);
});

$Container->bind('notFoundController', function () use ($Container) {
    $pageRepository = $Container->get('pageRepository');
    return new \App\Frontend\Controller\NotFoundController($pageRepository);
});

$route = (string) ($_GET['route'] ?? 'pages');

if ($route === 'pages') {

    $page = (string) ($_GET['page'] ?? 'index');

    $PagesController = $Container->get('pagesController');
    $PagesController->showPage($page);
} else {
    $NotFoundController = $Container->get('notFoundController');
    $NotFoundController->error_404();
}
