<?php
$pageTitle = 'Client Experience';
$pageDescription = 'How a project with Maxy Fusion works, from first inquiry to final delivery.';
$stages = [
    ['label' => 'Before the shoot', 'title' => 'Concept alignment', 'text' => 'Mood, location, outfit, timeline, references and final output are agreed in advance.'],
    ['label' => 'During the shoot', 'title' => 'Directed with confidence', 'text' => 'Guided posing, framing and camera work, with creative decisions made on set.'],
    ['label' => 'After the shoot', 'title' => 'Careful delivery', 'text' => 'Curated selection, editing and export, delivered ready to share and archive.'],
];
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Client experience', 'What working together looks like, from the first message to the final delivery.'); ?>

<section class="section tight">
    <div class="container">
        <ol class="columns three steps">
            <?php foreach ($stages as $stage): ?>
            <li class="column"><span class="step-label"><?= esc($stage['label']) ?></span><h2><?= esc($stage['title']) ?></h2><p><?= esc($stage['text']) ?></p></li>
            <?php endforeach; ?>
        </ol>
        <p class="after-grid"><a class="btn" href="booking.php">Start a booking</a></p>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
