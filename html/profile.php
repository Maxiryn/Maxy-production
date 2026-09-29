<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}

$userId = $_SESSION['user_id']; 

// Database connection
$conn = new mysqli('localhost', 'root', '', 'maxy_production');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$userQuery = "SELECT * FROM users WHERE id = '$userId'";
$userResult = $conn->query($userQuery);
$userData = $userResult->fetch_assoc();

// Fetch booking data
$bookingQuery = "SELECT * FROM bookings WHERE email = '" . $userData['email'] . "' ORDER BY date DESC";
$bookingResult = $conn->query($bookingQuery);


// Handle update of personal info
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $full_name = $_POST['full_name'];
    $nickname = $_POST['nickname'];
    $ic_number = $_POST['ic_number'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];

    $updateQuery = "UPDATE users SET full_name='$full_name', nickname='$nickname', ic_number='$ic_number', 
                    age='$age', address='$address', dob='$dob', email='$email' WHERE id='$userId'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

// Handle booking deletion
if (isset($_GET['delete_booking'])) {
    $bookingId = $_GET['delete_booking'];
    $deleteQuery = "DELETE FROM bookings WHERE id = '$bookingId'";

    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: profile.php"); // Refresh the page to reflect the deletion
        exit;
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
}

// Handle booking confirmation
if (isset($_GET['confirm_booking'])) {
    $bookingId = $_GET['confirm_booking'];
    $confirmQuery = "UPDATE bookings SET status='Confirmed' WHERE id = '$bookingId'";

    if ($conn->query($confirmQuery) === TRUE) {
        header("Location: profile.php"); // Refresh the page to reflect the change
        exit;
    } else {
        echo "Error confirming booking: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Max Raynold Sapaun</title>
  <link rel="stylesheet" href="../css/styles8.css">
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
        <a href="logout.php" class="login-button">Logout</a>
      </nav>
    </div>
  </header>

  <div class="sidebar">
    <ul>
      <li><a href="#personal-info">Personal Information</a></li>
      <li><a href="#booking-info">Booking Information</a></li>
      <li><a href="#feedback">Feedback</a></li>
    </ul>
  </div>

  <div class="content">
    <!-- Personal Info Section -->
    <div class="section" id="personal-info">
      <h2>Personal Information</h2>
      <form action="" method="POST">
        <label for="full-name">Full Name</label>
        <input type="text" id="full-name" name="full_name" value="<?= $userData['full_name'] ?>" required />

        <label for="nickname">Nickname</label>
        <input type="text" id="nickname" name="nickname" value="<?= $userData['nickname'] ?>" />

        <label for="ic-number">IC Number</label>
        <input type="text" id="ic-number" name="ic_number" value="<?= $userData['ic_number'] ?>" />

        <label for="age">Age</label>
        <input type="number" id="age" name="age" value="<?= $userData['age'] ?>" />

        <label for="address">Address</label>
        <textarea id="address" name="address"><?= $userData['address'] ?></textarea>

        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" value="<?= $userData['dob'] ?>" />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $userData['email'] ?>" required />

        <button type="submit" name="update_profile">Save</button>
      </form>
    </div>

  <!-- Booking Info Section -->
<div class="section" id="booking-info">
    <h2>Booking Information</h2>
    <?php
        if ($bookingResult->num_rows > 0) {
            while ($row = $bookingResult->fetch_assoc()) {
                echo "<div class='booking-item'>";  // This is the box around each booking
                echo "<div class='booking-header'>";
                echo "<p><strong>Service:</strong> " . $row['service'] . "</p>";
                echo "<p><strong>Price:</strong> " . $row['price'] . "</p>";
                echo "<p><strong>PAX:</strong> " . $row['pax'] . "</p>";
                echo "<p><strong>Time:</strong> " . $row['time'] . "</p>";
                echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";
                echo "<p><strong>Message:</strong> " . $row['message'] . "</p>";
                echo "<p><strong>Status:</strong> " . $row['status'] . "</p>";

				echo "</div>";

                // Actions for pending bookings
                if ($row['status'] == 'Pending') {
                    echo "<div class='booking-actions'>";
                    echo "<a href='profile.php?delete_booking=" . $row['id'] . "' class='btn delete-btn'>Delete</a>";
                    echo "<a href='profile.php?confirm_booking=" . $row['id'] . "' class='btn confirm-btn'>Confirm</a>";
                    

					echo "</div>";
					
                }
                echo "</div>";
            }
        } else {
            echo "<p>No bookings found.</p>";
        }
    ?>
</div>

<div class="section" id="feedback">
    <h2>Feedback</h2>
    <?php
    $feedbackQuery = "SELECT feedback.comment, feedback.rating, bookings.service 
                      FROM feedback 
                      JOIN bookings ON feedback.booking_id = bookings.id 
                      WHERE bookings.email = '" . $userData['email'] . "'";
    $feedbackResult = $conn->query($feedbackQuery);

    if ($feedbackResult->num_rows > 0) {
        while ($feedback = $feedbackResult->fetch_assoc()) {
            echo "<div class='feedback-item'>";
            echo "<p><strong>Service:</strong> " . $feedback['service'] . "</p>";
            echo "<p><strong>Feedback:</strong> " . $feedback['comment'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No feedback submitted yet.</p>";
    }
    ?>
</div>

    <div class="section" id="feedback">
      <h2>Feedback</h2>
      <form action="submit_feedback.php" method="POST">
        <label for="booking_id">Select Booking</label>
        <select id="booking_id" name="booking_id" required>
            <?php
            $bookingQuery = "SELECT id, service FROM bookings WHERE email = '" . $userData['email'] . "'";
            $bookingResult = $conn->query($bookingQuery);

            while ($booking = $bookingResult->fetch_assoc()) {
                echo "<option value='" . $booking['id'] . "'>" . $booking['service'] . "</option>";
            }
            ?>
        </select>
        <label for="feedback">Your Feedback</label>
        <textarea id="feedback" name="feedback" rows="5" required></textarea>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>

  <footer>
    <div class="container">
      <p>© 2021 Maxy production. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
