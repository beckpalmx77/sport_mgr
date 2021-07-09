<?php include('includes/lang.php'); ?>

<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $system_name_th . " | " . $system_name_en ?> | Nakhon Ratchasima Rajabhat University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/bootstrap4/bootstrap.css">
    <link rel="stylesheet" href="css/font-thai.css" media="screen">
    <script src="vender/customjs/jquery3.51.js"></script>
    <script src="vender/customjs/umd/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/font_mystyle.css">
    <script>
        $(document).ready(function () {
            jQuery.fn.carousel.Constructor.TRANSITION_DURATION = 2000  // 2 seconds
        });
    </script>

    <script type="text/javascript">
        /// some script

        // jquery ready start
        $(document).ready(function () {
            // jQuery code

            ///////////////// fixed menu on scroll for desctop
            if ($(window).width() > 992) {

                var navbar_height = $('.navbar').outerHeight();

                $(window).scroll(function () {
                    if ($(this).scrollTop() > 300) {
                        $('.navbar-wrap').css('height', navbar_height + 'px');
                        $('#navbar_top').addClass("fixed-top");

                    } else {
                        $('#navbar_top').removeClass("fixed-top");
                        $('.navbar-wrap').css('height', 'auto');
                    }
                });
            } // end if


        }); // jquery end
    </script>

    <style type="text/css">

        .fixed-top.navbar {
            padding: 0px;
        }

    </style>

    <style>

        body {
        / / background-color: #ffc107;
            background-color: #ffffff;
        }

    </style>

    <style>
        .footer {
            /*position: fixed; */
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #28a745;
            color: white;
            text-align: center;
        }
    </style>

</head>
<body>

<?php include('index-header.php'); ?>


<!-- ========================= SECTION CONTENT ========================= -->


<!--div class="container" style="max-width: 720px"-->

<div class="container">

    <section class="section-content py-5">

        <?php include('slide_show.php'); ?>

    </section>


    <div class="card">
        <div class="card-header card bg-success text-white"><h3><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;ข่าวสาร /
                ประกาศ</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>

            <p style="font-family:Kanit; color:#0f6674"><a href="show-news-page-other.php" class="ex2" rel="external"
                                                           target="_blank">
                    <img src="images/icon/synchronize-cloud.gif" hight="30" width="30">
                    &nbsp;&nbsp;อ่าน ข่าว/ประกาศ ทั้งหมด</a>
            </p>
            <?php include('show_box_news.php'); ?>
            <!--p class="card-text"></p-->
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header card bg-success text-white"><h3><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;ข่าวสาร /
                ประกาศ</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>

            <p style="font-family:Kanit; color:#0f6674"><a href="show_box_image_all.php" class="ex2" rel="external"
                                                           target="_blank">
                    <img src="images/icon/synchronize-cloud.gif" hight="30" width="30">
                    &nbsp;&nbsp;ดู ภาพกิจกรรมทั้งหมด</a>
            </p>
            <?php include('show_box_image.php'); ?>
            <!--?php include('show_box_detail.php'); ?-->
            <!--p class="card-text"></p-->
        </div>
    </div>

    <div class="card">
        <div class="card-header card bg-success text-white"><h3><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;ภาพเคลื่อนไหว / Video</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>

            <p style="font-family:Kanit; color:#0f6674"><a href="show_box_video_all.php" class="ex2" rel="external"
                                                           target="_blank">
                    <img src="images/icon/synchronize-cloud.gif" hight="30" width="30">
                    &nbsp;&nbsp;ดู ภาพเคลื่อนไหว/Video ทั้งหมด</a>
            </p>
            <?php include('show_box_video.php'); ?>
            <!--?php include('show_box_detail.php'); ?-->
            <!--p class="card-text"></p-->
        </div>
    </div>

</div>

</section>

</div><!-- container //  -->

<br>

<style>
    .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }

    .my-class {
        background: white;
    }
</style>
<div class="footer">

    <p><?php echo $system_owner ?></p>

</div>
</body>
</html>
