<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$db = new SQLite3('database.db');
$error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $favoriteColor = $_POST['answer1'];
    $money = $_POST['answer2'];
    function generateRandomPassword($length = 8) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$password = '';
    	for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    	}
    	return $password;
    }

    if ($username === 'admin' && $favoriteColor === 'gray' && $money == '14896') {
        $resetPasswordID = generateRandomPassword(18);
        $stmt = $db->prepare("UPDATE user SET password = ? WHERE username = 'admin'");
        $stmt->bindValue(1, md5($resetPasswordID), SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Reset password</title>
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
      h1 {
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
      ul {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;
      }

      ul li {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
      }

      ul li input {
        flex: 1;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>Reset password</h1>
      <form action="resetpass1.php" method="post">
        <p>Step 1 - Please enter your username:</p>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />

        <p>Step 2 - Please answer the following questions:</p>
        <ul>
            <li>
                <label for="question1">What is your favorite color?</label>
                <input type="text" id="answer1" name="answer1" required />
            </li>
            <li>
                <label for="question2">How much money you spent for your first car?</label>
                <input type="text" id="answer2" name="answer2" required />
            </li>
        </ul>
        <input type="submit" value="Submit" />
      </form>
      <?php if ($error): ?>
        <p><?php echo "<script>
                alert('Your password reset ID is: $resetPasswordID');
              </script>"; ?></p>
      <?php else: ?>
        <p style="color: red; text-align: center;">Type a correct answer</p>
            <?php endif; ?>
      <a href="index.php">Back to login</a>
    </div>
  </body>
</html>
