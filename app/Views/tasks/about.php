<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <p class="eyebrow">A LITTLE ABOUT US</p>
    <h1>Simple by design<span class="accent-dot">.</span></h1>
    <p class="hero-copy">A small web systems project built around making each day easier to plan.</p>
</section>

<section class="about-card">
    <div class="about-symbol" aria-hidden="true">✳</div>
    <p class="eyebrow">THE PROJECT</p>
    <h2>Tasks for Today</h2>
    <p>This task management system was developed by the student developer as a web systems activity using CodeIgniter 4, PHP, and MySQL.</p>
    <div class="developer-tag"><span class="online-dot" aria-hidden="true"></span> Developer: Student Developer</div>
</section>
<?= $this->endSection() ?>
