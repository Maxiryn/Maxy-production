<?php
$pageTitle = 'Booking Centre';
$pageDescription = 'Premium project inquiry and booking centre.';
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Booking Centre</span></div>
    <p class="eyebrow">Booking Centre • Project Inquiry • Availability</p>
    <h1><span class="gradient-text">Booking</span></h1>
    <p>A seamless premium space to request photography, videography, model portfolio, event coverage and creative production services tailored to your vision.</p>
</section>
<section class="section tight split">
    <form class="showcase-panel glass" action="submit_booking.php" method="post">
        <div class="form-grid">
            <div class="form-field"><label>Name</label><input name="name" required placeholder="Your full name"></div>
            <div class="form-field"><label>Email</label><input name="email" type="email" required placeholder="your@email.com"></div>
            <div class="form-field"><label>Phone / WhatsApp</label><input name="phone" required placeholder="+60..."></div>
            <div class="form-field"><label>Service</label><select name="service" required><option value="">Choose service</option><option>Photography</option><option>Videography</option><option>Model Portfolio</option><option>Event Coverage</option><option>Cinematic Production</option><option>Creative Direction</option></select></div>
            <div class="form-field"><label>Preferred Date</label><input name="date" type="date"></div>
            <div class="form-field"><label>Budget Range</label><select name="budget"><option>To be discussed</option><option>Below RM500</option><option>RM500 - RM1,000</option><option>RM1,000 - RM3,000</option><option>RM3,000+</option></select></div>
            <div class="form-field full"><label>Project Details</label><textarea name="message" rows="6" placeholder="Tell me your concept, location, event type, mood, deadline and output needed."></textarea></div>
        </div>
        <br><button class="btn magnetic" type="submit">Submit Project Inquiry</button>
    </form>
    <aside class="showcase-panel glass">
        <p class="eyebrow">Client Flow</p>
        <h2>Clear, premium and professional.</h2>
        <div class="timeline">
            <div class="timeline-item"><strong>01 Inquiry</strong><p>Submit your project request with service, date and concept.</p></div>
            <div class="timeline-item"><strong>02 Consultation</strong><p>We align mood, location, output, timeline and creative direction.</p></div>
            <div class="timeline-item"><strong>03 Production</strong><p>Photography, videography or full production is executed with planned camera work.</p></div>
            <div class="timeline-item"><strong>04 Delivery</strong><p>Final visuals are delivered in a premium digital-ready format.</p></div>
        </div>
    </aside>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
