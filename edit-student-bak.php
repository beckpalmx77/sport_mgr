<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

    $stid = intval($_GET['stid']);

    if (isset($_POST['submit'])) {

        $target_dir = "images/student/picture/";

        //$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);

        $temp = explode(".", $_FILES["fileUpload"]["name"]);

        $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            $success = "Y";
        } else {
            $success = "N";
        }

        $FirstName = $_POST['firstname'];
        $LastName = $_POST['lastname'];
        $rollid = $_POST['rollid'];
        $studentemail = $_POST['emailid'];
        $gender = $_POST['gender'];
        $classid = $_POST['class'];
        $dob = $_POST['dob'];
        $status = $_POST['status'];
        $picture = $target_file;
        $sql = "update tblstudents set FirstName=:FirstName,LastName=:LastName,RollId=:rollid,StudentEmail=:studentemail
,Gender=:gender,DOB=:dob,Status=:status,picture=:picture where StudentId=:stid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':FirstName', $FirstName, PDO::PARAM_STR);
        $query->bindParam(':LastName', $LastName, PDO::PARAM_STR);
        $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
        $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':picture', $picture, PDO::PARAM_STR);
        $query->bindParam(':stid', $stid, PDO::PARAM_STR);
        $query->execute();

        $msg = "Updated successfully";
    }


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ARMS Admin| Edit Student < </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
        <script src="https://รับเขียนโปรแกรม.net/picker_date/picker_date.js"></script>
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
                                <h2 class="title">Athlete Admission</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">Athlete Admission</li>
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
                                            <h5>Fill the Athlete info</h5>
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
                                        <form action="" class="form-horizontal" method="post"
                                              enctype="multipart/form-data">
                                            <?php

                                            $sql = "SELECT tblstudents.picture,tblstudents.FirstName,tblstudents.LastName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblstudents.StudentEmail,tblstudents.Gender,tblstudents.DOB,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>

                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">picture</label>

                                                        <div class="col-sm-10">
                                                            <img id="picture"
                                                                 src="<?php echo htmlentities($result->picture) ?>"
                                                                 width="100" height="100" alt="">
                                                            <input type='file' name="fileUpload" id="fileUpload"
                                                                   accept="image/png, image/jpeg" onchange="readURL(this);"/>
                                                            <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                                (ไฟล์ .jpg หรือ .png เท่านั้น)</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Roll
                                                            Id</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="rollid" class="form-control"
                                                                   id="rollid"
                                                                   value="<?php echo htmlentities($result->RollId) ?>"
                                                                   maxlength="5" required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">ชื่อ</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="firstname" class="form-control"
                                                                   id="firstname"
                                                                   value="<?php echo htmlentities($result->FirstName) ?>"
                                                                   required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">นามสกุล</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="lastname" class="form-control"
                                                                   id="lastname"
                                                                   value="<?php echo htmlentities($result->LastName) ?>"
                                                                   required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label">วันเกิด</label>
                                                        <!--  สร้าง textbox สำหรับสร้างตัวเลือก ปฎิทิน โดยมี id มีค่าเป็น my_date  -->
                                                        <div class="col-sm-10">
                                                            <input id="dob" name="dob"  class="form-control" value="<?php echo htmlentities($result->DOB) ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Email
                                                            id)</label>

                                                        <div class="col-sm-10">
                                                            <input type="email" name="emailid" class="form-control"
                                                                   id="email"
                                                                   value="<?php echo htmlentities($result->StudentEmail) ?>"
                                                                   required="required" autocomplete="off">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">Gender</label>

                                                        <div class="col-sm-10">
                                                            <?php $gndr = $result->Gender;
                                                            if ($gndr == "Male") {
                                                                ?>
                                                                <input type="radio" name="gender" value="Male"
                                                                       required="required" checked>Male <input
                                                                    type="radio" name="gender" value="Female"
                                                                    required="required">Female <input type="radio"
                                                                                                      name="gender"
                                                                                                      value="Other"
                                                                                                      required="required">Other
                                                            <?php } ?>
                                                            <?php
                                                            if ($gndr == "Female") {
                                                                ?>
                                                                <input type="radio" name="gender" value="Male"
                                                                       required="required">Male <input type="radio"
                                                                                                       name="gender"
                                                                                                       value="Female"
                                                                                                       required="required"
                                                                                                       checked>Female
                                                                <input type="radio" name="gender" value="Other"
                                                                       required="required">Other
                                                            <?php } ?>
                                                            <?php
                                                            if ($gndr == "Other") {
                                                                ?>
                                                                <input type="radio" name="gender" value="Male"
                                                                       required="required">Male <input type="radio"
                                                                                                       name="gender"
                                                                                                       value="Female"
                                                                                                       required="required">Female
                                                                <input type="radio" name="gender" value="Other"
                                                                       required="required" checked>Other
                                                            <?php } ?>


                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">Class</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="classname" class="form-control"
                                                                   id="classname"
                                                                   value="<?php echo htmlentities($result->ClassName) ?>(<?php echo htmlentities($result->Section) ?>)"
                                                                   readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label">วันเกิด(mm/dd/yyyy)</label>

                                                        <div class="col-sm-10">
                                                            <input type="date" name="dob1" class="form-control"
                                                                   value="<?php echo htmlentities($result->DOB) ?>"
                                                                   id="date">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Reg
                                                            Date: </label>

                                                        <div class="col-sm-10">
                                                            <?php echo htmlentities($result->RegDate) ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">Status</label>

                                                        <div class="col-sm-10">
                                                            <?php $stats = $result->Status;
                                                            if ($stats == "1") {
                                                                ?>
                                                                <input type="radio" name="status" value="1"
                                                                       required="required" checked>Active <input
                                                                    type="radio" name="status" value="0"
                                                                    required="required">Block
                                                            <?php } ?>
                                                            <?php
                                                            if ($stats == "0") {
                                                                ?>
                                                                <input type="radio" name="status" value="1"
                                                                       required="required">Active <input type="radio"
                                                                                                         name="status"
                                                                                                         value="0"
                                                                                                         required="required"
                                                                                                         checked>Block
                                                            <?php } ?>


                                                        </div>
                                                    </div>

                                                <?php }
                                            } ?>


                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn btn-primary">Add
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

        <script>
            //กำหนดให้ textbox ที่มี id เท่ากับ my_date เป็นตัวเลือกแบบ ปฎิทิน
            picker_date(document.getElementById("dob"),{year_range:"-100:+300"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
        </script>

    </body>
    </html>
<?PHP } ?>
