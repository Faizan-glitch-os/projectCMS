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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= $entry->id ?></td>
                <td><?= $entry->title ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>