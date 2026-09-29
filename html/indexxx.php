<?php
session_start(); 


if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname'];
} else {
    header("Location: login.php");
    exit();
}
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Max Raynold Sapaun</title>
  <link rel="stylesheet" href="../css/styles1.css">
</head>
<body>
  <header>
    <div class="container header-content">
      <img src="../img/logo.png" alt="Your Logo" class="logo">
      <nav>
        <a href="indexxx.php">Home</a>
        <a href="about.php">About</a>
        <a href="portfolio.php">Portfolio</a>
        <a href="video.php">Video</a>
        <a href="production.php">Production</a>
        <a href="artwork.php">Artwork</a>

		<a href="profile.php"> Your Profile</a>
      </nav>
    </div>
  </header>

 <main>
    <div class="container">
      <h1>Welcome, <?php echo htmlspecialchars($nickname); ?>!</h1>
      <p>We are glad to have you here.</p>
    </div>
  </main>

  <section id="slideshow">
    <div class="slides">
      <div class="slide"><img src="../img/photo1.png" alt="Sample Work 1"></div>
      <div class="slide"><img src="../img/photo2.png" alt="Sample Work 2"></div>
      <div class="slide"><img src="../img/photo3.png" alt="Sample Work 3"></div>
    </div>
    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
  </section>

  <!-- About Section -->
  <section id="about">
    <div class="container">
      <h2>About Me</h2>
      <p>I am a professional videographer and photographer passionate about capturing life's most beautiful moments. From stunning landscapes to unforgettable weddings, my mission is to turn memories into timeless art.</p>
    </div>
  </section>

  <!-- About Me (Additional Info) -->
  <section id="about-more">
    <div class="container">
      <h3>About Maxy Production</h3>
      <img src="../img/my_portrait.png" alt="Portrait of Maxy Raynold Sapaun" class="portrait">
      <div class="about-content">
        <div class="about-item">
          <h3>Who I Am</h3>
          <p>I am a freelance videographer and photographer passionate about capturing life's most beautiful moments. From stunning landscapes to unforgettable moments, my mission is to turn memories into timeless art.</p>
        </div>
        <div class="about-item">
          <h3>Maxy Production</h3>
          <p>Maxy Production was established in 2021 as a freelance platform to showcase my creative photography and videography services. I started as a program participant in PDI and later enhanced my skills to become an independent photographer.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Production Team -->
  <section id="production">
    <div class="container">
      <h2>Meet the Production Team</h2>
      <div class="team">
        <div class="team-member">
          <img src="../img/team1.png" alt="John Doe">
          <h3>Avenisa Callyn Willfred</h3>
          <p>Freelance, runaway and Fashion Show 2023/2024/2025 Model</p>
        </div>
        <div class="team-member">
          <img src="../img/team2.png" alt="Jane Smith">
          <h3>Tati Brendia Vita</h3>
          <p>Top 5 Unduk Ngadau Putrajaya 2024 and Fashion Show Model</p>
        </div>
        <div class="team-member">
          <img src="../img/team3.png" alt="Michael Brown">
          <h3>Adelyn Justin</h3>
          <p>Top 3 Unduk Ngadau Putrajaya 2022 and Fashion Show Model</p>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>© 2021 Maxy production. All rights reserved.</p>
    </div>
  </footer>

  <!-- Link to your external JavaScript file -->
  <script src="../js/script.js"></script>
</body>
</html>
