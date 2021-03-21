<?php
//session_start();
//if (!isset($_SESSION['rss_script_admin'])) {
// header("location:login.php");
// exit;
//}
include('../logincontroller.php');


if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: ../index.php");
}
error_reporting(E_ERROR);
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
$draft_videos = $general->count_draft_news('video');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="" type="">
    <link rel="shortcut icon" href="assetss/images/favicon.png" type="image/x-icon">
    <title>Poco - Premium Admin Template</title>
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
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assetss/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assetss/css/style.css">
    <link id="color" rel="stylesheet" href="assetss/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assetss/css/responsive.css">

    <!-- for chat-->
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->



    <!-- script start-->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script type="text/javascript" src="asset/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="asset/js/jquery-ui/jquery-ui.min.js"></script>


    <!-- jquery slimscroll js -->

    <!-- modernizr js -->

    <!-- am chart -->

    <!-- Todo js -->

    <!-- Custom js -->

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <!-- script end-->
    <script src="asset/js/raphael/raphael.min.js"></script>
    <script src="asset/js/morris.js/morris.js"></script>
    <!-- Custom js -->
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
                                <li><a href="channels.php">DFY</a></li>
                                <li><a href="news.php">Traning</a></li>
                                <li><a href="videos.php">Support</a></li>
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
                        <div class="col-lg-12 xl-100">
                            <div class="row" style="margin-top: 100px;">
                                <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                                    <div class="card gradient-primary o-hidden">
                                        <div class="card-body tag-card">
                                            <div class="default-chart">
                                                <div class="apex-widgets">
                                                    <div id="area-widget-chart"></div>
                                                </div>
                                                <div class="widgets-bottom">
                                                    <h5 class="f-w-700 mb-0">videos<span class="pull-right"><?php echo $general->count_news('rss'); ?></span></h5>
                                                </div>
                                            </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                                    <div class="card gradient-secondary o-hidden">
                                        <div class="card-body tag-card">
                                            <div class="default-chart">
                                                <div class="apex-widgets">
                                                    <div id="area-widget-chart-2"></div>
                                                </div>
                                                <div class="widgets-bottom">
                                                    <h5 class="f-w-700 mb-0">Sources<span class="pull-right"><?php echo $general->count_sources('rss'); ?></span></h5>
                                                </div>
                                            </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                                    <div class="card gradient-warning o-hidden">
                                        <div class="card-body tag-card">
                                            <div class="default-chart">
                                                <div class="apex-widgets">
                                                    <div id="area-widget-chart-3"></div>
                                                </div>
                                                <div class="widgets-bottom">
                                                    <h5 class="f-w-700 mb-0">Categories<span class="pull-right"><?php echo $general->count_categories(); ?></span></h5>
                                                </div>
                                            </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"> </span></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                                    <div class="card gradient-info o-hidden">
                                        <div class="card-body tag-card">
                                            <div class="default-chart">
                                                <div class="apex-widgets">
                                                    <div id="area-widget-chart-4"></div>
                                                </div>
                                                <div class="widgets-bottom">
                                                    <h5 class="f-w-700 mb-0">Channel<span class="pull-right"><?php echo $general->count_sources('video'); ?></span></h5>
                                                </div>
                                            </div><span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"> </span></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $start = $general->start_period();
                        if ($start != 0) {
                            $month = intval(make_safe(xss_clean($_GET['month'])));
                            $year = intval(make_safe(xss_clean($_GET['year'])));
                            if (!isset($month) or empty($month) or $month > 12) {
                                $current_month = date('n');
                            } else {
                                $current_month = $month;
                            }
                            if (!isset($year) or empty($year) or $year > date('Y')) {
                                $current_year = date('Y');
                            } else {
                                $current_year = $year;
                            }
                        ?>





                            <div class="card col-md-12">
                                <div class="page-header page-heading">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5><i class="fa fa-bar-chart"></i> Content Statistics For <span class="text-info"><?php echo month_name($current_month) . ', ' . $current_year; ?></span></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <form method="GET" name="menu">
                                                <select name="selectedPage" onChange="changePage(this.form.selectedPage)" class="form-control">
                                                    <option>Choose a Month</option>
                                                    <?php
                                                    echo generate_statics_select($start['year'], $start['month']);
                                                    ?>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    $thetime = mktime(0, 0, 0, $current_month, 3, $current_year);
                                    $days = date('t', $thetime);
                                    ?>
                                    <script>
                                        $(function() {
                                            Morris.Area({
                                                element: 'morris-bar-chart',
                                                data: [
                                                    <?php for ($i = 1; $i < $days + 1; $i++) {
                                                    ?>
                                                        <?php echo "{"; ?>
                                                        periods: '<?php echo $current_year . '-' . $current_month . '-' . $i; ?>',
                                                        news: <?php echo $general->statistics_news($i, $current_month, $current_year); ?>,
                                                        videos: <?php echo $general->statistics_videos($i, $current_month, $current_year); ?>
                                                        <?php echo "}, "; ?>
                                                    <?php } ?>
                                                ],
                                                xkey: 'periods',
                                                ykeys: ['news', 'videos'],
                                                labels: ['News', 'Videos'],
                                                lineColors: ['#FFB443', '#DF5B37'],
                                                pointSize: 4,
                                                hideHover: 'auto',
                                                behaveLikeLine: true,
                                                resize: true
                                            });
                                        });
                                    </script>



                                    <div class="card-block col-lg-12">
                                        <div id="morris-bar-chart"></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <!-- Container-fluid Ends-->
                <div class="welcome-popup modal fade" id="loadModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <div class="modal-body">
                                <div class="modal-header"></div>
                                <div class="contain p-30">
                                    <div class="text-center">
                                        <h3> Welcome to viralgroove</h3>
                                        <p>Start building your sites </p>
                                        <button class="btn btn-primary btn-lg txt-white" type="button" data-dismiss="modal" aria-label="Close">Get Started</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright © 2021 viralgroove </p>
                        </div>
                        <div class="col-md-6">
                            <p class="pull-right mb-0">Powered By viralgroove <i class="fa fa-heart"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="assetss/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assetss/js/bootstrap/popper.min.js"></script>
    <script src="assetss/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="assetss/js/icons/feather-icon/feather.min.js"></script>
    <script src="assetss/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assetss/js/sidebar-menu.js"></script>
    <script src="assetss/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="assetss/js/typeahead/handlebars.js"></script>
    <script src="assetss/js/typeahead/typeahead.bundle.js"></script>
    <script src="assetss/js/typeahead/typeahead.custom.js"></script>
    <script src="assetss/js/typeahead-search/handlebars.js"></script>
    <script src="assetss/js/typeahead-search/typeahead-custom.js"></script>
    <script src="assetss/js/chart/chartist/chartist.js"></script>
    <script src="assetss/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="assetss/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assetss/js/chart/apex-chart/stock-prices.js"></script>
    <script src="assetss/js/prism/prism.min.js"></script>
    <script src="assetss/js/clipboard/clipboard.min.js"></script>
    <script src="assetss/js/counter/jquery.waypoints.min.js"></script>
    <script src="assetss/js/counter/jquery.counterup.min.js"></script>
    <script src="assetss/js/counter/counter-custom.js"></script>
    <script src="assetss/js/custom-card/custom-card.js"></script>
    <script src="assetss/js/notify/bootstrap-notify.min.js"></script>
    <script src="assetss/js/dashboard/default.js"></script>
    <script src="assetss/js/notify/index.js"></script>
    <script src="assetss/js/datepicker/date-picker/datepicker.js"></script>
    <script src="assetss/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="assetss/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="assetss/js/chat-menu.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assetss/js/script.js"></script>
    <script src="assetss/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>