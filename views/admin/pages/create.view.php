<div class="container p-4 my-4 rounded-4 border border-2">
    <div class="row text-center">
        <h1 class="text-black">Create Page</h1>
    </div>
    <div class="row">
        <form class="form" method="POST" action="index.php?<?= http_build_query(['route' => 'admin/pages/create']) ?>">
            <?php if (!empty($errors['allEmpty'])) : ?>
                <p class="fs-6 text-danger"><?= $errors['allEmpty'] ?></p>
            <?php endif ?>

            <div class="mb-3">
                <label class="form-label text-black opacity-75" for="title">Title:</label>
                <input class="form-control" type="text" id="title" name="title" value="<?php if (isset($_POST['title'])) echo e($_POST['title']) ?>">
                <?php if (!empty($errors['emptyTitle'])) : ?>
                    <p class="fs-6 text-danger"><?= $errors['emptyTitle'] ?></p>
                <?php endif ?>
            </div>


            <div class="mb-3">
                <label class="form-label text-black opacity-75" for="slug">Slug:</label>
                <input class="form-control" type="text" id="slug" name="slug" value="<?php if (isset($_POST['slug'])) echo e($_POST['slug']) ?>">
                <?php if (!empty($errors['emptySlug'])) : ?>
                    <p class="fs-6 text-danger"><?= $errors['emptySlug'] ?></p>
                <?php endif ?>
                <?php if (!empty($errors['duplicateSlug'])) : ?>
                    <p class="fs-6 text-danger"><?= $errors['duplicateSlug'] ?></p>
                <?php endif ?>
            </div>


            <div class="mb-3">
                <label class="form-label text-black opacity-75" for="content">Content:</label>
                <textarea class="form-control" name="content" id="content" rows="5"><?php if (isset($_POST['content'])) echo e($_POST['content']) ?></textarea>
                <?php if (!empty($errors['emptyContent'])) : ?>
                    <p class="fs-6 text-danger"><?= $errors['emptyContent'] ?></p>
                <?php endif ?>
            </div>

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</div>