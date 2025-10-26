<?php

namespace App\Repository;

use App\Models\PageModel;
use PDO;

class PageRepository
{

    public function __construct(private PDO $pdo) {}

    public function fetchPages()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `pages` ORDER BY `id` ASC");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);

        $pages = $stmt->fetchAll();

        return $pages;
    }

    public function fetchBySlug($slug): ?PageModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `pages` WHERE `slug` = :slug");
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);

        $page = $stmt->fetch();

        if (!empty($page)) {
            return $page;
        } else {
            return null;
        }
    }
}
