<?php

/**
 * @var PageModel[] $entries
 */

?>


<div class="container text-center">
    <div class="row">
        <h2 class="text-success text-center my-4">Manage Entries</h2>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider align-baseline">
                <?php foreach ($entries as $entry): ?>
                    <tr>
                        <td><?= e($entry->id) ?></td>
                        <td><?= e($entry->title) ?></td>
                        <td><?= e($entry->slug) ?></td>
                        <td>
                            <a class="link-offset-2-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="index.php?<?= http_build_query(['route' => 'admin/pages/edit', 'id' => e($entry->id)]) ?>">Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="index.php?<?= http_build_query(['route' => 'admin/pages/delete']) ?>">
                                <input type="hidden" name="id" value="<?= e($entry->id) ?>">
                                <input class="form-control" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <a class="link-offset-2-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="index.php?<?= http_build_query(['route' => 'admin/pages/create']) ?>">Create page</a>
    </div>
</div>