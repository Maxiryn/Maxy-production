<?php
$pageTitle = 'Artwork Showcase';
$pageDescription = 'Premium artwork showcase and digital gallery.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Artwork Showcase</span></div>
    <p class="eyebrow">Digital Gallery • Artwork Showcase • Private Collection</p>
    <h1><span class="gradient-text">Artwork</span></h1>
    <p>A curated digital gallery for portraits, performance frames, event visuals, creative edits and archive-ready artwork.</p>
</section>
<section class="section tight">
    <div class="grid four">
        <?php foreach($artworks as $item): ?>
        <article class="card gallery-card" data-lightbox="../img/<?= htmlspecialchars($item['img']) ?>">
            <div class="card-media"><img src="../img/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"></div>
            <div class="card-body"><span class="pill"><?= htmlspecialchars($item['tag']) ?></span><h3><?= htmlspecialchars($item['title']) ?></h3><p>Selected for the Maxy Fusion digital archive and premium artwork showcase.</p></div>
        </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
