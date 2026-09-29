<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maxy_production";  // Change this to your actual database name
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data and validate
$user_id = $_POST['user_id'] ?? null;
$full_name = $_POST['full_name'] ?? null;
$nickname = $_POST['nickname'] ?? null;
$ic_number = $_POST['ic_number'] ?? null;
$age = $_POST['age'] ?? null;
$address = $_POST['address'] ?? null;
$dob = $_POST['dob'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$confirm_password = $_POST['confirm_password'] ?? null;

// Check if any required field is empty
if (empty($user_id) || empty($full_name) || empty($nickname) || empty($ic_number) || empty($age) || empty($address) || empty($dob) || empty($email) || empty($password) || empty($confirm_password)) {
    die("All fields are required.");
}

// Check if passwords match
if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the IC number already exists
$sql_check = "SELECT * FROM users WHERE ic_number = '$ic_number'";
$result = $conn->query($sql_check);
if ($result->num_rows > 0) {
    die("This IC Number is already registered.");
}

// SQL query to insert data into database
$sql = "INSERT INTO users (user_id, full_name, nickname, ic_number, age, address, dob, email, password)
        VALUES ('$user_id', '$full_name', '$nickname', '$ic_number', '$age', '$address', '$dob', '$email', '$hashed_password')";

// Execute query and check if successful
if ($conn->query($sql) === TRUE) {
    echo "Account created successfully.";
    // Redirect to login page after successful sign-up
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>