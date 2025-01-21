<?php
session_start();
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
                      <tr>
                        <th scope="row" class="border-0">
                          <div class="p-2">
                            <img
                              src="https://res.cloudinary.com/dnpbiimui/image/upload/v1733172822/xlvmrmk94vfmbj0a0z33.jpg"
                              alt=""
                              width="70"
                              height="70"
                              class="img rounded shadow-sm"
                            />
                            <div class="ml-3 d-inline-block align-middle">
                              <h5 class="mb-0">
                                <a
                                  href="#"
                                  class="text-dark d-inline-block align-middle"
                                  >Parmesan Cheese</a
                                >
                              </h5>
                            </div>
                          </div>
                        </th>
                        <td class="border-0 align-middle">
                          <strong>$2.99</strong>
                        </td>
                        <td class="border-0 align-middle">
                          <strong>1</strong>
                        </td>
                        <td class="border-0 align-middle">
                          <a href="#" class="text-dark"
                            ><i class="fa fa-trash"></i
                          ></a>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="border-0">
                          <div class="p-2">
                            <img
                              src="https://res.cloudinary.com/dnpbiimui/image/upload/v1733172822/whagitawqzdr1jpygojs.jpg"
                              alt=""
                              width="70"
                              height="70"
                              class="img rounded shadow-sm"
                            />
                            <div class="ml-3 d-inline-block align-middle">
                              <h5 class="mb-0">
                                <a
                                  href="#"
                                  class="text-dark d-inline-block align-middle"
                                  >Pizza Dough</a
                                >
                              </h5>
                            </div>
                          </div>
                        </th>
                        <td class="border-0 align-middle">
                          <strong>$1.49</strong>
                        </td>
                        <td class="border-0 align-middle">
                          <strong>1</strong>
                        </td>
                        <td class="border-0 align-middle">
                          <a href="#" class="text-dark"
                            ><i class="fa fa-trash"></i
                          ></a>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="border-0">
                          <div class="p-2">
                            <img
                              src="https://res.cloudinary.com/dnpbiimui/image/upload/v1733172822/zx6tkg2mpmk9vaqbqqyq.jpg"
                              alt=""
                              width="70"
                              height="70"
                              class="img rounded shadow-sm"
                            />
                            <div class="ml-3 d-inline-block align-middle">
                              <h5 class="mb-0">
                                <a
                                  href="#"
                                  class="text-dark d-inline-block align-middle"
                                  >Mozzarella Cheese</a
                                >
                              </h5>
                            </div>
                          </div>
                        </th>
                        <td class="border-0 align-middle">
                          <strong>$2.38</strong>
                        </td>
                        <td class="border-0 align-middle">
                          <strong>1</strong>
                        </td>
                        <td class="border-0 align-middle">
                          <a href="#" class="text-dark"
                            ><i class="fa fa-trash"></i
                          ></a>
                        </td>
                      </tr>
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
                  <div class="input-group mb-4 border rounded-pill p-2">
                    <input
                      type="text"
                      placeholder="Apply coupon"
                      aria-describedby="button-addon3"
                      class="form-control border-0"
                    />
                    <div class="input-group-append border-0">
                      <button
                        id="button-addon3"
                        type="button"
                        class="btn btn-dark px-4 rounded-pill"
                      >
                        <i class="fa fa-gift mr-2"></i>Apply coupon
                      </button>
                    </div>
                  </div>
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
                    <li
                      class="d-flex justify-content-between py-3 border-bottom"
                    >
                      <strong class="text-muted">Order Subtotal </strong
                      ><strong>$6.86</strong>
                    </li>
                    <li
                      class="d-flex justify-content-between py-3 border-bottom"
                    >
                      <strong class="text-muted">Shipping and handling</strong
                      ><strong>$5.00</strong>
                    </li>
                    <li
                      class="d-flex justify-content-between py-3 border-bottom"
                    >
                      <strong class="text-muted">Tax</strong
                      ><strong>$0.00</strong>
                    </li>
                    <li
                      class="d-flex justify-content-between py-3 border-bottom"
                    >
                      <strong class="text-muted">Total</strong>
                      <h5 class="font-weight-bold">$11.86</h5>
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
