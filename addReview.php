<?php
session_start();
include 'includes/db.php';

$recipe_id = $_POST['recipeID'] ?? null;
$user_id = $_POST['userID'] ?? null;
$commentText = $_POST['CommentText'] ?? null;

$comment_sql = "INSERT INTO comment (CommentText) VALUES ('$commentText')";
$conn->query($comment_sql);
$commentID = $conn->insert_id;

$recipe_comment_sql = "INSERT INTO recipe_comment (RecipeID, CommentID, UserID) VALUES ('$recipe_id','$commentID','$user_id')";
$conn->query($recipe_comment_sql);

?>