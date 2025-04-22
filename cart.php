<?php
session_start();
include 'includes/db.php';

// Initialize variables
$total = 0.00;
$ingredientArray = array();

// Initialize discount
if (!isset($_SESSION['discount'])) {
    $_SESSION['discount'] = 0;
}

// Process coupon code
if (isset($_POST['apply_coupon'])) {
    $coupon_code = strtoupper(trim($_POST['coupon_code']));
    
    if ($coupon_code === 'STUDENT') {
        $_SESSION['discount'] = 0.20; // 20% discount
        $_SESSION['coupon_code'] = $coupon_code;
        $_SESSION['coupon_message'] = 'Student discount (20%) applied successfully!';
        $_SESSION['coupon_status'] = 'success';
    } else {
        $_SESSION['discount'] = 0;
        $_SESSION['coupon_code'] = '';
        $_SESSION['coupon_message'] = 'Invalid coupon code.';
        $_SESSION['coupon_status'] = 'danger';
    }
    
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Get user's cart items
$user_id = $_SESSION['userID'];
$sql = "SELECT users.UserID, ingredients.Ingredient, cart.cartID, ingredients.IngredientID, ingredients.price 
        FROM cart 
        JOIN users ON cart.UserID = users.UserID
        JOIN ingredients ON cart.IngredientID = ingredients.IngredientID
        WHERE users.UserID = $user_id";

$result = mysqli_query($conn, $sql);

// Calculate total from cart items
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ingredientArray[] = $row;
        $total += floatval($row['price']); // Convert price to float and add to total
    }
}

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>RecipeBuddy</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <script>
      //remove from cart function
    function removeIngredient(ingredientId) {
      console.log(ingredientId);
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'removeIngredient.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.send(`IngredientID=${ingredientId}&userID=<?php echo $user_id?>`); // Send any necessary parameters
      location.reload();
    }
    </script>
  </head>
  <body>
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
            <a class="nav-link fs-4 " href="recipes.php">Recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-4" href="contactus.php">Contact Us</a>
          </li>
          <?php
          if (isset($_SESSION['Username']) && $_SESSION['loggedin'] == true) {
            echo '<li class="nav-item"><a class="nav-link fs-4 fw-semibold active" href="cart.php">Cart</a></li>';
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
    <div class="shopping-cart">
      <div class="px-4 px-lg-0">
        <div class="pb-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                <!-- Add this debugging section temporarily at the top of your cart display -->
                <div class="container py-4">
                    <?php
                    // Debug query to show all prices
                    $debug_sql = "SELECT Ingredient, price FROM ingredients WHERE IngredientID IN (SELECT IngredientID FROM cart WHERE UserID = " . $_SESSION['userID'] . ")";
                    $debug_result = mysqli_query($conn, $debug_sql);
                    
                    echo "<div class='alert alert-info'>";
                    echo "<h4>Your Cart Items:</h4>";
                    while ($row = mysqli_fetch_assoc($debug_result)) {
                        echo htmlspecialchars($row['Ingredient']) . ": $" . number_format($row['price'], 2) . "<br>";
                    }
                    echo "</div>";
                    ?>
                </div>
                <!-- Shopping cart table -->
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="border-0 bg-light">
                          <div class="p-2 px-3 text-uppercase">Product</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Price</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Quantity</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Remove</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($ingredientArray != null):?>
                        <?php foreach ($ingredientArray as $i):?>
                        <tr>
                          <th scope="row" class="border-0">
                              <div class="ml-3 d-inline-block align-middle">
                                <h5 class="mb-0">
                                  <a
                                    href="#"
                                    class="text-dark d-inline-block align-middle"
                                    ><?php echo $i['Ingredient'];?></a
                                  >
                                </h5>
                              </div>
                            </div>
                          </th>
                          <td class="border-0 align-middle">
                            <strong>$<?php echo number_format($i['price'], 2); ?></strong>
                          </td>
                          <td class="border-0 align-middle">
                            <strong>1</strong>
                          </td>
                          <td class="border-0 align-middle">
                            <a href="#" class="text-dark ms-4"
                              ><i class="fa fa-trash" onclick="removeIngredient(<?php echo $i['IngredientID']?>)"></i
                            ></a>
                          </td>
                        </tr>
                        <?php endforeach;?>
                      <?php endif;?>
                    </tbody>
                  </table>
                </div>
                <!-- End -->
              </div>
            </div>

            <div class="row py-5 p-4 bg-white rounded shadow-sm">
              <div class="col-lg-6">
                <div
                  class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
                >
                  Coupon code
                </div>
                <div class="p-4">
                  <p class="font-italic mb-4">
                    If you have a coupon code, please enter it in the box below
                  </p>
                  <form method="POST" action="">
                    <div class="input-group mb-4 border rounded-pill p-2">
                      <input
                        type="text"
                        name="coupon_code"
                        placeholder="Apply coupon"
                        aria-describedby="button-addon3"
                        class="form-control border-0"
                        value="<?php echo isset($_SESSION['coupon_code']) ? $_SESSION['coupon_code'] : ''; ?>"
                      />
                      <div class="input-group-append border-0">
                        <button
                          type="submit"
                          name="apply_coupon"
                          class="btn btn-dark px-4 rounded-pill"
                        >
                          <i class="fa fa-gift mr-2"></i>Apply coupon
                        </button>
                      </div>
                    </div>
                  </form>
                  <?php if(isset($_SESSION['coupon_message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['coupon_status']; ?> mt-2">
                      <?php echo $_SESSION['coupon_message']; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div
                  class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
                >
                  Instructions for seller
                </div>
                <div class="p-4">
                  <p class="font-italic mb-4">
                    If you have some information for the seller you can leave
                    them in the box below
                  </p>
                  <textarea
                    name=""
                    cols="30"
                    rows="2"
                    class="form-control"
                  ></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div
                  class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
                >
                  Order summary
                </div>
                <div class="p-4">
                  <p class="font-italic mb-4">
                    Shipping and additional costs are calculated based on values
                    you have entered.
                  </p>
                  <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between py-3 border-bottom">
                      <strong class="text-muted">Order Subtotal </strong>
                      <strong>$<?php echo number_format($total, 2); ?></strong>
                    </li>
                    <?php if ($_SESSION['discount'] > 0): ?>
                    <li class="d-flex justify-content-between py-3 border-bottom">
                      <strong class="text-muted">Discount (20%) </strong>
                      <strong>-$<?php echo number_format($total * $_SESSION['discount'], 2); ?></strong>
                    </li>
                    <?php endif; ?>
                    <li class="d-flex justify-content-between py-3 border-bottom">
                      <strong class="text-muted">Shipping and handling</strong>
                      <strong>$5.00</strong>
                    </li>
                    <li class="d-flex justify-content-between py-3 border-bottom">
                      <strong class="text-muted">Tax</strong>
                      <strong>$0.00</strong>
                    </li>
                    <li class="d-flex justify-content-between py-3 border-bottom">
                      <strong class="text-muted">Total</strong>
                      <h5 class="font-weight-bold">$<?php 
                        $discounted_total = $total * (1 - $_SESSION['discount']);
                        echo number_format($discounted_total + 5.00, 2); 
                      ?></h5>
                    </li>
                  </ul>
                  <a href="#" class="btn btn-dark rounded-pill py-2 btn-block"
                    >Procceed to checkout</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
  </body>
</html>
