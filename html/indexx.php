<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Max Raynold Sapaun</title>
  <link rel="stylesheet" href="../css/styles1.css">

  <style>
/* Popup styles */
.popup {
  display: none;
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 80px; /* Increased padding for more space */
  border-radius: 10px;
  z-index: 9999;
  width: 450px; /* Set the width to make it larger */
  text-align: center;
  font-size: 18px;
  line-height: 1.6; /* Added line height to increase space between lines */
}

/* Button styling */
.popup button {
  background-color: red;
  color: white;
  border: none;
  padding: 20px 40px; /* Increased padding for a larger button */
  cursor: pointer;
  font-size: 18px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  margin-top: 60px; /* Increased margin to push the button further down */
}

/* Hover effect for the button */
.popup button:hover {
  background-color: darkred;
}
  </style>
</head>
<body>
  <header>
    <div class="container header-content">
      <img src="../img/logo.png" alt="Your Logo" class="logo">
      <nav>
        <!-- Links trigger popup -->
        <a href="javascript:void(0);" onclick="showPopup()">About</a>
        <a href="javascript:void(0);" onclick="showPopup()">Portfolio</a>
        <a href="javascript:void(0);" onclick="showPopup()">Video</a>
        <a href="javascript:void(0);" onclick="showPopup()">Production</a>
        <a href="javascript:void(0);" onclick="showPopup()">Artwork</a>
        <a href="login.php">Log In</a>
      </nav>
    </div>
  </header>

  <!-- Popup -->
  <div id="loginPopup" class="popup">
    <p>You must log in first.</p>
    <button onclick="goToLogin()">OK</button>
  </div>

  <script>
    // Function to show the popup when a link is clicked
    function showPopup() {
      document.getElementById("loginPopup").style.display = "block";
    }

    function goToLogin() {
      window.location.href = "login.php"; 
    }
  </script>

  <section id="slideshow">
    <div class="slides">
      <div class="slide"><img src="../img/photo1.png" alt="Sample Work 1"></div>
      <div class="slide"><img src="../img/photo2.png" alt="Sample Work 2"></div>
      <div class="slide"><img src="../img/photo3.png" alt="Sample Work 3"></div>
    </div>
    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
  </section>

  <section id="about">
    <div class="container">
      <h2>About Me</h2>
      <p>I am a professional videographer and photographer passionate about capturing life's most beautiful moments. From stunning landscapes to unforgettable weddings, my mission is to turn memories into timeless art.</p>
    </div>
  </section>

  <section id="about-more">
    <div class="container">
      <h3>Maxy Production</h3>
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

  <script src="../js/script.js"></script>
</body>
</html>
