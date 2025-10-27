<h1>Create Page</h1>

<form method="POST" action="index.php?<?= http_build_query(['route' => 'admin/pages/create']) ?>">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php if (isset($_POST['title'])) echo e($_POST['title']) ?>" required>

    <label for="slug">Slug:</label>
    <input type="text" id="slug" name="slug" value="<?php if (isset($_POST['slug'])) echo e($_POST['slug']) ?>" required>

    <label for="content">Content:</label>
    <textarea name="content" id="content" rows="5" required><?php if (isset($_POST['content'])) echo e($_POST['content']) ?></textarea>

    <button type="submit">Submit</button>
</form>