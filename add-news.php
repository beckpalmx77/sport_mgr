<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {

        $news_id = $_POST['news_id'];
        $topic = $_POST['topic'];
        $topic_desc = $_POST['topic_desc'];
        $link = $_POST['link'];
        $doc_date = $_POST['doc_date'];

        $sql = "INSERT INTO  tblnews(news_id,topic,topic_desc,link,doc_date) VALUES(:news_id,:topic,:topic_desc,:link,:doc_date)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':news_id', $news_id, PDO::PARAM_STR);
        $query->bindParam(':topic', $topic, PDO::PARAM_STR);
        $query->bindParam(':topic_desc', $topic_desc, PDO::PARAM_STR);
        $query->bindParam(':link', $link, PDO::PARAM_STR);
        $query->bindParam(':doc_date', $doc_date, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {

            if (strlen($_FILES["fileUpload"]["name"]) > 0) {

                $target_dir = "upload/";

                $temp = explode(".", $_FILES["fileUpload"]["name"]);

                $target_file = $target_dir . strtotime("now") . "-" . round(microtime(true)) . '.' . end($temp);

                $picture = $target_file;

                if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                    $sql = "update tblnews set file_name=:picture where id=:id ";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':picture', $picture, PDO::PARAM_STR);
                    $query->bindParam(':id', $lastInsertId, PDO::PARAM_STR);
                    $query->execute();
                    $success = "Y";
                } else {
                    $success = "N";
                }

                $loop = 1 ;

                while (list($key, $value) = each($_FILES['upload_file']['name'])) {

                    if (!empty($value)) {   // this will check if any blank field is entered
                        $filename = rand(1, 100000) . $value;    // filename stores the value
                        $filename = str_replace(" ", "_", $filename);// Add _ inplace of blank space in file name, you can remove this line
                        $add = "upload/$filename";   // upload directory path is set

                        copy($_FILES['upload_file']['tmp_name'][$key], $add);

                        $sql2 = "update tblnews set file_" . $loop . " =:filesave  where id=:id ";
                        $query2 = $dbh->prepare($sql2);
                        $query2->bindParam(':filesave', $add, PDO::PARAM_STR);
                        $query2->bindParam(':id', $lastInsertId, PDO::PARAM_STR);
                        $query2->execute();
                        $sql21 = $sql21 . " | " . $sql2 ;
                    }
                        $loop++;
                }

            }

            $msg = "เพิ่มข้อมูลเรียบร้อยแล้ว info added successfully" ;

        } else {

            $error = "Something went wrong. Please try again " ;

        }

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ARMS Admin เพิ่ม ประกาศ/ข่าวสาร</title>
        <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
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
                <!-- /.left-news_idebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เพิ่ม ประกาศ/ข่าวสาร</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>กำหนดระบบ</li>
                                    <li class="active">เพิ่ม ประกาศ/ข่าวสาร</li>
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
                                            <h5>เพิ่ม ประกาศ/ข่าวสาร</h5>
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
                                                    <a href="manage-news-page.php"
                                                       class="btn btn-info btn-labeled">BACK<span
                                                            class="btn-label btn-label-right"><i
                                                                class="fa fa-check"></i></span></a>
                                                </div>
                                            </div>

                                            <?php
                                            $id = intval($_GET['id']);
                                            $sql = "SELECT * from tblnews order by id desc limit 1 ";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {

                                                    $news_id = "N-" . sprintf("%09d", $result->id + 1);
                                                }
                                            } else {

                                                $news_id = "N-" . sprintf("%09d", 1);
                                            }

                                            ?>

                                            <input type="hidden" name="news_id"
                                                   value="<?php echo htmlentities($news_id) ?>">


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
                                                           accept="image/png, image/jpeg ,.pdf"
                                                           onchange="readURL(this);"/>
                                                    <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                        (ไฟล์ .jpg , .png เท่านั้น)</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">หัวข้อ
                                                    ประกาศ/ข่าวสาร</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="topic" class="form-control"
                                                           id="topic"
                                                           value=""
                                                           required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">รายละเอียด
                                                    ประกาศ/ข่าวสาร</label>

                                                <div class="col-sm-10">
                                                    <textarea rows="4" cols="50" name="topic_desc" class="form-control"
                                                              id="topic_desc" value="" required="required"
                                                              autocomplete="off"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Link URL
                                                    ที่เกี่ยวข้อง</label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="link" class="form-control"
                                                           id="link"
                                                           value="" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">แนบไฟล์เอกสาร
                                                    รูปภาพ PNG , JPG , PDF,WORD</label>
                                                    <?php
                                                    echo "<div class='col-sm-10'>";
                                                    $max_no_img=5; // Maximum number of images value to be set here
                                                    for($i=1; $i<=$max_no_img; $i++){
                                                        echo "<input type=file name='upload_file[]' class='bginput' accept='.doc,.docx,.pdf,.jpg,.png'>";
                                                    }
                                                    echo "</div>";
                                                    ?>

                                            </div>

                                            <div class="form-group">
                                                <label for="date" class="col-sm-2 control-label">วันที่ประกาศ</label>
                                                <!--  สร้าง textbox สำหรับสร้างตัวเลือก ปฎิทิน โดยมี id มีค่าเป็น my_date  -->
                                                <div class="col-sm-4">
                                                    <input id="doc_date" name="doc_date" class="form-control"
                                                           required="required"
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
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/datepicker-thai/datepicker-lib.js"></script>
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
            picker_date(document.getElementById("doc_date"), {year_range: "-100:+1000"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
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
