<?php
$pageTitle = 'Portfolio';
$pageDescription = 'Filterable photography, videography and camera work portfolio.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Portfolio</span></div>
    <p class="eyebrow">Portfolio • Photography • Videography • Camera Work</p>
    <h1><span class="gradient-text">Portfolio</span></h1>
    <p>A premium collection of visual storytelling, featured projects, model portraits, events, cinematic production and signature camera work.</p>
</section>
<section class="section tight">
    <div class="filters">
        <?php $cats = ['All','Photography','Model Portfolio','Events','Camera Work','Cinematic Production']; foreach($cats as $cat): ?>
            <button class="filter-btn <?= $cat==='All'?'active':'' ?>" data-filter="<?= $cat ?>"><?= $cat ?></button>
        <?php endforeach; ?>
    </div>
    <div class="grid four">
        <?php foreach($portfolio as $item): ?>
        <article class="card gallery-card" data-category="<?= htmlspecialchars($item['cat']) ?>" data-lightbox="../img/<?= htmlspecialchars($item['img']) ?>">
            <div class="card-media"><img src="../img/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"></div>
            <div class="card-body"><span class="pill"><?= htmlspecialchars($item['cat']) ?></span><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['desc']) ?></p></div>
        </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
