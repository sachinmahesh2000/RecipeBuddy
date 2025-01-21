<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    $conn->begin_transaction();
    try {
        $sql = "DELETE FROM `recipe_instructions` WHERE RecipeID = $recipe_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error deleting from recipe_instructions: " . $conn->error);
        }
        $sql = "DELETE FROM `recipe_ingredients` WHERE RecipeID = $recipe_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error deleting from recipe_ingredients: " . $conn->error);
        }
        $sql = "DELETE FROM recipe WHERE RecipeID = $recipe_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error deleting from recipes: " . $conn->error);
        }
        $conn->commit();
        header("Location: mybook.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
} else {
    echo "Invalid recipe ID.";
}
