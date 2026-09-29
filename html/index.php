<?php
$pageTitle = 'Exclusive Website';
$pageDescription = 'Premium Maxy Fusion portfolio, artwork showcase and booking centre.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="hero">
    <div class="hero-media"><img src="../img/photo1.png" alt="Maxy Fusion cinematic portrait"></div>
    <div class="hero-content">
        <p class="eyebrow">Exclusive Website • Portfolio • Artwork Showcase</p>
        <h1><span class="gradient-text">Maxy</span><br>Fusion</h1>
        <p><?= $brand['caption'] ?> This premium archive brings together photography, videography, visual storytelling, creative direction, signature works, camera work, collaborations and project booking in one cinematic experience.</p>
        <div class="hero-actions">
            <a class="btn magnetic" href="portfolio.php">Explore Portfolio</a>
            <a class="btn ghost magnetic" href="booking.php">Start Booking</a>
            <a class="btn gold magnetic" href="production.php">Watch Production</a>
        </div>
        <div class="hero-stats">
            <div class="stat-card"><strong data-count="2" data-suffix="Y+">0</strong><span>Development Journey</span></div>
            <div class="stat-card"><strong data-count="18" data-suffix="+">0</strong><span>Program Coverage</span></div>
            <div class="stat-card"><strong data-count="5" data-suffix="+">0</strong><span>Awards / Recognitions</span></div>
            <div class="stat-card"><strong data-count="30" data-suffix="+">0</strong><span>Creative Categories</span></div>
        </div>
    </div>
</section>
<section class="marquee">
    <div class="marquee-track">
        <?php for($r=0;$r<2;$r++): foreach($keywords as $word): ?>
            <span><?= htmlspecialchars($word) ?> <b>✦</b></span>
        <?php endforeach; endfor; ?>
    </div>
</section>
<section class="section">
    <div class="section-head reveal">
        <div><p class="eyebrow">The Premium Experience</p><h2>High-end creative system for every visual story.</h2></div>
        <p>Designed as a complete digital identity: portfolio, artwork showcase, history, achievements, services, booking centre, production archive, social proof, FAQ, and professional guidelines.</p>
    </div>
    <div class="grid three">
        <article class="card feature-card"><span class="pill">01 Portfolio</span><h3>Curated visual storytelling</h3><p>Premium photography, videography, model portfolio, featured projects, signature works and camera direction in one showcase.</p></article>
        <article class="card feature-card"><span class="pill">02 Booking Centre</span><h3>From idea to production</h3><p>Project inquiry, availability check, service packages and clear client journey built for serious creative requests.</p></article>
        <article class="card feature-card"><span class="pill">03 Archive</span><h3>History with identity</h3><p>A digital gallery that records achievements, events, media coverage, collaborations and the creative journey of Maxy Fusion.</p></article>
    </div>
</section>
<section class="section tight split">
    <div class="image-stack reveal">
        <img src="../img/photo2.png" alt="Portfolio frame">
        <img src="../img/artwork12.png" alt="Stage performance">
        <img src="../img/my_portrait.png" alt="Maxy Fusion portrait">
    </div>
    <div class="showcase-panel glass reveal">
        <p class="eyebrow">Creative Direction</p>
        <h2>Not just a website. A living production archive.</h2>
        <p>Every page is crafted to feel cinematic, exclusive, and professional. The interface uses moving gradients, glass panels, interactive hover motion, filterable galleries, video previews, and strong brand language.</p>
        <div class="keyword-cloud">
            <?php foreach(array_slice($keywords, 0, 15) as $word): ?><span><?= htmlspecialchars($word) ?></span><?php endforeach; ?>
        </div>
    </div>
</section>
<section class="section">
    <div class="section-head reveal">
        <div><p class="eyebrow">Featured Projects</p><h2>Signature works and camera work.</h2></div>
        <a class="btn ghost" href="portfolio.php">View All Work</a>
    </div>
    <div class="grid four">
        <?php foreach(array_slice($portfolio, 0, 8) as $item): ?>
        <article class="card gallery-card" data-lightbox="../img/<?= htmlspecialchars($item['img']) ?>">
            <div class="card-media"><img src="../img/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"></div>
            <div class="card-body"><span class="pill"><?= htmlspecialchars($item['cat']) ?></span><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['desc']) ?></p></div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
<section class="section split">
    <div class="showcase-panel glass reveal">
        <p class="eyebrow">Booking Centre</p>
        <h2>Request a premium creative session.</h2>
        <p>Built for photography, videography, model portfolio, cinematic production, events, media coverage, creative direction and custom visual projects.</p>
        <a class="btn magnetic" href="booking.php">Open Booking Centre</a>
    </div>
    <div class="card reveal">
        <div class="card-media"><video src="../videos/video1.mp4" muted playsinline loop autoplay poster="../img/video1_thumbnail.jpg"></video></div>
        <div class="card-body"><span class="pill">Production Archive</span><h3>Motion, rhythm and cinematic energy.</h3><p>Use the production page to preview showreels, event highlights, and video archive materials.</p></div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
