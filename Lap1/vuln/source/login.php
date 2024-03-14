<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$db = new SQLite3('database.db');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = sanitize_input($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = sanitize_input($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid_email = true;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    do {
        $user_id = uniqid();
        
        $stmt_check = $db->prepare("SELECT COUNT(*) as count FROM users WHERE id = ?");
        $stmt_check->bindValue(1, $user_id, SQLITE3_TEXT);
        $result_check = $stmt_check->execute();
        $row = $result_check->fetchArray(SQLITE3_ASSOC);
    } while ($row['count'] > 0);

    $stmt = $db->prepare("INSERT INTO users (id, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bindValue(1, $user_id, SQLITE3_TEXT);
    $stmt->bindValue(2, $username, SQLITE3_TEXT);
    $stmt->bindValue(3, $email, SQLITE3_TEXT);
    $stmt->bindValue(4, $password_hash, SQLITE3_TEXT);
    $result = $stmt->execute();
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $db->lastErrorMsg();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <form action="index.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Signup</button>
        </div>
    </form>
</body>
</html>
