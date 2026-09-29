<?php
$pageTitle = 'Terms & Guidelines';
$pageDescription = 'Booking terms and production guidelines for Maxy Fusion clients.';
$terms = [
    ['Reservation', 'A booking is confirmed once the date, service, scope, location and payment arrangement are agreed.'],
    ['Deposit', 'A deposit may be required to secure production time. The balance is paid according to the project agreement.'],
    ['Final output', 'Edited files are delivered digitally, based on the selected package and production timeline.'],
    ['Usage rights', 'Maxy Fusion may use selected work in its portfolio unless privacy is requested before production.'],
    ['Date changes', 'Rescheduling depends on availability and should be requested as early as possible.'],
    ['Respectful production', 'Clients and crew keep communication respectful and working conditions safe.'],
];
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Terms & guidelines', 'Clear terms that protect both client and creator and keep the process smooth.'); ?>

<section class="section tight">
    <div class="container narrow">
        <dl class="terms-list">
            <?php foreach ($terms as [$title, $text]): ?><div><dt><?= esc($title) ?></dt><dd><?= esc($text) ?></dd></div><?php endforeach; ?>
        </dl>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
