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
                <p class="eyebrow">CUSTOMER DIRECTORY</p>
                <h1><?= esc($title) ?></h1>
            </div>
            <a class="button" href="<?= site_url('customers/new') ?>">New Customer</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= esc($customer['full_name']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td><?= esc($customer['phone'] ?? '') ?></td>
                            <td><a href="<?= site_url('customers/edit/' . $customer['id']) ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if ($customers === []): ?>
                        <tr><td colspan="4" class="empty-cell">No customer accounts yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>