<h1>Edit Page</h1>
<form method="POST" action="index.php?<?= http_build_query(['route' => 'admin/pages/edit', 'id' => e($toEdit->id)]) ?>">
    <?php if (!empty($errors)) : ?>
        <h3><?= $errors ?></h3>
    <?php endif ?>

    <label for="title">Title:</label>
    <input type="text"
        id="title" name="title"
        value="<?php if (isset($_POST['title'])) echo e($_POST['title']);
                else echo e($toEdit->title) ?>" required>

    <label for="content">Content:</label>
    <textarea name="content"
        id="content"
        rows="5" required><?php if (isset($_POST['content'])) echo e($_POST['content']);
                            else echo e($toEdit->content) ?></textarea>

    <button type="submit">Submit</button>
</form>