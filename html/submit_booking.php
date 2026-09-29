<?php
require_once __DIR__ . '/../lib/supabase.php'; check_post(); $ok=false; $message='';
try {
 $user=current_user(); $email=field('email',254); $name=field('name',200); $phone=field('phone',50); $service=field('service',100); $date=field('date',10);
 if(!$name || !$phone || !filter_var($email,FILTER_VALIDATE_EMAIL) || !in_array($service,['Photography','Videography','Model Portfolio','Event Coverage','Cinematic Production','Creative Direction'],true)) throw new RuntimeException('Please provide your name, email, phone and a valid service.');
 if($date && (!preg_match('/^\d{4}-\d{2}-\d{2}$/',$date) || !checkdate((int)substr($date,5,2),(int)substr($date,8,2),(int)substr($date,0,4)))) throw new RuntimeException('Please enter a valid date.');
 db('bookings','POST',['user_id'=>$user['id'] ?? null,'name'=>$name,'email'=>$email,'phone'=>$phone,'service'=>$service,'preferred_date'=>$date ?: null,'budget'=>field('budget',100),'message'=>field('message',5000)],'return=minimal');
 $ok=true; $message='Your project inquiry has been received. We will contact you to discuss the details.';
} catch(RuntimeException $e) { http_response_code(400); $message=$e->getMessage(); }
page_start($ok?'Inquiry Received':'Inquiry Not Saved'); notice($message); ?><a class="btn" href="booking.php">Back to Booking</a><?php page_end(); ?>
