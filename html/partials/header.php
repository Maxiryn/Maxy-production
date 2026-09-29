<?php
if (!isset($pageTitle)) { $pageTitle = 'Maxy Fusion'; }
if (!isset($pageDescription)) { $pageDescription = 'Portrait, event and stage photography, film and creative direction by Maxy Fusion.'; }
require_once __DIR__ . '/data.php';
$activeSection = current_section();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($pageDescription) ?>">
    <meta name="theme-color" content="#0d0c0f">
    <title><?= esc($pageTitle) ?> | Maxy Fusion</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="../css/premium.css">
</head>
<body class="<?= isset($bodyClass) ? esc($bodyClass) : '' ?>">
<a class="skip-link" href="#content">Skip to content</a>
<header class="site-header" id="top">
    <div class="container header-inner">
        <a class="brand" href="index.php"><img src="../img/logo.png" alt="Maxy Fusion home" width="200" height="80"></a>
        <nav class="site-nav" id="site-nav" aria-label="Main">
            <?php foreach (site_sections() as $key => $section): ?>
                <a href="<?= esc($section['url']) ?>"<?= $key === $activeSection ? ' aria-current="true"' : '' ?>><?= esc($section['label']) ?></a>
            <?php endforeach; ?>
            <a class="nav-account" href="profile.php">Account</a>
        </nav>
        <div class="header-actions">
            <a class="nav-account" href="profile.php">Account</a>
            <a class="btn btn-small" href="booking.php">Book a session</a>
            <button class="menu-toggle" type="button" aria-controls="site-nav" aria-expanded="false"><span class="visually-hidden">Menu</span><span aria-hidden="true"></span></button>
        </div>
    </div>
</header>
<main id="content">
