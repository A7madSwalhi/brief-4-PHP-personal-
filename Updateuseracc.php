<?php 
session_start();

if (!isset($_SESSION['user_type'])) {
    include_once("logout.php");
    header("location: login.php");
    exit();
} else {
    if ($_SESSION['user_type'] == "admin") {
        include_once("logout.php");
        exit();
    }
}

require_once('config.php');
require_once("include/clsValidator.php");

// Find user by id
function db_find(string $table, $id): mixed
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $table WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}

// Find the first record by condition
function db_first(string $table, string $condition): mixed
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $table $condition");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}

// Update user by id
function db_update(string $table, array $data, $id): array
{
    global $conn;
    $setPart = [];
    foreach ($data as $key => $value) {
        $setPart[] = "$key = ?";
    }
    $setString = implode(", ", $setPart);

    $stmt = $conn->prepare("UPDATE $table SET $setString WHERE user_id= ?");
    
    $types = str_repeat("s", count($data)) . "i";
    $values = array_values($data);
    $values[] = $id;

    $stmt->bind_param($types, ...$values);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM $table WHERE user_id= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $result;
}

$stat = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["user_id"])) {
        $Curruser = db_find('users', $_SESSION['user_id']);
        $username = $conn->real_escape_string($_POST["username"]);
        $email = $conn->real_escape_string($_POST["email"]);

        $updemail = db_first('users', "WHERE email = '$email'");
        $upduser = db_first('users', "WHERE name = '$username'");

        if ($updemail && $upduser) {
            if (!($Curruser['email'] == $updemail['email'] && $Curruser['name'] == $upduser['name'])) {
                db_update('users', ["email" => $updemail['email'], "name" => $upduser['name']], $_SESSION["user_id"]);
                $stat = "Email And Username Updated.";
            } elseif ($Curruser['email'] != $updemail['email'] && $Curruser['name'] == $upduser['name']) {
                db_update('users', ["email" => $updemail['email']], $_SESSION["user_id"]);
                $stat = "Email Updated.";
            } elseif ($Curruser['email'] == $updemail['email'] && $Curruser['name'] != $upduser['name']) {
                db_update('users', ["name" => $upduser['name']], $_SESSION["user_id"]);
                $stat = "Username Updated.";
            } else {
                $stat = "You didn't change anything to update.";
            }
            
                $conn->close();
        }
      }
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <!-- Mirrored from htmldemo.net/flosun/flosun/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Dec 2022 05:03:27 GMT -->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>FloSun - Flower Shop HTML5 Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Favicon -->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/images/favicon.ico"
    />

    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font.awesome.min.css" />
    <!-- Linear Icons CSS -->
    <link rel="stylesheet" href="assets/css/vendor/linearicons.min.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css" />
    <!-- Jquery ui CSS -->
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.min.css" />
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css" />

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <body>
    <!-- Header Area Start Here -->
    <header class="main-header-area">
      <!-- Main Header Area Start -->
      <div class="main-header header-sticky">
        <div class="container custom-area">
          <div class="row align-items-center">
            <div class="col-lg-2 col-xl-2 col-md-6 col-6 col-custom">
              <div class="header-logo d-flex align-items-center">
                <a href="index.html">
                  <img
                    class="img-full"
                    src="assets/images/logo/logo.png"
                    alt="Header Logo"
                  />
                </a>
              </div>
            </div>
            <div
              class="col-lg-8 d-none d-lg-flex justify-content-center col-custom"
            >
              <nav class="main-nav d-none d-lg-flex">
                <ul class="nav">
                  <li>
                    <a href="index.html">
                      <span class="menu-text"> Home</span>
                      <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-submenu dropdown-hover">
                      <li><a href="index.html">Home Page - 1</a></li>
                      <li><a href="index-2.html">Home Page - 2</a></li>
                      <li><a href="index-3.html">Home Page - 3</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="shop.html">
                      <span class="menu-text">Shop</span>
                      <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="mega-menu dropdown-hover">
                      <div class="menu-colum">
                        <ul>
                          <li><span class="mega-menu-text">Shop</span></li>
                          <li><a href="shop.html">Shop Left Sidebar</a></li>
                          <li>
                            <a href="shop-right-sidebar.html"
                              >Shop Right Sidebar</a
                            >
                          </li>
                          <li>
                            <a href="shop-list-left.html"
                              >Shop List Left Sidebar</a
                            >
                          </li>
                          <li>
                            <a href="shop-list-right.html"
                              >Shop List Right Sidebar</a
                            >
                          </li>
                          <li>
                            <a href="shop-fullwidth.html">Shop Full Width</a>
                          </li>
                        </ul>
                      </div>
                      <div class="menu-colum">
                        <ul>
                          <li><span class="mega-menu-text">Product</span></li>
                          <li>
                            <a href="product-details.html">Single Product</a>
                          </li>
                          <li>
                            <a href="variable-product-details.html"
                              >Variable Product</a
                            >
                          </li>
                          <li>
                            <a href="external-product-details.html"
                              >External Product</a
                            >
                          </li>
                          <li>
                            <a href="gallery-product-details.html"
                              >Gallery Product</a
                            >
                          </li>
                          <li>
                            <a href="countdown-product-details.html"
                              >Countdown Product</a
                            >
                          </li>
                        </ul>
                      </div>
                      <div class="menu-colum">
                        <ul>
                          <li><span class="mega-menu-text">Others</span></li>
                          <li><a href="error-404.html">Error 404</a></li>
                          <li><a href="compare.html">Compare Page</a></li>
                          <li><a href="cart.html">Cart Page</a></li>
                          <li><a href="checkout.html">Checkout Page</a></li>
                          <li><a href="wishlist.html">Wishlist Page</a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a href="blog-details-fullwidth.html">
                      <span class="menu-text"> Blog</span>
                      <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-submenu dropdown-hover">
                      <li><a href="blog.html">Blog Left Sidebar</a></li>
                      <li>
                        <a href="blog-list-right-sidebar.html"
                          >Blog List Right Sidebar</a
                        >
                      </li>
                      <li>
                        <a href="blog-list-fullwidth.html"
                          >Blog List Fullwidth</a
                        >
                      </li>
                      <li><a href="blog-grid.html">Blog Grid Page</a></li>
                      <li>
                        <a href="blog-grid-right-sidebar.html"
                          >Blog Grid Right Sidebar</a
                        >
                      </li>
                      <li>
                        <a href="blog-grid-fullwidth.html"
                          >Blog Grid Fullwidth</a
                        >
                      </li>
                      <li>
                        <a href="blog-details-sidebar.html"
                          >Blog Details Sidebar</a
                        >
                      </li>
                      <li>
                        <a href="blog-details-fullwidth.html"
                          >Blog Details Fullwidth</a
                        >
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a class="active" href="#">
                      <span class="menu-text"> Pages</span>
                      <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-submenu dropdown-hover">
                      <li><a href="contact-us.html">Contact</a></li>
                      <li><a href="my-account.html">My Account</a></li>
                      <li><a href="frequently-questions.html">FAQ</a></li>
                      <li><a class="active" href="login.html">Login</a></li>
                      <li><a href="register.html">Register</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="about-us.html">
                      <span class="menu-text"> About Us</span>
                    </a>
                  </li>
                  <li>
                    <a href="contact-us.html">
                      <span class="menu-text">Contact Us</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="col-lg-2 col-md-6 col-6 col-custom">
              <div class="header-right-area main-nav">
                <ul class="nav">
                  <li class="minicart-wrap">
                    <a href="#" class="minicart-btn toolbar-btn">
                      <i class="fa fa-shopping-cart"></i>
                      <span class="cart-item_count">3</span>
                    </a>
                    <div
                      class="cart-item-wrapper dropdown-sidemenu dropdown-hover-2"
                    >
                      <div class="single-cart-item">
                        <div class="cart-img">
                          <a href="cart.html"
                            ><img src="assets/images/cart/1.jpg" alt=""
                          /></a>
                        </div>
                        <div class="cart-text">
                          <h5 class="title">
                            <a href="cart.html">Odio tortor consequat</a>
                          </h5>
                          <div class="cart-text-btn">
                            <div class="cart-qty">
                              <span>1×</span>
                              <span class="cart-price">$98.00</span>
                            </div>
                            <button type="button">
                              <i class="fa fa-trash-o"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="single-cart-item">
                        <div class="cart-img">
                          <a href="cart.html"
                            ><img src="assets/images/cart/2.jpg" alt=""
                          /></a>
                        </div>
                        <div class="cart-text">
                          <h5 class="title">
                            <a href="cart.html">Integer eget augue</a>
                          </h5>
                          <div class="cart-text-btn">
                            <div class="cart-qty">
                              <span>1×</span>
                              <span class="cart-price">$98.00</span>
                            </div>
                            <button type="button">
                              <i class="fa fa-trash-o"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="single-cart-item">
                        <div class="cart-img">
                          <a href="cart.html"
                            ><img src="assets/images/cart/3.jpg" alt=""
                          /></a>
                        </div>
                        <div class="cart-text">
                          <h5 class="title">
                            <a href="cart.html">Eleifend quam</a>
                          </h5>
                          <div class="cart-text-btn">
                            <div class="cart-qty">
                              <span>1×</span>
                              <span class="cart-price">$98.00</span>
                            </div>
                            <button type="button">
                              <i class="fa fa-trash-o"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                      <div
                        class="cart-price-total d-flex justify-content-between"
                      >
                        <h5>Total :</h5>
                        <h5>$166.00</h5>
                      </div>
                      <div class="cart-links d-flex justify-content-between">
                        <a
                          class="btn product-cart button-icon flosun-button dark-btn"
                          href="cart.html"
                          >View cart</a
                        >
                        <a
                          class="btn flosun-button secondary-btn rounded-0"
                          href="checkout.html"
                          >Checkout</a
                        >
                      </div>
                    </div>
                  </li>
                  <li class="sidemenu-wrap">
                    <a href="#"><i class="fa fa-search"></i> </a>
                    <ul
                      class="dropdown-sidemenu dropdown-hover-2 dropdown-search"
                    >
                      <li>
                        <form action="#">
                          <input
                            name="search"
                            id="search"
                            placeholder="Search"
                            type="text"
                          />
                          <button type="submit">
                            <i class="fa fa-search"></i>
                          </button>
                        </form>
                      </li>
                    </ul>
                  </li>
                  <li class="account-menu-wrap d-none d-lg-flex">
                    <a href="#" class="off-canvas-menu-btn">
                      <i class="fa fa-bars"></i>
                    </a>
                  </li>
                  <li class="mobile-menu-btn d-lg-none">
                    <a class="off-canvas-btn" href="#">
                      <i class="fa fa-bars"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Main Header Area End -->
    </header>

    <!-- Header Area End Here -->
    <!-- Breadcrumb Area Start Here -->
    <div class="my-account-wrapper mt-no-text">
    <div class="container container-default-2 custom-area">
      <div class="row">
        <div class="col-lg-12 col-custom">
          <!-- My Account Page Start -->
          <div class="myaccount-page-wrapper">
            <!-- My Account Tab Menu Start -->
            <div class="row">
              <div class="col-lg-3 col-md-4 col-custom">
                <div class="myaccount-tab-menu nav" role="tablist">
                  <a href="userDetails.php" >
                    <i class="fa fa-dashboard"></i> Account Details
                  </a>
                  <a href="Updateuseracc.php" class="active">
                    <i class="fa fa-user"></i> Update Account
                  </a>
                  <a href="updateuserpass.php">
                    <i class="fa fa-lock"></i> Change Password
                  </a>
                  <a href="logout.php">
                    <i class="fa fa-sign-out"></i> Logout
                  </a>
                </div>
              </div>
              <!-- My Account Tab Menu End -->

              <!-- My Account Tab Content Start -->
              <div class="col-lg-9 col-md-8 col-custom">
                <div class="myaccount-content">
                  <h3>Update Account</h3>
                  <div class="account-details-form">
                    <form action="" method="post" id="form">
                      <div class="single-input-item mb-3">
                        <label for="username" class="required mb-1">Username</label>
                        <input type="text" id="username" placeholder="Username" name="username" value="<?php echo $_SESSION['user_name'] ?>"/>
                      </div>
                      <div id="usernameerr" style="color: red;margin-bottom:20px;"></div>
                      <div class="single-input-item mb-3">
                        <label for="email" class="required mb-1">Email Address</label>
                        <input type="email" id="email" placeholder="Email Address" name="email"  value="<?php echo $_SESSION['user_email'] ?>" />
                      </div>
                      <div id="emailerr" style="color: red;margin-bottom:20px;"></div>
                      <div class="single-input-item single-item-button">
                        <button class="btn flosun-button secondary-btn theme-color rounded-0" type="submit">
                          Save Changes
                        </button>
                        <?php if (!is_null($stat)) {
                          if ($stat === "You dont change any Thing to Update it") {
                            echo '<div id="state" style="color: red;margin:20px 0 0 0;">'. $stat . '</div>';
                          }else {
                            echo '<div id="state" style="color: green;margin:20px 0 0 0;">'. $stat . '</div>';
                          }
                        }?>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- My Account Tab Content End -->
            </div>
          </div>
          <!-- My Account Page End -->
        </div>
      </div>
    </div>
  </div>

    <!-- Breadcrumb Area End Here -->
    <!-- my account wrapper start -->

    <!-- my account wrapper end -->

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- jQuery Migrate JS -->
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Swiper Slider JS -->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <!-- nice select JS -->
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <!-- Ajaxchimpt js -->
    <script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script>
    <!-- Jquery Ui js -->
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <!-- Jquery Countdown js -->
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <!-- jquery magnific popup js -->
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <script>
          let usernamereg = /^[a-zA-z0-9_-]{3,16}$/;
          let emailreg = /^([a-z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

          let form = document.getElementById("form");
          let email = document.querySelector("input[name='email']");
          let username = document.querySelector("input[name='username']");
          let emailerr = document.querySelector("#emailerr");
          let userlerr = document.querySelector("#usernameerr");


          email.addEventListener("blur", () => {
            if (!emailreg.test(email.value)) {
              emailerr.innerHTML = "Invalid Email";
            } else {
              emailerr.innerHTML = "";
            }
          });

          username.addEventListener("blur", () => {
            if (!usernamereg.test(username.value)) {
              userlerr.innerHTML = "Invalid Username";
            } else {
              userlerr.innerHTML = "";
            }
          });


          form.onsubmit = (e) => {

              let validation = true;

              if (!emailreg.test(email.value)) {
                console.log("Invalid email");
                validation = false;
              }

              if (!usernamereg.test(username.value)) {
                console.log("Invalid username");
                validation = false;
              }

              if (validation) {
                btn.disabled = true;
              } else {
                e.preventDefault();
              }
};


          console.log(form);
          console.log(email);
          console.log(username);
          console.log(emailerr);
          console.log(userlerr);



    </script>
  </body>

  <!-- Mirrored from htmldemo.net/flosun/flosun/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Dec 2022 05:03:27 GMT -->
</html>
