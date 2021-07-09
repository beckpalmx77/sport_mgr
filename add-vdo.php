<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin เพิ่ม Video</title>
        <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>

        <script type="text/javascript">
            window.onload = function () {
                var fm = document.getElementsByTagName('form')[0];
                fm.onsubmit = function (evt) {
                    //① Collect form information FormData
                    var fd = new FormData(this);
                    //② Ajax transfers the form information to the server
                    var xhr = new XMLHttpRequest();

                    //console.log(xhr);
                    //Perceive the attachment upload situation through the xhr.upload.onprogress event, and trigger the onprogress event every 100 milliseconds
                    xhr.upload.onprogress = function (event) {
                        //Perceive the attachment upload situation through the event object event
                        //console.log(event);//output once every 100ms or so
                        //Get the ratio of the uploaded size to the total size
                        var loaded = event.loaded; //The size that has been uploaded
                        var total = event.total; //Total size
                        var per = Math.floor((loaded / total) * 100) + "%"; //Upload percentage
                        //Set the upload percentage to id=son style width width
                        document.getElementById('son').innerHTML = per;
                        document.getElementById('son').style.width = per;
                    }

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4) {
                            alert(xhr.responseText);
                        }
                    }
                    xhr.open('post', './xprocess_upload_file.php');
                    xhr.send(fd);

                    evt.preventDefault(); //Prevent the browser form submission action
                }
            }
        </script>

        <!--script>
            function readPictureURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#video')
                            .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script-->

        <script>
            function readVideoURL(input) {

                const video = document.getElementById('video');
                const videoSource = document.createElement('source');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        videoSource.setAttribute('src', e.target.result);
                        video.appendChild(videoSource);
                        video.load();
                        video.play();
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <style type="text/css">
            #pat {
                width: 450px;
                height: 35px;
                border: 5px solid blue;
            }

            #son {
                width: 0;
                height: 100%;
                background-color: lightblue;
            }
        </style>

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
                <!-- /.left-video_idebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เพิ่ม Video</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>กำหนดระบบ</li>
                                    <li class="active">เพิ่ม Video</li>
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
                                                <h5>เพิ่ม Video</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <a href="manage-video-page.php"
                                                           class="btn btn-info btn-labeled">BACK<span
                                                                    class="btn-label btn-label-right"><i
                                                                        class="fa fa-check"></i></span></a>
                                                    </div>
                                                </div>

                                                <?php
                                                $id = intval($_GET['id']);
                                                $sql = "SELECT * from tblvideo order by id desc limit 1 ";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {

                                                        $video_id = "V-" . sprintf("%09d", $result->id + 1);
                                                    }
                                                } else {

                                                    $video_id = "V-" . sprintf("%09d", 1);
                                                }

                                                ?>

                                                <input type="hidden" name="video_id"
                                                       value="<?php echo htmlentities($video_id) ?>">

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label"></label>
                                                    <div class="col-sm-10">
                                                        <video id="video" width="320" height="240" controls>
                                                        </video>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-2 control-label"></label>
                                                    <div class="col-sm-10">
                                                        <div id="pat">
                                                            <div id="son"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <label for="default"
                                                           class="col-sm-2 control-label">ไฟล์</label>

                                                    <div class="col-sm-10">
                                                        <!--img id="picture" src=""
                                                             width="100" height="100" alt=""
                                                             onmouseover="" onmouseout=""
                                                             onclick=""-->
                                                        <input type='file' name="fileUpload" id="fileUpload"
                                                               accept="video/mp4"
                                                               onchange="readVideoURL(this);"/>
                                                        <label class="custom-file-label" for="chooseFile">เลือกไฟล์
                                                            (ไฟล์ VDO) .mp4 เท่านั้น</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">รายละเอียด
                                                        Video</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" name="filedoc_desc" class="form-control"
                                                               id="filedoc_desc"
                                                               value=""
                                                               required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Link
                                                        ที่เกี่ยวข้อง (URL)</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" name="link"
                                                               class="form-control"
                                                               id="link"
                                                               value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">ประเภท ไฟล์</label>

                                                    <div class="col-sm-10">
                                                        <select id="type_image" name="type_image"
                                                                class="form-control" data-live-search="true"
                                                                title="Please select">
                                                            <option value="V" selected>Video (V)</option>
                                                        </select>
                                                    </div>
                                                </div>


                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-primary">
                                                    Submit
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
