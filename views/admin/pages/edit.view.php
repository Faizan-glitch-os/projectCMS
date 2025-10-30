<div class="container rounded-3 border border-2 p-4 my-4">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <ul class="list-unstyled">
                <li class="fs-8 text-danger"><?= $error ?></li>
            </ul>
        <?php endforeach ?>
    <?php endif ?>
    <div class="row">
        <h2 class="text-black">Edit Page</h2>
    </div>
    <div class="row">
        <form class="form" method="POST" action="index.php?<?= http_build_query(['route' => 'admin/pages/edit', 'id' => e($toEdit->id)]) ?>">
            <?php if (!empty($errors)) : ?>
                <h3><?= $errors ?></h3>
            <?php endif ?>

            <div class="mb-3">
                <label class="form-label text-black opacity-75" for="title">Title:</label>
                <input class="form-control" type="text"
                    id="title" name="title"
                    value="<?php if (isset($_POST['title'])) echo e($_POST['title']);
                            else echo e($toEdit->title) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-black opacity-75" for="content">Content:</label>
                <textarea class="form-control" name="content"
                    id="content"
                    rows="5" required><?php if (isset($_POST['content'])) echo e($_POST['content']);
                                        else echo e($toEdit->content) ?></textarea>
            </div>


            <button class="btn btn-primary" type="submit">Edit</button>
        </form>
    </div>
</div>