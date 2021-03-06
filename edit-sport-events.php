<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {

        $id = $_POST['id'];
        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        $place = $_POST['place'];
        $link = $_POST['link'];
        $doc_date_from = $_POST['doc_date_from'];
        $doc_date_to = $_POST['doc_date_to'];

        $sql = "UPDATE  tblsport_events SET event_id=:event_id,event_name=:event_name,place=:place
        ,link=:link,doc_date_from=:doc_date_from,doc_date_to=:doc_date_to WHERE id=:id";

        $query = $dbh->prepare($sql);
        $query->bindParam(':event_id', $event_id, PDO::PARAM_STR);
        $query->bindParam(':event_name', $event_name, PDO::PARAM_STR);
        $query->bindParam(':place', $place, PDO::PARAM_STR);
        $query->bindParam(':link', $link, PDO::PARAM_STR);
        $query->bindParam(':doc_date_from', $doc_date_from, PDO::PARAM_STR);
        $query->bindParam(':doc_date_to', $doc_date_to, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $msg = "ปรับปรุงข้อมูลเรียบร้อยแล้ว info added successfully";

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin ปรับปรุง รายการแข่งขันกีฬา</title>
        <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#picture')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        function bigImg(x) {
            x.style.height = "100%";
            x.style.width = "100%";
        }
        function normalImg(x) {
            x.style.height = "100px";
            x.style.width = "100px";
        }
    </script>

    <div class="main-wrapper">

        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <!--?php include('includes/leftbar.php'); ?-->
                <!-- /.left-event_idebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">ปรับปรุง รายการแข่งขันกีฬา</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>กำหนดระบบ</li>
                                    <li class="active">ปรับปรุง รายการแข่งขันกีฬา</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <section class="section">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>ปรับปรุง รายการแข่งขันกีฬา</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>ดำเนินการสำเร็จ : </strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <a href="manage-sport-events.php"
                                                           class="btn btn-info btn-labeled">BACK<span
                                                                class="btn-label btn-label-right"><i
                                                                    class="fa fa-check"></i></span></a>
                                                    </div>
                                                </div>

                                                <?php
                                                $id = intval($_GET['id']);
                                                $sql = "SELECT tblsport_events.* FROM tblsport_events WHERE id=:id ";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {

                                                        ?>

                                                        <input type="hidden" name="event_id"
                                                               value="<?php echo htmlentities($result->event_id) ?>">

                                                        <input type="hidden" name="id"
                                                               value="<?php echo htmlentities($result->id) ?>">

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">
                                                                รายการแข่งขันกีฬา</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="event_name"
                                                                       class="form-control"
                                                                       id="event_name"
                                                                       value="<?php echo htmlentities($result->event_name) ?>"
                                                                       required="required" autocomplete="off">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">สถานที่จัดการแข่งขัน</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="place" class="form-control"
                                                                       id="place"
                                                                       value="<?php echo htmlentities($result->place) ?>"
                                                                       required="required" autocomplete="off">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Link URL
                                                                ที่เกี่ยวข้อง</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="link" class="form-control"
                                                                       id="link"
                                                                       value="<?php echo htmlentities($result->link) ?>"
                                                                       required="required" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="date" class="col-sm-2 control-label">วันที่การแข่งขัน
                                                                เริ่มต้น</label>

                                                            <div class="col-sm-4">
                                                                <input id="doc_date_from" name="doc_date_from"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->doc_date_from) ?>"
                                                                       placeholder="วัน/เดือน/ปี" readonly="true">
                                                            </div>
                                                            <label for="date" class="col-sm-2 control-label">วันที่การแข่งขัน
                                                                สิ้นสุด</label>

                                                            <div class="col-sm-4">
                                                                <input id="doc_date_to" name="doc_date_to"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->doc_date_to) ?>"
                                                                       placeholder="วัน/เดือน/ปี" readonly="true">
                                                            </div>
                                                        </div>

                                                    <?php }
                                                } ?>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="submit" class="btn btn-primary">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/datepicker-thai/datepicker-lib.js"></script>
        <script>
            $(function ($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>

        <script>
            //กำหนดให้ textbox ที่มี id เท่ากับ my_date เป็นตัวเลือกแบบ ปฎิทิน
            picker_date(document.getElementById("doc_date_from"), {year_range: "-100:+1000"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
        </script>

        <script>
            //กำหนดให้ textbox ที่มี id เท่ากับ my_date เป็นตัวเลือกแบบ ปฎิทิน
            picker_date(document.getElementById("doc_date_to"), {year_range: "-100:+1000"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
        </script>


    </body>
    </html>
<?PHP } ?>
