<?php

/*error_reporting(E_ERROR);
include("../include/config.php");
include("../include/connect.php");
include("include/functions.php");
include("include/general.class.php");
include("include/upload.class.php");
include("include/pagination.php");
include("include/nocsrf.php");

$general = new General;
$general->set_connection($mysqli);
$options = $general->get_all_options();
$parts = Explode('/', $_SERVER["PHP_SELF"]);
$currenttab = $parts[count($parts) - 1];
$draft_news = $general->count_draft_news('rss');
$draft_videos = $general->count_draft_news('video');*/
include('../logincontroller.php');


if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>viral grove</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="assetss/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assetss/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assetss/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assetss/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assetss/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/animate.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="assetss/css/chartist.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/prism.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/material-design-icon.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/pe7-icon.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assetss/css/bootstrap.css">
    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assetss/css/style.css">
    <link id="color" rel="stylesheet" href="assetss/css/color-1.css" media="screen">
    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="assetss/css/responsive.css">
    <style>
        input[type=radio] {
            border: 5px;
            width: 1.2em;
            height: 1.2em;
        }
    </style>
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="typewriter">
            <h1>Loading..</h1>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right">
                <div class="main-header-left text-center">
                    <div class="logo-wrapper"><a href="index.php"><img src="assetss/images/logo/logo.png" alt=""></a></div>
                </div>
                <div class="mobile-sidebar">
                    <div class="media-body text-right switch-sm">
                        <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
                    </div>
                </div>
                <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"> </i></div>
                <div class="nav-right col pull-right right-menu">
                    <ul class="nav-menus">
                        <li>

                        </li>
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid" src="assetss/images/dashboard/user.png" alt=""></span>
                            <ul class="onhover-show-div profile-dropdown">
                                <li class="gradient-primary">
                                    <h5 class="f-w-600 mb-0"></h5><span><?php echo $_SESSION['email'] ?></span>
                                </li>
                                <li><a href="index.php?logout='1'">logout </a></li>
                                <li><a href="">Change password</a>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
                </div>
                <script id="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
            <div class="ProfileCard-details">
           
            </div>
            </div>
          </script>
                <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="iconsidebar-menu">
                <div class="sidebar">
                    <ul class="iconMenu-bar custom-scrollbar">
                        <li><a class="bar-icons" href="javascript:void(0)">
                                <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>General </span>
                            </a>
                            <ul class="iconbar-mainmenu custom-scrollbar">
                                <li class="iconbar-header">Dashboard</li>
                                <li>
                                    <a href="index.php">Default</a>
                                </li>
                                <li><a href="sitelist.php">Website list</a></li>
                                <li><a href="create.php">Create website</a></li>
                                <li><a href="#">DFY</a></li>
                                <li><a href="#">Traning</a></li>
                                <li><a href="#">Support</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page Sidebar Ends-->

            <div class="page-body">

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        <i class="fa fa-link"></i> Links
                                    </h3>
                                </div>
                                <div style="margin: 20px;">
                                    <!-- begning of php new-->
                                    <form actions="">
                                        <div class="form-group">
                                            <h5>Website type:</h5>
                                            <fieldset class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadio" id="inlineRadio1" value="option">
                                                            <label class="form-check-label" for="inlineRadio1">Sub domain</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadio" id="inlineRadio1" value="option">
                                                            <label class="form-check-label" for="inlineRadio1">Custom domain</label>
                                                        </div>
                                                    </div>
                                            </fieldset>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="">Enter url</label>
                                                <input type="text" name="website" class="form-control" placeholder="Enter your url">
                                            </div>
                                            <div class="col-sm-2" style="margin-top: 30px;background-color:rgb(192,192,192); height:35px; color:black">
                                                <span class="input-group-text" id="basic-addon2">.viragrove.com</span>
                                            </div>
                                        </div>
                                        <div>
                                            <fieldset class="form-group">
                                                <h6>select template</h6>
                                                <div class="d-flex mb-5">
                                                    <div class="Column mr-1 ">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                            <label class="form-check-label" for="inlineRadio1">template 1</label>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1">
                                                                preview
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class=" Column mr-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                            <label class="form-check-label" for="inlineRadio1">template 2</label>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">
                                                                preview
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="Column mr-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                            <label class="form-check-label" for="inlineRadio1">template 3</label>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal3">
                                                                preview
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="Column mr-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                            <label class="form-check-label" for="inlineRadio1">template 4</label>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal4">
                                                                preview
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="Column mr-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                            <label class="form-check-label" for="inlineRadio1">template 5</label>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal5">
                                                                preview
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-secondary">
                                                publish
                                            </button>
                                    </form>




                                </div>

                            </div>
                            <!-- end of php new-->
                        </div>
                    </div>
                </div>




                <!-- The Modal -->


            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->

        <!-- modal for template 1-->
        <div class="modal" id="myModal1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Modal Heading</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <img src="templates/template1.jpeg" style="width:100%; height:100%">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal for template 1 ends-->
        <!-- modal for template 2-->
        <div class="modal" id="myModal2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Modal Heading</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <img src="templates/template2.jpeg" style="width:100%; height:100%">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal for template 2 ends-->
        <!-- modal for template 3-->
        <div class="modal" id="myModal3">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Modal Heading</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <img src="templates/template3.jpeg" style="width:100%; height:100%">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal for template 3 ends-->
        <!-- modal for template 4-->
        <div class="modal" id="myModal4">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Modal Heading</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <img src="templates/template1.jpeg" style="width:100%; height:100%">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal for template 4 ends-->
        <!-- modal for template 5-->
        <div class="modal" id="myModal5">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Modal Heading</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <img src="templates/template2.jpeg" style="width:100%; height:100%">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal for template 5 ends-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">viralgrove</p>
                    </div>
                    <div class="col-md-6">
                        <p class="pull-right mb-0"><i class="fa fa-heart"></i></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <!-- latest jquery -->
    <script src="assetss/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="assetss/js/bootstrap/popper.min.js"></script>
    <script src="assetss/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js -->
    <script src="assetss/js/icons/feather-icon/feather.min.js"></script>
    <script src="assetss/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery -->
    <script src="assetss/js/sidebar-menu.js"></script>
    <script src="assetss/js/config.js"></script>
    <!-- Plugins JS start -->
    <script src="assetss/js/chat-menu.js"></script>
    <!-- Plugins JS Ends -->
    <!-- Theme js -->
    <script src="assetss/js/script.js"></script>
    <script src="assetss/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->

</body>

</html>