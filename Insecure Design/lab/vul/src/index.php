<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$db = new SQLite3('database.db');
$error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "admin") {
    
    $stmt = $db->prepare("SELECT * FROM user WHERE username=:username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        // Verify the password
        if (md5($password) === $result['password']) {
            $error = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-image: url('bghacker.jpeg');
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }
      .container {
        background-color: rgba(250, 250, 250, 0.7);
        padding: 2rem;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }
      h1, h3 {
        text-align: center;
        margin-bottom: 1rem;
      }
      form {
        display: flex;
        flex-direction: column;
      }
      label {
        margin-bottom: 0.5rem;
      }
      input[type="text"],
      input[type="password"] {
        padding: 0.5rem;
        border-radius: 4px;
border: 1px solid #ccc;
      }
      input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 0.5rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 1rem;
      }
      input[type="submit"]:hover {
        background-color: #45a049;
      }
      p {
        text-align: center;
        margin-top: 1rem;
      }
      p a {color: #4CAF50;
        text-decoration: none;
      }
      p a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <h3>Can you login as admin</h3>
      <form action="index.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <input type="submit" value="Login" />
      </form>
      <?php if ($error): ?>
        <p><?php echo "<script>
                alert('WOAHH KING KING HACKER LORD HACKER LORD');
              </script>"; ?></p>
      <?php else: ?>
        <p style="color: red; text-align: center;">Type a correct credential</p>
      <?php endif; ?>
      <p>Forgot your password? <a href="resetpass1.php">I forgot my pass</a></p>
    </div>
  </body>
</html>
