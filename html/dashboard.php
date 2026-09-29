<?php
session_start();

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}

$userId = $_SESSION['user_id'];

$conn = new mysqli('localhost', 'root', '', 'maxy_production');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param('i', $userId);
$query->execute();
$result = $query->get_result();
$userData = $result->fetch_assoc();
?>


<?php
$conn->close();
?>