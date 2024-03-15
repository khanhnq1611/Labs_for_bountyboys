<?php
session_start();
$db = new SQLite3('database.db');
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
// Fetch user data from the database
if (isset($_SESSION['user_id']))
$id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bindValue(1, $id, SQLITE3_TEXT);
    $result = $stmt->execute();
    $result->fetchArray(SQLITE3_ASSOC);
// Handle avatar upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['avatar'])) {
    $upload_dir = "avatars/"; // Directory where avatars will be stored
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
    $max_size = 5 * 1024 * 1024; // 5MB in bytes
    if ($avatar_size > $max_size) {
        echo "Error: File size exceeds the maximum limit (5MB).";
        exit();
    }

    // Generate unique filename
    $avatar_filename = uniqid() . '_' . $avatar_name;

    // Move uploaded file to destination directory
    if (move_uploaded_file($avatar_tmp, $upload_dir . $avatar_filename)) {
        // Update user's avatar filename in the database
        $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt->bindParam(1, $avatar_filename, SQLITE3_TEXT);
        $stmt->bindParam(2, $user_id, SQLITE3_INTEGER);
        $stmt->execute();
        echo "Avatar uploaded successfully.";
    } else {
        echo "Error uploading avatar.";
    }
}
include 'account.html';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Page</title>
</head>
<body>
    <h1>My Account</h1>
    <p>Welcome, <?php echo $result['username']; ?>!</p>
    <p>Email: <?php echo $result['email']; ?></p>

    <!-- Display current avatar -->
    <?php if ($result['avatar']): ?>
        <img src="avatars/<?php echo $result['avatar']; ?>" alt="Avatar" width="100">
    <?php else: ?>
        <p>No avatar uploaded.</p>
    <?php endif; ?>

    <!-- Upload new avatar form -->
    <h2>Upload Avatar</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" required>
        <button type="submit">Upload</button>
    </form>

    <!-- Logout link -->
    <a href="logout.php">Logout</a>
</body>
</html>
