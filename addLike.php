<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeID = $_POST['recipeID'];
    $userID = $_POST['userID'];

    $insert_sql = "INSERT INTO recipe_likes(RecipeID, UserID) VALUES ($recipeID, $userID)";
    $conn->query($insert_sql);
}
?>