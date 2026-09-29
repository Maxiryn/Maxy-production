<?php
require_once __DIR__ . '/../lib/supabase.php'; $user=require_user(); $csrf=csrf(); $message=''; $id=rawurlencode($user['id']);
try {
 if($_SERVER['REQUEST_METHOD']==='POST') {
  check_post();
  if(($_POST['action'] ?? '')==='cancel') {
   db('bookings?id=eq.'.rawurlencode(field('booking_id',36)).'&user_id=eq.'.$id.'&status=eq.Pending','DELETE',null,'return=minimal'); $message='Pending booking cancelled.';
  } else {
   $data=['id'=>$user['id']];
   foreach(['full_name','nickname','ic_number','address'] as $key) $data[$key]=field($key);
   $data['age']=field('age',3)===''?null:(int)field('age',3); $data['dob']=field('dob',10) ?: null;
   db('profiles?on_conflict=id','POST',$data,'resolution=merge-duplicates,return=minimal'); $message='Profile saved.';
  }
 }
 $profile=db('profiles?id=eq.'.$id)[0] ?? ['full_name'=>$user['user_metadata']['full_name'] ?? '', 'nickname'=>$user['user_metadata']['nickname'] ?? ''];
 $bookings=db('bookings?user_id=eq.'.$id.'&order=created_at.desc');
 $feedback=db('feedback?user_id=eq.'.$id.'&order=created_at.desc');
} catch(RuntimeException $e) { $message=$e->getMessage(); $profile=$profile ?? []; $bookings=$bookings ?? []; $feedback=$feedback ?? []; }
page_start('Your Profile'); if($message) notice($message);
?><p><?= esc($user['email']) ?> · <a href="logout.php">Sign out</a></p><h2>Personal information</h2>
<form method="post" class="form-grid"><?= $csrf ?><input type="hidden" name="action" value="profile">
<?php foreach(['full_name'=>'Full name','nickname'=>'Nickname','ic_number'=>'IC number (optional)','address'=>'Address (optional)','age'=>'Age (optional)','dob'=>'Date of birth (optional)'] as $key=>$label) input($key,$label,(string)($profile[$key] ?? ''),$key==='dob'?'date':($key==='age'?'number':'text')); ?>
<button class="btn" type="submit">Save profile</button></form>
<h2>Your bookings</h2><p>Bookings made while signed in appear here. Guest inquiries are handled directly by the studio.</p>
<?php if(!$bookings) notice('No bookings yet.'); foreach($bookings as $b): ?>
<article class="card"><div class="card-body"><h3><?= esc($b['service']) ?></h3><p><?= esc($b['preferred_date']) ?> · <?= esc($b['status']) ?></p><p><?= esc($b['message']) ?></p>
<?php if($b['status']==='Pending'): ?><form method="post"><?= $csrf ?><input type="hidden" name="action" value="cancel"><input type="hidden" name="booking_id" value="<?= esc($b['id']) ?>"><button class="btn ghost">Cancel pending booking</button></form><?php endif; ?>
</div></article><?php endforeach; ?>
<h2>Feedback</h2><?php foreach($feedback as $f) notice($f['comment']); ?>
<?php if($bookings): ?><form method="post" action="submit_feedback.php" class="form-grid"><?= $csrf ?><div class="form-field"><label for="booking_id">Booking</label><select id="booking_id" name="booking_id"><?php foreach($bookings as $b): ?><option value="<?= esc($b['id']) ?>"><?= esc($b['service']) ?> — <?= esc($b['preferred_date']) ?></option><?php endforeach; ?></select></div>
<?php input('rating','Rating (1–5)','5','number',true); ?><div class="form-field full"><label for="feedback">Your feedback</label><textarea id="feedback" name="feedback" maxlength="5000" required></textarea></div><button class="btn">Submit feedback</button></form><?php endif; page_end(); ?>
