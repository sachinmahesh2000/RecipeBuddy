<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['userID'];
$user_sql = "SELECT * FROM users WHERE UserID = $user_id";
$user_result = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bio = $_POST['bio'];
    
    // Handle image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $image = $_FILES['profile_image']['tmp_name'];
        $image_name = $_FILES['profile_image']['name'];
        $image_path = 'assets/img/profiles/' . basename($image_name);
        
        // Create directory if it doesn't exist
        if (!file_exists('assets/img/profiles/')) {
            mkdir('assets/img/profiles/', 0777, true);
        }
        
        if (move_uploaded_file($image, $image_path)) {
            $update_sql = "UPDATE users SET 
                Username = '$username',
                Email = '$email',
                Phone = '$phone',
                Address = '$address',
                Bio = '$bio',
                UserImagePath = '$image_path',
                UserImageName = '$image_name'
                WHERE UserID = $user_id";
        }
    } else {
        $update_sql = "UPDATE users SET 
            Username = '$username',
            Email = '$email',
            Phone = '$phone',
            Address = '$address',
            Bio = '$bio'
            WHERE UserID = $user_id";
    }
    
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['Username'] = $username;
        $success_message = "Profile updated successfully!";
        // Refresh user data
        $user_result = mysqli_query($conn, $user_sql);
        $user = mysqli_fetch_assoc($user_result);
    } else {
        $error_message = "Error updating profile: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>RecipeBuddy - My Account</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .image-upload-wrapper {
            position: relative;
            display: inline-block;
        }
        .image-upload-wrapper:hover .overlay {
            opacity: 1;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
            cursor: pointer;
        }
        .overlay i {
            color: white;
            font-size: 24px;
        }
    </style>
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
                    <li class="nav-item">
                        <a class="nav-link active fs-4 fw-semibold" href="account.php">My Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <form id="profileForm" method="POST" enctype="multipart/form-data">
                                <div class="image-upload-wrapper">
                                    <img src="<?php echo $user['UserImagePath'] ?: 'assets/img/default-profile.jpg'; ?>" 
                                         alt="Profile" class="profile-image" id="profileImage">
                                    <label for="profile_image" class="overlay">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                    <input type="file" id="profile_image" name="profile_image" 
                                           accept="image/*" style="display: none"
                                           onchange="document.getElementById('profileImage').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                
                                <?php if (isset($success_message)): ?>
                                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                                <?php endif; ?>
                                
                                <?php if (isset($error_message)): ?>
                                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?php echo htmlspecialchars($user['Username']); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" 
                                              rows="3"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio" 
                                              rows="3"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="logout.php" class="btn btn-danger">Logout</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
</body>

</html>