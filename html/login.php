<?php
require_once __DIR__ . '/../lib/supabase.php';
$adminLogin = $adminLogin ?? false; $message = ''; $csrf = csrf();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_post();
    try {
        $data = sb('/auth/v1/token?grant_type=password', 'POST', ['email'=>field('email',254), 'password'=>(string)($_POST['password'] ?? '')]);
        if ($adminLogin && ($data['user']['app_metadata']['role'] ?? '') !== 'admin') throw new RuntimeException('This account does not have administrator access.');
        save_auth($data); go($adminLogin ? 'indexxadmin.php' : 'profile.php');
    } catch (RuntimeException $e) { $message = $e->getMessage(); }
}
page_start($adminLogin ? 'Admin Login' : 'Login');
if ($message) notice($message);
?><form method="post" class="form-grid"><?= $csrf ?>
<?php input('email','Email','','email',true); input('password','Password','','password',true); ?>
<button class="btn" type="submit">Sign in</button></form>
<p><a href="sign-up.php">Create an account</a> · <a href="<?= $adminLogin ? 'login.php' : 'admin_login.php' ?>"><?= $adminLogin ? 'Client login' : 'Admin login' ?></a></p>
<?php page_end(); ?>
