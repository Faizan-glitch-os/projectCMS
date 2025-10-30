<div class="container w-50 bg-black opacity-75 border border-1 p-5 my-4 rounded-4">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <ul class="list-unstyled">
                <li class="fs-8 text-danger"><?= $error ?></li>
            </ul>
        <?php endforeach ?>
    <?php endif ?>
    <form action="index.php?<?= http_build_query(['route' => 'admin/login']) ?>" method="POST">
        <div class="mb-3">
            <label class="form-label text-white" for="email">Email Address</label>
            <input class="form-control" type="text" name="email" id="email">
        </div>
        <div class="mb-3">
            <label class="form-label text-white" for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>