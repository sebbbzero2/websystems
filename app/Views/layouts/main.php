<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A simple task management system for today's priorities.">
    <title><?= esc($title) ?> | POS System</title>
    <link rel="stylesheet" href="/assets/css/tasks.css">
</head>
<body>
    <div class="site-shell">
        <header class="site-header">
            <a class="brand" href="<?= site_url('/') ?>" aria-label="POS System home">
                <span class="brand-mark" aria-hidden="true">T</span>
                <span>POS System</span>
            </a>
            <nav class="main-nav" aria-label="Main navigation">
                <a href="<?= site_url('/') ?>" class="<?= uri_string() === '' ? 'active' : '' ?>">Today</a>
                <a href="<?= site_url('tasks') ?>" class="<?= uri_string() === 'tasks' ? 'active' : '' ?>">All tasks</a>
                <a href="<?= site_url('profile') ?>" class="<?= uri_string() === 'profile' ? 'active' : '' ?>">Profile</a>
                <a href="<?= site_url('about') ?>" class="<?= uri_string() === 'about' ? 'active' : '' ?>">About</a>
            </nav>
        </header>

        <main class="main-content">
            <?= $this->renderSection('content') ?>
        </main>

        <footer class="site-footer">
            <span>POS System</span>
            <span>Small steps, thoughtfully planned.</span>
        </footer>
    </div>
</body>
</html>
