<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeID = $_POST['recipeID'];
    $userID = $_POST['userID'];
    
    // Check if user has already liked this recipe
    $check_sql = "SELECT Recipe_Likes_ID FROM recipe_likes 
                  WHERE RecipeID = ? AND UserID = ?";
    
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $recipeID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User has already liked, so unlike
        $delete_sql = "DELETE FROM recipe_likes 
                      WHERE RecipeID = ? AND UserID = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("ii", $recipeID, $userID);
        $stmt->execute();
        echo 'unliked';
    } else {
        // User hasn't liked, so add like
        $insert_sql = "INSERT INTO recipe_likes(RecipeID, UserID) 
                      VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ii", $recipeID, $userID);
        $stmt->execute();
        echo 'liked';
    }
}
?>