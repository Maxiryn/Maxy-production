<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'maxy_production');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete feedback functionality
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM feedback WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param('i', $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback deleted successfully'); window.location.href='feedbackadmin.php';</script>";
    } else {
        echo "<script>alert('Error deleting feedback'); window.location.href='feedbackadmin.php';</script>";
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
</head>
<body>
  <!-- Header -->
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

  <!-- Client Feedback Section -->
  <section id="feedback">
    <div class="container">
      <h2>Client Feedback</h2>
      <div class="feedback-container">
        <?php
        // Fetch feedback
        $sql = "SELECT f.id, f.rating, f.comment, b.name AS client_name 
                FROM feedback f
                LEFT JOIN bookings b ON f.booking_id = b.id 
                ORDER BY f.id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output feedback items
            while ($row = $result->fetch_assoc()) {
                echo '<div class="feedback-segment">';
                echo '<div class="feedback-item">';
                echo '<p>"' . htmlspecialchars($row['comment']) . '"</p>';
                if (!empty($row['client_name'])) {
                    echo '<p class="client-name">- ' . htmlspecialchars($row['client_name']) . '</p>';
                }
                echo '<p>Rating: ' . str_repeat('★', $row['rating']) . str_repeat('☆', 5 - $row['rating']) . '</p>';
                echo '</div>';

                // Delete button
                echo '<a href="?delete_id=' . $row['id'] . '" class="delete-btn">Delete</a>';
                echo '</div>'; 
            }
        } else {
            echo '<p>No feedback available yet.</p>';
        }

        // Close connection
        $conn->close();
        ?>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>© 2021 Maxy Production. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
