<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'maxy_production');

// Check for connection errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $username; 
            header('Location: indexxadmin.php'); 
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }

    $stmt->close(); // Close prepared statement
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Max Raynold Sapaun</title>
  <link rel="stylesheet" href="../css/styles9.css">
</head>
<body>
  <header>
    <div class="container header-content">
      <img src="../img/logo.png" alt="Your Logo" class="logo">
      <nav>
        <a href="indexx.php">Home</a>
        <a href="login.php">Login User</a>
      </nav>
    </div>
  </header>

  <main>
    <div class="container">
      <h1>Admin Login</h1>
      <form method="POST" action=""> 
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required />

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required />

        <button type="submit">Login</button>
      </form>

      <?php

      if (!empty($error)) {
          echo "<p style='color: red;'>$error</p>";
      }
      ?>

    </div>
  </main>

  <footer>
    <div class="container">
      <p>© 2021 Maxy production. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>

