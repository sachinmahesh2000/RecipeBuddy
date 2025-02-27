<?php
include 'includes/db.php';
session_start();
$id = "";
$userID = $_SESSION['userID'];
$ingredientsArray = array();


if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $ingredient_sql = "SELECT recipe.RecipeID, recipe.RecipeImagePath, Title, ingredient FROM recipe_ingredients
                      JOIN recipe ON recipe_ingredients.RecipeID = recipe.RecipeID
                      JOIN ingredients ON recipe_ingredients.IngredientID = ingredients.IngredientID
                      WHERE recipe.RecipeID = $id";

  $instructions_sql = "SELECT recipe.RecipeID, instructions.Instruction FROM recipe_instructions
                        JOIN recipe ON recipe_instructions.RecipeID = recipe.RecipeID
                        JOIN instructions ON recipe_instructions.InstructionsID = instructions.InstructionID
                        WHERE recipe.RecipeID = $id";

  $users_sql = "SELECT recipe.RecipeID,users.UserID, Username, UserImagePath FROM `recipe_users`
                  JOIN recipe ON recipe_users.RecipeID = recipe.RecipeID
                  JOIN users ON recipe_users.UserID = users.UserID
                  WHERE recipe.RecipeID = $id";

  $units_sql = "SELECT recipe.RecipeID, Unit, Quantity, ingredients.Ingredient FROM recipe_ingredients_units
                JOIN recipe ON recipe_ingredients_units.RecipeID = recipe.RecipeID
                JOIN units ON recipe_ingredients_units.UnitID = units.UnitID
                JOIN ingredients ON recipe_ingredients_units.IngredientID = ingredients.IngredientID
                WHERE recipe.RecipeID = $id";

  $likes_sql = "SELECT COUNT(RecipeID) AS 'Likes' FROM recipe_likes WHERE RecipeID = $id";

  $already_liked_sql = "SELECT COUNT(RecipeID) AS 'Likes' FROM recipe_likes WHERE RecipeID = $id and UserID = $userID ";

  $ingredient_result = mysqli_query($conn, $ingredient_sql);
  $ingredient_row = mysqli_fetch_assoc($ingredient_result);
  $instructions_result = mysqli_query($conn, $instructions_sql);
  $users_result = mysqli_query($conn, $users_sql);
  $users_row = mysqli_fetch_assoc($users_result);
  $units_result = mysqli_query($conn, $units_sql);
  $likes_result = mysqli_query($conn, $likes_sql);
  $likes_row = mysqli_fetch_assoc($likes_result);
  $already_liked_result = mysqli_query($conn, $already_liked_sql);
  $already_liked_row = mysqli_fetch_assoc($already_liked_result);

  $like_class = $already_liked_row['Likes'] == 1 ? "text-danger" : "";


  if ($ingredient_result) {
    while ($row = mysqli_fetch_assoc($ingredient_result)) {
      $ingredientsArray[] = $row;
    }
  }
  if ($units_result) {
    while ($row = mysqli_fetch_assoc($units_result)) {
      $unitsArray[] = $row;
    }
  }
}
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Recipe</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <style>
    .border-heart {
      color: transparent;
      -webkit-text-stroke-width: 1px;
      -webkit-text-stroke-color: red;
    }
  </style>
  <script>
        function addLike() {
          console.log("clicked");
            var xhr = new XMLHttpRequest();
            console.log(xhr);
            xhr.open('POST', 'addLike.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            // xhr.onreadystatechange = function() {
            //     if (xhr.readyState === 4 && xhr.status === 200) {
                    
            //     }
            // };
            debugger;
            xhr.send('recipeID=<?php echo $id;?>&userID=<?php echo $userID?>'); // Send any necessary parameters
            location.reload();
        }
    </script>
</head>

<body style="font-family: 'Abhaya Libre', serif">
  <nav
    class="navbar navbar-expand-md sticky-top bg-body py-3"
    style="
        background: var(--bs-primary);
        border-bottom: 1px solid var(--bs-primary);
      ">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php"><span
          class="fs-2 fw-semibold"
          style="color: var(--bs-primary); padding-top: 10px">Recipe Buddy</span></a><button
        data-bs-toggle="collapse"
        class="navbar-toggler"
        data-bs-target="#navcol-2"
        style="padding-top: 8px">
        <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navcol-2">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a
              class="nav-link active fs-4 fw-normal"
              href="index.php"
              style="
                  border-bottom-color: var(--bs-primary-text-emphasis);
                  color: var(--bs-dark-text-emphasis);
                ">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-4 fw-semibold active" href="recipes.php">Recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-4" href="contactus.php">Contact Us</a>
          </li>
          <?php
          if (isset($_SESSION['Username']) && $_SESSION['loggedin'] == true) {
            echo '<li class="nav-item"><a class="nav-link fs-4" href="cart.php">Cart</a></li>';
            echo '<li class="nav-item"><a class="nav-link fs-4" href="mybook.php">My Book</a></li>';
            echo '<li class="nav-item"><a class="nav-link fs-4" href="account.php">My Account</a></li>';
          } else {
            echo '<a class="btn btn-primary fs-4 ms-md-2" role="button" href="login.php" style="border-radius: 8px">Login</a>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- ingredient -->
  <div
    class="container py-4 py-xl-5"
    style="padding-top: 8px; margin-top: -24px">
    <div class="row d-flex justify-content-between align-items-center flex-lg-row flex-sm-column">
      <div class="col mt-sm-2 mt-md-2">
        <h1 class="display-5" style="margin-bottom: 20px"><?php echo $ingredient_row['Title'] ?></h1>
      </div>
      <div class="col d-flex mb-sm-3 mb-md-3 justify-content-sm-start justify-content-md-start justify-content-lg-end">
        <div class="row ">
          <div class="col d-flex align-items-center">
            <h1 class="fs-3"><?php echo $users_row['Username'] ?></h1>
          </div>
          <div class="col">
            <img
              class="rounded-circle flex-shrink-0 me-3 fit-cover"
              width="50"
              height="50"
              src="<?php echo $users_row['UserImagePath']; ?>" />
          </div>
        </div>
      </div>
    </div>
    <div class="container mb-2">
      <div class="d-flex align-items-center">
        <i id="heartIcon" class="border-heart fas fa-heart fa-2x <?php echo $like_class; ?> mr-2" onclick="addLike()"></i>
        <span id="vote-count" class="fs-1 ms-2"><?php echo $likes_row['Likes'];?></span>
      </div>
    </div>
    <div class="d-flex row flex-lg-row flex-xs-column flex-sm-column ">
      <div class="col mb-sm-3 mb-md-3">
        <img
          class="rounded w-100 h-100 fit-cover"
          style="min-height: 300px"
          src="<?php echo $ingredient_row['RecipeImagePath']; ?>" />
      </div>
      <div class="col">
        <div class="container d-flex flex-column">
          <h4 class="fs-3">Ingredients</h4>
          <ol class="list-group list-group-flush list-group-numbered fs-5 mb-2">
            <?php foreach ($unitsArray as $unit): ?>
              <li class="list-group-item">
                <?php echo $unit['Ingredient']; ?>
                | Quantity: <?php echo $unit['Quantity'] . $unit['Unit']; ?>
              </li>
            <?php endforeach; ?>
          </ol>
          <h4 class="fs-3">Instructions</h4>
          <ol class="list-group list-group-flush list-group-numbered fs-5">
            <?php while ($instructions_row = mysqli_fetch_assoc($instructions_result)): ?>
              <li class="list-group-item"><?php echo $instructions_row['Instruction']; ?></li>
            <?php endwhile; ?>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Dynamic ingredients Card -->
  <div
    class="container">
    <?php foreach ($unitsArray as $ingredient): ?>
      <div
        class="row d-flex m-2 d-xxl-flex flex-row justify-content-xxl-center align-items-xxl-center">
        <div class="col-md-12 col-xxl-6 d-xxl-flex align-items-xxl-center">
          <h3><?php echo $ingredient['Ingredient']; ?></h3>
        </div>
        <div
          class="col d-xxl-flex justify-content-xxl-end align-items-xxl-center">
          <h3 style="padding-top: 10px; padding-right: 20px">$1.49</h3>
          <button
            class="btn btn-primary btn-lg d-xxl-flex justify-content-xxl-center align-items-xxl-center"
            type="button">
            Add to Cart
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>


  <div
    class="container d-sm-flex justify-content-sm-end align-items-sm-center"
    style="padding-bottom: 12px">
    <?php
    if (isset($_SESSION['Username']) && $_SESSION['loggedin'] == true) {
      echo '<a
      class="bg-primary-subtle bg-opacity-10 border rounded-pill border-1 border-primary"
      href="cart.php"
      data-bs-theme="light">View Cart</a>';
    }
    ?>

  </div>
  <footer class="text-center bg-dark">
    <div class="container text-white py-4 py-lg-5">
      <ul class="list-inline">
        <li class="list-inline-item me-4">
          <a class="fs-5 link-light" href="recipes.php">Recipes</a>
        </li>
        <li class="list-inline-item fs-5 me-4">
          <a class="fs-5 link-light" href="contactus.php">Contact us</a>
        </li>
        <li class="list-inline-item fs-5">
          <a class="fs-5 link-light" href="mybook.php">My Recipes</a>
        </li>
      </ul>
      <ul class="list-inline fs-5">
        <li class="list-inline-item fs-5 me-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="1em"
            height="1em"
            fill="currentColor"
            viewBox="0 0 16 16"
            class="bi bi-facebook fs-5 text-light">
            <path
              d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"></path>
          </svg>
        </li>
        <li class="list-inline-item fs-5 me-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="1em"
            height="1em"
            fill="currentColor"
            viewBox="0 0 16 16"
            class="bi bi-twitter fs-5 text-light">
            <path
              d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15"></path>
          </svg>
        </li>
        <li class="list-inline-item fs-5">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="1em"
            height="1em"
            fill="currentColor"
            viewBox="0 0 16 16"
            class="bi bi-instagram fs-5 text-light">
            <path
              d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"></path>
          </svg>
        </li>
      </ul>
      <p class="fs-3 mb-0" style="color: var(--bs-tertiary-bg)">
        Copyright © 2023 Recipe Buddy
      </p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>