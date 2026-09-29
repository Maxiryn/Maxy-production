<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Service Manager | Max Raynold Sapaun</title>
  <link rel="stylesheet" href="../css/styles5.css">
    <style>
    /* Additional Admin Page Specific Styles */
    .admin-container {
      margin-top: 3rem;
    }

    .admin-title {
      text-align: center;
      margin-bottom: 2rem;
      color: #f0c040;
    }

    .admin-form {
      background: #444;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
      margin-bottom: 3rem;
    }

    .admin-form label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    .admin-form input,
    .admin-form textarea,
    .admin-form select {
      width: 100%;
      padding: 10px;
      margin-bottom: 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      background: #333;
      color: #fff;
    }

    .admin-form button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .admin-form button:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }

    .service-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 2rem;
    }

    .service-table th, .service-table td {
      border: 1px solid #555;
      padding: 1rem;
      text-align: left;
    }

    .service-table th {
      background: #222;
      color: #f0c040;
    }

    .service-table td {
      background: #333;
    }

    .action-buttons {
      display: flex;
      gap: 10px;
    }

    .action-buttons a {
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      color: white;
      transition: background-color 0.3s;
    }

    .action-buttons .edit {
      background-color: #28a745;
    }

    .action-buttons .edit:hover {
      background-color: #218838;
    }

    .action-buttons .delete {
      background-color: #dc3545;
    }

    .action-buttons .delete:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>
  <header>
    <div class="container header-content">
      <img src="../img/logo.png" alt="Your Logo" class="logo">
      <nav>
        <a href="indexxadmin.php">Booking Report</a>
        <a href="feedbackadmin.php">Feedback</a>
        <a href="portfolioadmin.php">Portfolio</a>
        <a href="logout.php" class="login-button">Logout</a>
      </nav>
    </div>
  </header>

  <section class="admin-container container">
    <h2 class="admin-title">Admin Service Manager</h2>

    <!-- Form to Add/Update Services -->
    <form class="admin-form" action="save_service.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" id="service-id">

      <label for="service-name">Service Name:</label>
      <input type="text" name="service_name" id="service-name" required>

      <label for="price-photo">Photo Price (RM):</label>
      <input type="number" name="price_photo" id="price-photo" required>

      <label for="price-video">Video Price (RM):</label>
      <input type="number" name="price_video" id="price-video" required>

      <label for="pax">PAX:</label>
      <input type="text" name="pax" id="pax" required>

      <label for="time">Time:</label>
      <input type="text" name="time" id="time" required>

      <label for="description">Description:</label>
      <textarea name="description" id="description" rows="5" required></textarea>

      <label for="image">Service Image:</label>
      <input type="file" name="image" id="image">

      <button type="submit">Save Service</button>
    </form>

    <!-- Display Services -->
    <table class="service-table">
      <thead>
        <tr>
          <th>Service Name</th>
          <th>Photo Price (RM)</th>
          <th>Video Price (RM)</th>
          <th>PAX</th>
          <th>Time</th>
          <th>Description</th>
          <th>Image</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'maxy_production');
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch services
        $sql = "SELECT * FROM Services";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['service_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price_photo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price_video']) . "</td>";
            echo "<td>" . htmlspecialchars($row['pax']) . "</td>";
            echo "<td>" . htmlspecialchars($row['time']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Service Image' width='100'></td>";
            echo "<td class='action-buttons'>
                    <a href='#' class='edit' onclick='editService(" . htmlspecialchars(json_encode($row)) . ")'>Edit</a>
                    <a href='delete_service.php?id=" . $row['id'] . "' class='delete'>Delete</a>
                  </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='8'>No services available.</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </section>

  <footer>
    <div class="container">
      <p>© 2021 Maxy Production. All rights reserved.</p>
    </div>
  </footer>

  <script>
    // Populate the form for editing
    function editService(service) {
      // Decode the service object and populate the form
      document.getElementById('service-id').value = service.id;
      document.getElementById('service-name').value = service.service_name;
      document.getElementById('price-photo').value = service.price_photo;
      document.getElementById('price-video').value = service.price_video;
      document.getElementById('pax').value = service.pax;
      document.getElementById('time').value = service.time;
      document.getElementById('description').value = service.description;
    }
  </script>
</body>
</html>







