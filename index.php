<?php


require __DIR__ . '/inc/all.inc.php';

$container = new \App\Support\container;

$container->bind('pdo', function () {
    return require_once __DIR__ . '/inc/db-connect.inc.php';
});

$container->bind('pageRepository', function () use ($container) {
    $pdo = $container->get('pdo');
    return new \App\Repository\PageRepository($pdo);
});

$container->bind('pagesController', function () use ($container) {
    $pageRepository = $container->get('pageRepository');
    return new \App\Frontend\Controller\PagesController($pageRepository);
});

$container->bind('notFoundController', function () use ($container) {
    $pageRepository = $container->get('pageRepository');
    return new \App\Frontend\Controller\NotFoundController($pageRepository);
});

$container->bind('adminController', function () use ($container) {
    $pagesRepository = $container->get('pageRepository');
    return new \App\Admin\Controller\PagesAdminController($pagesRepository);
});

$container->bind('authService', function () use ($container) {
    $pdo = $container->get('pdo');

    return new App\Admin\Support\AuthService($pdo);
});

$container->bind('loginController', function () use ($container) {
    $authService = $container->get('authService');
    return new App\Admin\Controller\LoginController($authService);
});

$route = (string) ($_GET['route'] ?? 'pages');

if ($route === 'pages') {

    $page = (string) ($_GET['page'] ?? 'index');

    $PagesController = $container->get('pagesController');
    $PagesController->showPage($page);
} else if ($route === 'admin/login') {
    $loginController = $container->get('loginController');
    $loginController->handleLogin();
} else if ($route === 'admin/pages') {
    $authService = $container->get('authService');
    $authService->ensureLogin();

    $adminController = $container->get('adminController');
    $adminController->index();
} else if ($route === 'admin/pages/create') {
    $authService = $container->get('authService');
    $authService->ensureLogin();

    $adminController = $container->get('adminController');
    $adminController->create();
} else if ($route === 'admin/pages/delete') {
    $authService = $container->get('authService');
    $authService->ensureLogin();

    $adminController = $container->get('adminController');
    $adminController->delete();
} else if ($route === 'admin/pages/edit') {
    $authService = $container->get('authService');
    $authService->ensureLogin();

    $adminController = $container->get('adminController');
    $adminController->edit();
} else {
    $NotFoundController = $container->get('notFoundController');
    $NotFoundController->error_404();
}
