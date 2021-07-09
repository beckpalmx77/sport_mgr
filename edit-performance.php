<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    $id = $_GET['id'];
    if (isset($_POST['update'])) {

        $sid = $_POST['sid'];
        $order_test = $_POST['order_test'];
        $date_test = $_POST['date_test'];
        $hight = $_POST['hight'];
        $weight = $_POST['weight'];
        $bfp = $_POST['bfp'];
        $fms = $_POST['fms'];
        $sj = $_POST['sj'];
        $gs = $_POST['gs'];
        $tss = $_POST['tss'];
        $sr = $_POST['sr'];
        $tff = $_POST['tff'];
        $dr_type = $_POST['dr_type'];
        $dr_result = $_POST['dr_result'];
        $test_result = $_POST['test_result'];
        $rec_id = $_POST['rec_id'];

        $sql = "UPDATE tbl_performance SET sid=:sid,order_test=:order_test,date_test=:date_test,hight=:hight,
        weight=:weight,bfp=:bfp,fms=:fms,sj=:sj,gs=:gs,tss=:tss,sr=:sr,
        tff=:tff,dr_type=:dr_type,dr_result=:dr_result,test_result=:test_result  where id=:rec_id";

        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':order_test', $order_test, PDO::PARAM_STR);
        $query->bindParam(':date_test', $date_test, PDO::PARAM_STR);
        $query->bindParam(':hight', $hight, PDO::PARAM_STR);
        $query->bindParam(':weight', $weight, PDO::PARAM_STR);
        $query->bindParam(':bfp', $bfp, PDO::PARAM_STR);
        $query->bindParam(':fms', $fms, PDO::PARAM_STR);
        $query->bindParam(':sj', $sj, PDO::PARAM_STR);
        $query->bindParam(':gs', $gs, PDO::PARAM_STR);
        $query->bindParam(':tss', $tss, PDO::PARAM_STR);
        $query->bindParam(':sr', $sr, PDO::PARAM_STR);
        $query->bindParam(':tff', $tff, PDO::PARAM_STR);
        $query->bindParam(':dr_type', $dr_type, PDO::PARAM_STR);
        $query->bindParam(':dr_result', $dr_result, PDO::PARAM_STR);
        $query->bindParam(':test_result', $test_result, PDO::PARAM_STR);
        $query->bindParam(':rec_id', $rec_id, PDO::PARAM_STR);
        $query->execute();

        $msg = "Data has been updated successfully";

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin ปรับปรุง ข้อมูลทดสอบสมรรถภาพร่างกาย </title>
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
                                <h2 class="title">ปรับปรุง ข้อมูลทดสอบสมรรถภาพร่างกาย </h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i>Home</a></li>
                                    <li>ทะเบียนนักกีฬา</li>
                                    <li class="active">ปรับปรุง ข้อมูลทดสอบสมรรถภาพร่างกาย</li>
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
                                                <h5>ปรับปรุง ข้อมูลทดสอบสมรรถภาพร่างกาย </h5>
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
                                                $sql = "SELECT *
					                        ,(select tblstudents.FirstName from tblstudents where tblstudents.RollId = tbl_performance.sid) as FirstName
					                        ,(select tblstudents.LastName from tblstudents where tblstudents.RollId = tbl_performance.sid) as LastName
					                        ,(select tblstudents.picture from tblstudents where tblstudents.RollId = tbl_performance.sid) as picture
                                            from tbl_performance
                                            where id=:id";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>

                                                        <input type="hidden" name="rec_id"
                                                               value="<?php echo htmlentities($result-- > id) ?>">

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
                                                            <label for="order_test"
                                                                   class="col-sm-2 control-label">ครั้งที่ทดสอบ</label>

                                                            <div class="col-sm-4">
                                                                <input id="order_test" name="order_test"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->order_test) ?>"
                                                                       placeholder="" readonly="true">
                                                            </div>

                                                            <label for="date"
                                                                   class="col-sm-2 control-label">วันที่ทดสอบ</label>
                                                            <!--  สร้าง textbox สำหรับสร้างตัวเลือก ปฎิทิน โดยมี id มีค่าเป็น my_date  -->
                                                            <div class="col-sm-4">
                                                                <input id="date_test" name="date_test"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->date_test) ?>"
                                                                       placeholder="วัน/เดือน/ปี">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ส่วนสูง</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="hight" class="form-control"
                                                                       value="<?php echo htmlentities($result->hight) ?>"
                                                                       id="hight" autocomplete="off">
                                                            </div>

                                                            <label for="default"
                                                                   class="col-sm-2 control-label">น้ำหนัก</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="weight" class="form-control"
                                                                       value="<?php echo htmlentities($result->weight) ?>"
                                                                       id="weight" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">เปอร์เซ็นต์ไขมัน
                                                                Body fat Percentage </label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="bfp" class="form-control"
                                                                       value="<?php echo htmlentities($result->bfp) ?>"
                                                                       id="bfp" autocomplete="off">
                                                            </div>

                                                            <label for="default" class="col-sm-2 control-label">วิ่งเร็ว
                                                                50
                                                                เมตร (50MeterSprint)</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="fms" class="form-control"
                                                                       value="<?php echo htmlentities($result->fms) ?>"
                                                                       id="fms" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">ยืนกระโดดไกล
                                                                (StandJump)</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="sj" class="form-control"
                                                                       value="<?php echo htmlentities($result->sj) ?>"
                                                                       id="sj" autocomplete="off">
                                                            </div>

                                                            <label for="default" class="col-sm-2 control-label">แรงบีบมือ
                                                                (GripStrength) </label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="gs" class="form-control"
                                                                       value="<?php echo htmlentities($result->gs) ?>"
                                                                       id="gs" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">ลุก-นั่ง
                                                                30
                                                                วินาที (30SecondSit-up)</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="tss" class="form-control"
                                                                       value="<?php echo htmlentities($result->tss) ?>"
                                                                       id="tss" autocomplete="off">
                                                            </div>

                                                            <label for="default" class="col-sm-2 control-label">วิ่งเก็บของ
                                                                ( Shuttle Run)</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="sr" class="form-control"
                                                                       value="<?php echo htmlentities($result->sr) ?>"
                                                                       id="sr" autocomplete="off">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">นั่งงอตัวไปข้างหน้า
                                                                (Trunk Forward Flexion)</label>

                                                            <div class="col-sm-4">
                                                                <input type="number" name="tff" class="form-control"
                                                                       value="<?php echo htmlentities($result->tff) ?>"
                                                                       id="tff" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">

                                                            <label for="default"
                                                                   class="col-sm-2 control-label">วิ่งระยะไกล (Distance
                                                                Run) </label>

                                                            <div class="col-sm-4">
                                                                <select id="dr_type" name="dr_type"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->dr_type); ?>"
                                                                        selected><?php echo htmlentities($result->dr_type); ?></option>
                                                                    <option>วิ่ง 1,000 เมตร นักกีฬาชาย</option>
                                                                    <option>วิ่ง 800 เมตร นักกีฬาหญิง</option>
                                                                </select>
                                                            </div>
                                                            <label for="default"
                                                            <label for="date"
                                                                   class="col-sm-2 control-label">ผลทดสอบ</label>

                                                            <div class="col-sm-4">
                                                                <input id="dr_result" name="dr_result"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->dr_result); ?>"
                                                                       placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ผลการทดสอบ</label>

                                                            <div class="col-sm-10">
                                                                <select id="test_result" name="test_result"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->test_result); ?>"
                                                                        selected><?php echo htmlentities($result->test_result); ?></option>
                                                                    <option>ผ่าน</option>
                                                                    <option>ไม่ผ่าน</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <?php
                                                    }
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="update" class="btn btn-primary">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <a href="manage-edit-performance.php?rollid=<?php echo htmlentities($result->sid); ?>"
                                                           class="btn btn-info btn-labeled">BACK<span
                                                                class="btn-label btn-label-right"><i
                                                                    class="fa fa-check"></i></span></a>
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
            picker_date(document.getElementById("date_test"), {year_range: "-100:+1000"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
        </script>

    </body>
    </html>
<?PHP } ?>


