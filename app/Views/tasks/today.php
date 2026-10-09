<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero">
    <div>
        <p class="eyebrow"><?= esc($today) ?></p>
        <h1>Make today count<span class="accent-dot">.</span></h1>
        <p class="hero-copy">A clear view of what's on your plate today.</p>
    </div>
    <div class="hero-icon" aria-hidden="true">✦</div>
</section>

<section class="content-section" aria-labelledby="today-heading">
    <div class="section-heading">
        <div>
            <p class="eyebrow">YOUR FOCUS</p>
            <h2 id="today-heading">Today's tasks</h2>
        </div>
        <span class="count-pill"><?= count($tasks) ?> <?= count($tasks) === 1 ? 'task' : 'tasks' ?></span>
    </div>

    <?php if ($tasks === []): ?>
        <div class="empty-state">
            <span class="empty-icon" aria-hidden="true">✓</span>
            <h3>A little breathing room</h3>
            <p>There are no tasks scheduled for today.</p>
        </div>
    <?php else: ?>
        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <li class="task-card">
                    <span class="task-check <?= strtolower($task['status']) === 'completed' ? 'is-complete' : '' ?>" aria-hidden="true">
                        <?= esc(strtolower($task['status']) === 'completed' ? '✓' : '') ?>
                    </span>
                    <span class="task-title"><?= esc($task['title']) ?></span>
                    <span class="status-badge <?= esc(str_replace('_', '-', strtolower($task['status']))) ?>"><?= esc(ucfirst($task['status'])) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a class="text-link" href="<?= site_url('tasks') ?>">See all tasks <span aria-hidden="true">→</span></a>
</section>
<?= $this->endSection() ?>
