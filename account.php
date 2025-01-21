<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

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
                            style="
                  border-bottom-color: var(--bs-primary-text-emphasis);
                  color: var(--bs-dark-text-emphasis);
                ">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="recipes.php">Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="contactus.php">Contact Us</a>
                    </li>
                    <?php
                    if (isset($_SESSION['Username']) && $_SESSION['loggedin'] == true) {
                        echo '<li class="nav-item"><a class="nav-link fs-4" href="mybook.php">My Book</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome, <?php echo $_SESSION['Username']; ?>!</h5>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>