<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #e0e9f3;
        }
        .container {
            display: flex;
            height: 100%;
            align-items: flex-start;
            padding: 20px;
            box-sizing: border-box;
        }
        .image {
            width: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image img {
            max-width: 100%;
            height: auto;
            vertical-align: middle;
        }
        .details {
            width: 70%;
            margin-left: 30px;
        }
        h2 {
            font-size: 32px;
            margin-bottom: 10px;
            margin-top: 0;
        }
        p {
            font-size: 20px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .comment-container {
  max-width: 800px;
  margin: 0 auto;
}

.comment-form {
  display: flex;
  flex-direction: column;
  margin-bottom: 2rem;
}

.comment-form input[type="text"],
.comment-form textarea {
  margin-bottom: 1rem;
  padding: 0.5rem;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.comment-form input[type="submit"] {
  padding: 0.5rem;
  border-radius: 5px;
  border: none;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

.comment-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.comment-item {
  display: flex;
  flex-direction: column;
  background-color: #f5f5f5;
  padding: 1rem;
  border-radius: 5px;
}

.comment-header {
  font-weight: bold;
  margin-bottom: 0.5rem;
}

.comment-content {
  white-space: pre-wrap;
  margin-bottom: 0.5rem;
}
    </style>
</head>
<body>
    <div class="container">
	    <a href="index.php">Home</a>
        <div class="image">
            <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                session_start();
		$db = new SQLite3('posts.db');
		$postId = $_GET['id'];
		$query = "SELECT src FROM posts WHERE id = {$postId} ";
		$result = $db->query($query);
		if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		    $linkAddress = $row['src'];
		    $htmlCode = '<img src="' . $linkAddress . '" alt="Item Image">';
		    echo $htmlCode;
		} else {
		    echo "No result found.";
		}
	     ?>

        </div>
        <div class="details">
            <?php
                

                $db = new SQLite3("posts.db");
                if (isset($_GET['id'])) {
                    $postId = $_GET['id'];
                    $query = "SELECT * FROM posts WHERE id = :id";
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':id', $postId, SQLITE3_INTEGER);
                    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

                    if ($result) {
                        echo '<h2>' . $result['title'] . '</h2>';
                        echo '<p>' . $result['description'] . '</p>';
                    } else {
                        echo "<p>No post found with the specified ID.</p>";
                    }
                }
                
            ?>
            <div class="comment-container">
                <h3>Customer Comments</h3>

                <form action="submit-comment.php" method="post" class="comment-form">
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($postId); ?>">

                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required>

                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" rows="5" cols="30" required></textarea>

                    <input type="submit" value="Post">
                </form>
    
                <div class="comment-list">
                    <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);

                        $db = new SQLite3("comments.db");
			$query = "SELECT * FROM posts;";
			$result = $db->query($query);
			
			while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			  echo "<div class='comment-item'>";
			  echo "<div class='comment-header'>" . $row["name"] . "</div>";
 			  echo "<div class='comment-content'>" . $row["comments"] . "</div>";
			  echo "</div>";
			}
			$db->close();

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
