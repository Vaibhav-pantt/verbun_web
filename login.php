<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'backend';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Make sure the table `users` exists with columns `username` and `password`
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "User added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Language Learning Login</title>
  <link rel="stylesheet" href="login.css" />
  <style>

  </style>
  <link
    rel="icon"
    type="image/png"
    sizes="512x512"
    href="https://th.bing.com/th/id/OIP.alhj0rKDTAyVES_ZqymUmwAAAA?w=188&h=218&c=7&r=0&o=5&dpr=1.3&pid=1.7"
  />
</head>
<body>
  <div id="content">
    <div class="login-container">
      <h2>Welcome to Language Learning</h2>

      <!-- Message placeholder, will be shown via JS if needed -->
      <p class="message" id="messageBox" style="display: none;"></p>

      <form id="loginForm" class="login-form" method="POST" action="login.php">
        <div class="form-group">
          <label for="username">Username:</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Enter your username"
            required
          />
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter your password"
            required
          />
        </div>

        <button type="submit" class="login-btn">Login</button>
        <p class="signup-text">
          Don't have an account? <a href="signup.html">Sign up here</a>
        </p>
      </form>
    </div>
  </div>

  <script>
    function updateOnlineStatus() {
      const content = document.getElementById('content');
      if (navigator.onLine) {
        content.style.display = 'block';
        content.style.opacity = '1';
      } else {
        content.style.opacity = '0';
        setTimeout(() => (content.style.display = 'none'), 1000);
      }
    }

    window.addEventListener('load', updateOnlineStatus);
    window.addEventListener('online', updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);
  </script>
</body>
</html>

