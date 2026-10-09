<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <p class="eyebrow">YOUR SPACE</p>
    <h1>Profile<span class="accent-dot">.</span></h1>
    <p class="hero-copy">The account connected to this task list.</p>
</section>

<section class="profile-card">
    <?php if ($user === null): ?>
        <div class="empty-state">
            <span class="empty-icon" aria-hidden="true">☺</span>
            <h2>No profile found</h2>
            <p>Run the demo seeder to add the profile for this project.</p>
        </div>
    <?php else: ?>
        <div class="profile-avatar" aria-hidden="true"><?= esc(strtoupper(substr($user['full_name'], 0, 1))) ?></div>
        <p class="eyebrow">DEMO ACCOUNT</p>
        <h2><?= esc($user['full_name']) ?></h2>
        <p class="profile-handle">@<?= esc($user['username']) ?></p>
        <div class="profile-details">
            <div>
                <span class="detail-label">Email</span>
                <span><?= esc($user['email'] ?? '') ?></span>
            </div>
            <div>
                <span class="detail-label">Member since</span>
                <span><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></span>
            </div>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
