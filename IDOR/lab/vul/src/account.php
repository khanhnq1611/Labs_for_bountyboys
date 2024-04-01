<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$db = new SQLite3('idor.db');
if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}
$success = '';
if (isset($_GET['id']))
$user_id = $_GET['id']; else $user_id = $_SESSION['user_id'];

$stmt = $db->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bindValue(1, $user_id, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://i.ytimg.com/vi/Jr_J2YUXms8/maxresdefault.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            padding: 2rem;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            color: white;
        }

        h1 {
            font-size: 2.5rem;
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
            font-size: 1.5rem;
        }

        .account-info img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .account-info input[type="file"] {
            margin-bottom: 1rem;
        }

        .account-info button {
            padding: 0.5rem 2rem;
            background-color: rgba(255, 255, 255, 0.8);
            color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .account-info button:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        .logout {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2rem;
            padding: 1rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 4px;
        }

        .logout a {
            color: #4CAF50;
            text-decoration: none;
            margin-left: 1rem;
            font-size: 1.2rem;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Account</h1>
        <div class="account-info">
            <?php if ($result): ?>
                <img src="https://tse4.mm.bing.net/th?id=OIP.KhoYogN5AtG-vmUvP-zZEgHaEK&pid=Api&P=0&h=220" alt="User Profile">
                <h2>
                    Welcome,
                    <em>
                        <strong><?= htmlspecialchars($result['username']) ?></strong>
                    </em>
                </h2>
                <p>Yourwallet was earned 100$ from the store for the VIP member of the month!</p>
                <p>Total money in your wallet: $<?= htmlspecialchars($result['money']) ?></p>
            <?php endif; ?>
        </div>
        <div class="logout">
            <a href="index2.php">Home</a>
            <a href="signup.php">Logout</a>
        </div>
    </div>
</body>
</html>
</body>
</html>
</html>
