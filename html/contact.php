<?php
$pageTitle = 'Contact';
$pageDescription = 'Contact and social media links for Maxy Fusion.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Contact</span></div>
    <p class="eyebrow">Contact • Social Media • Project Inquiry</p>
    <h1><span class="gradient-text">Contact</span></h1>
    <p>Connect for project inquiry, collaborations, media coverage, events, availability, and creative production discussions.</p>
</section>
<section class="section tight split">
    <div class="showcase-panel glass">
        <h2>Let’s build the next visual story.</h2>
        <div class="contact-list">
            <a href="mailto:<?= htmlspecialchars($brand['email']) ?>"><?= htmlspecialchars($brand['email']) ?></a>
            <span><?= htmlspecialchars($brand['phone']) ?></span>
            <span><?= htmlspecialchars($brand['location']) ?></span>
        </div>
    </div>
    <div class="showcase-panel glass">
        <p class="eyebrow">Social Media</p>
        <div class="social-wall">
            <a href="#">Instagram</a>
            <a href="#">TikTok</a>
            <a href="#">YouTube</a>
            <a href="#">Facebook</a>
            <a href="#">WhatsApp</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
