<?php
require_once __DIR__ . '/../lib/supabase.php';
$csrf = csrf(); $message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_post();
    try {
        $email=field('email',254); $name=field('full_name',200); $password=(string)($_POST['password'] ?? '');
        if (!filter_var($email,FILTER_VALIDATE_EMAIL) || !$name || strlen($password)<12 || $password !== ($_POST['confirm_password'] ?? '')) throw new RuntimeException('Enter your name, a valid email, and matching passwords of at least 12 characters.');
        $data=sb('/auth/v1/signup','POST',['email'=>$email,'password'=>$password,'data'=>['full_name'=>$name,'nickname'=>field('nickname',100)]]);
        if (!empty($data['access_token'])) { save_auth($data); go('profile.php'); }
        $message='Check your email to confirm your account, then return here to sign in.';
    } catch (RuntimeException $e) { $message=$e->getMessage(); }
}
page_start('Create Account'); if($message) notice($message);
?><form method="post" class="form-grid"><?= $csrf ?>
<?php input('full_name','Full name','','text',true); input('nickname','Nickname'); input('email','Email','','email',true); input('password','Password (at least 12 characters)','','password',true); input('confirm_password','Confirm password','','password',true); ?>
<button class="btn" type="submit">Create account</button></form><p><a href="login.php">Sign in</a></p>
<?php page_end(); ?>
