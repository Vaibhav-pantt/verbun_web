<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "verbun"; // Your actual DB name

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['newUsername'] ?? '';
$password = $_POST['newPassword'] ?? '';

// Optional: hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert into users table
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    echo "Signup successful. <a href='login.php'>Click here to login</a>";
} else {
    echo "Signup failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Language Learning</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="icon" type="image/png" sizes="512x512" href="https://th.bing.com/th/id/OIP.-Xj8GFLdjXXnUOGDiBC2YAHaHF?w=772&h=738&rs=1&pid=ImgDetMain">

</head>
<body>
    <div class="container">
        <h2>Create an Account</h2>
        <form id="signupForm" class="signup-form" method="POST" action="signup.php">

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="newUsername" name="newUsername" placeholder="Create your username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="newPassword" name="newPassword" placeholder="Create a password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>
            <button type="button" class="button" onclick="window.location.href='home.html'">Sign Up</button>

            <p class="login-text">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
    <script>
        function togglePassword() {
            let passwordInput = document.getElementById("newPassword");
            let toggleIcon = document.querySelector(".toggle-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
    <script src="signup.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

