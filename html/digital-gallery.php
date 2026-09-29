<?php
$pageTitle = 'Digital Gallery';
$pageDescription = 'Digital gallery and featured visual archive.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Digital Gallery</span></div>
    <p class="eyebrow">Digital Gallery • Featured Projects • Signature Works</p>
    <h1><span class="gradient-text">Gallery</span></h1>
    <p>A fast visual wall for previewing selected photography, artwork, events and production stills.</p>
</section>
<section class="section tight">
    <div class="grid four">
        <?php foreach(array_merge($portfolio, $artworks) as $item): $img = $item['img']; ?>
        <article class="card gallery-card" data-lightbox="../img/<?= htmlspecialchars($img) ?>"><div class="card-media"><img src="../img/<?= htmlspecialchars($img) ?>" alt="Digital gallery item"></div></article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
