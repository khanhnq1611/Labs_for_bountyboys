<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$db = new SQLite3('database.db');
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
// Fetch user data from the database
if (isset($_SESSION['user_id']))
$user_id = $_SESSION['user_id'];

$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bindValue(1, $user_id, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    
// Handle avatar upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['avatar'])) {
    $upload_dir = "/var/www/html/files/avatars/"; // Directory where avatars will be stored
    $avatar_name = $_FILES['avatar']['name'];
    $avatar_tmp = $_FILES['avatar']['tmp_name'];
    $avatar_size = $_FILES['avatar']['size'];
    $avatar_type = $_FILES['avatar']['type'];

    // Check if file is an image
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'application/x-httpd-php');
    if (!in_array($avatar_type, $allowed_types)) {
        echo "Error: Only JPEG, PNG, PHP and GIF files are allowed.";
        exit();
    }

    // Check file size (max 5MB)
    //$max_size = 5 * 1024 * 1024; // 5MB in bytes
    //if ($avatar_size > $max_size) {
    //    echo "Error: File size exceeds the maximum limit (5MB).";
    //    exit();
    //}

    // Generate unique filename
    //$avatar_filename = uniqid() . '_' . $avatar_name;

    // Move uploaded file to destination directory
    if (move_uploaded_file($avatar_tmp, $upload_dir . $avatar_name)) {
        // Update user's avatar filename in the database
        $stmt = $db->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt->bindValue(1, $avatar_name, SQLITE3_TEXT);
        $stmt->bindValue(2, $user_id, SQLITE3_TEXT);
        $stmt->execute();
        echo "Avatar uploaded successfully.";
    } else {
        echo "Error uploading avatar.";
    }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>My Account</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        padding: 2rem;
      }
      h1 {
        text-align: center;
        margin-bottom: 1rem;
      }
      .account-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 2rem;
      }
      .account-info h2 {
        margin-bottom: 1rem;
      }
      .account-info p {
        margin-bottom: 1rem;
      }
      .account-info input[type="file"] {
        margin-bottom: 1rem;
      }
      .account-info button {
        padding: 0.5rem 2rem;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      .account-info button:hover {
        background-color: #45a049;
      }
      .logout {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: flex;
        align-items: center;
      }
      .logout a {
        margin-left: 1rem;
      }
    </style>
  </head>
  <body>
    <h1>My Account</h1>
    <div class="account-info">
      <?php if ($result): ?>
        <h2>Your username is <em><strong><?= htmlspecialchars($result['username']) ?></strong></em></h2>
        <h2>Your email is <em><strong><?= htmlspecialchars($result['email']) ?></em></strong></h2>
      <?php endif; ?>
      <p>Change avatar</p>
      <form action="account.php" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" accept="image/*" required />
        <button type="submit">Upload avatar</button>
      </form>
    </div>
    <div class="logout">
      <a href="home.html">Home</a>
      <a href="index.php">Logout</a>
    </div>
    </body>
</html>
