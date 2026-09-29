<?php
$pageTitle = 'Model Portfolio';
$pageDescription = 'Portrait and model portfolio photography by Maxy Fusion.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Model portfolio', 'Portrait work focused on styling, posture and clean composition.'); ?>

<section class="section tight">
    <div class="container">
        <div class="tile-grid wide">
            <?php foreach ($portfolio as $item) if (in_array($item['cat'], ['Model Portfolio', 'Photography'], true)) work_tile($item['img'], $item['title'], $item['desc']); ?>
        </div>
        <p class="after-grid"><a class="btn ghost" href="services.php">Model portfolio packages</a></p>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
