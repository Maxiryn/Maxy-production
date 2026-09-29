<?php
require_once __DIR__ . '/../lib/supabase.php'; $csrf=csrf();
if ($_SERVER['REQUEST_METHOD']==='POST') {
 check_post();
 if(!empty($_COOKIE['maxy_access'])) { try { sb('/auth/v1/logout','POST',[], $_COOKIE['maxy_access']); } catch(RuntimeException $e) {} }
 cookie_value('maxy_access','',time()-3600); cookie_value('maxy_refresh','',time()-3600); go('index.php');
}
page_start('Sign out'); ?><form method="post"><?= $csrf ?><button class="btn" type="submit">Sign out</button></form><?php page_end(); ?>
