<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {

        $FirstName = $_POST['firstname'];
        $LastName = $_POST['lastname'];
        $rollid = $_POST['rollid'];
        $studentemail = $_POST['email'];
        $gender = $_POST['gender'];
        $classid = $_POST['class'];
        $subject = $_POST['subject'];
        $dob = $_POST['dob'];
        $hight = $_POST['hight'];
        $weight = $_POST['weight'];
        $BloodGroup = $_POST['BloodGroup'];
        $citi_no = $_POST['citi_no'];
        $Disease = $_POST['Disease'];
        $size_shirt = $_POST['size_shirt'];
        $sport_type1 = $_POST['sport_type1'];
        $sport_type2 = $_POST['sport_type2'];
        $sport_type3 = $_POST['sport_type3'];
        $facebook = $_POST['facebook'];
        $line = $_POST['line'];
        $phone = $_POST['phone'];

        $membertype = $_POST['membertype'];
        $edutype_id = $_POST['edutype_id'];
        $edutcat_id = $_POST['edutcat_id'];
        $Class_Education = $_POST['Class_Education'];
        $Level_Education = $_POST['Level_Education'];
        $rh_blood = $_POST['rh_blood'];
        $BMI = $_POST['BMI'];
        $status = 1;

        $sql = "INSERT INTO  tblstudents(RollId,FirstName,LastName,StudentEmail,Gender,ClassId,DOB,hight,weight,BloodGroup,citi_no,Disease
        ,SubjectId,size_shirt,sport_type1,sport_type2,sport_type3,facebook,line,Phone,membertype,EducatId,edutype_id,Class_Education,Level_Education,rh_blood,BMI)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $query = $dbh->prepare($sql);
        $query->bindParam(1, $rollid);
        $query->bindParam(2, $FirstName);
        $query->bindParam(3, $LastName);
        $query->bindParam(4, $studentemail);
        $query->bindParam(5, $gender);
        $query->bindParam(6, $classid);
        $query->bindParam(7, $dob);
        $query->bindParam(8, $hight);
        $query->bindParam(9, $weight);
        $query->bindParam(10, $BloodGroup);
        $query->bindParam(11, $citi_no);
        $query->bindParam(12, $Disease);
        $query->bindParam(13, $subject);
        $query->bindParam(14, $size_shirt);
        $query->bindParam(15, $sport_type1);
        $query->bindParam(16, $sport_type2);
        $query->bindParam(17, $sport_type3);
        $query->bindParam(18, $facebook);
        $query->bindParam(19, $line);
        $query->bindParam(20, $phone);
        $query->bindParam(21, $membertype);
        $query->bindParam(22, $edutype_id);
        $query->bindParam(23, $edutcat_id);
        $query->bindParam(24, $Class_Education);
        $query->bindParam(25, $Level_Education);
        $query->bindParam(26, $rh_blood);
        $query->bindParam(27, $BMI);


        /*      $query->bindParam(':status', $status);     */


        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {

            if (strlen($_FILES["fileUpload"]["name"]) > 0) {

                $target_dir = "images/student/picture/";

                $temp = explode(".", $_FILES["fileUpload"]["name"]);

                $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

                $picture = $target_file;

                if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                    $sql = "update tblstudents set picture=:picture where StudentId=:stid ";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':picture', $picture);
                    $query->bindParam(':stid', $lastInsertId);
                    $query->execute();
                    $success = "Y";
                } else {
                    $success = "N";
                }
            }

            $msg = "เพิ่มข้อมูลเรียบร้อยแล้ว info added successfully";

        } else {
            //$error = "Something went wrong. Please try again !!! " . $sql ;
            $error = "มีข้อผิดพลาดในการบันทึกข้อมูล กรุณาตรวจสอบอีกครั้ง Something went wrong. Please try again !!! " ;
            //echo "ERROR : " . $sql->errorInfo();
        }

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin| Athlete Admission< </title>
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>

        <!--script src="https://รับเขียนโปรแกรม.net/picker_date/picker_date.js"></script-->
        <script src="js/datepicker-thai/datepicker-lib.js"></script>
        <script src="vender/myjs/check_citi_no.js"></script>

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

    </head>
    <body class="top-navbar-fixed">
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
                                <h2 class="title">บันทึกข้อมูลนักกีฬา</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">บันทึกข้อมูลนักกีฬา (Athlete Info)</li>
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
                                                <h5>ป้อนข้อมูลนักกีฬา</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                <a href="#" class="close" data-dismiss="alert"
                                                   aria-label="close">&times;</a>
                                                <strong>ดำเนินการสำเร็จ : </strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                       aria-label="close">&times;</a>
                                                    <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>

                                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

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

                                                    <div class="col-sm-10">
                                                        <img id="picture"
                                                             src=""
                                                             width="100" height="100" alt="">
                                                        <input type='file' name="fileUpload" id="fileUpload"
                                                               accept="image/png, image/jpeg"
                                                               onchange="readURL(this);"/>
                                                        <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                            (ไฟล์ .jpg หรือ .png เท่านั้น)</label>
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
                                                        <select name="edutcat_id" class="form-control" id="edutcat_id">
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
                                                        <select name="edutype_id" class="form-control" id="edutype_id">
                                                            <option
                                                                value="<?php echo htmlentities($result->edutype_id); ?>"
                                                                selected><?php echo htmlentities($result->edutype_id); ?></option>
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

                                                    <div class="col-sm-4">
                                                        <input type="text" name="rollid" class="form-control"
                                                               id="rollid"
                                                               maxlength="20" required="required" autocomplete="off">
                                                    </div>
                                                    <label for="default"
                                                           class="col-sm-2 control-label">เลขบัตรประชาชน</label>

                                                    <div class="col-sm-4">
                                                        <input type="text" name="citi_no" class="form-control"
                                                               id="citi_no"
                                                               onchange="chkDigitPid(this.value)"
                                                               maxlength="13" required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">เพศ</label>

                                                    <div class="col-sm-10">
                                                        <input type="radio" name="gender" value="Male"
                                                               required="required"
                                                               checked="">&nbsp;ผู้ชาย
                                                        <input type="radio" name="gender" value="Female"
                                                               required="required">&nbsp;ผู้หญิง
                                                        <input type="radio" name="gender" value="Other"
                                                               required="required">&nbsp;อื่นๆ
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">ชื่อ</label>

                                                    <div class="col-sm-4">
                                                        <input type="text" name="firstname" class="form-control"
                                                               id="firstname" required="required" autocomplete="off">
                                                    </div>
                                                    <label for="default" class="col-sm-2 control-label">นามสกุล</label>

                                                    <div class="col-sm-4">
                                                        <input type="text" name="lastname" class="form-control"
                                                               id="lastname" required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="date" class="col-sm-2 control-label">วันเกิด</label>
                                                    <!--  สร้าง textbox สำหรับสร้างตัวเลือก ปฎิทิน โดยมี id มีค่าเป็น my_date  -->
                                                    <div class="col-sm-4">
                                                        <input id="dob" name="dob" class="form-control"
                                                               placeholder="วัน/เดือน/ปี" readonly="true">
                                                    </div>


                                                    <label for="default"
                                                           class="col-sm-2 control-label">ขนาดเสื้อ</label>

                                                    <div class="col-sm-4">
                                                        <select id="size_shirt" name="size_shirt"
                                                                class="form-control" data-live-search="true"
                                                                title="Please select">
                                                            <option value="">เลือก ขนาดเสื้อ</option>
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
                                                    <label for="default" class="col-sm-2 control-label">ส่วนสูง</label>

                                                    <div class="col-sm-4">
                                                        <input type="number" name="hight" class="form-control"
                                                               id="hight" autocomplete="off">
                                                    </div>

                                                    <label for="default" class="col-sm-2 control-label">น้ำหนัก</label>

                                                    <div class="col-sm-4">
                                                        <input type="number" name="weight" class="form-control"
                                                               id="weight" autocomplete="off">
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
                                                        (สำรอง
                                                        1)</label>

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
                                                        (สำรอง
                                                        2)</label>

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
                                                               id="Disease" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">โทรศีพท์</label>

                                                    <div class="col-sm-10">
                                                        <input type="phone" name="phone" class="form-control" id="phone"
                                                               autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Email</label>

                                                    <div class="col-sm-10">
                                                        <input type="email" name="email" class="form-control" id="email"
                                                               autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Facebook</label>

                                                    <div class="col-sm-4">
                                                        <input type="text" name="facebook" class="form-control"
                                                               id="facebook "
                                                               autocomplete="off">
                                                    </div>
                                                    <label for="default" class="col-sm-2 control-label">Line ID</label>

                                                    <div class="col-sm-4">
                                                        <input type="text" name="line" class="form-control" id="line"
                                                               autocomplete="off">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label">คณะ/หน่วยงาน</label>

                                                    <div class="col-sm-10">
                                                        <select name="class" class="form-control" id="class">
                                                            <option value="">เลือก คณะ/หน่วยงาน</option>
                                                            <?php $sql = "SELECT * from tblclasses";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $result) { ?>
                                                                    <option
                                                                        value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>
                                                                        <!--&nbsp;
                                                                        Section-->
                                                                        <!--?php echo htmlentities($result->Section); ?--></option>
                                                                <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label">สาขาวิชา/แผนก</label>

                                                    <div class="col-sm-10">
                                                        <select name="subject" class="form-control" id="subject"
                                                                data-live-search="true">
                                                            <option value="">เลือก สาขาวิชา/แผนก</option>
                                                            <?php $sql = "SELECT * from tblsubjects";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $result) { ?>
                                                                    <option
                                                                        value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->SubjectName); ?></option>
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

