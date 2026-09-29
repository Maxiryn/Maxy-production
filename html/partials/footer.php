<?php $footerBrand = site_brand(); ?>
</main>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="../img/logo.png" alt="Maxy Fusion" width="200" height="80" loading="lazy">
                <p>Portrait, event and stage photography and film from <?= esc($footerBrand['location']) ?>.</p>
                <a class="text-link" href="mailto:<?= esc($footerBrand['email']) ?>"><?= esc($footerBrand['email']) ?></a>
            </div>
            <?php foreach (site_sections() as $section): if (!$section['pages']) continue; ?>
            <div>
                <h2><?= esc($section['label']) ?></h2>
                <ul>
                    <?php foreach ($section['pages'] as $url => $label): ?>
                        <li><a href="<?= esc($url) ?>"><?= esc($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="footer-bottom">
            <span>© <?= date('Y') ?> Maxy Fusion. All rights reserved.</span>
            <span><a href="contact.php">Contact</a> · <a href="profile.php">Account</a> · <a href="#top">Back to top</a></span>
        </div>
    </div>
</footer>
<script src="../js/premium.js" defer></script>
</body>
</html>
