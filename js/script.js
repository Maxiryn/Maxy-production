// JavaScript for handling video gallery and video playback
const videoFiles = [
  'videos/video1.mp4',
  'videos/video2.mp4',
  'videos/video3.mp4'
];
const videoThumbnails = [
  'img/thumbnails/video1_thumbnail.jpg',
  'img/thumbnails/video2_thumbnail.jpg',
  'img/thumbnails/video3_thumbnail.jpg'
];

let currentVideoIndex = 0;

const videoPlayer = document.getElementById('videoPlayer');
const videoPlayerSection = document.getElementById('videoPlayerSection');
const videoGallery = document.querySelector('.video-gallery');

// Function to play a video by index
function playVideo(index) {
  // Show video player section and hide thumbnails
  videoPlayerSection.style.display = 'block';
  videoGallery.style.display = 'none';
  
  // Set the current video index and update the video source
  currentVideoIndex = index;
  videoPlayer.src = videoFiles[currentVideoIndex];
  videoPlayer.play();

  // Enter full-screen mode if supported
  if (videoPlayer.requestFullscreen) {
    videoPlayer.requestFullscreen().catch((err) => {
      console.warn('Fullscreen mode failed:', err);
    });
  } else if (videoPlayer.webkitRequestFullscreen) {
    videoPlayer.webkitRequestFullscreen();
  } else if (videoPlayer.mozRequestFullScreen) {
    videoPlayer.mozRequestFullScreen();
  } else if (videoPlayer.msRequestFullscreen) {
    videoPlayer.msRequestFullscreen();
  }

  // Play the next video when the current one ends
  videoPlayer.onended = function () {
    currentVideoIndex = (currentVideoIndex + 1) % videoFiles.length; // Loop through videos
    videoPlayer.src = videoFiles[currentVideoIndex];
    videoPlayer.play();
  };
}

// JavaScript for Slideshow Functionality
let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const totalSlides = slides.length;

// Function to change the slide
function changeSlide(direction) {
  currentSlide += direction;

  // Loop back to the first slide if we reach the end, or go to the last slide if at the beginning
  if (currentSlide < 0) {
    currentSlide = totalSlides - 1;
  } else if (currentSlide >= totalSlides) {
    currentSlide = 0;
  }

  updateSlidePosition();
}

// Function to update the position of the slides
function updateSlidePosition() {
  const slideWidth = slides[0].clientWidth; // Get the width of a single slide
  document.querySelector(".slides").style.transform = `translateX(-${currentSlide * slideWidth}px)`;
}

// Automatic slideshow movement every 3 seconds
setInterval(() => {
  changeSlide(1);
}, 3000); // 3000 milliseconds (3 seconds)

// Initial call to set the first slide correctly
updateSlidePosition();


