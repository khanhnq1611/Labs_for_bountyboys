<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$db = new SQLite3('database.db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a statement to retrieve the user's details by username
    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result) {
        // Verify the password
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            header("Location: home.php?id=" . $result['id']); ;
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password";
        }
    } else {
        // Username not found
        echo "User not found";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="index.php" method="post">
        <label for="username">Username:</label>
        <input type="username" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="login.php">Signup</a></p>
</body>
</html>
