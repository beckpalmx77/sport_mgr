<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ARMS Admin| Athlete Admission | Nakhon Ratchasima Rajabhat University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/bootstrap4/bootstrap.min.css">
    <script src="vender/customjs/jquery.min.js"></script>
    <script src="vender/customjs/umd/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

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
            background-color: #ffc107;
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

</div><!-- container //  -->


</div><!-- container //  -->


</body>
</html>
