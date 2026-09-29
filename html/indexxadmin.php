<?php
require_once __DIR__ . '/../lib/supabase.php'; require_user(true); $csrf=csrf(); $message='';
try {
 if($_SERVER['REQUEST_METHOD']==='POST') { check_post(); $id=rawurlencode(field('booking_id',36)); $status=field('status',30); if(!in_array($status,['Pending','Confirmed','Completed','Cancelled'],true)) throw new RuntimeException('Invalid status.'); db('bookings?id=eq.'.$id,'PATCH',['status'=>$status],'return=minimal'); $message='Booking updated.'; }
 $bookings=db('bookings?order=created_at.desc');
} catch(RuntimeException $e) { $message=$e->getMessage(); $bookings=[]; }
page_start('Booking Report'); if($message) notice($message);
?><p><a href="feedbackadmin.php">Feedback</a> · <a href="portfolioadmin.php">Services</a> · <a href="logout.php">Sign out</a></p>
<?php if(!$bookings) notice('No bookings yet.'); foreach($bookings as $b): ?><article class="card"><div class="card-body"><h2><?= esc($b['name']) ?> — <?= esc($b['service']) ?></h2>
<?php foreach(['email','phone','preferred_date','budget','message','status'] as $field) echo '<p>'.esc(ucwords(str_replace('_',' ',$field))).': '.esc($b[$field]).'</p>'; ?>
<form method="post"><?= $csrf ?><input type="hidden" name="booking_id" value="<?= esc($b['id']) ?>"><label>Status <select name="status"><?php foreach(['Pending','Confirmed','Completed','Cancelled'] as $s): ?><option <?= $s===$b['status']?'selected':'' ?>><?= esc($s) ?></option><?php endforeach; ?></select></label><button class="btn">Save status</button></form></div></article><?php endforeach; page_end(); ?>
