<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $RollId = $_POST['rollid'];
        $filedoc_type = $_POST['filedoc_type'];
        $sql = "INSERT INTO  tblattach_file(sid,filedoc_type) VALUES(:sid,:filedoc_type)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $RollId, PDO::PARAM_STR);
        $query->bindParam(':filedoc_type', $filedoc_type, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {

            if (strlen($_FILES["fileUpload"]["name"]) > 0) {

                $target_dir = "images/student/card/";

                $temp = explode(".", $_FILES["fileUpload"]["name"]);

                $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

                $picture = $target_file;

                if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                    $sql = "update tblattach_file set file_name=:picture where id=:id ";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':picture', $picture, PDO::PARAM_STR);
                    $query->bindParam(':id', $lastInsertId, PDO::PARAM_STR);
                    $query->execute();
                    $success = "Y";
                } else {
                    $success = "N";
                }
            }

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
        <title>ARMS Admin เพิ่ม ภาพถ่าย / เอกสาร</title>
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
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-sidebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เพิ่ม ภาพถ่าย / เอกสาร</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>ทะเบียนนักกีฬา</li>
                                    <li class="active">เพิ่ม ภาพถ่าย / เอกสาร </li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>เพิ่ม ภาพถ่าย / เอกสาร</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <a href="manage-file-attach.php"
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
                                            foreach ($results as $result) { ?>

                                                <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">รหัสประจำตัว</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="rollid" class="form-control"
                                                                   id="rollid" readonly="true"
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
                                                <label for="default"
                                                       class="col-sm-2 control-label">รูปภาพ</label>
                                                <div class="col-sm-10">
                                                    <img id="picture" src=""
                                                         width="100" height="100" alt=""
                                                         onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                                         onclick="window.open(this.src,'_blank')">
                                                    <input type='file' name="fileUpload" id="fileUpload"
                                                           onchange="readURL(this);"/>
                                                    <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                        (ไฟล์ .jpg หรือ .png เท่านั้น)(Click ที่รูปเพื่อขยาย)</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default"
                                                       class="input-group my-3">&nbsp;&nbsp;ประเภทเอกสาร/ภาพถ่าย</label>

                                                <div class="col-sm-10">
                                                    <select name="filedoc_type" class="form-control" id="filedoc_type" required="required">

                                                        <option value="">เลือก ประเภทเอกสาร/ภาพถ่าย</option>
                                                        <?php $sql = "SELECT * from tbldoctype";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) { ?>
                                                                <option
                                                                    value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->document_type_name); ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit
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
    </body>
    </html>
<?PHP } ?>
