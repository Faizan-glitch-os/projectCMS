<?php

namespace App\Repository;

use App\Models\PageModel;
use PDO;

class PageRepository
{

    public function __construct(private PDO $pdo) {}

    public function fetchBySlug($slug): PageModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `pages` WHERE `slug` = :slug");
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);

        $page = $stmt->fetch();

        return $page;
    }
}
