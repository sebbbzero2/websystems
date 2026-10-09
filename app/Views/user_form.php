<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="/assets/css/accounts.css">
</head>
<body>
    <?= view('navbar') ?>

    <main class="page form-page">
        <a class="back-link" href="<?= site_url('users') ?>">← User Accounts</a>
        <h1><?= esc($title) ?></h1>

        <?php if ($errors !== []): ?>
            <div class="form-errors" role="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="account-form" action="<?= $user === null ? site_url('users/new') : site_url('users/edit/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <label for="username">Username</label>
            <input id="username" name="username" type="text" maxlength="50" value="<?= esc(old('username', $user['username'] ?? '')) ?>" required>

            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" type="text" maxlength="100" value="<?= esc(old('full_name', $user['full_name'] ?? '')) ?>" required>

            <?php if ($user !== null): ?>
                <label for="avatar">Profile Picture</label>
                <div class="avatar-field">
                    <img class="avatar-preview" src="<?= ! empty($user['avatar']) ? '/uploads/' . rawurlencode($user['avatar']) : '/assets/images/avatar-placeholder.svg' ?>" alt="Current profile picture">
                    <div>
                        <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                        <small>JPG or PNG, maximum 2MB. The image will be resized to 300 × 300.</small>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-actions">
                <a class="button button-secondary" href="<?= site_url('users') ?>">Cancel</a>
                <button class="button" type="submit"><?= $user === null ? 'Create User' : 'Save Changes' ?></button>
            </div>
        </form>
    </main>
</body>
</html>
