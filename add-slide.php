<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {

        $ext_chk = array("png", "jpg");
        if (!in_array(strtolower(substr(strrchr($_FILES["fileUpload"]["name"], '.'), 1)), $ext_chk)) {
            $ext_msg = "ไฟล์ต้องเป็น PNG , JPG เท่านั้น";
        } else {

            $slide_id = $_POST['slide_id'];
            $filedoc_desc = $_POST['filedoc_desc'];
            $sql = "INSERT INTO  tblslide(slide_id,filedoc_desc) VALUES(:slide_id,:filedoc_desc)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':slide_id', $slide_id, PDO::PARAM_STR);
            $query->bindParam(':filedoc_desc', $filedoc_desc, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {

                if (strlen($_FILES["fileUpload"]["name"]) > 0) {

                    $target_dir = "images/slide/";

                    $temp = explode(".", $_FILES["fileUpload"]["name"]);

                    $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

                    $picture = $target_file;

                    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                        $sql = "update tblslide set file_name=:picture where id=:id ";
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
                $error = "Something went wrong. Please try again " ;
            }

        }
        $error = "Something went wrong. Please try again " . $ext_msg;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin เพิ่ม สไลด์ / ประกาศ</title>
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
                <!-- /.left-slide_idebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เพิ่ม สไลด์ / ประกาศ</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>กำหนดระบบ</li>
                                    <li class="active">เพิ่ม สไลด์ / ประกาศ</li>
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
                                            <h5>เพิ่ม สไลด์ / ประกาศ</h5>
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
                                                    <a href="manage-slide-page.php"
                                                       class="btn btn-info btn-labeled">BACK<span
                                                            class="btn-label btn-label-right"><i
                                                                class="fa fa-check"></i></span></a>
                                                </div>
                                            </div>

                                            <?php
                                            $id = intval($_GET['id']);
                                            $sql = "SELECT * from tblslide order by id desc limit 1 ";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {

                                                    $slide_id = "S-" . sprintf("%09d", $result->id + 1);
                                                }
                                            } else {

                                                $slide_id = "S-" . sprintf("%09d", 1);
                                            }

                                            ?>

                                            <input type="hidden" name="slide_id"
                                                   value="<?php echo htmlentities($slide_id) ?>">


                                            <div class="form-group">
                                                <label for="default"
                                                       class="col-sm-2 control-label">รูปภาพ</label>

                                                <div class="col-sm-10">
                                                    <img id="picture" src=""
                                                         width="100" height="100" alt=""
                                                         onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                                         onclick="window.open(this.src,'_blank')">
                                                    <input type='file' name="fileUpload" id="fileUpload"
                                                           accept="image/*"
                                                           accept="image/png, image/jpeg" onchange="readURL(this);"/>
                                                    <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                        (ไฟล์ .jpg หรือ .png เท่านั้น)(Click
                                                        ที่รูปเพื่อขยาย)</label>
                                                    <label class="custom-file-label" for="chooseFile">ขนาดไฟล์ภาพ 1600 x
                                                        430 Pixel</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">รายละเอียด
                                                    สไลด์ / ประกาศ</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="filedoc_desc" class="form-control"
                                                           id="filedoc_desc"
                                                           value=""
                                                           required="required" autocomplete="off">
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
