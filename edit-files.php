<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

    $id = $_GET['id'];

    if (isset($_POST['submit'])) {

        $filedoc_type = $_POST['filedoc_type'];

        $sql = "update tblattach_file set filedoc_type=:filedoc_type where id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':filedoc_type', $filedoc_type, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        if (strlen($_FILES["fileUpload"]["name"]) > 0) {

            $target_dir = "images/student/card/";

            $temp = explode(".", $_FILES["fileUpload"]["name"]);

            $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

            $picture = $target_file;

            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $sql = "update tblattach_file set file_name=:picture where id=:id ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':picture', $picture, PDO::PARAM_STR);
                $query->bindParam(':id', $id, PDO::PARAM_STR);
                $query->execute();
                $success = "Y";
            } else {
                $success = "N";
            }
        }
        $msg = "ปรับปรุงข้อมูลเรียบร้อยแล้ว Update info successfully = " . $id;

    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin แก้ไข ภาพถ่าย / เอกสาร</title>
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
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
                                <h2 class="title">แก้ไข ภาพถ่าย / เอกสาร</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>ทะเบียนนักกีฬา</li>
                                    <li class="active">แก้ไข ภาพถ่าย / เอกสาร</li>
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
                                                <h5>แก้ไข ภาพถ่าย / เอกสาร</h5>
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
                                                <?php

                                                $sql = "SELECT tblattach_file.*
                                            ,(select tblstudents.FirstName from tblstudents where tblstudents.RollId = tblattach_file.sid) as FirstName
                                            ,(select tblstudents.LastName from tblstudents where tblstudents.RollId = tblattach_file.sid) as LastName
                                            ,(select tbldoctype.document_type_name from tbldoctype where tbldoctype.id = tblattach_file.filedoc_type) as document_type_name
                                            from tblattach_file where id=:id";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
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
                                                                       value="<?php echo htmlentities($result->sid) ?>"
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


                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">รูปภาพ</label>

                                                            <div class="col-sm-10">

                                                                <?php
                                                                if (file_exists($result->file_name)) {
                                                                    $file = $result->file_name;
                                                                } else {
                                                                    $file = "images/Document-icon.png";
                                                                }
                                                                ?>

                                                                <img id="picture"
                                                                     src="<?php echo htmlentities($file) ?>"
                                                                     width="100" height="100"
                                                                     class="img-thumbnail"
                                                                     alt="<?php echo htmlentities($file) ?>"
                                                                     onmouseover="bigImg(this)"
                                                                     onmouseout="normalImg(this)"
                                                                     onclick="window.open(this.src,'_blank')">
                                                                <input type='file' name="fileUpload" id="fileUpload"
                                                                       accept="image/png, image/jpeg"
                                                                       onchange="readURL(this);"/>
                                                                <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                                    (ไฟล์ .jpg หรือ .png เท่านั้น)(Click
                                                                    ที่รูปเพื่อขยาย)</label>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">ประเภทเอกสาร</label>

                                                            <div class="col-sm-6">
                                                                <select name="filedoc_type" class="form-control"
                                                                        id="filedoc_type">
                                                                    <!--option value="">Select Class</option-->
                                                                    <option
                                                                        value="<?php echo htmlentities($result->filedoc_type); ?>"
                                                                        selected><?php echo htmlentities($result->document_type_name); ?></option>
                                                                    <?php $sql1 = "SELECT * from tbldoctype";
                                                                    $query1 = $dbh->prepare($sql1);
                                                                    $query1->execute();
                                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query1->rowCount() > 0) {
                                                                        foreach ($results1 as $result1) { ?>
                                                                            <option
                                                                                value="<?php echo htmlentities($result1->id); ?>"><?php echo htmlentities($result1->document_type_name); ?></option>
                                                                        <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="col-sm-offset-2 col-sm-6">
                                                                <button type="submit" name="submit"
                                                                        class="btn btn-primary">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="panel-heading">
                                                            <div class="panel-title">
                                                                <a href="manage-edit-files.php?rollid=<?php echo htmlentities($result->sid); ?>"
                                                                   class="btn btn-info btn-labeled">BACK<span
                                                                        class="btn-label btn-label-right"><i
                                                                            class="fa fa-check"></i></span></a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
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
    </body>
    </html>
<?PHP } ?>
