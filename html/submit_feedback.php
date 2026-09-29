<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$conn = new mysqli('localhost', 'root', '', 'maxy_production');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $feedback = $conn->real_escape_string($_POST['feedback']);
    $bookingId = isset($_POST['booking_id']) ? (int)$_POST['booking_id'] : null;

    if (empty($feedback)) {
        echo "Feedback cannot be empty!";
        exit;
    }

    $insertQuery = "INSERT INTO feedback (booking_id, comment, rating) VALUES ('$bookingId', '$feedback', 5)";

    if ($conn->query($insertQuery) === TRUE) {
        echo "Feedback submitted successfully!";
        header("Location: profile.php#feedback");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
