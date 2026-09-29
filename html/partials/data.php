<?php
$brand = [
    'name' => 'Maxy Fusion',
    'tagline' => 'Exclusive Portfolio & Artwork Showcase',
    'caption' => 'Two Years in the Making. A Legacy in Motion.',
    'email' => 'hello@maxyfusion.studio',
    'phone' => '+60 00-000 0000',
    'location' => 'Malaysia / Borneo / International',
];

$navMain = [
    ['label' => 'Home', 'url' => 'index.php'],
    ['label' => 'Portfolio', 'url' => 'portfolio.php'],
    ['label' => 'Artwork', 'url' => 'artwork.php'],
    ['label' => 'Production', 'url' => 'production.php'],
    ['label' => 'Booking', 'url' => 'booking.php'],
];

$navMore = [
    ['label' => 'History', 'url' => 'history.php'],
    ['label' => 'About', 'url' => 'about.php'],
    ['label' => 'Achievements & Awards', 'url' => 'achievements.php'],
    ['label' => 'Creative Journey', 'url' => 'history.php#journey'],
    ['label' => 'Service Packages', 'url' => 'services.php'],
    ['label' => 'Client Experience', 'url' => 'client-experience.php'],
    ['label' => 'Digital Gallery', 'url' => 'digital-gallery.php'],
    ['label' => 'Model Portfolio', 'url' => 'model-portfolio.php'],
    ['label' => 'T&C / Guidelines', 'url' => 'terms.php'],
    ['label' => 'FAQ', 'url' => 'faq.php'],
    ['label' => 'Contact', 'url' => 'contact.php'],
];

$keywords = [
    'Portfolio', 'Artwork Showcase', 'History', 'About', 'Achievements & Awards', 'Creative Journey',
    'Booking Centre', 'Service Packages', 'Client Experience', 'Cinematic Production', 'Photography',
    'Videography', 'Visual Storytelling', 'Creative Direction', 'Featured Projects', 'Signature Works',
    'Camera Work', 'Collaborations', 'Media Coverage', 'Events', 'Production Archive', 'Digital Gallery',
    'Model Portfolio', 'Project Inquiry', 'Availability', 'T&C', 'Guidelines', 'Contact', 'Social Media', 'FAQ'
];

$portfolio = [
    ['img'=>'photo1.png','title'=>'Quiet Romance Editorial','cat'=>'Photography','desc'=>'Soft natural light, emotional framing, and premium portrait direction.'],
    ['img'=>'photo2.png','title'=>'Graduation Legacy Frame','cat'=>'Photography','desc'=>'A polished milestone portrait crafted for timeless memory.'],
    ['img'=>'photo3.png','title'=>'Academic Elegance','cat'=>'Model Portfolio','desc'=>'Clean composition, ceremonial styling, and confident subject presence.'],
    ['img'=>'pic1.png','title'=>'Nature Portrait Series','cat'=>'Photography','desc'=>'Outdoor portraiture with warm tones and cinematic depth.'],
    ['img'=>'pic2.png','title'=>'Creative Team Moment','cat'=>'Events','desc'=>'High-energy documentary frame for community and production culture.'],
    ['img'=>'pic3.png','title'=>'Botanical Portrait','cat'=>'Model Portfolio','desc'=>'Natural color, premium close-up styling, and story-led framing.'],
    ['img'=>'pic4.png','title'=>'Behind The Creative Scene','cat'=>'Events','desc'=>'Authentic documentation of moments that shape the archive.'],
    ['img'=>'pic5.png','title'=>'Ensemble Production Archive','cat'=>'Events','desc'=>'Large-format group coverage for formal and cultural events.'],
    ['img'=>'artwork9.png','title'=>'Live Saxophone Stage','cat'=>'Camera Work','desc'=>'Stage light, motion, and music captured through expressive camera work.'],
    ['img'=>'artwork12.png','title'=>'Vocal Performance Highlight','cat'=>'Cinematic Production','desc'=>'Performance coverage designed for media-ready storytelling.'],
    ['img'=>'artwork13.png','title'=>'Theatre Energy Frame','cat'=>'Cinematic Production','desc'=>'Dramatic stage moment with expressive lighting and emotion.'],
    ['img'=>'artwork10.png','title'=>'Concert Motion Archive','cat'=>'Camera Work','desc'=>'High-contrast event photography with atmosphere and rhythm.'],
];

$artworks = [];
for ($i = 1; $i <= 16; $i++) {
    $artworks[] = [
        'img' => 'artwork' . $i . '.png',
        'title' => 'Artwork Study ' . str_pad($i, 2, '0', STR_PAD_LEFT),
        'tag' => ($i <= 8 ? 'Portrait Archive' : 'Performance Archive'),
    ];
}

$services = [
    ['name'=>'Signature Portrait Session','tag'=>'Photography','price'=>'From RM350','points'=>['Creative direction', 'Edited premium gallery', 'Indoor / outdoor concept', 'Usage-ready digital delivery']],
    ['name'=>'Cinematic Event Coverage','tag'=>'Videography','price'=>'From RM900','points'=>['Highlight film', 'Event storytelling', 'Professional camera movement', 'Social media cutdown']],
    ['name'=>'Model Portfolio Build','tag'=>'Portfolio','price'=>'From RM550','points'=>['Pose direction', 'Editorial portraits', 'Lookbook selection', 'Online portfolio-ready output']],
    ['name'=>'Full Creative Production','tag'=>'Production','price'=>'Custom Quote','points'=>['Concept development', 'Shoot planning', 'Camera work', 'Post-production direction']],
];

$awards = [
    ['year'=>'2023','title'=>'First Place — Warna Warni Alor Gajah Videography','desc'=>'Recognition for visual storytelling, production planning, and creative editing.'],
    ['year'=>'2023','title'=>'First Place — Est Cola Video, Kupi-Kupi FM Sabah','desc'=>'Award-winning commercial-style content with strong cultural energy.'],
    ['year'=>'2022','title'=>'1st Runner Up — Khar Videography Competition','desc'=>'A milestone that shaped the Maxy Fusion cinematic identity.'],
    ['year'=>'UPSI','title'=>'Best Videographer — Media Seekers','desc'=>'Recognition for consistent event coverage and production contribution.'],
    ['year'=>'Global','title'=>'International Videographer — EDU Innovate Expo','desc'=>'Creative coverage across educational, cultural, and innovation platforms.'],
];

$videos = [
    ['file'=>'video1.mp4','thumb'=>'video1_thumbnail.jpg','title'=>'Stage Motion Film','desc'=>'A performance-led visual archive with rhythm, stage light, and atmosphere.'],
    ['file'=>'video2.mp4','thumb'=>'video2_thumb_generated.jpg','title'=>'Creative Production Reel','desc'=>'A cinematic showcase focused on movement, mood, and story development.'],
    ['file'=>'video3.mp4','thumb'=>'video3_thumb_generated.jpg','title'=>'Event Highlight Archive','desc'=>'Premium recap direction for events, productions, and campaign memories.'],
];

function isActive($file) {
    return basename($_SERVER['PHP_SELF']) === $file ? 'is-active' : '';
}
?>
