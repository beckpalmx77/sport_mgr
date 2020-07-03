<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['update'])) {
        $classname = $_POST['classname'];
        $classnamenumeric = $_POST['classnamenumeric'];
        $section = $_POST['section'];
        $id = intval($_GET['clasid']);
        $sql = "update  tbl_performance set ClassName=:classname,ClassNameNumeric=:classnamenumeric,Section=:section where id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':classname', $classname, PDO::PARAM_STR);
        $query->bindParam(':classnamenumeric', $classnamenumeric, PDO::PARAM_STR);
        $query->bindParam(':section', $section, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
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
        <title>SARRS Admin Update ข้อมูลทดสอบสมรรถภาพร่างกาย</title>
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
        <link rel="stylesheet" href="css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
    <div class="main-wrapper">

        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-----End Top bar>
          <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-idebar -->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Update ข้อมูลทดสอบสมรรถภาพร่างกาย</h2>
                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="#">ทะเบียนหลัก</a></li>
                                    <li class="active">Update ข้อมูลทดสอบสมรรถภาพร่างกาย</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                    <section class="section">
                        <div class="container-fluid">


                            <div class="row">
                                <!--div class="col-md-10 col-md-offset-1"-->
                                    <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Update ข้อมูลทดสอบสมรรถภาพร่างกาย</h5>
                                            </div>
                                        </div>
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>

                                        <form method="post">
                                            <?php
                                            $id = $_GET['id'];
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
                                                    <div class="panel-heading">
                                                        <div class="panel-title">
                                                            <a href="manage-edit-performance.php"
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
                                                                 src="<?php echo htmlentities($result->picture) ?>"
                                                                 width="100" height="100" alt=""
                                                                 onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                                                 onclick="window.open(this.src,'_blank')">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">รหัสประจำตัว</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="id" class="form-control"
                                                                   id="id" readonly="true"
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
                                                            <input id="order_test" name="order_test" class="form-control"
                                                                   value="<?php echo htmlentities($order_test)?>"
                                                                   placeholder="" readonly="true">
                                                        </div>

                                                        <label for="date" class="col-sm-2 control-label">วันที่ทดสอบ</label>
                                                        <!--  สร้าง textbox สำหรับสร้างตัวเลือก ปฎิทิน โดยมี id มีค่าเป็น my_date  -->
                                                        <div class="col-sm-4">
                                                            <input id="date_test" name="date_test" class="form-control"
                                                                   value="<?php echo htmlentities($result->date_test) ?>"
                                                                   placeholder="วัน/เดือน/ปี">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">เปอร์เซ็นต์ไขมัน Body fat Percentage </label>
                                                        <div class="col-sm-4">
                                                            <input type="number" name="bfp" class="form-control"
                                                                   value=""
                                                                   id="bfp" autocomplete="off">
                                                        </div>

                                                        <label for="default" class="col-sm-2 control-label">วิ่งเร็ว 50 เมตร (50MeterSprint)</label>

                                                        <div class="col-sm-4">
                                                            <input type="number" name="fms" class="form-control"
                                                                   value=""
                                                                   id="fms" autocomplete="off">
                                                        </div>
                                                    </div>



                                                <?php }
                                            } ?>
                                            <div class="form-group has-success">

                                                <div class="">
                                                    <button type="submit" name="update"
                                                            class="btn btn-success btn-labeled">Update<span
                                                            class="btn-label btn-label-right"><i
                                                                class="fa fa-check"></i></span></button>
                                                </div>

                                            </div>


                                        </form>


                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-8 col-md-offset-2 -->
                        </div>
                        <!-- /.row -->


                </div>
                <!-- /.container-fluid -->
                </section>
                <!-- /.section -->

            </div>
            <!-- /.main-page -->


            <!-- /.right-idebar -->

        </div>
        <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->

    </div>
    <!-- /.main-wrapper -->

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="js/prism/prism.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>


    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
    </html>
<?php } ?>
