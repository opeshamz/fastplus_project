<?php
include("logincontroller.php");
include("controllersignup.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
  <title>Viralgroove</title>
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Font Awesome-->
  <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="assets/css/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
  <!-- Plugins css start-->
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</head>

<body style="background-color:#333a62 !important">
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="typewriter">
      <h1>Loading..</h1>
    </div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper">
    <div class="container-fluid p-0">
      <!-- login page start-->
      <div class="authentication-main">
        <div class="row">
          <div class="col-md-12">
            <div class="auth-innerright">
              <div class="authentication-box">
                <div class="card-body p-0">
                  <div class="cont text-center">
                    <div><?php include("error.php");
                          include("sucess.php"); ?></div>



                    <div>
                      <form class="theme-form" method="post" actions>

                        <h4>LOGIN</h4>
                        <h6>Enter your email and Password</h6>
                        <div class="form-group">
                          <label class="col-form-label pt-0">Email</label>
                          <input class="form-control" name="email" type="email" required="">
                        </div>
                        <div class="form-group">
                          <label class="col-form-label">Password</label>
                          <input class="form-control" name="password" type="password" required="">
                        </div>
                        <div class="checkbox p-0">
                          <input id="checkbox1" type="checkbox">
                          <label for="checkbox1">Remember me</label>
                        </div>
                        <div class="form-group form-row mt-3 mb-0">
                          <button class="btn btn-primary btn-block" name="login_user" type="submit">LOGIN</button>
                        </div>
                        <div class="login-divider"></div>
                        <div class="social mt-3">
                          <div class="form-row btn-showcase">
                            <div class="col-md-4 col-sm-6">
                              <button class="btn social-btn btn-fb" disabled>Facebook</button>
                            </div>
                            <div class="col-md-4 col-sm-6">
                              <button class="btn social-btn btn-twitter" disabled>Twitter</button>
                            </div>
                            <div class="col-md-4 col-sm-6">
                              <button class="btn social-btn btn-google" disabled>Google + </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="sub-cont">
                      <div class="img">
                        <div class="img__text m--up">
                          <h2>New here?</h2>
                          <p>Sign up and discover great amount of new opportunities!</p>
                        </div>
                        <div class="img__text m--in">
                          <h2>One of us?</h2>
                          <p>If you already has an account, just sign in.</p>
                        </div>
                        <div class="img__btn"><span class="m--up">Sign up</span><span class="m--in">Sign in</span></div>
                      </div>
                      <div>
                        <form class="theme-form" method="post" actions="">
                          <h4 class="text-center">NEW USER</h4>
                          <h6 class="text-center">Sign up here</h6>
                          <div class="form-row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <input class="form-control" name="username" type="text" placeholder="Username">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <input class="form-control" name="email" type="text" placeholder="Email">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <input class="form-control" name="password_signup" type="password" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <input class="form-control" name="confirm-password" type="password" placeholder="Confirm password">
                          </div>
                          <div class="form-row">
                            <div class="col-sm-4">
                              <button class="btn btn-primary" name="submit_button" type="submit">Sign Up</button>
                            </div>

                          </div>
                          <div class="form-divider"></div>
                          <div class="social mt-3">
                            <div class="form-row btn-showcase">
                              <div class="col-sm-4">
                                <button class="btn social-btn btn-fb" disabled>Facebook</button>
                              </div>
                              <div class="col-sm-4">
                                <button class="btn social-btn btn-twitter" disabled>Twitter</button>
                              </div>
                              <div class="col-sm-4">
                                <button class="btn social-btn btn-google" disabled>Google +</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- login page end-->
    </div>

  </div>
  <!-- latest jquery-->
  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap js-->
  <script src="assets/js/bootstrap/popper.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.js"></script>
  <!-- feather icon js-->
  <script src="assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
  <!-- Sidebar jquery-->
  <script src="assets/js/sidebar-menu.js"></script>
  <script src="assets/js/config.js"></script>
  <!-- Plugins JS start-->
  <script src="assets/js/login.js"></script>
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="assets/js/script.js"></script>



  <!-- login js-->
  <!-- Plugin used-->
</body>

</html>