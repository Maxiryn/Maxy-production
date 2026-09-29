<?php
$pageTitle = 'Awards';
$pageDescription = 'Maxy Fusion achievements, awards and recognitions.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Awards & recognition', 'Milestones that shaped the identity and production confidence of Maxy Fusion.'); ?>

<section class="section tight">
    <div class="container narrow">
        <ul class="award-list">
            <?php foreach ($awards as $item): ?>
            <li><span class="year"><?= esc($item['year']) ?></span><div><h2><?= esc($item['title']) ?></h2><p><?= esc($item['desc']) ?></p></div></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
