<?php

/**
 * @var PageModel[] $entries
 */

?>

<h1>Admin: Manage Entries</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= $entry->id ?></td>
                <td><?= $entry->title ?></td>
                <td><?= $entry->slug ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="index.php?<?= http_build_query(['route' => 'admin/pages/create']) ?>">Create page</a>