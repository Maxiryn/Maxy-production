<?php
$pageTitle = 'Artwork';
$pageDescription = 'Artwork studies from the Maxy Fusion archive: portraits, live performance and street photography.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Artwork', 'Sixteen studies from the archive, grouped by subject.'); ?>

<?php foreach ($artworkGroups as $group => $numbers): ?>
<section class="section tight">
    <div class="container">
        <div class="section-head small"><h2><?= esc($group) ?></h2><span class="muted"><?= count($numbers) ?> images</span></div>
        <div class="tile-grid">
            <?php foreach ($artworks as $item) if ($item['tag'] === $group) work_tile($item['img'], $item['title'], $group, '', false); ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
