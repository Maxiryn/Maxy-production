<?php
require_once __DIR__ . '/../../lib/supabase.php';

function site_brand(): array {
    return [
        'name' => 'Maxy Fusion',
        'tagline' => 'Photography, film and creative direction',
        'caption' => 'Two years in the making. A legacy in motion.',
        'email' => 'hello@maxyfusion.studio',
        'phone' => '+60 00-000 0000',
        'location' => 'Malaysia, Borneo and international',
        // Add a full URL to show a profile on the contact page; empty entries stay hidden.
        'social' => ['Instagram' => '', 'TikTok' => '', 'YouTube' => '', 'Facebook' => '', 'WhatsApp' => ''],
    ];
}

// Top-level navigation. Each section's pages appear as tabs under the page title and as a footer column.
function site_sections(): array {
    return [
        'work' => ['label' => 'Work', 'url' => 'portfolio.php', 'pages' => [
            'portfolio.php' => 'Portfolio',
            'artwork.php' => 'Artwork',
            'production.php' => 'Films',
            'model-portfolio.php' => 'Model portfolio',
            'digital-gallery.php' => 'Full gallery',
        ]],
        'about' => ['label' => 'About', 'url' => 'about.php', 'pages' => [
            'about.php' => 'Studio',
            'history.php' => 'Journey',
            'achievements.php' => 'Awards',
            'client-experience.php' => 'Client experience',
        ]],
        'services' => ['label' => 'Services', 'url' => 'services.php', 'pages' => [
            'services.php' => 'Packages',
            'booking.php' => 'Booking',
            'faq.php' => 'FAQ',
            'terms.php' => 'Terms',
        ]],
        'contact' => ['label' => 'Contact', 'url' => 'contact.php', 'pages' => []],
    ];
}

function current_page(): string { return basename($_SERVER['PHP_SELF'] ?? ''); }

function current_section(): ?string {
    $page = current_page();
    foreach (site_sections() as $key => $section) {
        if ($page === $section['url'] || isset($section['pages'][$page])) return $key;
    }
    return null;
}

// Title block with the current section's tabs underneath.
function page_header(string $title, string $intro = ''): void {
    $key = current_section();
    $section = $key ? site_sections()[$key] : null;
    echo '<header class="page-head"><div class="container">';
    if ($section && $section['pages']) echo '<p class="eyebrow">' . esc($section['label']) . '</p>';
    echo '<h1>' . esc($title) . '</h1>';
    if ($intro !== '') echo '<p class="lead">' . esc($intro) . '</p>';
    if ($section && count($section['pages']) > 1) {
        echo '<nav class="tabs" aria-label="' . esc($section['label']) . ' pages">';
        foreach ($section['pages'] as $url => $label) {
            $current = $url === current_page() ? ' aria-current="page"' : '';
            echo '<a href="' . esc($url) . '"' . $current . '>' . esc($label) . '</a>';
        }
        echo '</nav>';
    }
    echo '</div></header>';
}

// One clickable image tile. The lightbox reads data-caption; without JavaScript the link opens the image.
function work_tile(string $img, string $title = '', string $meta = '', string $category = '', bool $showCaption = true): void {
    $src = '../img/' . $img;
    $caption = trim($title . ($meta !== '' ? ' · ' . $meta : ''), ' ·');
    echo '<figure class="tile"' . ($category !== '' ? ' data-category="' . esc($category) . '"' : '') . '>';
    echo '<a class="tile-media" href="' . esc($src) . '" data-lightbox data-caption="' . esc($caption) . '">';
    echo '<img src="' . esc($src) . '" alt="' . esc($title !== '' ? $title : 'Maxy Fusion archive image') . '" loading="lazy" decoding="async"></a>';
    if ($showCaption && $title !== '') echo '<figcaption><span>' . esc($title) . '</span>' . ($meta !== '' ? '<small>' . esc($meta) . '</small>' : '') . '</figcaption>';
    echo '</figure>';
}

$brand = site_brand();

$portfolio = [
    ['img'=>'photo1.png','title'=>'Quiet Romance Editorial','cat'=>'Photography','desc'=>'Soft natural light and emotional framing.'],
    ['img'=>'photo2.png','title'=>'Graduation Legacy Frame','cat'=>'Photography','desc'=>'A milestone portrait made to last.'],
    ['img'=>'photo3.png','title'=>'Academic Elegance','cat'=>'Model Portfolio','desc'=>'Clean composition, ceremonial styling and confident presence.'],
    ['img'=>'pic1.png','title'=>'Nature Portrait Series','cat'=>'Photography','desc'=>'Outdoor portraiture with warm tones and depth.'],
    ['img'=>'pic2.png','title'=>'Creative Team Moment','cat'=>'Events','desc'=>'Documentary coverage of community and production culture.'],
    ['img'=>'pic3.png','title'=>'Botanical Portrait','cat'=>'Model Portfolio','desc'=>'Natural colour and story-led close-up styling.'],
    ['img'=>'pic4.png','title'=>'Behind The Creative Scene','cat'=>'Events','desc'=>'Candid moments that shape the archive.'],
    ['img'=>'pic5.png','title'=>'Ensemble Production Archive','cat'=>'Events','desc'=>'Large-format group coverage for formal and cultural events.'],
    ['img'=>'artwork9.png','title'=>'Live Saxophone Stage','cat'=>'Camera Work','desc'=>'Stage light, motion and music.'],
    ['img'=>'artwork12.png','title'=>'Vocal Performance Highlight','cat'=>'Cinematic Production','desc'=>'Performance coverage for media-ready storytelling.'],
    ['img'=>'artwork13.png','title'=>'Theatre Energy Frame','cat'=>'Cinematic Production','desc'=>'A dramatic stage moment with expressive lighting.'],
    ['img'=>'artwork10.png','title'=>'Concert Motion Archive','cat'=>'Camera Work','desc'=>'High-contrast event photography with atmosphere and rhythm.'],
];

$artworkGroups = [
    'Portraits' => range(1, 8),
    'Live performance' => range(9, 13),
    'Street & candid' => range(14, 16),
];
$artworks = [];
foreach ($artworkGroups as $group => $numbers) {
    foreach ($numbers as $i) {
        $artworks[] = ['img' => 'artwork' . $i . '.png', 'title' => 'Artwork Study ' . str_pad((string)$i, 2, '0', STR_PAD_LEFT), 'tag' => $group];
    }
}

$services = [
    ['name'=>'Signature Portrait Session','tag'=>'Photography','price'=>'From RM350','points'=>['Creative direction', 'Edited gallery', 'Indoor or outdoor concept', 'Digital delivery ready to use']],
    ['name'=>'Cinematic Event Coverage','tag'=>'Videography','price'=>'From RM900','points'=>['Highlight film', 'Event storytelling', 'Professional camera movement', 'Social media cutdown']],
    ['name'=>'Model Portfolio Build','tag'=>'Portfolio','price'=>'From RM550','points'=>['Pose direction', 'Editorial portraits', 'Lookbook selection', 'Output ready for an online portfolio']],
    ['name'=>'Full Creative Production','tag'=>'Production','price'=>'Custom quote','points'=>['Concept development', 'Shoot planning', 'Camera work', 'Post-production direction']],
];

$awards = [
    ['year'=>'2023','title'=>'First Place — Warna Warni Alor Gajah Videography','desc'=>'For visual storytelling, production planning and creative editing.'],
    ['year'=>'2023','title'=>'First Place — Est Cola Video, Kupi-Kupi FM Sabah','desc'=>'Commercial-style content with strong cultural energy.'],
    ['year'=>'2022','title'=>'1st Runner Up — Khar Videography Competition','desc'=>'The milestone that shaped the Maxy Fusion cinematic identity.'],
    ['year'=>'UPSI','title'=>'Best Videographer — Media Seekers','desc'=>'For consistent event coverage and production work.'],
    ['year'=>'Global','title'=>'International Videographer — EDU Innovate Expo','desc'=>'Coverage across education, culture and innovation platforms.'],
];

$videos = [
    ['file'=>'video1.mp4','thumb'=>'video1_thumbnail.jpg','title'=>'Stage Motion Film','desc'=>'A performance film built on rhythm, stage light and atmosphere.'],
    ['file'=>'video2.mp4','thumb'=>'video2_thumb_generated.jpg','title'=>'Creative Production Reel','desc'=>'Movement, mood and story development in one reel.'],
    ['file'=>'video3.mp4','thumb'=>'video3_thumb_generated.jpg','title'=>'Event Highlight Archive','desc'=>'Recaps for events, productions and campaigns.'],
];
