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
        <a class="back-link" href="<?= site_url('customers') ?>">← Customer Accounts</a>
        <h1><?= esc($title) ?></h1>

        <?php if ($errors !== []): ?>
            <div class="form-errors" role="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="account-form" action="<?= $customer === null ? site_url('customers/new') : site_url('customers/edit/' . $customer['id']) ?>" method="post">
            <?= csrf_field() ?>
            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" type="text" maxlength="100" value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>" required>

            <label for="email">Email Address</label>
            <input id="email" name="email" type="email" maxlength="100" value="<?= esc(old('email', $customer['email'] ?? '')) ?>" required>

            <label for="phone">Phone Number</label>
            <input id="phone" name="phone" type="text" maxlength="20" value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>">

            <div class="form-actions">
                <a class="button button-secondary" href="<?= site_url('customers') ?>">Cancel</a>
                <button class="button" type="submit"><?= $customer === null ? 'Create Customer' : 'Save Changes' ?></button>
            </div>
        </form>
    </main>
</body>
</html>
