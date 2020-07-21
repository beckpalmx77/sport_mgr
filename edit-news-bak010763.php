<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('myfw/preview_icon.php');

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {

        /*
        $ext_chk = array("png", "jpg", "pdf");
        if (!in_array(strtolower(substr(strrchr($_FILES["fileUpload"]["name"], '.'), 1)), $ext_chk)) {
            $ext_msg = "ไฟล์ต้องเป็น PNG , JPG , PDF เท่านั้น";
        } else {
*/

        $topic = $_POST['topic'];
        //$topic_desc = $mysqli -> real_escape_string($_POST['$topic_desc']);
        $topic_desc = $_POST['topic_desc'];
        $link = $_POST['link'];
        $doc_date = $_POST['doc_date'];

        $sql = "update tblnews set topic=:topic,topic_desc=:topic_desc,link=:link,doc_date=:doc_date where id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':topic', $topic, PDO::PARAM_STR);
        $query->bindParam(':topic_desc', $topic_desc, PDO::PARAM_STR);
        $query->bindParam(':link', $link, PDO::PARAM_STR);
        $query->bindParam(':doc_date', $doc_date, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        if (strlen($_FILES["fileUpload"]["name"]) > 0) {

            $target_dir = "upload/";

            $temp = explode(".", $_FILES["fileUpload"]["name"]);

            $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

            $picture = $target_file;

            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $sql = "update tblnews set file_name=:picture where id=:id ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':picture', $picture, PDO::PARAM_STR);
                $query->bindParam(':id', $id, PDO::PARAM_STR);
                $query->execute();
                $success = "Y";
            } else {
                $success = "N";
            }

        }


        $loop = 1;

        while (list($key, $value) = each($_FILES['upload_file']['name'])) {

            if (!empty($value)) {   // this will check if any blank field is entered
                $filename = rand(1, 100000) . $value;    // filename stores the value
                $filename = str_replace(" ", "_", $filename);// Add _ inplace of blank space in file name, you can remove this line
                $add = "upload/$filename";   // upload directory path is set

                copy($_FILES['upload_file']['tmp_name'][$key], $add);

                $sql2 = "update tblnews set file_" . $loop . " = '" . $target_dir . $filename . "'  where id=:id ";
                $query2 = $dbh->prepare($sql2);
                $query2->bindParam(':id', $id, PDO::PARAM_STR);
                $query2->execute();
                $sql21 = $sql21 . " # " . $sql2;
            }

            $loop++;

        }

        $msg = "ปรับปรุงข้อมูลเรียบร้อยแล้ว Update info successfully = ";
        /*
                }

                $error = "Something went wrong. Please try again " . $ext_msg;
        */

    }


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin ปรับปรุง ประกาศ/ข่าวสาร</title>
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
        <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
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
                                <h2 class="title">ปรับปรุง ประกาศ/ข่าวสาร</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>กำหนดระบบ</li>
                                    <li class="active">ปรับปรุง ประกาศ/ข่าวสาร</li>
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
                                            <h5>ปรับปรุง ประกาศ/ข่าวสาร</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>ดำเนินการสำเร็จ :  </strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <a href="manage-news-page.php"
                                                       class="btn btn-info btn-labeled">BACK<span
                                                            class="btn-label btn-label-right"><i
                                                                class="fa fa-check"></i></span></a>
                                                </div>
                                            </div>

                                            <?php

                                            $sql = "SELECT * from tblnews where id=:id";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>


                                                    <?php
                                                    if (file_exists($result->file_name)) {
                                                        $file = $result->file_name;
                                                    } else {
                                                        $file = "images/Document-icon.png";
                                                    }
                                                    ?>

                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">รูปภาพ/ไฟล์ pdf</label>

                                                        <div class="col-sm-10">
                                                            <img id="picture" src="<?php echo htmlentities($file) ?>"
                                                                 width="100" height="100" alt=""
                                                                 onmouseover="bigImg(this)" onmouseout="normalImg(this)"
                                                                 onclick="window.open(this.src,'_blank')">
                                                            <input type='file' name="fileUpload" id="fileUpload"
                                                                   multiple="multiple"
                                                                   accept="image/png, image/jpeg ,.pdf"
                                                                   onchange="readURL(this);"/>
                                                            <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                                (ไฟล์ .jpg , .png , .pdf เท่านั้น)</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">หัวข้อ
                                                            ประกาศ/ข่าวสาร</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="topic" class="form-control"
                                                                   id="topic"
                                                                   value="<?php echo htmlentities($result->topic) ?>"
                                                                   required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">รายละเอียด
                                                            ประกาศ/ข่าวสาร</label>

                                                        <div class="col-sm-10">
                                                    <textarea rows="4" cols="50" name="topic_desc" class="form-control"
                                                              id="topic_desc" required="required"
                                                              autocomplete="off"><?php echo $result->topic_desc ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Link URL
                                                            ที่เกี่ยวข้อง</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" name="link" class="form-control"
                                                                   id="link"
                                                                   value="<?php echo htmlentities($result->link) ?>"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <?PHP

                                                    $max = 5;

                                                    for ($i = 1; $i <= $max; $i++) {

                                                        ${"file_" . $i} = $result->{"file_" . $i};

                                                        //echo ${"file_" . $i};

                                                        if (${"file_" . $i} != "") { ?>
                                                            <a href="<?php echo htmlentities(${"file_" . $i}) ?>"
                                                               target="_blank">CLICK ดูรายละเอียด ไฟล์ที่ <?php echo $i ?><img
                                                                    src="<?php echo GetIconPNG(${"file_" . $i}) ?>"
                                                                    width="30" height="30"></a>
                                                            <?php
                                                            echo "<br><br>";
                                                        }
                                                    }
                                                    ?>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">ไฟล์เอกสาร
                                                            รูปภาพ PNG , JPG , PDF,WORD</label>


                                                        <div class='col-sm-10'>
                                                            <div class="menu">

                                                                <?php if ($result->file_1 != "") { ?>
                                                                    <a href="<?php echo htmlentities($result->file_1) ?>"
                                                                       target="_blank">CLICK ดูรายละเอียด ไฟล์ที่ 1 <img
                                                                            src="<?php echo GetIconPNG($result->file_1) ?>"
                                                                            width="30" height="30"></a>
                                                                    <?php
                                                                    echo "<br><br>";
                                                                }
                                                                ?>

                                                                <?php if ($result->file_2 != "") { ?>
                                                                    <a href="<?php echo htmlentities($result->file_2) ?>"
                                                                       target="_blank">CLICK ดูรายละเอียด ไฟล์ที่ 2 <img
                                                                            src="<?php echo GetIconPNG($result->file_2) ?>"
                                                                            width="30" height="30"></a>
                                                                    <?php
                                                                    echo "<br><br>";
                                                                }
                                                                ?>

                                                                <?php if ($result->file_3 != "") { ?>
                                                                    <a href="<?php echo htmlentities($result->file_3) ?>"
                                                                       target="_blank">CLICK ดูรายละเอียด ไฟล์ที่ 3 <img
                                                                            src="<?php echo GetIconPNG($result->file_3) ?>"
                                                                            width="30" height="30"></a>
                                                                    <?php
                                                                    echo "<br><br>";
                                                                }
                                                                ?>

                                                                <?php if ($result->file_4 != "") { ?>
                                                                    <a href="<?php echo htmlentities($result->file_4) ?>"
                                                                       target="_blank">CLICK ดูรายละเอียด ไฟล์ที่ 4 <img
                                                                            src="<?php echo GetIconPNG($result->file_4) ?>"
                                                                            width="40" height="40"></a>
                                                                    <?php
                                                                    echo "<br><br>";
                                                                }
                                                                ?>

                                                                <?php if ($result->file_5 != "") { ?>
                                                                    <a href="<?php echo htmlentities($result->file_5) ?>"
                                                                       target="_blank">CLICK ดูรายละเอียด ไฟล์ที่ 5 <img
                                                                            src="<?php echo GetIconPNG($result->file_5) ?>"
                                                                            width="30" height="30"></a>
                                                                <?php }
                                                                ?>
                                                                <!--
                                                                <a href="<?php echo htmlentities($result->file_3) ?>" target="_blank"><?php if ($result->file_3 != "") echo "CLICK ดูรายละเอียด ไฟล์ที่ 3 "; ?><img src="<?php echo GetIconPNG($result->file_3) ?>"  width="30" height="30"></a>
                                                                <br><br>
                                                                <a href="<?php echo htmlentities($result->file_4) ?>" target="_blank"><?php if ($result->file_4 != "") echo "CLICK ดูรายละเอียด ไฟล์ที่ 4 "; ?><img src="<?php echo GetIconPNG($result->file_4) ?>"  width="30" height="30"></a>
                                                                <br><br>
                                                                <a href="<?php echo htmlentities($result->file_5) ?>" target="_blank"><?php if ($result->file_5 != "") echo "CLICK ดูรายละเอียด ไฟล์ที่ 5 "; ?><img src="<?php echo GetIconPNG($result->file_5) ?>"  width="30" height="30"></a>
-->
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">แนบไฟล์เอกสาร
                                                            รูปภาพ PNG , JPG , PDF,WORD</label>
                                                        <?php
                                                        echo "<div class='col-sm-10'>";
                                                        $max_no_img = 5; // Maximum number of images value to be set here
                                                        for ($i = 1; $i <= $max_no_img; $i++) {
                                                            echo "ไฟล์ที่ " . $i;
                                                            echo "<input type=file name='upload_file[]' class='bginput' accept='.doc,.docx,.pdf,.jpg,.png'>";
                                                        }
                                                        echo "</div>";
                                                        ?>

                                                    </div>


                                                    <div class="form-group">
                                                        <label for="date"
                                                               class="col-sm-2 control-label">วันที่ประกาศ</label>
                                                        <!--  สร้าง textbox สำหรับสร้างตัวเลือก ปฎิทิน โดยมี id มีค่าเป็น my_date  -->
                                                        <div class="col-sm-4">
                                                            <input id="doc_date" name="doc_date" class="form-control"
                                                                   required="required"
                                                                   value="<?php echo htmlentities($result->doc_date) ?>"
                                                                   placeholder="วัน/เดือน/ปี" readonly="true">
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            }

                                            ?>

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


        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            //CKEDITOR.replace('topic_desc');
            //function CKupdate() {
            //for (instance in CKEDITOR.instances)
            //CKEDITOR.instances[instance].updateElement();
            //}

            CKEDITOR.replace('topic_desc', {
                //filebrowserUploadUrl: 'ckeditor/ck_upload.php',
                filebrowserUploadUrl: 'myfw/ck_uploads.php',
                filebrowserUploadMethod: 'form'
            });

        </script>

    </body>
    </html>
<?PHP } ?>
