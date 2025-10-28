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
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= e($entry->id) ?></td>
                <td><?= e($entry->title) ?></td>
                <td><?= e($entry->slug) ?></td>
                <td>
                    <form method="POST" action="index.php?<?= http_build_query(['route' => 'admin/pages/delete']) ?>">
                        <input type="hidden" name="id" value="<?= e($entry->id) ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
                <td>
                    <a href="index.php?<?= http_build_query(['route' => 'admin/pages/edit', 'id' => e($entry->id)]) ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="index.php?<?= http_build_query(['route' => 'admin/pages/create']) ?>">Create page</a>