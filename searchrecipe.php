<?php
include 'includes/db.php';
session_start();

$recipes = [];
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $keywords = explode(" ", $search);
    $conditions = [];

    foreach ($keywords as $keyword) {
        $conditions[] = " recipe.Title LIKE '%".$keyword."%'";
    }

    $search_sql = "SELECT
        recipe.RecipeID,
        recipe.RecipeImagePath,
        recipe.Title,
        recipe.Description,
        recipe.isPublic,
        recipe.allergens,
        users.UserID,
        users.Username,
        users.UserImagePath,
        (SELECT SUM(i.price) 
         FROM recipe_ingredients ri 
         JOIN ingredients i ON ri.IngredientID = i.IngredientID 
         WHERE ri.RecipeID = recipe.RecipeID) as total_price
        FROM
          `recipe_users`
        JOIN recipe ON recipe_users.RecipeID = recipe.RecipeID
        JOIN users ON recipe_users.UserID = users.UserID
        WHERE ";
    
    $search_sql .= implode(" OR", $conditions);

    // Add sorting
    if ($sort == 'price_asc') {
        $search_sql .= " ORDER BY total_price ASC";
    } elseif ($sort == 'price_desc') {
        $search_sql .= " ORDER BY total_price DESC";
    }

    $search_result = mysqli_query($conn, $search_sql);
    if ($search_result) {
        while ($search_row = mysqli_fetch_assoc($search_result)) {
            $recipes[] = $search_row;
        }
    }
}
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>RecipeBuddy - Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
  <div class="container py-4 py-xl-5">
    <div class="row mb-5">
      <div class="col-md-8 col-xl-6 text-center mx-auto">
        <h1 class="display-4" style="color: var(--bs-primary)">
          Search Results
        </h1>
        <form method="POST" action="searchrecipe.php" id="searchForm">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search for..." name="search" 
                   value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>" required />
            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Filters Section -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center filter-section">
          <div class="d-flex gap-2 flex-wrap align-items-center">
            <div class="dropdown">
              <button class="btn btn-outline-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-sort"></i> Sort by Price
              </button>
              <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                <li><a class="dropdown-item <?php echo $sort == 'price_asc' ? 'active' : ''; ?>" 
                       href="?<?php echo http_build_query(array_merge($_GET, ['sort' => 'price_asc'])); ?>">
                  <i class="bi bi-arrow-up"></i> Low to High
                </a></li>
                <li><a class="dropdown-item <?php echo $sort == 'price_desc' ? 'active' : ''; ?>" 
                       href="?<?php echo http_build_query(array_merge($_GET, ['sort' => 'price_desc'])); ?>">
                  <i class="bi bi-arrow-down"></i> High to Low
                </a></li>
                <li><a class="dropdown-item <?php echo $sort == '' ? 'active' : ''; ?>" 
                       href="?<?php echo http_build_query(array_diff_key($_GET, ['sort' => ''])); ?>">
                  <i class="bi bi-x"></i> Clear Sorting
                </a></li>
              </ul>
            </div>
            
            <!-- Allergen Filter -->
            <div class="allergen-filter">
              <div class="d-flex flex-wrap gap-2">
                <button class="allergen-btn" data-allergen="vegetarian">Vegetarian</button>
                <button class="allergen-btn" data-allergen="vegan">Vegan</button>
                <button class="allergen-btn" data-allergen="gluten-free">Gluten Free</button>
                <button class="allergen-btn" data-allergen="dairy-free">Dairy Free</button>
                <button class="allergen-btn" data-allergen="nut-free">Nut Free</button>
              </div>
            </div>

            <!-- Reset All Filters Button -->
            <button onclick="window.location.href='recipes.php'" class="btn btn-danger ms-2">
              <i class="bi bi-arrow-counterclockwise"></i> Reset All Filters
            </button>
          </div>

          <!-- Active Filters Display -->
          <div id="activeFilters" class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
            <!-- Active filters will be displayed here via JavaScript -->
          </div>
        </div>
      </div>
    </div>

    <!-- Recipe Cards -->
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin-bottom: 25px" id="recipeBlock">
      <?php if (!empty($recipes)): ?>
        <?php foreach ($recipes as $recipe): ?>
          <?php if ($recipe['isPublic'] == 1): ?>
            <div class="col">
              <div class="card" 
                   data-allergens="<?php echo htmlspecialchars($recipe['allergens'] ?? ''); ?>"
                   style="box-shadow: 0px 0px 6px 1px rgba(225, 225, 225, 0.9)">
                <a href="showrecipe.php?id=<?php echo $recipe['RecipeID']; ?>">
                  <img class="card-img-top w-100 d-block fit-cover" 
                       style="height: 200px" 
                       src="<?php echo $recipe['RecipeImagePath']; ?>" 
                       alt="<?php echo $recipe['Title']; ?>">
                </a>
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title mb-0"><?php echo $recipe['Title']; ?></h4>
                    <span class="badge bg-primary price-badge">
                      $<?php echo number_format($recipe['total_price'] ?? 0, 2); ?>
                    </span>
                  </div>
                  <div class="allergen-tags mb-2">
                    <?php
                    if (!empty($recipe['allergens'])) {
                      $allergens = explode(',', $recipe['allergens']);
                      foreach ($allergens as $allergen) {
                        echo '<span class="badge bg-secondary me-1">' . htmlspecialchars(trim($allergen)) . '</span>';
                      }
                    }
                    ?>
                  </div>
                  <p class="card-text overflow-hidden">
                    <?php echo $recipe['Description']; ?>
                  </p>
                  <div class="d-flex">
                    <img class="rounded-circle flex-shrink-0 me-3 fit-cover"
                         width="50" height="50"
                         src="<?php echo $recipe['UserImagePath']; ?>" />
                    <div class="d-flex align-items-center">
                      <p class="fw-bold mb-0"><?php echo $recipe['Username']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <h3>No recipes found matching your search criteria</h3>
          <a href="recipes.php" class="btn btn-primary mt-3">View All Recipes</a>
        </div>
      <?php endif; ?>
    </div>
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