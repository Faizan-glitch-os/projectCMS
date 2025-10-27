<?php

namespace App\Repository;

use App\Models\PageModel;
use PDO;

class PageRepository
{

    public function __construct(private PDO $pdo) {}

    public function checkSlug($slug): bool
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(`slug`) AS `count` FROM `pages`");
        $stmt->execute();

        $count = $stmt->fetchAll(PDO::FETCH_ASSOC)['count'];

        return ($count >= 1);
    }

    public function createPage($title, $slug, $content): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO `pages` (`title`, `slug`, `content`) VALUES (:title, :slug, :content)");

        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':slug', $slug);
        $stmt->bindValue(':content', $content);

        $stmt->execute();

        $result = $stmt->fetch();

        return ($result === 1);
    }

    public function getAllEntries()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `pages` ORDER BY `id` ASC");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);

        $entries = $stmt->fetchAll();

        return $entries;
    }

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
