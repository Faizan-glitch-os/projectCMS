<h1>Create Page</h1>

<form method="POST" action="index.php?<?= http_build_query(['route' => 'admin/pages/create']) ?>">
    <?php if (!empty($errors['allEmpty'])) : ?>
        <h2><?= $errors['allEmpty'] ?></h2>
    <?php endif ?>

    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php if (isset($_POST['title'])) echo e($_POST['title']) ?>">
    <?php if (!empty($errors['emptyTitle'])) : ?>
        <p><?= $errors['emptyTitle'] ?></p>
    <?php endif ?>

    <label for="slug">Slug:</label>
    <input type="text" id="slug" name="slug" value="<?php if (isset($_POST['slug'])) echo e($_POST['slug']) ?>">
    <?php if (!empty($errors['emptySlug'])) : ?>
        <p><?= $errors['emptySlug'] ?></p>
    <?php endif ?>
    <?php if (!empty($errors['duplicateSlug'])) : ?>
        <p><?= $errors['duplicateSlug'] ?></p>
    <?php endif ?>

    <label for="content">Content:</label>
    <textarea name="content" id="content" rows="5"><?php if (isset($_POST['content'])) echo e($_POST['content']) ?></textarea>
    <?php if (!empty($errors['emptyContent'])) : ?>
        <p><?= $errors['emptyContent'] ?></p>
    <?php endif ?>

    <button type="submit">Submit</button>
</form>