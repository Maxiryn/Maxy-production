<?php
require_once __DIR__ . '/../lib/supabase.php'; $user=require_user(); check_post();
try { $rating=(int)field('rating',1); $comment=field('feedback',5000); if(!$comment || $rating<1 || $rating>5) throw new RuntimeException('Enter feedback and a rating from 1 to 5.'); db('feedback','POST',['user_id'=>$user['id'],'booking_id'=>field('booking_id',36),'rating'=>$rating,'comment'=>$comment],'return=minimal'); go('profile.php'); }
catch(RuntimeException $e) { http_response_code(400); page_start('Feedback not saved'); notice($e->getMessage()); page_end(); }
