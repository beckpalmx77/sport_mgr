<?php
session_start();
error_reporting(0);
include('includes/config.php');
include("includes/lang.php");

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sports And Recreation Record System | Dashboard</title>
        <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen">
        <link rel="stylesheet" href="css/icheck/skins/line/blue.css">
        <link rel="stylesheet" href="css/icheck/skins/line/red.css">
        <link rel="stylesheet" href="css/icheck/skins/line/green.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>

        <style>
            body {
                background: #eeeeee;
                font-family: 'Prompt', sans-serif;
            }

        </style>

    </head>
    <body class="top-navbar-fixed" >
    <div class="main-wrapper">
        <?php include('includes/topbar.php'); ?>

        <div class="content-wrapper">
            <div class="content-container">

                <!--?php include('includes/leftbar.php'); ?-->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-sm-4">
                                <!--h2 class="title">Dashboard</h2-->
                                <img src="images/logo-name-1.png" alt="Logo" style="width:280px;">
                            </div>

                            <div class="col-sm-8">
                                <a href="#" class="text-white"><h2><p style="font-family:kanit;"><span style="color:darkolivegreen;font-weight:bold;font-size: 130%;"><?php echo $system_name_th?></span></p></h2></a>
                            </div>

                            <!-- /.col-sm-6 -->
                        </div>                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->
                    <div class="container">
                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <?php include("chart_total_ath.php"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-container -->

            </div>
            <!-- /.content-wrapper -->



        </div>

    </div>
    <!-- /.main-wrapper -->

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="js/prism/prism.js"></script>
    <script src="js/waypoint/waypoints.min.js"></script>
    <script src="js/counterUp/jquery.counterup.min.js"></script>
    <script src="js/amcharts/amcharts.js"></script>
    <script src="js/amcharts/serial.js"></script>
    <script src="js/amcharts/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="js/amcharts/plugins/export/export.css" type="text/css" media="all"/>
    <script src="js/amcharts/themes/light.js"></script>
    <script src="js/toastr/toastr.min.js"></script>
    <script src="js/icheck/icheck.min.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script src="js/production-chart.js"></script>
    <script src="js/traffic-chart.js"></script>
    <script src="js/task-list.js"></script>

    <script>
        $(function () {

            // Counter for dashboard stats
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });

            // Welcome notification
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            //toastr["success"]("Welcome to Sports And Recreation Record System!");

        });
    </script>
    </body>
    </html>
<?php } ?>
