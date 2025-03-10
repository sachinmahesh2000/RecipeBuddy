<?php
include 'includes/db.php';

$recipe_id = $_GET['id'];
$recipe = null;
$ingredients = array();
$instructions = [];
$quantites = [];


// Fetch recipe
if ($recipe_id) {
    $sql = "SELECT * FROM recipe WHERE RecipeID = $recipe_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $recipe = mysqli_fetch_assoc($result);
    }

    $units_sql = "SELECT * FROM units";
    $units_result = mysqli_query($conn, $units_sql);
    while ($units_row = mysqli_fetch_assoc($units_result)) {
        $units[] = $units_row;
    }

    // Fetch ingredients
    // $sql = "SELECT ingredients.IngredientID, Ingredient, Quantity, Unit, UnitID FROM `recipe_ingredients` 
    //         JOIN recipe ON recipe_ingredients.RecipeID = recipe.RecipeID
    //         JOIN ingredients ON recipe_ingredients.IngredientID = ingredients.IngredientID
    //         WHERE recipe.RecipeID = $recipe_id";

    $sql = "SELECT recipe.RecipeID, Unit, Quantity, ingredients.Ingredient, ingredients.IngredientID FROM recipe_ingredients_units
                JOIN recipe ON recipe_ingredients_units.RecipeID = recipe.RecipeID
                JOIN units ON recipe_ingredients_units.UnitID = units.UnitID
                JOIN ingredients ON recipe_ingredients_units.IngredientID = ingredients.IngredientID
                WHERE recipe.RecipeID = $recipe_id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ingredients[] = $row;
        }
    }

    // Fetch instructions data 
    $sql = "SELECT instructions.InstructionID, Instruction FROM recipe_instructions 
            JOIN recipe ON recipe_instructions.RecipeID = recipe.RecipeID
            JOIN instructions ON recipe_instructions.InstructionsID = instructions.InstructionID
            WHERE recipe.RecipeID = $recipe_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $instructions[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $quantities = $_POST['quantities'];
    $instructions = $_POST['instructions'];
    $image_path = $recipe['image_path'];
    $visibility = $_POST['visibilityRadio'];

    if ($_FILES['image']['tmp_name']) {
        $image_name = $_FILES['image']['name'];
        $image_path = 'assets/img/' . basename($image_name);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    $conn->begin_transaction();
    try {

        //update recipe
        $sql = "UPDATE recipe SET Title = '$title', Description = '$description', RecipeImagePath = '$image_path', RecipeImageName = '$image_name' isPublic = '$visibility' WHERE RecipeID = $recipe_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error updating recipe: " . $conn->error);
        }

        // update ingredients
        $sql = "DELETE FROM recipe_ingredients WHERE RecipeID = $recipe_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error deleting old ingredients: " . $conn->error);
        }
        foreach ($ingredients as $index => $ingredient) {
            $quantity = $quantities[$index];
            $sql = "INSERT INTO ingredients (Ingredient, Quantity) VALUES ('$ingredient', '$quantity') ON DUPLICATE KEY UPDATE IngredientID = LAST_INSERT_ID(IngredientID)";
            if ($conn->query($sql) !== TRUE) {
                throw new Exception("Error inserting ingredient: " . $conn->error);
            }
            $ingredient_id = $conn->insert_id;
            $sql = "INSERT INTO recipe_ingredients (RecipeID, IngredientID ) VALUES ('$recipe_id', '$ingredient_id')";
            if ($conn->query($sql) !== TRUE) {
                throw new Exception("Error inserting recipe ingredient: " . $conn->error);
            }
        }

        // update insctructions
        $sql = "DELETE FROM recipe_instructions WHERE RecipeID = $recipe_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error deleting old instructions: " . $conn->error);
        }
        foreach ($instructions as $instruction) {
            $sql = "INSERT INTO instructions (Instruction) VALUES ('$instruction') ON DUPLICATE KEY UPDATE InstructionID = LAST_INSERT_ID(InstructionID)";
            if ($conn->query($sql) !== TRUE) {
                throw new Exception("Error inserting instruction: " . $conn->error);
            }
            $instruction_id = $conn->insert_id;
            $sql = "INSERT INTO recipe_instructions (RecipeID, InstructionsID) VALUES ('$recipe_id', '$instruction_id')";
            if ($conn->query($sql) !== TRUE) {
                throw new Exception("Error inserting recipe instruction: " . $conn->error);
            }
        }
        $conn->commit();
        // header("Location: view_recipe.php?id=$recipe_id");
        header("Location: mybook.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <style>
        .dynamic-input {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .remove-btn {
            color: red;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <h1 class="mb-4">Edit Recipe</h1>
        <?php if ($recipe): ?>
            <form id="editForm" action="editrecipe.php?id=<?php echo $recipe_id; ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="form-label">Recipe Image</label>
                    <input type="file" class="form-control" id="image" name="image" />
                    <img src="<?php echo $recipe['RecipeImagePath']; ?>" alt="<?php echo $recipe['Title']; ?>" class="img-thumbnail mt-2" width="150">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Recipe Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $recipe['Title']; ?>" required />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Recipe Description</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo $recipe['Description']; ?>
                    </textarea>
                </div>
                <label class="mb-2 fs-4">Visibility</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="visibilityRadio" id="publicRadioID" value="1" <?php if($recipe['isPublic'] == 1) echo "checked";?>>
                    <label class="form-check-label" for="publicRadioID">
                        Public
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="visibilityRadio" id="privateRadioID" value="0" <?php if($recipe['isPublic'] == 0) echo "checked";?>>
                    <label class="form-check-label" for="privateRadioID">
                        Private
                    </label>
                </div>
                <div class="mb-3">
                    <label class="mb-2" for="ingredients">Ingredients</label>
                    <div id="ingredients">
                        <?php foreach ($ingredients as $ingredient): ?>
                            <div class="dynamic-input">
                                <input type="text" class="form-control" name="ingredients[]" value="<?php echo $ingredient['Ingredient']; ?>" required>
                                <input type="text" class="form-control" name="quantities[]" value="<?php echo $ingredient['Quantity']; ?>" required>
                                <select class="form-select" name="units[]" aria-label="SI Units" onclick="populateDropdown(this)">
                                    <!-- todo: set the default value of units when fetching data -->
                                </select>
                                <button type="button" class="btn-close" onclick="removeElement(this)" aria-label="Close"></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addIngredient()">Add Ingredient</button>
                </div>
                <div class="mb-3">
                    <label class="mb-2" for="instructions">Instructions</label>
                    <div id="instructions">
                        <?php foreach ($instructions as $instruction): ?>
                            <div class="dynamic-input">
                                <input type="text" class="form-control" name="instructions[]" value="<?php echo $instruction['Instruction']; ?>" required>
                                <button type="button" class="btn-close" onclick="removeElement(this)" aria-label="Close"></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addInstruction()">Add Instruction</button>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='mybook.php'">Discard</button>
            </form>
        <?php else: ?>
            <p>Recipe not found.</p>
        <?php endif; ?>
    </div>
    <script>
        function addIngredient() {
            var container = document.getElementById('ingredients');
            var input = document.createElement('div');
            input.className = 'dynamic-input';
            input.innerHTML = `
                <input type="text" class="form-control" name="ingredients[]" placeholder="Enter ingredient" required>
                <input type="text" class="form-control" name="quantities[]" placeholder="Enter quantity" required>
                <select class="form-select" name="units[]" aria-label="SI Units" onclick="populateDropdown(this)">
                </select>
                <button type="button" class="btn-close" onclick="removeElement(this)" aria-label="Close"></button>
            `;
            container.appendChild(input);
        }

        function addInstruction() {
            var container = document.getElementById('instructions');
            var input = document.createElement('div');
            input.className = 'dynamic-input';
            input.innerHTML = `
                <input type="text" class="form-control" name="instructions[]" placeholder="Enter instruction" required>
                <button type="button" class="btn-close" onclick="removeElement(this)" aria-label="Close"></button>
            `;
            container.appendChild(input);
        }

        // add instruction row js functions
        function addInstruction() {
            var container = document.getElementById('instructions');
            var input = document.createElement('div');
            input.className = 'dynamic-input';
            input.innerHTML = `
                <input type="text" class="form-control" name="instructions[]" placeholder="Enter instruction" required>
                <button type="button" class="btn-close" onclick="removeElement(this)" aria-label="Close"></button>
            `;
            container.appendChild(input);
        }

        // Pass PHP array to JavaScript
        var units_js = <?php echo json_encode($units); ?>;
        console.log(units_js);

        // Function to populate units dropdowm
        function populateDropdown(element) {
            // appendOptions.call(element, units_js);
            if (element.querySelector('option') == null) {
                units_js.forEach(function(x) {
                    var option = document.createElement('option');
                    option.value = x.UnitID;
                    option.textContent = x.Unit;
                    element.appendChild(option);
                });
            }
        }

        // Call the function after the DOM is loaded
        document.addEventListener('DOMContentLoaded', populateDropdown);

        function removeElement(element) {
            element.parentElement.remove();
        }

        document.getElementById('recipeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            this.submit();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>