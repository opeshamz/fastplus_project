<?php
include('header.php');
?>
<div class="jumbotron-fluid bg-none">
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <?php

                    if ($draft_news > 0) {
                        $draft_newss = notification('warning', 'You Have <b>' . $draft_news . '</b> News Set as Draft, <a href="news.php?case=review" class="alert-link">Publish or Delete</a> Them.');
                    }
                    if ($draft_videos > 0) {
                        $draft_videos = notification('warning', 'You Have <b>' . $draft_videos . '</b> Videos Set as Draft, <a href="videos.php?case=review" class="alert-link">Publish or Delete</a> Them.');
                    }
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-pie-chart bg-c-blue card1-icon"></i>
                                        <span class="text-c-blue f-w-600">News $ Videos</span>
                                        <h4><?php echo $general->count_news('rss'); ?></h4>

                                    </div>
                                </div>
                            </div>
                            <!-- card1 end -->
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
                                        <span class="text-c-pink f-w-600">Sources</span>
                                        <h4><?php echo $general->count_sources('rss'); ?></h4>

                                    </div>
                                </div>
                            </div>
                            <!-- card1 end -->
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-warning-alt bg-c-green card1-icon"></i>
                                        <span class="text-c-green f-w-600">Categories</span>
                                        <h4><?php echo $general->count_categories(); ?></h4>

                                    </div>
                                </div>
                            </div>
                            <!-- card1 end -->
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-social-twitter bg-c-yellow card1-icon"></i>
                                        <span class="text-c-yellow f-w-600">Channel</span>
                                        <h4><?php echo $general->count_sources('video'); ?></h4>

                                    </div>
                                </div>
                            </div>
                            <!-- card1 end -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--
<div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-reorder fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php //echo $general->count_categories(); 
                                                        ?></div>
                                    <div class="stat-text">Categories</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-rss fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php //echo $general->count_sources('rss'); 
                                                        ?></div>
                                    <div class="stat-text">Sources</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-3 col-sm-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php //echo $general->count_sources('video'); 
                                                        ?></div>
                                    <div class="stat-text">Channels</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-3 col-sm-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-newspaper-o fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div class="stat-text">News & Videos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>-->
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
        <div class="pcoded-content" style="margin-top: -50px;">
            <div class="pcoded-inner-content">

                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="page-header page-heading">
                                    <div class="row">
                                        <div class="col-md-8">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>




    <?php
    }
    //include('footer.php');
    ?>