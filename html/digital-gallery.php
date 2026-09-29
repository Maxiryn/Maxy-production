<?php
$pageTitle = 'Full Gallery';
$pageDescription = 'Every image in the Maxy Fusion archive on one page.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Full gallery', 'Every image in the archive on one page.'); ?>

<section class="section tight">
    <div class="container">
        <div class="tile-grid dense">
            <?php foreach (array_merge($portfolio, $artworks) as $item) work_tile($item['img'], $item['title'], $item['cat'] ?? $item['tag'], '', false); ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
