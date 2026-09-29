<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maxy_production";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all bookings from the table
$sql = "SELECT id, service, price, pax, time, name, email, phone, address, date, message, status FROM bookings ORDER BY date DESC";
$bookingResult = $conn->query($sql);

// Handle booking deletion
if (isset($_GET['delete_booking'])) {
    $deleteBookingId = $_GET['delete_booking'];
    $deleteBookingSql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($deleteBookingSql);
    $stmt->bind_param("i", $deleteBookingId);
    if ($stmt->execute()) {
        echo "<script>alert('Booking deleted successfully!'); window.location.href = 'indexxx.php';</script>";
    } else {
        echo "<p>Error deleting booking: " . $conn->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Information Admin</title>
  <link rel="stylesheet" href="../css/styles3admin.css">
  <script>
    // Function to print booking details
    function printBooking(bookingId) {
        const bookingElement = document.getElementById(`booking-${bookingId}`);
        const newWindow = window.open("", "_blank");
        newWindow.document.write(`<html><head><title>Print Booking</title></head><body>${bookingElement.innerHTML}</body></html>`);
        newWindow.document.close();
        newWindow.print();
    }
  </script>
</head>
<body>

  <header>
    <div class="container header-content">
      <img src="../img/logo.png" alt="Max Raynold Sapaun Logo" class="logo">
      <nav>
        <a href="indexxadmin.php">Booking Report</a>
        <a href="feedbackadmin.php">Feedback</a>
		<a href="portfolioadmin.php">Portfolio</a>
        <a href="logout.php" class="login-button">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Booking Info Section -->
  <div class="section" id="booking-info">
    <h2>Booking Information</h2>
    <?php
        if ($bookingResult->num_rows > 0) {
            while ($row = $bookingResult->fetch_assoc()) {
                echo "<div class='booking-item' id='booking-" . $row['id'] . "'>";  // Box around each booking
                echo "<div class='booking-header'>";
                echo "<p><strong>Service:</strong> " . htmlspecialchars($row['service']) . "</p>";
                echo "<p><strong>Price:</strong> " . htmlspecialchars($row['price']) . "</p>";
                echo "<p><strong>PAX:</strong> " . htmlspecialchars($row['pax']) . "</p>";
                echo "<p><strong>Time:</strong> " . htmlspecialchars($row['time']) . "</p>";
                echo "<p><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                echo "<p><strong>Phone:</strong> " . htmlspecialchars($row['phone']) . "</p>";
                echo "<p><strong>Address:</strong> " . htmlspecialchars($row['address']) . "</p>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
                echo "<p><strong>Message:</strong> " . htmlspecialchars($row['message']) . "</p>";
                echo "<p><strong>Status:</strong> " . htmlspecialchars($row['status']) . "</p>";
                echo "</div>"; // Close booking-header div

                // Add action buttons
                echo "<div class='booking-actions'>";
                echo "<button class='btn print-btn' onclick='printBooking(" . $row['id'] . ")'>Print</button>";
                echo "<a href='?delete_booking=" . $row['id'] . "' class='btn delete-btn'>Delete</a>";
                echo "</div>";

                echo "</div>";  // Close booking-item div
            }
        } else {
            echo "<p>No bookings found.</p>";
        }
    ?>
  </div>

  <footer>
    <div class="container">
      <p>© 2021 Maxy Production. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
