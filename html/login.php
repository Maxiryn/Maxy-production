<?php
session_start(); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = new mysqli('localhost', 'root', '', 'maxy_production');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the query to check the user credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {     
        $userData = $result->fetch_assoc();

        if (password_verify($password, $userData['password'])) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['nickname'] = $userData['nickname'];
            $_SESSION['email'] = $userData['email'];

            header("Location: indexxx.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No user found with that email.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Max Raynold Sapaun</title>
  <link rel="stylesheet" href="../css/styles9.css">
</head>
<body>
  <header>
    <div class="container header-content">
      <img src="../img/logo.png" alt="Your Logo" class="logo">
      <nav>
        <a href="indexx.php">Home</a>
        <a href="Sign-up.php">Sign Up</a>
       <a href="admin_login.php">Admin</a> 
		
      </nav>
    </div>
  </header>

  <main>
    <div class="container">
      <h1>User Login</h1>
      <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required />

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required />

        <button type="submit">Login</button>
      </form>

      <?php
      // Display error if credentials are incorrect
      if (isset($error)) {
          echo "<p style='color: red;'>$error</p>";
      }
      ?>

      <p>Don't have an account? <a href="sign-up.php">Sign up here</a>.</p>
    </div>
  </main>

  <footer>
    <div class="container">
      <p>© 2021 Maxy production. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
