<?php
$pageTitle = 'Photography & Film';
$pageDescription = 'Portrait, event and stage photography, film and creative direction by Maxy Fusion.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php $byImage = array_column($portfolio, null, 'img'); $featured = array_filter(array_map(fn($img) => $byImage[$img] ?? null, ['pic3.png','artwork12.png','pic1.png','artwork9.png','pic5.png','artwork13.png'])); ?>

<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow">Photography · Film · Creative direction</p>
            <h1>Every frame needs emotion, rhythm and <em>purpose.</em></h1>
            <p class="lead">Maxy Fusion creates portrait, event and stage photography and cinematic video across Malaysia, Borneo and beyond. <?= esc($brand['caption']) ?></p>
            <div class="actions">
                <a class="btn" href="portfolio.php">View work</a>
                <a class="btn ghost" href="booking.php">Book a session</a>
            </div>
            <dl class="facts">
                <div><dt>2+</dt><dd>Years of practice</dd></div>
                <div><dt>18+</dt><dd>Programs covered</dd></div>
                <div><dt><?= count($awards) ?></dt><dd>Awards &amp; recognitions</dd></div>
            </dl>
        </div>
        <div class="hero-media">
            <img src="../img/photo1.png" alt="Portrait of a woman with a clear umbrella among trees" width="1920" height="1080" fetchpriority="high">
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <h2>Selected work</h2>
            <a class="text-link" href="portfolio.php">View all work <span aria-hidden="true">→</span></a>
        </div>
        <div class="tile-grid">
            <?php foreach ($featured as $item) work_tile($item['img'], $item['title'], $item['cat']); ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <h2>Services</h2>
            <a class="text-link" href="services.php">See all packages <span aria-hidden="true">→</span></a>
        </div>
        <div class="service-row">
            <?php foreach ($services as $item): ?>
            <a class="service-link" href="services.php">
                <span class="tag"><?= esc($item['tag']) ?></span>
                <h3><?= esc($item['name']) ?></h3>
                <span class="price"><?= esc($item['price']) ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div>
            <h2>Recognition</h2>
            <p class="muted">Competition wins and roles that shaped how Maxy Fusion works today.</p>
            <a class="text-link" href="achievements.php">All awards <span aria-hidden="true">→</span></a>
        </div>
        <ul class="award-list compact">
            <?php foreach ($awards as $item): ?>
            <li><span class="year"><?= esc($item['year']) ?></span><span><?= esc($item['title']) ?></span></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-band">
            <div>
                <h2>Have a project in mind?</h2>
                <p>Share the date, the idea and the feeling you want to capture. We will reply to confirm availability and next steps.</p>
            </div>
            <div class="actions">
                <a class="btn" href="booking.php">Start a booking</a>
                <a class="btn ghost" href="mailto:<?= esc($brand['email']) ?>">Email us</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
