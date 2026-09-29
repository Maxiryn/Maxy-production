<?php
$pageTitle = 'Contact';
$pageDescription = 'Contact Maxy Fusion for projects, collaborations, media coverage and events.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Contact', 'For projects, collaborations, media coverage and events.'); $social = array_filter($brand['social']); ?>

<section class="section tight">
    <div class="container split top">
        <dl class="contact-list">
            <div><dt>Email</dt><dd><a href="mailto:<?= esc($brand['email']) ?>"><?= esc($brand['email']) ?></a></dd></div>
            <div><dt>Phone</dt><dd><?= esc($brand['phone']) ?></dd></div>
            <div><dt>Based in</dt><dd><?= esc($brand['location']) ?></dd></div>
            <?php if ($social): ?>
            <div><dt>Social</dt><dd class="social-links"><?php foreach ($social as $label => $url): ?><a href="<?= esc($url) ?>" rel="noopener" target="_blank"><?= esc($label) ?></a><?php endforeach; ?></dd></div>
            <?php endif; ?>
        </dl>
        <div class="panel">
            <h2>Planning a shoot?</h2>
            <p class="muted">The booking form collects everything needed to confirm a date: service, budget and project details.</p>
            <a class="btn" href="booking.php">Book a session</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
