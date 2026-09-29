<?php
declare(strict_types=1);
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
if (PHP_SAPI === 'cli-server' && preg_match('#^/(css|js|img|videos)/[a-zA-Z0-9_.-]+$#', $path) && is_file(__DIR__ . '/..' . $path)) return false;
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Cache-Control: private, no-store');
if ($path === '/') { header('Location: /html/index.php', true, 302); exit; }
$name = basename($path);
$allowed = ['index.php','about.php','achievements.php','artwork.php','booking.php','client-experience.php','contact.php','digital-gallery.php','faq.php','history.php','model-portfolio.php','portfolio.php','production.php','services.php','terms.php','video.php','login.php','admin_login.php','sign-up.php','signup_process.php','profile.php','logout.php','submit_booking.php','submit_feedback.php','update_profile.php','indexxadmin.php','feedbackadmin.php','portfolioadmin.php','indexx.php','indexxx.php','dashboard.php'];
if ($path !== '/html/' . $name || !in_array($name, $allowed, true)) { http_response_code(404); exit('Page not found.'); }
$_SERVER['PHP_SELF'] = $path;
try { require __DIR__ . '/../html/' . $name; }
catch (Throwable $e) {
    error_log('Application error: ' . get_class($e));
    http_response_code(503);
    echo '<p>We could not complete this request. Please try again shortly.</p>';
}
