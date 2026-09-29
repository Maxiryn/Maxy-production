<?php
$pageTitle = 'Portfolio';
$pageDescription = 'Selected portrait, event and stage photography by Maxy Fusion.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Portfolio', 'Selected portraits, events and stage performances. Open any image to view it larger.'); ?>

<section class="section tight">
    <div class="container">
        <div class="filters" role="group" aria-label="Filter by category">
            <?php $cats = array_merge(['All'], array_values(array_unique(array_column($portfolio, 'cat')))); foreach ($cats as $cat): ?>
                <button class="filter-btn" type="button" data-filter="<?= esc($cat) ?>" aria-pressed="<?= $cat === 'All' ? 'true' : 'false' ?>"><?= esc($cat) ?></button>
            <?php endforeach; ?>
        </div>
        <div class="tile-grid wide">
            <?php foreach ($portfolio as $item) work_tile($item['img'], $item['title'], $item['cat'], $item['cat']); ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
