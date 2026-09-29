<?php
require_once __DIR__ . '/partials/data.php';
function clean($v){ return trim(str_replace(["\r","\n"], ' ', $v ?? '')); }
$fields = ['date_submitted'=>date('Y-m-d H:i:s'),'name'=>clean($_POST['name'] ?? ''),'email'=>clean($_POST['email'] ?? ''),'phone'=>clean($_POST['phone'] ?? ''),'service'=>clean($_POST['service'] ?? ''),'preferred_date'=>clean($_POST['date'] ?? ''),'budget'=>clean($_POST['budget'] ?? ''),'message'=>clean($_POST['message'] ?? '')];
$dataDir = dirname(__DIR__) . '/data';
if (!is_dir($dataDir)) { mkdir($dataDir, 0777, true); }
$file = $dataDir . '/bookings.csv';
$new = !file_exists($file);
$ok = false;
if ($handle = fopen($file, 'a')) {
    if ($new) { fputcsv($handle, array_keys($fields)); }
    fputcsv($handle, array_values($fields));
    fclose($handle); $ok = true;
}
$pageTitle = 'Booking Submitted';
$pageDescription = 'Booking inquiry submission result.';
require_once __DIR__ . '/partials/header.php';
?>
<section class="page-hero">
    <div class="crumb"><a href="index.php">Home</a><span>/</span><span>Booking Submitted</span></div>
    <p class="eyebrow">Booking Centre</p>
    <h1><span class="gradient-text"><?= $ok ? 'Received' : 'Not Saved' ?></span></h1>
    <p><?= $ok ? 'Your project inquiry has been saved successfully into the booking archive.' : 'The form was submitted but the website could not write into the data folder. Check folder permission in XAMPP.' ?></p>
    <a class="btn" href="booking.php">Back to Booking</a>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
