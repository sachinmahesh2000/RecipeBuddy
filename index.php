<?php
session_start();
include 'includes/db.php';
if(isset($_SESSION['userID'])){
  $user_id = $_SESSION['userID'];
}else{
  $user_id = 0;
}
$sql = "SELECT
        recipe.RecipeID,
        recipe.RecipeImagePath,
        recipe.Title,
        recipe.Description,
        users.UserID,
        users.Username,
        users.UserImagePath
        FROM
          `recipe_users`
        JOIN recipe ON recipe_users.RecipeID = recipe.RecipeID
        JOIN users ON recipe_users.UserID = users.UserID
        WHERE users.UserID = $user_id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>RecipeBuddy</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
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
              class="nav-link active fs-4 fw-semibold"
              href="index.php"
              style="border-bottom-color: var(--bs-primary-text-emphasis)">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-4" href="recipes.php">Recipes</a>
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
  <section>
    <div
      data-bss-parallax-bg="true"
      style="
          height: 600px;
          background: linear-gradient(
              145deg,
              rgba(18, 43, 145, 0.8),
              rgba(72, 214, 210, 0.8) 160%
            ),
            url('assets/img/brooke-lark-jUPOXXRNdcA-unsplash.jpg') center /
              cover no-repeat;
        ">
      <div class="container h-100">
        <div class="row h-100">
          <div
            class="col-md-6 text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center">
            <div style="max-width: 350px">
              <h1
                class="display-4 fw-bold"
                style="width: 380px; color: rgb(250, 250, 250)">
                When Life Gives You Vegetables and spices,<br />You Better
                Cook
              </h1>
              <p
                class="lead fs-5 text-light my-3"
                style="color: rgb(250, 250, 250)">
                Tincidunt laoreet leo, adipiscing taciti tempor. Primis
                senectus sapien, risus donec ad fusce augue interdum.
              </p>
              <a
                class="btn btn-primary btn-lg fs-4 link-primary me-2"
                role="button"
                href="recipes.php"
                style="
                    background: #ffffff;
                    font-weight: bold;
                    box-shadow: 0px 0px 6px 1px rgba(102, 102, 102, 0.9);
                    border-bottom-width: 1px;
                    border-bottom-color: var(--bs-indigo);
                  ">Browse Recipes</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container py-4 py-xl-5">
    <div class="row mb-5">
      <div class="col-md-8 col-xl-6 text-center mx-auto">
        <h1 class="display-4" style="color: var(--bs-primary)">
          Trending Recipes
        </h1>
        <p
          class="fs-5 w-lg-50"
          style="color: var(--bs-primary-text-emphasis)">
          Curae hendrerit donec commodo hendrerit egestas tempus, turpis
          facilisis nostra nunc. Vestibulum dui eget ultrices.
        </p>
      </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
      <div class="col">
        <div
          class="card"
          style="box-shadow: 0px 0px 6px 1px rgba(225, 225, 225, 0.9)">
          <img
            class="card-img-top w-100 d-block fit-cover"
            style="height: 200px"
            src="assets/img/recpie-3.jpg" />
          <div class="card-body p-4">
            <h4 class="card-title">Cheesy Pizza</h4>
            <p class="card-text">
              Nullam id dolor id nibh ultricies vehicula ut id elit. Cras
              justo odio, dapibus ac facilisis in, egestas eget quam. Donec id
              elit non mi porta gravida at eget metus.
            </p>
            <div class="d-flex">
              <img
                class="rounded-circle flex-shrink-0 me-3 fit-cover"
                width="50"
                height="50"
                src="assets/img/face-7.jpg" />
              <div>
                <p class="fw-bold mb-0">John Smith</p>
                <p class="text-muted mb-0">Erat netus</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div
          class="card"
          style="box-shadow: 0px 0px 6px 1px rgba(225, 225, 225, 0.9)">
          <img
            class="img-fluid card-img-top w-100 d-block fit-cover"
            style="height: 200px"
            src="assets/img/recpie-1.jpg" />
          <div class="card-body p-4">
            <h4 class="card-title">Healthy Salad Bowl</h4>
            <p class="card-text">
              Nullam id dolor id nibh ultricies vehicula ut id elit. Cras
              justo odio, dapibus ac facilisis in, egestas eget quam. Donec id
              elit non mi porta gravida at eget metus.
            </p>
            <div class="d-flex">
              <img
                class="rounded-circle flex-shrink-0 me-3 fit-cover"
                width="50"
                height="50"
                src="assets/img/face-1.jpg" />
              <div>
                <p class="fw-bold mb-0">John Smith</p>
                <p class="text-muted mb-0">Erat netus</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div
          class="card"
          style="box-shadow: 0px 0px 6px 1px rgba(225, 225, 225, 0.9)">
          <img
            class="img-fluid card-img-top w-100 d-block fit-cover"
            style="height: 200px"
            src="assets/img/recpie-2.jpg" />
          <div class="card-body p-4">
            <h4 class="card-title">Pancackes</h4>
            <p class="card-text">
              Nullam id dolor id nibh ultricies vehicula ut id elit. Cras
              justo odio, dapibus ac facilisis in, egestas eget quam. Donec id
              elit non mi porta gravida at eget metus.
            </p>
            <div class="d-flex">
              <img
                class="rounded-circle flex-shrink-0 me-3 fit-cover"
                width="50"
                height="50"
                src="assets/img/face-2.jpg" />
              <div>
                <p class="fw-bold mb-0">John Smith</p>
                <p class="text-muted mb-0">Erat netus</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section
    style="
        background: linear-gradient(
            145deg,
            rgba(18, 43, 145, 0.8),
            rgba(72, 214, 210, 0.8) 160%
          ),
          url('assets/img/katie-smith-uQs1802D0CQ-unsplash.jpg') center / cover
            no-repeat;
      ">
    <div class="row">
      <div class="col text-center">
        <h1
          class="display-4"
          style="
              margin-bottom: 25px;
              color: var(--bs-tertiary-bg);
              margin-top: 20px;
            ">
          Statistics Globally
        </h1>
      </div>
    </div>
    <div
      class="row gy-4 row-cols-2 row-cols-md-4 d-flex d-xxl-flex justify-content-center align-items-xxl-center"
      style="padding-top: 0px; margin-top: -28px; padding-bottom: 30px">
      <div class="col-xxl-2" style="margin-left: 10px; margin-right: 10px">
        <div
          class="text-center d-flex flex-column justify-content-center align-items-center py-3">
          <div
            class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"
            style="
                box-shadow: 0px 0px 6px 1px rgba(102, 102, 102, 0.9);
                background: var(--bs-body-bg);
                color: var(--bs-primary);
              ">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="1em"
              height="1em"
              fill="currentColor"
              viewBox="0 0 16 16"
              class="bi bi-book">
              <path
                d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"></path>
            </svg>
          </div>
          <div class="px-3">
            <h2 class="fw-bold mb-0" style="color: var(--bs-body-bg)">
              123+
            </h2>
            <p class="mb-0" style="color: var(--bs-body-bg)">Recipes</p>
          </div>
        </div>
      </div>
      <div
        class="col-xxl-2"
        style="
            margin-right: 10px;
            margin-left: 10px;
            color: var(--bs-body-bg);
          ">
        <div
          class="text-center d-flex flex-column justify-content-center align-items-center py-3"
          style="color: var(--bs-body-bg)">
          <div
            class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"
            style="
                box-shadow: 0px 0px 6px 1px rgba(102, 102, 102, 0.9);
                color: var(--bs-primary);
                background: var(--bs-body-bg);
              ">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="1em"
              height="1em"
              fill="currentColor"
              viewBox="0 0 16 16"
              class="bi bi-globe"
              style="color: var(--bs-primary)">
              <path
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472M3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z"></path>
            </svg>
          </div>
          <div class="px-3" style="color: var(--bs-body-bg)">
            <h2 class="fw-bold mb-0" style="color: var(--bs-body-bg)">45+</h2>
            <p class="mb-0" style="color: var(--bs-body-bg)">Countries</p>
          </div>
        </div>
      </div>
      <div
        class="col-xxl-2"
        style="
            margin-right: 10px;
            margin-left: 10px;
            color: var(--bs-body-bg);
          ">
        <div
          class="text-center d-flex flex-column justify-content-center align-items-center py-3"
          style="color: var(--bs-body-bg)">
          <div
            class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"
            style="
                box-shadow: 0px 0px 6px 1px rgba(102, 102, 102, 0.9);
                color: var(--bs-primary);
                background: var(--bs-body-bg);
              ">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="1em"
              height="1em"
              fill="currentColor"
              viewBox="0 0 16 16"
              class="bi bi-cup"
              style="color: var(--bs-primary)">
              <path
                fill-rule="evenodd"
                d="M.11 3.187A.5.5 0 0 1 .5 3h13a.5.5 0 0 1 .488.608l-.22.991a3.001 3.001 0 0 1-1.3 5.854l-.132.59A2.5 2.5 0 0 1 9.896 13H4.104a2.5 2.5 0 0 1-2.44-1.958L.012 3.608a.5.5 0 0 1 .098-.42Zm12.574 6.288a2 2 0 0 0 .866-3.899l-.866 3.9ZM1.124 4l1.516 6.825A1.5 1.5 0 0 0 4.104 12h5.792a1.5 1.5 0 0 0 1.464-1.175L12.877 4H1.123Z"></path>
            </svg>
          </div>
          <div class="px-3" style="color: var(--bs-body-bg)">
            <h2 class="fw-bold mb-0" style="color: var(--bs-body-bg)">67+</h2>
            <p class="mb-0" style="color: var(--bs-body-bg)">Coffee Brewed</p>
          </div>
        </div>
      </div>
      <div
        class="col-xxl-2"
        style="
            margin-right: 10px;
            margin-left: 10px;
            color: var(--bs-body-bg);
          ">
        <div
          class="text-center d-flex flex-column justify-content-center align-items-center py-3"
          style="color: var(--bs-body-bg)">
          <div
            class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg"
            style="
                box-shadow: 0px 0px 6px 1px rgba(102, 102, 102, 0.9);
                color: var(--bs-primary);
                background: var(--bs-body-bg);
              ">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="1em"
              height="1em"
              fill="currentColor"
              viewBox="0 0 16 16"
              class="bi bi-bookmarks"
              style="color: var(--bs-primary)">
              <path
                d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1z"></path>
              <path
                d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1"></path>
            </svg>
          </div>
          <div class="px-3" style="color: var(--bs-body-bg)">
            <h2 class="fw-bold mb-0" style="color: var(--bs-body-bg)">89+</h2>
            <p class="mb-0" style="color: var(--bs-body-bg)">Bookmarks</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div
    class="container py-4 py-xl-5"
    style="border-bottom: 1px solid var(--bs-primary)">
    <div class="row mb-5">
      <div class="col-md-8 col-xl-6 text-center mx-auto">
        <h1 class="display-4" style="color: var(--bs-primary)">
          Testimonials
        </h1>
      </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
      <div class="col">
        <div>
          <p class="bg-body-tertiary border rounded border-0 p-4">
            Nisi sit justo faucibus nec ornare amet, tortor torquent. Blandit
            class dapibus, aliquet morbi.
          </p>
          <div class="d-flex">
            <img
              class="rounded-circle flex-shrink-0 me-3 fit-cover"
              width="50"
              height="50"
              src="assets/img/face-4.jpg" />
            <div>
              <p class="fw-bold text-primary mb-0">John Smith</p>
              <p class="text-muted mb-0">Erat netus</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div>
          <p class="bg-body-tertiary border rounded border-0 p-4">
            Nisi sit justo faucibus nec ornare amet, tortor torquent. Blandit
            class dapibus, aliquet morbi.
          </p>
          <div class="d-flex">
            <img
              class="rounded-circle flex-shrink-0 me-3 fit-cover"
              width="50"
              height="50"
              src="assets/img/face-5.jpg" />
            <div>
              <p class="fw-bold text-primary mb-0">John Smith</p>
              <p class="text-muted mb-0">Erat netus</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div>
          <p class="bg-body-tertiary border rounded border-0 p-4">
            Nisi sit justo faucibus nec ornare amet, tortor torquent. Blandit
            class dapibus, aliquet morbi.
          </p>
          <div class="d-flex">
            <img
              class="rounded-circle flex-shrink-0 me-3 fit-cover"
              width="50"
              height="50"
              src="assets/img/face-6.jpg" />
            <div>
              <p class="fw-bold text-primary mb-0">John Smith</p>
              <p class="text-muted mb-0">Erat netus</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- User Recent Recipes Start -->
  <?php if (isset($_SESSION['Username']) && $_SESSION['loggedin'] == true): ?>
  <div class="container py-4 py-xl-5" style="border-bottom: 1px solid var(--bs-primary)">
    <div class="row mb-5">
      <div class="col-md-8 col-xl-6 text-center mx-auto">
        <h1 class="display-4" style="color: var(--bs-primary)">
          Your Recent Recipes
        </h1>
      </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <!-- Dynamic Recipe Card -->
          <div class="col">
            <div
              class="card"
              style="box-shadow: 0px 0px 6px 1px rgba(225, 225, 225, 0.9)">
              <a href="showrecipe.php?id=<?php echo $row['RecipeID'] ?>">
                <img
                  class="card-img-top w-100 d-block fit-cover"
                  style="height: 200px"
                  src="<?php echo $row['RecipeImagePath']; ?>"
                  alt="<?php echo $row['Title']; ?>" />
              </a>
              <div class="card-body p-4">
                <h4 class="card-title"><?php echo $row['Title']; ?></h4>
                <p class="card-text overflow-hidden">
                  <?php echo $row['Description']; ?>
                </p>
                <div class="d-flex">
                  <img
                    class="rounded-circle flex-shrink-0 me-3 fit-cover"
                    width="50"
                    height="50"
                    src="<?php echo $row['UserImagePath']; ?>" />
                  <div class="d-flex align-items-center">
                    <p class="fw-bold mb-0"><?php echo $row['Username']; ?></p>
                  </div>
                </div>
                <div class="d-flex mt-2">
                  <a href="editrecipe.php?id=<?php echo $row['RecipeID'] ?>" class="btn btn-primary mx-2">Edit</a>
                  <a href="deleterecipe.php?id=<?php echo $row['RecipeID'] ?>" onclick="alert('Do you Really want to delete this delicious recipe?')" class="btn btn-danger">Delete</a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="row text-center" style="margin-top: 20px">
        <div class="col">
          <a class="btn btn-primary btn-lg" role="button" style="padding-left: 26px; padding-right: 26px" href="mybook.php">My Book</a>
        </div>
      </div>
      <?php endif; ?>
  </div>
  <!-- User Recent Recipes End -->

  <section class="position-relative py-4 py-xl-5">
    <div class="container position-relative">
      <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h1 class="display-4">Contact us</h1>
          <p class="fs-5 w-lg-50">
            Curae hendrerit donec commodo hendrerit egestas tempus, turpis
            facilisis nostra nunc. Vestibulum dui eget ultrices.
          </p>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-lg-4 col-xl-4">
          <div
            class="d-flex flex-column justify-content-center align-items-start h-100">
            <div class="d-flex align-items-center p-3">
              <div
                class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  fill="currentColor"
                  viewBox="0 0 16 16"
                  class="bi bi-telephone">
                  <path
                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"></path>
                </svg>
              </div>
              <div class="px-2">
                <h6 class="mb-0">Phone</h6>
                <p class="mb-0">+123456789</p>
              </div>
            </div>
            <div class="d-flex align-items-center p-3">
              <div
                class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  fill="currentColor"
                  viewBox="0 0 16 16"
                  class="bi bi-envelope">
                  <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"></path>
                </svg>
              </div>
              <div class="px-2">
                <h6 class="mb-0">Email</h6>
                <p class="mb-0">info@example.com</p>
              </div>
            </div>
            <div class="d-flex align-items-center p-3">
              <div
                class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  fill="currentColor"
                  viewBox="0 0 16 16"
                  class="bi bi-pin">
                  <path
                    d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A5.921 5.921 0 0 1 5 6.708V2.277a2.77 2.77 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354zm1.58 1.408-.002-.001.002.001m-.002-.001.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007-.054.03a4.922 4.922 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a4.915 4.915 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458 1.775 1.775 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14c.06.1.133.191.214.271a1.78 1.78 0 0 0 .37.282"></path>
                </svg>
              </div>
              <div class="px-2">
                <h6 class="mb-0">Location</h6>
                <p class="mb-0">12 Example Street</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-5 col-xl-4">
          <div>
            <form class="p-3 p-xl-4" method="post">
              <div class="mb-3">
                <input
                  class="form-control"
                  type="text"
                  id="name-1"
                  name="name"
                  placeholder="Name" />
              </div>
              <div class="mb-3">
                <input
                  class="form-control"
                  type="email"
                  id="email-1"
                  name="email"
                  placeholder="Email" />
              </div>
              <div class="mb-3">
                <textarea
                  class="form-control"
                  id="message-1"
                  name="message"
                  rows="6"
                  placeholder="Message"></textarea>
              </div>
              <div>
                <button class="btn btn-primary d-block w-100" type="submit">
                  Send
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
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
  <script src="./assets/js/server.js"></script>
</body>

</html>