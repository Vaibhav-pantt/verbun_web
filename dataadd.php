<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "backend"; // change this

    $con = mysqli_connect($server, $username, $password, $backend);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $u_name = $_POST['username'];
    $u_passw = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO backend (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $u_name, $u_passw);

    if ($stmt->execute()) {
        echo "Successfully inserted";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
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

      <form id="loginForm" class="login-form" method="POST" action="dataadd.php">
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


