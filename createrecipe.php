<?php
session_start();
include 'includes/db.php';

$units_sql = "SELECT * FROM units";
$units_result = mysqli_query($conn, $units_sql);
while ($units_row = mysqli_fetch_assoc($units_result)) {
    $units[] = $units_row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Recipe</title>
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
    <div class="container mt-5">
        <h1 class="mb-4">Upload Recipe</h1>
        <form id="recipeForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="mb-2 fs-4" for="image">Recipe Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label class="mb-2 fs-4" for="title">Recipe Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter recipe title" required>
            </div>
            <div class="form-group">
                <label class="mb-2 fs-4" for="description">Recipe Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter recipe description" required></textarea>
            </div>
            <div class="form-group">
                <label class="mb-2 fs-4" for="ingredients">Ingredients</label>
                <div id="ingredients">
                    <div class="dynamic-input">
                        <input type="text" class="form-control" name="ingredients[]" placeholder="Enter ingredient" required>
                        <input type="text" class="form-control" name="quantities[]" placeholder="Enter quantity" required>
                        <select class="form-select" name="units[]" aria-label="SI Units" onclick="populateDropdown(this)">

                        </select>
                        <button type="button" class="btn-close" onclick="removeElement(this)" aria-label="Close"></button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addIngredient()">Add Ingredient</button>
            </div>
            <div class="form-group">
                <label class="mb-2 fs-4" for="instructions">Instructions</label>
                <div id="instructions">
                    <div class="dynamic-input">
                        <input type="text" class="form-control" name="instructions[]" placeholder="Enter instruction" required>
                        <button type="button" class="btn-close" onclick="removeElement(this)" aria-label="Close"></button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addInstruction()">Add Instruction</button>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
    <script>
        // Add Ingredient row js function
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

        // remove (this) referenced eletement
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