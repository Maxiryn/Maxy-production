<?php
$pageTitle = 'Journey';
$pageDescription = 'The history and creative journey of Maxy Fusion.';
$phases = [
    ['label' => 'The spark', 'title' => 'Creative foundation', 'text' => 'A personal creative identity for photography, videography, music, event coverage and visual experiments.'],
    ['label' => 'The camera work', 'title' => 'Practice becomes signature', 'text' => 'Camera movement, framing, lighting and story direction became the core of the Maxy Fusion style.'],
    ['label' => 'The archive', 'title' => 'Portfolio and artwork', 'text' => 'Work is curated into galleries, a film archive, a model portfolio and featured projects.'],
    ['label' => 'The studio', 'title' => 'A client experience', 'text' => 'Bookings, service packages, clear terms and answers to common questions, all in one place.'],
];
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Journey', $brand['caption'] . ' Years of practice, event coverage and camera work shaped Maxy Fusion into what it is today.'); ?>

<section class="section tight" id="journey">
    <div class="container narrow">
        <ol class="timeline">
            <?php foreach ($phases as $i => $phase): ?>
            <li>
                <span class="step-label">Phase <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?> · <?= esc($phase['label']) ?></span>
                <h2><?= esc($phase['title']) ?></h2>
                <p><?= esc($phase['text']) ?></p>
            </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
