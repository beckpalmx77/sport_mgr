<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $equipment_id = $_POST['equipment_id'];
        $equipment_name = $_POST['equipment_name'];
        $equipment_no = $_POST['equipment_no'];
        $quantity = $_POST['quantity'];
        $doc_date_from = $_POST['doc_date_from'];

        $sql = "INSERT INTO  tblsport_equipment(equipment_id,equipment_name,equipment_no,quantity,doc_date_from)
                VALUES(:equipment_id,:equipment_name,:equipment_no,:quantity,:doc_date_from)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':equipment_id', $equipment_id, PDO::PARAM_STR);
        $query->bindParam(':equipment_name', $equipment_name, PDO::PARAM_STR);
        $query->bindParam(':equipment_no', $equipment_no, PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $query->bindParam(':doc_date_from', $doc_date_from, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {

            if (strlen($_FILES["fileUpload"]["name"]) > 0) {

                $target_dir = "images/equipment/";

                $temp = explode(".", $_FILES["fileUpload"]["name"]);

                $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

                $picture = $target_file;

                if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                    $sql = "update tblsport_equipment set picture=:picture where id=:id ";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':picture', $picture, PDO::PARAM_STR);
                    $query->bindParam(':id', $lastInsertId, PDO::PARAM_STR);
                    $query->execute();
                    $success = "Y";
                } else {
                    $success = "N";
                }
            }

            $msg = "เพิ่มข้อมูลเรียบร้อยแล้ว info added successfully" . $ext_msg;

        } else {
            $error = "Something went wrong. Please try again " . $ext_msg;
        }

    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin Create Class</title>
        <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
        <link rel="stylesheet" href="css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>

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

    </head>
    <body class="top-navbar-fixed">

    <div class="main-wrapper">

        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-equipment_idebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เพิ่ม อุปกรณ์กีฬา</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>ทะเบียนหลัก</li>
                                    <li class="active">เพิ่ม อุปกรณ์กีฬา</li>
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
                                            <h5>เพิ่ม อุปกรณ์กีฬา</h5>
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
                                                    <a href="manage-sport-equipment.php"
                                                       class="btn btn-info btn-labeled">BACK<span
                                                            class="btn-label btn-label-right"><i
                                                                class="fa fa-check"></i></span></a>
                                                </div>
                                            </div>

                                            <?php
                                            $id = intval($_GET['id']);
                                            $sql = "SELECT * from tblsport_equipment order by id desc limit 1 ";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {

                                                    $equipment_id = "EQ-" . sprintf("%09d", $result->id + 1);
                                                }
                                            } else {

                                                $equipment_id = "EQ-" . sprintf("%09d", 1);
                                            }

                                            ?>

                                            <input type="hidden" name="equipment_id"
                                                   value="<?php echo htmlentities($equipment_id) ?>">


                                            <div class="form-group">
                                                <label for="default"
                                                       class="col-sm-2 control-label">รูปภาพ</label>

                                                <div class="col-sm-10">
                                                    <img id="picture" src=""
                                                         width="100" height="100" alt=""
                                                         onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                                         onclick="window.open(this.src,'_blank')">
                                                    <input type='file' name="fileUpload" id="fileUpload"
                                                           multiple="multiple"
                                                           accept="image/png, image/jpeg"
                                                           onchange="readURL(this);"/>
                                                    <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                        (ไฟล์ .jpg , .png เท่านั้น)</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">
                                                    ชื่ออุปกรณ์กีฬา</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="equipment_name" class="form-control"
                                                           id="equipment_name"
                                                           value=""
                                                           required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">สถานที่ที่จัดเก็บ
                                                </label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="place" class="form-control"
                                                           id="place"
                                                           value=""
                                                           required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">จำนวน</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="quantity" class="form-control"
                                                           id="quantity"
                                                           value=""
                                                           required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default"
                                                       class="col-sm-2 control-label">หมายเลขอุปกรณ์</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="equipment_no" class="form-control"
                                                           id="equipment_no"
                                                           value=""
                                                           required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="date"
                                                       class="col-sm-2 control-label">วันที่ลงทะเบียนอุปกรณื</label>

                                                <div class="col-sm-4">
                                                    <input id="doc_date_from" name="doc_date_from" class="form-control"
                                                           placeholder="วัน/เดือน/ปี" readonly="true">
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

        <script src="js/datepicker-thai/datepicker-lib.js"></script>

        <script>
            //กำหนดให้ textbox ที่มี id เท่ากับ my_date เป็นตัวเลือกแบบ ปฎิทิน
            picker_date(document.getElementById("doc_date_from"), {year_range: "-100:+1000"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
        </script>


        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
    </html>
<?php } ?>
