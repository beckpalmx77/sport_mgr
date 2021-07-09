<?php
session_start();
error_reporting(0);
include('includes/config.php');
include "vender/phpqrcode/qrlib.php";

$PNG_WEB_DIR = 'images/education/';

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

    $stid = intval($_GET['stid']);

    if (isset($_POST['submit'])) {

        if (strlen($_FILES["fileUpload"]["name"]) > 0) {


            $target_dir = "images/student/picture/";

            $temp = explode(".", $_FILES["fileUpload"]["name"]);

            $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

            $picture = $target_file;

            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $success = "Y";
                $sql = "update tblstudents set picture=:picture where StudentId=:stid ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':picture', $picture, PDO::PARAM_STR);
                $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                $query->execute();
            } else {
                $success = "N";
            }
        }

        $FirstName = $_POST['firstname'];
        $LastName = $_POST['lastname'];
        $rollid = $_POST['rollid'];
        $studentemail = $_POST['emailid'];
        $gender = $_POST['gender'];
        $classid = $_POST['class'];
        $subject = $_POST['subject'];
        $hight = $_POST['hight'];
        $weight = $_POST['weight'];
        $dob = $_POST['dob'];
        $BloodGroup = $_POST['BloodGroup'];
        $citi_no = $_POST['citi_no'];
        $Disease = $_POST['Disease'];
        $facebook = $_POST['facebook'];
        $line = $_POST['line'];
        $size_shirt = $_POST['size_shirt'];
        $sport_type1 = $_POST['sport_type1']===""? '0' : $_POST['sport_type1'];
        $sport_type2 = $_POST['sport_type2']===""? '0' : $_POST['sport_type2'];
        $sport_type3 = $_POST['sport_type3']===""? '0' : $_POST['sport_type3'];
        $phone = $_POST['phone'];
        $membertype = $_POST['membertype']===""? '0' : $_POST['membertype'];
        $edutype_id = $_POST['edutype_id']===""? '0' : $_POST['edutype_id'];
        $edutcat_id = $_POST['edutcat_id']===""? '0' : $_POST['edutcat_id'];
        $Level_Education = $_POST['Level_Education'];
        $Class_Education = $_POST['Class_Education'];
        $rh_blood = $_POST['rh_blood'];
        $BMI = $_POST['BMI'];
        $status = $_POST['status'];

        $sql = "update tblstudents
        set FirstName=:FirstName,LastName=:LastName,RollId=:rollid,StudentEmail=:studentemail
        ,Gender=:gender,DOB=:dob,hight=:hight,weight=:weight,ClassId=:classid,BloodGroup=:BloodGroup
        ,citi_no=:citi_no,Disease=:Disease,facebook=:facebook,line=:line,SubjectId=:subject,size_shirt=:size_shirt
        ,sport_type1=:sport_type1,sport_type2=:sport_type2,sport_type3=:sport_type3,Phone=:phone
        ,membertype=:membertype,edutype_id=:edutype_id,EducatId=:edutcat_id,Level_Education=:Level_Education,Class_Education=:Class_Education
        ,rh_blood=:rh_blood,BMI=:BMI,Status=:status where StudentId=:stid ";

        $query = $dbh->prepare($sql);
        $query->bindParam(':FirstName', $FirstName, PDO::PARAM_STR);
        $query->bindParam(':LastName', $LastName, PDO::PARAM_STR);
        $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
        $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':hight', $hight, PDO::PARAM_STR);
        $query->bindParam(':weight', $weight, PDO::PARAM_STR);
        $query->bindParam(':classid', $classid, PDO::PARAM_STR);
        $query->bindParam(':BloodGroup', $BloodGroup, PDO::PARAM_STR);
        $query->bindParam(':citi_no', $citi_no, PDO::PARAM_STR);
        $query->bindParam(':Disease', $Disease, PDO::PARAM_STR);
        $query->bindParam(':facebook', $facebook, PDO::PARAM_STR);
        $query->bindParam(':line', $line, PDO::PARAM_STR);
        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':size_shirt', $size_shirt, PDO::PARAM_STR);
        $query->bindParam(':sport_type1', $sport_type1, PDO::PARAM_STR);
        $query->bindParam(':sport_type2', $sport_type2, PDO::PARAM_STR);
        $query->bindParam(':sport_type3', $sport_type3, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':membertype', $membertype, PDO::PARAM_STR);
        $query->bindParam(':edutype_id', $edutype_id, PDO::PARAM_STR);
        $query->bindParam(':edutcat_id', $edutcat_id, PDO::PARAM_STR);
        $query->bindParam(':Level_Education', $Level_Education, PDO::PARAM_STR);
        $query->bindParam(':Class_Education', $Class_Education, PDO::PARAM_STR);
        $query->bindParam(':rh_blood', $rh_blood, PDO::PARAM_STR);
        $query->bindParam(':BMI', $BMI, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':stid', $stid, PDO::PARAM_STR);
        $query->execute();

        $msg = "ปรับปรุงข้อมูลเรียบร้อยแล้ว Update info successfully";

    }


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin| Edit Student < </title>
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css?v=1" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
        <!--script src="https://รับเขียนโปรแกรม.net/picker_date/picker_date.js"></script-->
        <script src="js/datepicker-thai/datepicker-lib.js"></script>
        <script src="vender/myjs/check_citi_no.js"></script>

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

    <style>
        body {
            background: #eeeeee;
            font-family: 'Prompt', sans-serif;
        }

    </style>

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
                                <h2 class="title">แก้ไขข้อมูลนักกีฬา</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">แก้ไขข้อมูลนักกีฬา</li>
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
                                                <h5>Fill the Athlete info</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>ดำเนินการสำเร็จ : </strong><?php echo htmlentities($msg); ?>
                                                <a href="#" class="close" data-dismiss="alert"
                                                   aria-label="close">&times;</a>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                                    <a href="#" class="close" data-dismiss="alert"
                                                       aria-label="close">&times;</a>
                                                </div>
                                            <?php } ?>

                                            <form action="" class="form-horizontal" method="post"
                                                  enctype="multipart/form-data">
                                                <?php

                                                $sql = "SELECT tblstudents.*,tblsubjects.SubjectName,tblclasses.ClassName
					                        ,(select tblsporttype.SportName from tblsporttype where tblsporttype.id = tblstudents.sport_type1) as SportName1
					                        ,(select tblsporttype.SportName from tblsporttype where tblsporttype.id = tblstudents.sport_type2) as SportName2
					                        ,(select tblsporttype.SportName from tblsporttype where tblsporttype.id = tblstudents.sport_type3) as SportName3
					                        ,(select tbledutype.educationname from tbledutype where tbledutype.id = tblstudents.edutype_id ) as edutype_name
					                        ,(select tbleducat.educat_name from tbleducat where tbleducat.id = tblstudents.EducatId ) as EducatName
                                            from tblstudents left join tblclasses on tblclasses.id=tblstudents.ClassId
                                            left join tblsubjects on tblsubjects.id=tblstudents.SubjectId
                                            where tblstudents.StudentId=:stid";

                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>

                                                        <div class="panel-heading">
                                                            <div class="panel-title">
                                                                <a href="manage-students.php"
                                                                   class="btn btn-info btn-labeled">BACK<span
                                                                        class="btn-label btn-label-right"><i
                                                                            class="fa fa-check"></i></span></a>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">รูปภาพ</label>

                                                            <?php
                                                            if (file_exists($result->picture)) {
                                                                $file = $result->picture;
                                                            } else {
                                                                $file = "images/person.png";
                                                            }
                                                            ?>

                                                            <div class="col-sm-4">
                                                                <img id="picture"
                                                                     src="<?php echo htmlentities($file) ?>"
                                                                     width="100" height="100"
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
                                                            <?php

                                                            if ($result->RollId == '') {
                                                                $qrcode_filename = $PNG_WEB_DIR . 'system-name.png';
                                                            } else {
                                                                $qrcode_filename = $PNG_WEB_DIR . $result->RollId . '.png';
                                                                QRcode::png($result->RollId, $qrcode_filename, 'H', '10', 2);
                                                            }

                                                            ?>
                                                            <div class="col-sm-4">
                                                                <img id="qrcode"
                                                                     src="<?php echo $qrcode_filename; ?>"
                                                                     width="100" height="100"
                                                                     alt="<?php echo htmlentities($qrcode_filename) ?>"
                                                                     onmouseover="bigImg(this)"
                                                                     onmouseout="normalImg(this)"
                                                                     onclick="window.open(this.src,'_blank')">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ประเภทสมาชิก</label>

                                                            <div class="col-sm-10">
                                                                <input type="radio" name="membertype" value="1"
                                                                       required="required"
                                                                       checked="">&nbsp;นักศึกษา
                                                                <input type="radio" name="membertype" value="2"
                                                                       required="required">&nbsp;เจ้าหน้าที่/บุคลากร
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">ประเภท
                                                                กรณีนักศึกษา</label>

                                                            <div class="col-sm-4">
                                                                <select name="edutcat_id" class="form-control"
                                                                        id="edutcat_id">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->EducatId); ?>"
                                                                        selected><?php echo htmlentities($result->EducatName); ?></option>
                                                                    <?php $sql1 = "SELECT * from tbleducat";
                                                                    $query1 = $dbh->prepare($sql1);
                                                                    $query1->execute();
                                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query1->rowCount() > 0) {
                                                                        foreach ($results1 as $result1) { ?>
                                                                            <option
                                                                                value="<?php echo htmlentities($result1->id); ?>"><?php echo htmlentities($result1->educat_name); ?></option>
                                                                        <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <select name="edutype_id" class="form-control"
                                                                        id="edutype_id">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->edutype_id); ?>"
                                                                        selected><?php echo htmlentities($result->edutype_name); ?></option>
                                                                    <?php $sql1 = "SELECT * from tbledutype";
                                                                    $query1 = $dbh->prepare($sql1);
                                                                    $query1->execute();
                                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query1->rowCount() > 0) {
                                                                        foreach ($results1 as $result1) { ?>
                                                                            <option
                                                                                value="<?php echo htmlentities($result1->id); ?>"><?php echo htmlentities($result1->educationname); ?></option>
                                                                        <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">รหัสประจำตัว</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="rollid" class="form-control"
                                                                       id="rollid"
                                                                       value="<?php echo htmlentities($result->RollId) ?>"
                                                                       maxlength="20" required="required"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">เลขบัตรประชาชน</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="citi_no" class="form-control"
                                                                       id="citi_no"
                                                                       value="<?php echo htmlentities($result->citi_no) ?>"
                                                                       onchange="chkDigitPid(this.value)"
                                                                       maxlength="13" required="required"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">เพศ</label>

                                                            <div class="col-sm-10">
                                                                <?php $gndr = $result->Gender;
                                                                if ($gndr == "Male") {
                                                                    ?>
                                                                    <input type="radio" name="gender" value="Male"
                                                                           required="required" checked>&nbsp;ผู้ชาย
                                                                    <input type="radio" name="gender" value="Female"
                                                                           required="required">&nbsp;ผู้หญิง
                                                                    <input type="radio" name="gender" value="Other"
                                                                           required="required">&nbsp;อื่นๆ
                                                                <?php } ?>
                                                                <?php
                                                                if ($gndr == "Female") {
                                                                    ?>
                                                                    <input type="radio" name="gender" value="Male"
                                                                           required="required">&nbsp;ผู้ชาย
                                                                    <input type="radio" name="gender" value="Female"
                                                                           required="required" checked>&nbsp;ผู้หญิง
                                                                    <input type="radio" name="gender" value="Other"
                                                                           required="required">&nbsp;อื่นๆ
                                                                <?php } ?>
                                                                <?php
                                                                if ($gndr == "Other") {
                                                                    ?>
                                                                    <input type="radio" name="gender" value="Male"
                                                                           required="required">&nbsp;ผู้ชาย
                                                                    <input type="radio" name="gender" value="Female"
                                                                           required="required">&nbsp;ผู้หญิง
                                                                    <input type="radio" name="gender" value="Other"
                                                                           required="required" checked>&nbsp;อื่นๆ
                                                                <?php } ?>


                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ชื่อ</label>

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
                                                            <label for="date"
                                                                   class="col-sm-2 control-label">วันเกิด</label>
                                                            <!--  สร้าง textbox สำหรับสร้างตัวเลือก ปฎิทิน โดยมี id มีค่าเป็น my_date  -->
                                                            <div class="col-sm-4">
                                                                <input id="dob" name="dob" class="form-control"
                                                                       value="<?php echo htmlentities($result->DOB) ?>"
                                                                       readonly="true">
                                                            </div>

                                                            <!--label for="default" class="col-sm-2 control-label">ขนาดเสื้อ</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="size_shirt" class="form-control"
                                                                   id="size_shirt" autocomplete="off"
                                                                   value="<?php echo htmlentities($result->size_shirt) ?>">
                                                        </div-->


                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ขนาดเสื้อ</label>

                                                            <div class="col-sm-4">
                                                                <select id="size_shirt" name="size_shirt"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->size_shirt); ?>"
                                                                        selected><?php echo htmlentities($result->size_shirt); ?></option>
                                                                    <option>SS</option>
                                                                    <option>S</option>
                                                                    <option>M</option>
                                                                    <option>L</option>
                                                                    <option>XL</option>
                                                                    <option>2XL</option>
                                                                    <option>3XL</option>
                                                                    <option>4XL</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ส่วนสูง</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="hight" class="form-control"
                                                                       id="hight" autocomplete="off"
                                                                       value="<?php echo htmlentities($result->hight) ?>">
                                                            </div>

                                                            <label for="default"
                                                                   class="col-sm-2 control-label">น้ำหนัก</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="weight" class="form-control"
                                                                       id="weight" autocomplete="off"
                                                                       value="<?php echo htmlentities($result->weight) ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">กลุ่มเลือด</label>

                                                            <div class="col-sm-1">
                                                                <select id="BloodGroup" name="BloodGroup"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->BloodGroup); ?>"
                                                                        selected><?php echo htmlentities($result->BloodGroup); ?></option>
                                                                    <option>A</option>
                                                                    <option>B</option>
                                                                    <option>AB</option>
                                                                    <option>O</option>
                                                                </select>
                                                            </div>


                                                            <label for="default"
                                                                   class="col-sm-2 control-label">RH กลุ่มเลือด</label>

                                                            <div class="col-sm-1">
                                                                <select id="rh_blood" name="rh_blood"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->rh_blood); ?>"
                                                                        selected><?php echo htmlentities($result->rh_blood); ?></option>
                                                                    <option>+</option>
                                                                    <option>-</option>
                                                                </select>
                                                            </div>

                                                            <label for="default" class="col-sm-2 control-label">BMI
                                                            </label>

                                                            <div class="col-sm-4">
                                                                <input type="text" name="BMI" class="form-control"
                                                                       id="BMI"
                                                                       value="<?php echo htmlentities($result->BMI) ?>"
                                                                       autocomplete="off">
                                                            </div>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">ประเภทกีฬา
                                                                (หลัก)</label>

                                                            <div class="col-sm-2">
                                                                <select name="sport_type1" class="form-control"
                                                                        id="sport_type1">
                                                                    <!--option value="">Select Class</option-->
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

                                                            <label for="default" class="col-sm-2 control-label">ประเภทกีฬา
                                                                (สำรอง 1)</label>

                                                            <div class="col-sm-2">
                                                                <select name="sport_type2" class="form-control"
                                                                        id="sport_type2">
                                                                    <!--option value="">Select Class</option-->
                                                                    <option
                                                                        value="<?php echo htmlentities($result->sport_type2); ?>"
                                                                        selected><?php echo htmlentities($result->SportName2); ?></option>
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
                                                            <label for="default" class="col-sm-2 control-label">ประเภทกีฬา
                                                                (สำรอง 2)</label>

                                                            <div class="col-sm-2">
                                                                <select name="sport_type3" class="form-control"
                                                                        id="sport_type3">
                                                                    <!--option value="">Select Class</option-->
                                                                    <option
                                                                        value="<?php echo htmlentities($result->sport_type3); ?>"
                                                                        selected><?php echo htmlentities($result->SportName3); ?></option>
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
                                                                   class="col-sm-2 control-label">โรคประจำตัว</label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="Disease" class="form-control"
                                                                       value="<?php echo htmlentities($result->Disease) ?>"
                                                                       id="Disease" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">โทรศีพท์</label>

                                                            <div class="col-sm-10">
                                                                <input type="phone" name="phone" class="form-control"
                                                                       id="phone"
                                                                       value="<?php echo htmlentities($result->Phone) ?>"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">Email</label>

                                                            <div class="col-sm-10">
                                                                <input type="email" name="emailid" class="form-control"
                                                                       id="email"
                                                                       value="<?php echo htmlentities($result->StudentEmail) ?>"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Facebook
                                                            </label>

                                                            <div class="col-sm-4">
                                                                <input type="text" name="facebook" class="form-control"
                                                                       id="facebook"
                                                                       value="<?php echo htmlentities($result->facebook) ?>"
                                                                       autocomplete="off">
                                                            </div>
                                                            <label for="default" class="col-sm-2 control-label">Line ID
                                                            </label>

                                                            <div class="col-sm-4">
                                                                <input type="text" name="line" class="form-control"
                                                                       id="line"
                                                                       value="<?php echo htmlentities($result->line) ?>"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">คณะ/หน่วยงาน</label>

                                                            <div class="col-sm-6">
                                                                <select name="class" class="form-control" id="class">
                                                                    <!--option value="">Select Class</option-->
                                                                    <option
                                                                        value="<?php echo htmlentities($result->ClassId); ?>"
                                                                        selected><?php echo htmlentities($result->ClassName); ?></option>
                                                                    <?php $sql1 = "SELECT * from tblclasses";
                                                                    $query1 = $dbh->prepare($sql1);
                                                                    $query1->execute();
                                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query1->rowCount() > 0) {
                                                                        foreach ($results1 as $result1) { ?>
                                                                            <option
                                                                                value="<?php echo htmlentities($result1->id); ?>"><?php echo htmlentities($result1->ClassName); ?></option>
                                                                        <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">สาขาวิชา/แผนก</label>

                                                            <div class="col-sm-6">
                                                                <select name="subject" class="form-control"
                                                                        id="subject">
                                                                    <!--option value="">Select Class</option-->
                                                                    <option
                                                                        value="<?php echo htmlentities($result->SubjectId); ?>"
                                                                        selected><?php echo htmlentities($result->SubjectName); ?></option>
                                                                    <?php $sql1 = "SELECT * from tblsubjects";
                                                                    $query1 = $dbh->prepare($sql1);
                                                                    $query1->execute();
                                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query1->rowCount() > 0) {
                                                                        foreach ($results1 as $result1) { ?>
                                                                            <option
                                                                                value="<?php echo htmlentities($result1->id); ?>"><?php echo htmlentities($result1->SubjectName); ?></option>
                                                                        <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ระดับการศึกษา</label>

                                                            <div class="col-sm-4">
                                                                <select id="Class_Education" name="Class_Education"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->Class_Education); ?>"
                                                                        selected><?php echo htmlentities($result->Class_Education); ?></option>
                                                                    <option>ปริญญาตรี</option>
                                                                    <option>ปริญญาโท</option>
                                                                    <option>ปริญญาเอก</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ชั้นปีการศึกษา</label>

                                                            <div class="col-sm-4">
                                                                <select id="Level_Education" name="Level_Education"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->Level_Education); ?>"
                                                                        selected><?php echo htmlentities($result->Level_Education); ?></option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <!--div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">Class</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="classname" class="form-control"
                                                                   id="classname"
                                                                   value="<?php echo htmlentities($result->ClassName) ?>(<?php echo htmlentities($result->Section) ?>)"
                                                                   readonly>
                                                        </div>
                                                    </div-->

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">สถานะ</label>

                                                            <div class="col-sm-10">
                                                                <?php $stats = $result->Status;
                                                                if ($stats == "1") {
                                                                    ?>
                                                                    <input type="radio" name="status" value="1"
                                                                           required="required" checked>ปกติ <input
                                                                        type="radio" name="status" value="0"
                                                                        required="required">หมดอายุสมาชิก/ลาออก/พ้นสภาพ
                                                                <?php } ?>
                                                                <?php
                                                                if ($stats == "0") {
                                                                    ?>
                                                                    <input type="radio" name="status" value="1"
                                                                           required="required">ปกติ <input type="radio"
                                                                                                           name="status"
                                                                                                           value="0"
                                                                                                           required="required"
                                                                                                           checked>หมดอายุสมาชิก
                                                                <?php } ?>


                                                            </div>
                                                        </div>

                                                    <?php }
                                                } ?>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Reg
                                                        Date: </label>

                                                    <div class="col-sm-10">
                                                        <?php echo htmlentities($result->RegDate) ?>
                                                    </div>
                                                </div>

                                                <button onclick="topFunction()" id="myBtn" title="Go to top">Top
                                                </button>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="submit" class="btn btn-primary">Save
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
                </section>
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

        <style>
            #myBtn {
                display: none; /* Hidden by default */
                position: fixed; /* Fixed/sticky position */
                bottom: 20px; /* Place the button at the bottom of the page */
                right: 30px; /* Place the button 30px from the right */
                z-index: 99; /* Make sure it does not overlap */
                border: none; /* Remove borders */
                outline: none; /* Remove outline */
                background-color: red; /* Set a background color */
                color: white; /* Text color */
                cursor: pointer; /* Add a mouse pointer on hover */
                padding: 15px; /* Some padding */
                border-radius: 10px; /* Rounded corners */
                font-size: 18px; /* Increase font size */
            }

            #myBtn:hover {
                background-color: #555; /* Add a dark-grey background on hover */
            }

        </style>

        <script>
            //Get the button:
            mybutton = document.getElementById("myBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }
        </script>

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
            picker_date(document.getElementById("dob"), {year_range: "-100:+1000"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
        </script>

    </body>
    </html>
<?PHP } ?>


