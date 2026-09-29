<?php
$pageTitle = 'Production Archive';
$pageDescription = 'Cinematic production and video archive.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Production Archive</span></div>
    <p class="eyebrow">Cinematic Production • Videography • Production Archive</p>
    <h1><span class="gradient-text">Production</span></h1>
    <p>Motion-led works for performance, event coverage, creative reels and visual storytelling. Tap a video card to preview.</p>
</section>
<section class="section tight">
    <div class="grid three">
        <?php foreach($videos as $v): ?>
        <article class="card gallery-card" data-lightbox="../videos/<?= htmlspecialchars($v['file']) ?>" data-type="video">
            <div class="card-media"><img src="../img/<?= htmlspecialchars($v['thumb']) ?>" alt="<?= htmlspecialchars($v['title']) ?>"></div>
            <div class="card-body"><span class="pill">Video Archive</span><h3><?= htmlspecialchars($v['title']) ?></h3><p><?= htmlspecialchars($v['desc']) ?></p></div>
        </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
