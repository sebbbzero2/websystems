<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <p class="eyebrow">THE FULL PICTURE</p>
    <h1>All tasks<span class="accent-dot">.</span></h1>
    <p class="hero-copy">Every task, organized by date.</p>
</section>

<section class="content-section" aria-labelledby="all-tasks-heading">
    <div class="section-heading">
        <div>
            <p class="eyebrow">TASK OVERVIEW</p>
            <h2 id="all-tasks-heading">Your list</h2>
        </div>
        <span class="count-pill"><?= count($tasks) ?> <?= count($tasks) === 1 ? 'task' : 'tasks' ?></span>
    </div>

    <?php if ($tasks === []): ?>
        <div class="empty-state">
            <span class="empty-icon" aria-hidden="true">✦</span>
            <h3>Your list is ready</h3>
            <p>There are no tasks to show yet.</p>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table class="task-table">
                <thead>
                    <tr>
                        <th scope="col">Task</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td class="table-task-title"><?= esc($task['title']) ?></td>
                            <td><?= esc(date('M j, Y', strtotime($task['task_date']))) ?></td>
                            <td><span class="status-badge <?= esc(str_replace('_', '-', strtolower($task['status']))) ?>"><?= esc(ucfirst($task['status'])) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
