<?php
require_once __DIR__ . '/../lib/supabase.php'; require_user(true); $rows=db('feedback?select=*,bookings(name,service)&order=created_at.desc');
page_start('Client Feedback'); ?><p><a href="indexxadmin.php">Booking Report</a> · <a href="portfolioadmin.php">Services</a></p>
<?php if(!$rows) notice('No feedback yet.'); foreach($rows as $r): ?><article class="card"><div class="card-body"><h3><?= esc($r['bookings']['name'] ?? '') ?> — <?= esc($r['bookings']['service'] ?? '') ?></h3><p><?= esc($r['rating']) ?>/5</p><p><?= esc($r['comment']) ?></p></div></article><?php endforeach; page_end(); ?>
