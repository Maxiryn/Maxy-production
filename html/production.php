<?php
$pageTitle = 'Films';
$pageDescription = 'Performance films, production reels and event highlights by Maxy Fusion.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Films', 'Performance films, production reels and event highlights.'); ?>

<section class="section tight">
    <div class="container">
        <div class="tile-grid films">
            <?php foreach ($videos as $v): ?>
            <figure class="tile film">
                <a class="tile-media" href="../videos/<?= esc($v['file']) ?>" data-lightbox data-type="video" data-poster="../img/<?= esc($v['thumb']) ?>" data-caption="<?= esc($v['title']) ?>">
                    <img src="../img/<?= esc($v['thumb']) ?>" alt="<?= esc($v['title']) ?>" loading="lazy" decoding="async">
                    <span class="play" aria-hidden="true"></span>
                </a>
                <figcaption><span><?= esc($v['title']) ?></span><small><?= esc($v['desc']) ?></small></figcaption>
            </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
