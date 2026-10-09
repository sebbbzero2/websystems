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

    <main class="page">
        <div class="page-heading">
            <div>
                <p class="eyebrow">USER DIRECTORY</p>
                <h1><?= esc($title) ?></h1>
            </div>
            <a class="button" href="<?= site_url('users/new') ?>">New User</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <?php
                                $avatar = ! empty($user['avatar']) ? basename($user['avatar']) : '';
                                $avatarUrl = $avatar !== '' && is_file(FCPATH . 'uploads/' . $avatar)
                                    ? '/uploads/' . rawurlencode($avatar)
                                    : '/assets/images/avatar-placeholder.svg';
                                ?>
                                <img class="avatar" src="<?= esc($avatarUrl) ?>" alt="">
                            </td>
                            <td><?= esc($user['username']) ?></td>
                            <td><?= esc($user['full_name']) ?></td>
                            <td><?= esc($user['created_at']) ?></td>
                            <td><a href="<?= site_url('users/edit/' . $user['id']) ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if ($users === []): ?>
                        <tr><td colspan="5" class="empty-cell">No user accounts yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>