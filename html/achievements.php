<?php
$pageTitle = 'Achievements & Awards';
$pageDescription = 'Maxy Fusion achievements, awards and recognitions.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Achievements & Awards</span></div>
    <p class="eyebrow">Achievements • Awards • Media Coverage</p>
    <h1><span class="gradient-text">Awards</span></h1>
    <p>Selected milestones that shaped the credibility, identity and production confidence of Maxy Fusion.</p>
</section>
<section class="section tight">
    <div class="grid two">
        <?php foreach($awards as $item): ?>
        <article class="card"><div class="card-body"><span class="pill"><?= htmlspecialchars($item['year']) ?></span><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['desc']) ?></p></div></article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
