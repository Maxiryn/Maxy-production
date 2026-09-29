<?php
$pageTitle = 'Service Packages';
$pageDescription = 'Photography, videography, model portfolio and production packages from Maxy Fusion.';
?>
<?php require_once __DIR__ . '/../lib/supabase.php'; require_once __DIR__ . '/partials/data.php'; try { $stored=db('services?active=eq.true&order=created_at'); if($stored) $services=$stored; } catch(RuntimeException $e) {} require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Service packages', 'Starting prices for the most requested services. Final quotes depend on scope, location and delivery.'); ?>

<section class="section tight">
    <div class="container">
        <div class="package-grid">
            <?php foreach ($services as $item): ?>
            <article class="package">
                <span class="tag"><?= esc($item['tag']) ?></span>
                <h2><?= esc($item['name']) ?></h2>
                <p class="price"><?= esc($item['price']) ?></p>
                <ul class="check-list"><?php foreach ($item['points'] as $p): ?><li><?= esc($p) ?></li><?php endforeach; ?></ul>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="cta-band slim">
            <p>Not sure which package fits? Describe the project and we will suggest one.</p>
            <a class="btn" href="booking.php">Check availability</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
