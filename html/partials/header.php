<?php
if (!isset($pageTitle)) { $pageTitle = 'Maxy Fusion'; }
if (!isset($pageDescription)) { $pageDescription = 'Exclusive portfolio, artwork showcase, cinematic production and premium booking centre.'; }
require_once __DIR__ . '/data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
    <title><?= htmlspecialchars($pageTitle) ?> | Maxy Fusion</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/premium.css">
</head>
<body class="<?= isset($bodyClass) ? htmlspecialchars($bodyClass) : '' ?>">
<div class="noise"></div>
<div class="aurora aurora-one"></div>
<div class="aurora aurora-two"></div>
<div class="cursor-glow" aria-hidden="true"></div>

<header class="site-header" id="top">
    <a class="brand" href="index.php" aria-label="Maxy Fusion Home">
        <img src="../img/logo.png" alt="Maxy Fusion logo">
        <span>
            <strong>Maxy Fusion</strong>
            <small>Premium Visual Archive</small>
        </span>
    </a>
    <button class="menu-toggle" aria-label="Open menu"><span></span><span></span></button>
    <nav class="nav-panel" aria-label="Main navigation">
        <div class="nav-main">
            <?php foreach ($navMain as $item): ?>
                <a class="<?= isActive(basename($item['url'])) ?>" href="<?= $item['url'] ?>"><?= htmlspecialchars($item['label']) ?></a>
            <?php endforeach; ?>
        </div>
        <div class="nav-more">
            <button class="more-btn" type="button">Explore <span>+</span></button>
            <div class="mega-menu">
                <div>
                    <p class="eyebrow">Creative Index</p>
                    <h3>Everything inside the Maxy Fusion archive.</h3>
                </div>
                <div class="mega-grid">
                    <?php foreach ($navMore as $item): ?>
                        <a href="<?= $item['url'] ?>"><?= htmlspecialchars($item['label']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <a href="profile.php">My Account</a>
        <a class="nav-cta magnetic" href="booking.php">Book Project</a>
    </nav>
</header>
<main>
