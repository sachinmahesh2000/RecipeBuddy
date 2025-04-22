<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $units = $_POST['units'];
    $visibility = $_POST['visibilityRadio'];
    $quantity = $_POST['quantities'];
    $allergens = isset($_POST['allergens']) ? implode(',', $_POST['allergens']) : '';
    $image = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_path = 'assets/img/' . basename($image_name);
    $user_id = $_SESSION['userID'];

    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
        $conn->begin_transaction();

        try {
            $sql = "INSERT INTO recipe (Title, Description, RecipeImagePath, RecipeImageName, isPublic, allergens) VALUES ('$title', '$description', '$image_path', '$image_name', '$visibility', '$allergens')";
            if ($conn->query($sql) === TRUE) {
                $recipe_id = $conn->insert_id;

                foreach ($ingredients as $index => $ingredient) {
                    $sql = "INSERT INTO ingredients (Ingredient) VALUES ('$ingredient') ON DUPLICATE KEY UPDATE IngredientID=LAST_INSERT_ID(IngredientID)";
                    if ($conn->query($sql) === TRUE) {
                        $ingredient_id = $conn->insert_id;
                        $sql = "INSERT INTO recipe_ingredients (RecipeID, IngredientID) VALUES ('$recipe_id', '$ingredient_id')";
                        $conn->query($sql);
                        $units_sql = "INSERT INTO recipe_ingredients_units (UnitID, IngredientID, RecipeID, Quantity) VALUES ($units[$index], $ingredient_id, $recipe_id, $quantity[$index])";
                        $conn->query($units_sql);
                    }
                }

                // Insert into instructions and recipe_insructions
                foreach ($instructions as $index => $instruction) {
                    $sql = "INSERT INTO instructions (Instruction) VALUES ('$instruction') ON DUPLICATE KEY UPDATE InstructionID=LAST_INSERT_ID(InstructionID)";
                    if ($conn->query($sql) === TRUE) {
                        $instruction_id = $conn->insert_id;
                        $recipeInstruction_sql = "INSERT INTO recipe_instructions (RecipeID, InstructionsID) VALUES ('$recipe_id', '$instruction_id')";
                        $conn->query($recipeInstruction_sql);
                    }
                }

                // Insert into recipe_ingredients_units
                // foreach ($units as $index => $unit) {
                //     $sql = "INSERT INTO recipe_ingredients_units (UnitID, IngredientID, RecipeID, Quantity) VALUES ($units[$index], $ingredient_id, $recipe_id, $quantity[$index])";
                //     if ($conn->query($sql) === TRUE) {
                //         $unit_id = $conn->insert_id;
                //     }
                // }

                // Insert into recipe_users table 
                $recipeUsers_sql = "INSERT INTO recipe_users (RecipeID, UserID) VALUES ('$recipe_id', '$user_id')";
                if (!$conn->query($recipeUsers_sql)) {
                    throw new Exception("Error inserting into recipe_users: " . $conn->error);
                }

                $conn->commit();
?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Success</title>
                    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
                </head>

                <body>
                    <div class="container mt-5">
                        <div class="alert alert-success d-flex justify-content-around" role="alert">
                            <h2>
                                Recipe Uploaded Succesfully! :)
                            </h2>
                            <a href="mybook.php" class="btn btn-primary ml-3">Go to My Book</a>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                </body>

                </html>

<?php
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $conn->error);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo $e->getMessage();
        }
    } else {
        echo "Failed to upload image.";
    }
}
