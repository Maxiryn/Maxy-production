<?php
$pageTitle = 'Service Packages';
$pageDescription = 'Premium photography, videography and production service packages.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Service Packages</span></div>
    <p class="eyebrow">Service Packages • Project Inquiry • Availability</p>
    <h1><span class="gradient-text">Services</span></h1>
    <p>Premium creative packages for photography, videography, model portfolio, events, cinematic production and full custom creative direction.</p>
</section>
<section class="section tight">
    <div class="grid four">
        <?php foreach($services as $item): ?>
        <article class="card"><div class="card-body"><span class="pill"><?= htmlspecialchars($item['tag']) ?></span><h3><?= htmlspecialchars($item['name']) ?></h3><div class="price"><?= htmlspecialchars($item['price']) ?></div><ul class="service-list"><?php foreach($item['points'] as $p): ?><li><?= htmlspecialchars($p) ?></li><?php endforeach; ?></ul></div></article>
        <?php endforeach; ?>
    </div>
    <div style="margin-top:30px"><a class="btn magnetic" href="booking.php">Check Availability</a></div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
