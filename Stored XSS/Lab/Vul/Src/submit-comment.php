<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$db = new SQLite3("comments.db");

$postId = $_POST['post_id'];
$comment = $_POST['comment'];
$name = $_POST['name'];

$query = "INSERT INTO posts (name, comments)
         VALUES ( '$name', '$comment')";

$db->exec($query);

// Redirect back to the details page
header('Location: post.php?id=' . $postId);

$db->close();

?>
