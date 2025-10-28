<?php

namespace App\Repository;

use App\Models\PageModel;
use PDO;

class PageRepository
{

    public function __construct(private PDO $pdo) {}

    // check if slug exist
    public function checkSlug($slug): bool
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS `count` FROM `pages` WHERE `slug` = :slug");
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();

        $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return ($count['count'] >= 1);
    }

    // create new page
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

    // edit page
    public function editPage($title, $content, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE `pages` SET `title` = :title,  `content` = :content WHERE `id` = :id");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    // delete page by id 
    public function deleteById(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `pages` WHERE `id` = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    // get all the pages
    public function getAllEntries()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `pages` ORDER BY `id` ASC");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);

        $entries = $stmt->fetchAll();

        return $entries;
    }

    // fetch all the pages
    public function fetchPages()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `pages` ORDER BY `id` ASC");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);

        $pages = $stmt->fetchAll();

        return $pages;
    }

    // fetch by id
    public function fetchById($id): ?PageModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `pages` WHERE `id` = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);

        $page = $stmt->fetch();

        if (!empty($page)) {
            return $page;
        } else {
            return null;
        }
    }

    // fetch page by slug
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
