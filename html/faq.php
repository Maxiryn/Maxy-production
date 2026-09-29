<?php
$pageTitle = 'FAQ';
$pageDescription = 'Frequently asked questions for Maxy Fusion clients.';
$faqs = [
    ['How do I book a session?', 'Use the booking form and include your service, date, budget and project details. We will contact you to confirm.'],
    ['Do you cover events?', 'Yes. Event photography, videography, media coverage and highlight films can all be requested.'],
    ['Can I request a custom concept?', 'Yes. Custom concepts can include creative direction, a moodboard, location planning and a production plan.'],
    ['How long does delivery take?', 'It depends on the service, project size and editing scope. The timeline is confirmed before production.'],
    ['Can the work stay private?', 'Yes. Let us know before production if the project should not appear in the portfolio or on social media.'],
    ['Do you provide raw files?', 'Raw files must be discussed before booking and may involve additional terms.'],
];
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Frequently asked questions', 'Quick answers before you book.'); ?>

<section class="section tight">
    <div class="container narrow">
        <div class="faq-list">
            <?php foreach ($faqs as $i => [$q, $a]): ?>
            <details class="faq-item"<?= $i === 0 ? ' open' : '' ?>><summary><?= esc($q) ?></summary><p><?= esc($a) ?></p></details>
            <?php endforeach; ?>
        </div>
        <p class="after-grid muted">Still have a question? <a class="text-link" href="contact.php">Get in touch</a>.</p>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
