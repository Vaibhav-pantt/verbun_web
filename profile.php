<?php
$host = 'localhost';
$username = 'root'; // change if needed
$password = '';     // change if needed
$dbname = 'user-profile';

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $gender   = $_POST['gender'] ?? '';
    $dob      = $_POST['dob'] ?? '';
    $password = $_POST['password'] ?? '';
    $bio      = $_POST['bio'] ?? '';

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = basename($_FILES["profileImage"]["name"]);
        $targetFile = $targetDir . time() . "_" . $imageName;
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    // Prepare and insert data
    $stmt = $conn->prepare("INSERT INTO `profile-info` (name, email, gender, dob, password, bio, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $gender, $dob, $hashedPassword, $bio, $imagePath);

    if ($stmt->execute()) {
        echo "Profile saved successfully.";
    } else {
        echo "Error saving profile: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title></title>
  <link rel="stylesheet" href="profile.css" />
</head>
<body>
  <nav>
    <div class="logo">verbun</div>
    <input type="text" placeholder="Search..." class="search-input" />
    <div class="nav-links">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
    </div>
    <button class="theme-btn" id="theme-toggle">Toggle Theme</button>
  </nav>


  <!-- Main content: Profile Card -->
  <main class="main-content">
    <section class="profile-card">
      <img id="profilePreview" src="https://via.placeholder.com/100" alt="Profile Image" />
     <form id="profileForm" action="profile.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="imageInput" name="profileImage" accept="image/*" />
        <input type="text" name="name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <select name="gender" required>
          <option value="" disabled selected>Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
        <input type="date" name="dob" required />
        <input type="password" name="password" placeholder="Password" required />
        <textarea name="bio" rows="3" placeholder="Short bio (optional)"></textarea>
        <button type="submit">Save Profile</button>
      </form>
    </section>
  </main>

  <section class="progress-section">
  <h2>Language Learning Progress</h2>
  <div class="progress-bars-container">
    <div class="progress-bars">

      <div class="progress-circle" data-progress="75">
        <svg viewBox="0 0 36 36" class="circular-chart blue">
          <path class="circle-bg"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <path class="circle" stroke-dasharray="0, 100"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <text x="18" y="20.35" class="percentage">0%</text>
        </svg>
        <div class="progress-info">
          <h3>Spanish</h3>
          <p>Currently learning basic grammar and vocabulary.</p>
          <small>Last studied: 2 days ago</small>
        </div>
      </div>

      <div class="progress-circle" data-progress="50">
        <svg viewBox="0 0 36 36" class="circular-chart orange">
          <path class="circle-bg"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <path class="circle" stroke-dasharray="0, 100"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <text x="18" y="20.35" class="percentage">0%</text>
        </svg>
        <div class="progress-info">
          <h3>French</h3>
          <p>Focus on conversational skills.</p>
          <small>Last studied: 5 days ago</small>
        </div>
      </div>

      <div class="progress-circle" data-progress="90">
        <svg viewBox="0 0 36 36" class="circular-chart green">
          <path class="circle-bg"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <path class="circle" stroke-dasharray="0, 100"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <text x="18" y="20.35" class="percentage">0%</text>
        </svg>
        <div class="progress-info">
          <h3>Japanese</h3>
          <p>Advanced reading and writing practice.</p>
          <small>Last studied: Today</small>
        </div>
      </div>

      <div class="progress-circle" data-progress="65">
        <svg viewBox="0 0 36 36" class="circular-chart purple">
          <path class="circle-bg"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <path class="circle" stroke-dasharray="0, 100"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <text x="18" y="20.35" class="percentage">0%</text>
        </svg>
        <div class="progress-info">
          <h3>German</h3>
          <p>Grammar exercises ongoing.</p>
          <small>Last studied: 1 day ago</small>
        </div>
      </div>

      <div class="progress-circle" data-progress="40">
        <svg viewBox="0 0 36 36" class="circular-chart red">
          <path class="circle-bg"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <path class="circle" stroke-dasharray="0, 100"
            d="M18 2.0845
               a 15.9155 15.9155 0 0 1 0 31.831
               a 15.9155 15.9155 0 0 1 0 -31.831"
          />
          <text x="18" y="20.35" class="percentage">0%</text>
        </svg>
        <div class="progress-info">
          <h3>Italian</h3>
          <p>Basic vocabulary and phrases.</p>
          <small>Last studied: 3 days ago</small>
        </div>
      </div>

    </div>
  </div>
</section>



  <script src="profile.js"></script>
</body>
</html>
