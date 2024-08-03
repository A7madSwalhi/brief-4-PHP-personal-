<?php 
session_start();
  
    if (!isset($_SESSION['user_type']) ) {
      
      header("location: login.php");
      exit();
    }else {
      if ($_SESSION['user_type'] == "user") {
        header("location: login.php");
        exit();
      }
    }

    require_once("config.php");
    

    $sqlnporders = "SELECT COUNT(*) as number FROM orders WHERE status = 'pending';";
    $sqltotpay= "SELECT SUM(total)  as total FROM orders WHERE status = 'completed';";
    $sqlnproducts = "SELECT COUNT(*) as number FROM products ;";
    $sqlnusers = "SELECT COUNT(*) as number FROM users ;";
    $sqlnorders = "SELECT COUNT(*) as number FROM orders ;";
    $sqlncate = "SELECT COUNT(*) as number FROM categories;";

    $querynporders = mysqli_query($conn,$sqlnporders);
    $querytotpay= mysqli_query($conn,$sqltotpay);
    $querynproducts = mysqli_query($conn,$sqlnproducts);
    $querynusers = mysqli_query($conn,$sqlnusers);
    $querynorders = mysqli_query($conn,$sqlnorders);
    $queryncate = mysqli_query($conn,$sqlncate);
    
    $resultnporders = mysqli_fetch_assoc($querynporders);
    $resulttotpay= mysqli_fetch_assoc($querytotpay);
    $resultnproducts = mysqli_fetch_assoc($querynproducts);
    $resultnusers = mysqli_fetch_assoc($querynusers);
    $resultnorders = mysqli_fetch_assoc($querynorders);
    $resultncate = mysqli_fetch_assoc($queryncate);

/*     var_dump($resultnorders);
    echo "<br>";
    var_dump($resulttotpay);
    echo "<br>";
    var_dump($resultnproducts);
    echo "<br>";
    var_dump($resultnusers);
    echo "<br>";
    var_dump($resultnorders);
    echo "<br>";
    var_dump($resultncate);
    echo "<br>"; */

    mysqli_close($conn);
    





?>






<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>FloSun - Flower Shop HTML5 Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/font.awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/vendor/linearicons.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/nice-select.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css" />
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
                      <li>
                        <a class="active" href="my-account.html">My Account</a>
                      </li>
                      <li><a href="frequently-questions.html">FAQ</a></li>
                      <li><a href="login.html">Login</a></li>
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
      <!-- off-canvas menu start -->
      <aside class="off-canvas-wrapper" id="mobileMenu">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
          <div class="btn-close-off-canvas">
            <i class="fa fa-times"></i>
          </div>
          <div class="off-canvas-inner">
            <div class="search-box-offcanvas">
              <form>
                <input type="text" placeholder="Search product..." />
                <button class="search-btn"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <!-- mobile menu start -->
            <div class="mobile-navigation">
              <!-- mobile menu navigation start -->
              <nav>
                <ul class="mobile-menu">
                  <li class="menu-item-has-children">
                    <a href="#">Home</a>
                    <ul class="dropdown">
                      <li><a href="index.html">Home Page 1</a></li>
                      <li><a href="index-2.html">Home Page 2</a></li>
                      <li><a href="index-3.html">Home Page 3</a></li>
                      <li><a href="index-4.html">Home Page 4</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">Shop</a>
                    <ul class="megamenu dropdown">
                      <li class="mega-title has-children">
                        <a href="#">Shop Layouts</a>
                        <ul class="dropdown">
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
                      </li>
                      <li class="mega-title has-children">
                        <a href="#">Product Details</a>
                        <ul class="dropdown">
                          <li>
                            <a href="product-details.html"
                              >Single Product Details</a
                            >
                          </li>
                          <li>
                            <a href="variable-product-details.html"
                              >Variable Product Details</a
                            >
                          </li>
                          <li>
                            <a href="external-product-details.html"
                              >External Product Details</a
                            >
                          </li>
                          <li>
                            <a href="gallery-product-details.html"
                              >Gallery Product Details</a
                            >
                          </li>
                          <li>
                            <a href="countdown-product-details.html"
                              >Countdown Product Details</a
                            >
                          </li>
                        </ul>
                      </li>
                      <li class="mega-title has-children">
                        <a href="#">Others</a>
                        <ul class="dropdown">
                          <li><a href="error404.html">Error 404</a></li>
                          <li><a href="compare.html">Compare Page</a></li>
                          <li><a href="cart.html">Cart Page</a></li>
                          <li><a href="checkout.html">Checkout Page</a></li>
                          <li><a href="wishlist.html">Wish List Page</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">Blog</a>
                    <ul class="dropdown">
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
                          >Blog Details Sidebar Page</a
                        >
                      </li>
                      <li>
                        <a href="blog-details-fullwidth.html"
                          >Blog Details Fullwidth Page</a
                        >
                      </li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">Pages</a>
                    <ul class="dropdown">
                      <li><a href="frequently-questions.html">FAQ</a></li>
                      <li><a href="my-account.html">My Account</a></li>
                      <li>
                        <a href="login-register.html">login &amp; register</a>
                      </li>
                    </ul>
                  </li>
                  <li><a href="about-us.html">About Us</a></li>
                  <li><a href="contact-us.html">Contact</a></li>
                </ul>
              </nav>
              <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
            <div class="offcanvas-widget-area">
              <div class="switcher">
                <div class="language">
                  <span class="switcher-title">Language: </span>
                  <div class="switcher-menu">
                    <ul>
                      <li>
                        <a href="#">English</a>
                        <ul class="switcher-dropdown">
                          <li><a href="#">German</a></li>
                          <li><a href="#">French</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="currency">
                  <span class="switcher-title">Currency: </span>
                  <div class="switcher-menu">
                    <ul>
                      <li>
                        <a href="#">$ USD</a>
                        <ul class="switcher-dropdown">
                          <li><a href="#">€ EUR</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="top-info-wrap text-left text-black">
                <ul class="address-info">
                  <li>
                    <i class="fa fa-phone"></i>
                    <a href="info%40yourdomain.html">(1245) 2456 012</a>
                  </li>
                  <li>
                    <i class="fa fa-envelope"></i>
                    <a href="info%40yourdomain.html">info@yourdomain.com</a>
                  </li>
                </ul>
                <div class="widget-social">
                  <a class="facebook-color-bg" title="Facebook-f" href="#"
                    ><i class="fa fa-facebook-f"></i
                  ></a>
                  <a class="twitter-color-bg" title="Twitter" href="#"
                    ><i class="fa fa-twitter"></i
                  ></a>
                  <a class="linkedin-color-bg" title="Linkedin" href="#"
                    ><i class="fa fa-linkedin"></i
                  ></a>
                  <a class="youtube-color-bg" title="Youtube" href="#"
                    ><i class="fa fa-youtube"></i
                  ></a>
                  <a class="vimeo-color-bg" title="Vimeo" href="#"
                    ><i class="fa fa-vimeo"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside>
      <!-- off-canvas menu end -->
      <!-- off-canvas menu start -->
      <aside class="off-canvas-menu-wrapper" id="sideMenu">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
          <div class="off-canvas-inner">
            <div class="btn-close-off-canvas">
              <i class="fa fa-times"></i>
            </div>
            <!-- offcanvas widget area start -->
            <div class="offcanvas-widget-area">
              <ul class="menu-top-menu">
                <li><a href="about-us.html">About Us</a></li>
              </ul>
              <p class="desc-content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
                <br />
                Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat. <br />
                Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                cupidatat non proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum.
              </p>
              <div class="switcher">
                <div class="language">
                  <span class="switcher-title">Language: </span>
                  <div class="switcher-menu">
                    <ul>
                      <li>
                        <a href="#">English</a>
                        <ul class="switcher-dropdown">
                          <li><a href="#">German</a></li>
                          <li><a href="#">French</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="currency">
                  <span class="switcher-title">Currency: </span>
                  <div class="switcher-menu">
                    <ul>
                      <li>
                        <a href="#">$ USD</a>
                        <ul class="switcher-dropdown">
                          <li><a href="#">€ EUR</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="top-info-wrap text-left text-black">
                <ul class="address-info">
                  <li>
                    <i class="fa fa-phone"></i>
                    <a href="info%40yourdomain.html">(1245) 2456 012</a>
                  </li>
                  <li>
                    <i class="fa fa-envelope"></i>
                    <a href="info%40yourdomain.html">info@yourdomain.com</a>
                  </li>
                </ul>
                <div class="widget-social">
                  <a class="facebook-color-bg" title="Facebook-f" href="#"
                    ><i class="fa fa-facebook-f"></i
                  ></a>
                  <a class="twitter-color-bg" title="Twitter" href="#"
                    ><i class="fa fa-twitter"></i
                  ></a>
                  <a class="linkedin-color-bg" title="Linkedin" href="#"
                    ><i class="fa fa-linkedin"></i
                  ></a>
                  <a class="youtube-color-bg" title="Youtube" href="#"
                    ><i class="fa fa-youtube"></i
                  ></a>
                  <a class="vimeo-color-bg" title="Vimeo" href="#"
                    ><i class="fa fa-vimeo"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- offcanvas widget area end -->
          </div>
        </div>
      </aside>
      <!-- off-canvas menu end -->
    </header>
    <!-- Header Area End Here -->
    <!-- Breadcrumb Area Start Here -->
    <!-- Breadcrumb Area End Here -->

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
                    <a href="AdminDashboard.php" class="active"><i class="fa fa-dashboard"></i> Dashboard</a>
                    <a href="AdminUser.php"><i class="fa fa-user"></i> Users</a>
                    <a href="adminProducts.php" ><i class="fa-solid fa-boxes-stacked"></i> Products</a>
                    <a href="Admincategories.php"><i class="fa-solid fa-layer-group"></i> Categories</a>
                    <a href="AdminOrders.php"  ><i class="fa fa-cart-arrow-down"></i> Orders</a>
                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                  </div>
                </div>
                <!-- My Account Tab Menu End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-9 col-md-8 col-custom">
    <div class="tab-content" id="myaccountContent">
        <!-- Dashboard Tab Content Start -->
        <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
            <div class="myaccount-content">
                <h3>Admin Dashboard Details</h3>
                <div class="account-details-form">
                    <div class="row">
                        <!-- Card for Total Pendings -->
                       <!-- Card for Total Pendings -->
<div class="col-lg-4 col-md-6 col-custom mb-3">
    <div class="card custom-card">
        <div class="card-body">
            <h5 class="card-title custom-card-title"><i class="fa fa-hourglass-half mr-2"></i> Total Pendings</h5>
            <p style="color:#e72463 ;" class="card-text custom-card-text"><strong><?php echo $resultnporders['number']?></strong></p>
        </div>
    </div>
</div>

<!-- Card for Completed Payments -->
<div class="col-lg-4 col-md-6 col-custom mb-3">
    <div class="card custom-card">
        <div class="card-body">
            <h5 class="card-title custom-card-title"><i class="fa fa-check-circle mr-2"></i> Completed Payments</h5>
            <p style="color:#e72463 ;" class="card-text custom-card-text"><strong><?php echo $resulttotpay['total']?></strong></p>
        </div>
    </div>
</div>

<!-- Card for Total Product -->
<div class="col-lg-4 col-md-6 col-custom mb-3">
    <div class="card custom-card">
        <div class="card-body">
            <h5 class="card-title custom-card-title"><i class="fa fa-cube mr-2"></i> Total Product</h5>
            <p style="color:#e72463 ;" class="card-text custom-card-text"><strong><?php echo $resultnproducts['number']?></strong></p>
        </div>
    </div>
</div>

<!-- Card for Total Accounts -->
<div class="col-lg-4 col-md-6 col-custom mb-3">
    <div class="card custom-card">
        <div class="card-body">
            <h5 class="card-title custom-card-title"><i class="fa fa-users mr-2"></i> Total Accounts</h5>
            <p style="color:#e72463 ;" class="card-text custom-card-text"><strong><?php echo $resultnusers['number']?></strong></p>
        </div>
    </div>
</div>

<!-- Card for Most Requested -->
<div class="col-lg-4 col-md-6 col-custom mb-3">
    <div class="card custom-card">
        <div class="card-body">
            <h5 class="card-title custom-card-title"><i class="fa fa-star mr-2"></i> Total Orders</h5>
            <p style="color:#e72463 ;" class="card-text custom-card-text"><strong><?php echo $resultnorders['number']?></strong></p>
        </div>
    </div>
</div>


<div class="col-lg-4 col-md-6 col-custom mb-3">
    <div class="card custom-card">
        <div class="card-body">
            <h5 class="card-title custom-card-title"><i class="fa fa-star-half-alt mr-2"></i> Total Categories</h5>
            <p style="color:#e72463 ;" class="card-text custom-card-text"><strong><?php echo $resultncate['number']?></strong></p>
        </div>
    </div>
</div>
<!-- Card for Most Rated -->

                 
                </div>
            </div>
        </div>
        <!-- Dashboard Tab Content End -->
    </div>
</div>

                                        <!-- Orders Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Orders</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Aug 22, 2022</td>
                                                                <td>Pending</td>
                                                                <td>$3000</td>
                                                                <td><a href="cart.html" class="btn flosun-button secondary-btn theme-color  rounded-0">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>July 22, 2022</td>
                                                                <td>Approved</td>
                                                                <td>$200</td>
                                                                <td><a href="cart.html" class="btn flosun-button secondary-btn theme-color  rounded-0">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>June 12, 2022</td>
                                                                <td>On Hold</td>
                                                                <td>$990</td>
                                                                <td><a href="cart.html" class="btn flosun-button secondary-btn theme-color  rounded-0">View</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Orders Tab Content End -->
    
                                        <!-- Product Update Tab Content Start -->
                                        <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Product Update</h3>
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="product-id" class="required mb-1">Product ID</label>
                                                                <input type="text" id="product-id" placeholder="Product ID" />
                                                            </div>
                                                            <div class="single-input-item single-item-button">
                                                                <button class="btn flosun-button secondary-btn theme-color rounded-0"> <i class="fa fa-edit mr-2"></i>Update Product</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="product-name" class="required mb-1">Product Name</label>
                                                                <input type="text" id="product-name" placeholder="Product Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="category" class="required mb-1">Category</label>
                                                                <input type="text" id="category" placeholder="Category" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="sku" class="required mb-1">SKU</label>
                                                        <input type="text" id="sku" placeholder="SKU" />
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="price" class="required mb-1">Price</label>
                                                        <input type="number" id="price" placeholder="Price" />
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="product-image" class="required mb-1">Product Image</label>
                                                        <input type="file" id="product-image" />
                                                    </div>
                                                    <div class="single-input-item single-item-button">
                                                        <button class="btn flosun-button secondary-btn theme-color rounded-0"> Update </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Product Update Tab Content End -->
    
                                        <!-- Add Product Tab Content Start -->
                                        <div class="tab-pane fade" id="add" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Add Product</h3>
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="product-id" class="required mb-1">Product ID</label>
                                                                <input type="text" id="product-id" placeholder="Product ID" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="product-name" class="required mb-1">Product Name</label>
                                                                <input type="text" id="product-name" placeholder="Product Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="category" class="required mb-1">Category</label>
                                                                <input type="text" id="category" placeholder="Category" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="sku" class="required mb-1">SKU</label>
                                                        <input type="text" id="sku" placeholder="SKU" />
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="price" class="required mb-1">Price</label>
                                                        <input type="number" id="price" placeholder="Price" />
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="product-image" class="required mb-1">Product Image</label>
                                                        <input type="file" id="product-image" />
                                                    </div>
                                                    <div class="single-input-item single-item-button">
                                                        <button class="btn flosun-button secondary-btn theme-color rounded-0"> Add </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Add Product Tab Content End -->
    
                                        <!-- Account Info Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">
                                                    <form action="#">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-custom">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="first-name" class="required mb-1">First Name</label>
                                                                    <input type="text" id="first-name" placeholder="First Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-custom">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="last-name" class="required mb-1">Last Name</label>
                                                                    <input type="text" id="last-name" placeholder="Last Name" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item mb-3">
                                                            <label for="display-name" class="required mb-1">Display Name</label>
                                                            <input type="text" id="display-name" placeholder="Display Name" />
                                                        </div>
                                                        <div class="single-input-item mb-3">
                                                            <label for="email" class="required mb-1">Email Address</label>
                                                            <input type="email" id="email" placeholder="Email Address" />
                                                        </div>
                                                        <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="single-input-item mb-3">
                                                                <label for="current-pwd" class="required mb-1">Current Password</label>
                                                                <input type="password" id="current-pwd" placeholder="Current Password" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-custom">
                                                                    <div class="single-input-item mb-3">
                                                                        <label for="new-pwd" class="required mb-1">New Password</label>
                                                                        <input type="password" id="new-pwd" placeholder="New Password" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-custom">
                                                                    <div class="single-input-item mb-3">
                                                                        <label for="confirm-pwd" class="required mb-1">Confirm Password</label>
                                                                        <input type="password" id="confirm-pwd" placeholder="Confirm Password" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item single-item-button">
                                                            <button class="btn flosun-button secondary-btn theme-color rounded-0">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Account Info Tab Content End -->
                                    </div>
                <!-- My Account Tab Content End -->
              </div>
            </div>
            <!-- My Account Page End -->
          </div>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
