<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
</head>
<body>

    <?= view('navbar') ?>

    <h1><?= esc($title) ?></h1>

    <p>
        This basic POS website demonstrates CodeIgniter routes,
        controllers, views, and temporary array data.
    </p>

</body>
</html>