<div class="container border border-1 p-5 my-4 rounded-4">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="row">
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <div class="row">
        <form class="form" action="index.php?<?= http_build_query(['route' => 'admin/login']) ?>" method="POST">
            <div class="mb-3">
                <label class="form-label text-black" for="email">Email Address</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="mb-3">
                <label class="form-label text-black" for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

</div>