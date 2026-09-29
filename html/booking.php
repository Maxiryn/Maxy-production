<?php
require_once __DIR__ . '/../lib/supabase.php';
$csrf = csrf();
$user = current_user();
$pageTitle = 'Booking';
$pageDescription = 'Request a photography, videography or production booking with Maxy Fusion.';
$flow = [
    ['Inquiry', 'Send your service, date and concept using this form.'],
    ['Consultation', 'We agree on mood, location, output, timeline and direction.'],
    ['Production', 'The shoot or production happens with planned camera work.'],
    ['Delivery', 'Final edited files are delivered digitally.'],
];
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php page_header('Book a session', 'Tell us about your project. We will reply to confirm availability, scope and next steps.'); ?>

<section class="section tight">
    <div class="container booking-layout">
        <form class="panel" action="submit_booking.php" method="post">
            <?= $csrf ?>
            <p class="form-note"><?php if ($user): ?>Signed in as <?= esc($user['email'] ?? '') ?>. This booking will appear in <a href="profile.php">your account</a>.<?php else: ?>Booking as a guest. <a href="login.php">Sign in</a> first if you want to track this booking in your account.<?php endif; ?></p>
            <div class="form-grid">
                <div class="form-field"><label for="bk-name">Name</label><input id="bk-name" name="name" required autocomplete="name" placeholder="Your full name"></div>
                <div class="form-field"><label for="bk-email">Email</label><input id="bk-email" name="email" type="email" required autocomplete="email" placeholder="you@example.com"></div>
                <div class="form-field"><label for="bk-phone">Phone / WhatsApp</label><input id="bk-phone" name="phone" type="tel" required autocomplete="tel" placeholder="+60…"></div>
                <div class="form-field"><label for="bk-service">Service</label><select id="bk-service" name="service" required><option value="">Choose a service</option><option>Photography</option><option>Videography</option><option>Model Portfolio</option><option>Event Coverage</option><option>Cinematic Production</option><option>Creative Direction</option></select></div>
                <div class="form-field"><label for="bk-date">Preferred date <span class="optional">(optional)</span></label><input id="bk-date" name="date" type="date"></div>
                <div class="form-field"><label for="bk-budget">Budget</label><select id="bk-budget" name="budget"><option>To be discussed</option><option>Below RM500</option><option>RM500 - RM1,000</option><option>RM1,000 - RM3,000</option><option>RM3,000+</option></select></div>
                <div class="form-field full"><label for="bk-message">Project details</label><textarea id="bk-message" name="message" rows="6" placeholder="Concept, location, event type, mood, deadline and the output you need."></textarea></div>
            </div>
            <button class="btn" type="submit">Send inquiry</button>
        </form>
        <aside class="booking-aside">
            <h2>How it works</h2>
            <ol class="flow">
                <?php foreach ($flow as [$title, $text]): ?><li><strong><?= esc($title) ?></strong><span><?= esc($text) ?></span></li><?php endforeach; ?>
            </ol>
            <p class="muted">Prefer email? Write to <a class="text-link" href="mailto:<?= esc($brand['email']) ?>"><?= esc($brand['email']) ?></a>.</p>
            <p class="muted">See <a class="text-link" href="services.php">packages</a>, <a class="text-link" href="faq.php">FAQ</a> and <a class="text-link" href="terms.php">terms</a> before you book.</p>
        </aside>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
