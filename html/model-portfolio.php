<?php
$pageTitle = 'Model Portfolio';
$pageDescription = 'Model portfolio and portrait showcase.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Model Portfolio</span></div>
    <p class="eyebrow">Model Portfolio • Portrait Direction • Editorial</p>
    <h1><span class="gradient-text">Model</span></h1>
    <p>Portrait-led showcase for confidence, styling, clean composition and professional model portfolio presentation.</p>
</section>
<section class="section tight">
    <div class="grid three">
        <?php foreach($portfolio as $item): if($item['cat']==='Model Portfolio' || $item['cat']==='Photography'): ?>
        <article class="card gallery-card" data-lightbox="../img/<?= htmlspecialchars($item['img']) ?>"><div class="card-media"><img src="../img/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"></div><div class="card-body"><span class="pill"><?= htmlspecialchars($item['cat']) ?></span><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['desc']) ?></p></div></article>
        <?php endif; endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
