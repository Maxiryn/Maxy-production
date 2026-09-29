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

// Update user information if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['full_name'];
    $nickname = $_POST['nickname'];
    $icNumber = $_POST['ic_number'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];

    // Update query
    $updateQuery = "UPDATE users SET full_name = ?, nickname = ?, ic_number = ?, age = ?, address = ?, dob = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssiisss", $fullName, $nickname, $icNumber, $age, $address, $dob, $email, $userId);

    if ($stmt->execute()) {
        // Update successful
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        // Error
        $_SESSION['message'] = "Error updating profile: " . $conn->error;
    }

    // Redirect back to the profile page
    header("Location: profile.php");
    exit;
}

// Fetch the current user data
$userQuery = "SELECT * FROM users WHERE id = '$userId'";
$userResult = $conn->query($userQuery);
$userData = $userResult->fetch_assoc();

$conn->close();
?>
