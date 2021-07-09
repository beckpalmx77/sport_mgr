<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {

        $sid = $_POST['sid'];
        $event_id = $_POST['event_id'];
        $sport_type_id = $_POST['sport_type_id'];
        $result_1 = $_POST['result_1'];
        $result_2 = $_POST['result_2'];
        $result_3 = $_POST['result_3'];
        $doc_date_from = $_POST['doc_date_from'];
        $doc_date_to = $_POST['doc_date_to'];

        $sql = "INSERT INTO   tblsport_result(stid,event_id,sport_type_id,result_1,result_2,result_3,doc_date_from,doc_date_to)
                VALUES(:sid,:event_id,:sport_type_id,:result_1,:result_2,:result_3,:doc_date_from,:doc_date_to)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':event_id', $event_id, PDO::PARAM_STR);
        $query->bindParam(':sport_type_id', $sport_type_id, PDO::PARAM_STR);
        $query->bindParam(':result_1', $result_1, PDO::PARAM_STR);
        $query->bindParam(':result_2', $result_2, PDO::PARAM_STR);
        $query->bindParam(':result_3', $result_3, PDO::PARAM_STR);
        $query->bindParam(':doc_date_from', $doc_date_from, PDO::PARAM_STR);
        $query->bindParam(':doc_date_to', $doc_date_to, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {

            $msg = "เพิ่มข้อมูลเรียบร้อยแล้ว info added successfully";

        } else {
            $error = "Something went wrong. Please try again";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin เพิ่ม ผลงานประวัติการแข่งขันกีฬา </title>
        <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
        <script src="js/datepicker-thai/datepicker-lib.js"></script>
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
                <!-- /.left-sidebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เพิ่ม ผลงานประวัติการแข่งขันกีฬา </h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>ทะเบียนนักกีฬา</li>
                                    <li class="active">เพิ่ม ผลงานประวัติการแข่งขันกีฬา</li>
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
                                                <h5>เพิ่ม ผลงานประวัติการแข่งขันกีฬา </h5>
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
                                                        <a href="manage-at-sport-result.php"
                                                           class="btn btn-info btn-labeled">BACK<span
                                                                class="btn-label btn-label-right"><i
                                                                    class="fa fa-check"></i></span></a>
                                                    </div>
                                                </div>

                                                <?php
                                                $sid = intval($_GET['stid']);
                                                $sql = "SELECT * from tblstudents where StudentId=:sid";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {
                                                        $rollId = $result->RollId;
                                                        $hight = $result->hight;
                                                        $weight = $result->weight;
                                                        ?>


                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">รูปภาพ</label>

                                                            <div class="col-sm-10">
                                                                <img id="picture"
                                                                     src="<?php echo htmlentities($result->picture) ?>"
                                                                     width="100" height="100" alt=""
                                                                     onmouseover="bigImg(this)"
                                                                     onmouseout="normalImg(this)"
                                                                     onclick="window.open(this.src,'_blank')">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">รหัสประจำตัว</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="sid" class="form-control"
                                                                       id="sid" readonly="true"
                                                                       value="<?php echo htmlentities($result->RollId) ?>"
                                                                       maxlength="20" required="required"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ชื่อ</label>

                                                            <div class="col-sm-4">
                                                                <input type="text" name="firstname" class="form-control"
                                                                       id="firstname" readonly="true"
                                                                       value="<?php echo htmlentities($result->FirstName) ?>"
                                                                       maxlength="20" required="required"
                                                                       autocomplete="off">
                                                            </div>
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">นามสกุล</label>

                                                            <div class="col-sm-4">
                                                                <input type="text" name="lastname" class="form-control"
                                                                       id="lastname" readonly="true"
                                                                       value="<?php echo htmlentities($result->LastName) ?>"
                                                                       maxlength="20" required="required"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <?php

                                                    }
                                                }

                                                ?>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">ชื่อรายการแข่งขันกีฬา</label>

                                                    <div class="col-sm-10">
                                                        <select name="event_id" class="form-control"
                                                                id="event_id">
                                                            <option value="">เลือกรายการ</option>
                                                            <?php $sql1 = "SELECT * from tblsport_events";
                                                            $query1 = $dbh->prepare($sql1);
                                                            $query1->execute();
                                                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                            if ($query1->rowCount() > 0) {
                                                                foreach ($results1 as $result1) { ?>
                                                                    <option
                                                                        value="<?php echo htmlentities($result1->event_id); ?>"><?php echo htmlentities($result1->event_name); ?></option>
                                                                <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="date"
                                                           class="col-sm-2 control-label">วันที่เริ่มต้นแข่งขัน</label>

                                                    <div class="col-sm-4">
                                                        <input id="doc_date_from" name="doc_date_from"
                                                               class="form-control"
                                                               value="" placeholder="วัน/เดือน/ปี">
                                                    </div>
                                                    <label for="date"
                                                           class="col-sm-2 control-label">วันที่แข่งขันสิ้นสุด</label>

                                                    <div class="col-sm-4">
                                                        <input id="doc_date_to" name="doc_date_to" class="form-control"
                                                               value="" placeholder="วัน/เดือน/ปี">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label">ประเภทกีฬา</label>

                                                    <div class="col-sm-4">
                                                        <select name="sport_type_id" class="form-control"
                                                                id="sport_type_id">
                                                            <option value="">เลือกรายการ</option>
                                                            <option
                                                                value="<?php echo htmlentities($result->sport_type1); ?>"
                                                                selected><?php echo htmlentities($result->SportName1); ?></option>
                                                            <?php $sql1 = "SELECT * from tblsporttype";
                                                            $query1 = $dbh->prepare($sql1);
                                                            $query1->execute();
                                                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                            if ($query1->rowCount() > 0) {
                                                                foreach ($results1 as $result1) { ?>
                                                                    <option
                                                                        value="<?php echo htmlentities($result1->id); ?>"><?php echo htmlentities($result1->SportName); ?></option>
                                                                <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label">ผลการแข่งขัน</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" name="result_1" class="form-control"
                                                               value=""
                                                               id="result_1" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label">รางวัลที่ได้รับ</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" name="result_2" class="form-control"
                                                               value=""
                                                               id="result_2" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label">สถิติ</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" name="result_3" class="form-control"
                                                               value=""
                                                               id="result_3" autocomplete="off">
                                                    </div>
                                                </div>

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

        <script>

            $(document).ready(function () {
                $('#event_id').change(function () {
                    //Selected value
                    var inputValue = $(this).val();
                    //alert("value in js " + inputValue);

                    //Ajax for calling php function
                    $.post('myfw/myquery-sport-event.php', {dropdownValue: inputValue}, function (data) {
                        //alert('ajax completed. Response:  ' + data);
                        result = data.split('|');
                        //alert(result[0]);
                        //alert(result[1]);
                        document.getElementById("doc_date_from").value = result[0];
                        document.getElementById("doc_date_to").value = result[1];
                        /*
                         document.getElementById("sub_menu_id").value = data;
                         document.getElementById("sort").value = parseInt(data.substring(2, 4));
                         */
                        //do after submission operation in DOM
                    });
                });
            });

        </script>

    </body>
    </html>
<?PHP } ?>


