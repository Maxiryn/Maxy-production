<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video | Max Raynold Sapaun</title>
  <link rel="stylesheet" href="../css/styles7.css">
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

  <section id="video" class="video-section">
    <div class="container">
      <h2>My Work in Motion</h2>
      <div class="video-gallery">
        <div class="video-thumbnail" onclick="playVideo('../videos/video1.mp4')">
          <img src="../img/video1_thumbnail.jpg" alt="Video 1 Thumbnail">
          <p>Video 1</p>
        </div>
        <div class="video-thumbnail" onclick="playVideo('../videos/video2.mp4')">
          <img src="../img/video2_thumbnail.jpg" alt="Video 2 Thumbnail">
          <p>Video 2</p>
        </div>
        <div class="video-thumbnail" onclick="playVideo('../videos/video3.mp4')">
          <img src="../img/video3_thumbnail.jpg" alt="Video 3 Thumbnail">
          <p>Video 3</p>
        </div>
      </div>
      
      <!-- Video Player Section -->
      <div id="videoPlayerSection" style="display: none;">
        <video id="videoPlayer" controls>
          <source id="videoSource" src="" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>© 2021 Maxy Production. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function playVideo(videoPath) {
      const videoPlayerSection = document.getElementById('videoPlayerSection');
      const videoPlayer = document.getElementById('videoPlayer');
      const videoSource = document.getElementById('videoSource');

      // Update video source
      videoSource.src = videoPath;
      videoPlayer.load(); 
      videoPlayer.play(); 
      videoPlayerSection.style.display = 'block';
    }
  </script>
</body>
</html>
