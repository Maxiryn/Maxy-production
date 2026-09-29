<?php
$pageTitle = 'About';
$pageDescription = 'About Maxy Fusion: photography, videography and creative direction.';
$disciplines = [
    ['name' => 'Photography', 'text' => 'Portrait, event, model, graduation and editorial work. Clean, timeless and emotional.'],
    ['name' => 'Videography', 'text' => 'Event recaps, highlight films, production coverage and short cutdowns for social media.'],
    ['name' => 'Direction', 'text' => 'Planning, mood, pacing and camera work, from the first concept to the final frame.'],
];
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('About the studio', 'Maxy Fusion is a creative production identity focused on photography, videography, camera work and visual storytelling.'); ?>

<section class="section tight">
    <div class="container split">
        <div class="prose">
            <h2>Every frame needs emotion, rhythm and purpose.</h2>
            <p>The work spans cinematic portraits, stage and performance coverage, events and digital artwork. Each project is planned around the story it has to tell, and delivered ready to share.</p>
            <p><?= esc($brand['caption']) ?> What started as personal practice in photography, video and music has grown into an archive of award-winning work and a clear client process.</p>
            <p><a class="text-link" href="history.php">Read the journey <span aria-hidden="true">→</span></a></p>
        </div>
        <figure class="portrait">
            <img src="../img/my_portrait.png" alt="Maxy Fusion creative director holding a camera stabiliser" width="200" height="200">
            <figcaption>Creative director, Maxy Fusion</figcaption>
        </figure>
    </div>
</section>

<section class="section tight">
    <div class="container">
        <h2 class="visually-hidden">Disciplines</h2>
        <div class="columns three">
            <?php foreach ($disciplines as $item): ?>
            <div class="column"><h3><?= esc($item['name']) ?></h3><p><?= esc($item['text']) ?></p></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
