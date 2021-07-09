<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_GET['lang_value'])) {
        if (isset($_GET['lang_value'])) {
            $lang = $_GET['lang_value']=="" ? "th" : $_GET['lang_value'] ;
            $username = $_SESSION['alogin'];
            $sql = "update tbluser_account  set lang=:lang where UserName=:username";
            $query = $dbh->prepare($sql);
            $query->bindParam(':lang', $lang, PDO::PARAM_STR);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->execute();

            if ($query->execute() == 1) {
                $msg = "Your Languague succesfully changed | " . $lang . " | " . $username . " | " .  $_SESSION['lang'];
                unset($_SESSION['login']);
                session_destroy();
                header("location:index-main.php");
            }

        } else {
            $error = "wrong";
        }
    }


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Change Language</title>
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
    </head>
    <body class="top-navbar-fixed">
    <div class="main-wrapper">
        <?php include('includes/topbar.php'); ?>
        <div class="content-wrapper">
            <div class="content-container">
                <!--?php include('includes/leftbar.php'); ?-->
                <!-- /.left-sidebar -->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เปลี่ยนภาษา Change Language</h2>
                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">เปลี่ยนภาษา Change Language</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                    <section class="section">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>เปลี่ยนภาษา Change Language</h5>
                                            </div>
                                        </div>
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>ดำเนินการสำเร็จ :  </strong><?php echo $msg ;?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="panel-body">

                                            <form name="changelanguage" method="post">

                                                <div class="form-group">
                                                    <label for="default"
                                                           class="col-sm-4 control-label">เลือกภาษา/Select
                                                        Language</label>

                                                    <div class="col-sm-4">
                                                        <select id="lang" name="lang"
                                                                class="form-control" data-live-search="true"
                                                                title="Please select">
                                                            <option value="<?php echo $_SESSION['lang'] ?>"
                                                                    selected><?php echo $_SESSION['lang'] == "th" ? "ภาษาไทย/THAI" : "ภาษาอังกฤษ/ENGLISH"; ?></option>
                                                            <option value="th">ภาษาไทย/THAI</option>
                                                            <option value="en">ภาษาอังกฤษ/ENGLISH</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">

                                                    <!--div class="">
                                                        <button type="submit" name="submit"
                                                                class="btn btn-success btn-labeled">Change<span
                                                                class="btn-label btn-label-right"><i
                                                                    class="fa fa-check"></i></span></button>
                                                    </div-->
                                                    <button type="button" class="btn btn-primary" id="MySubmit1" onclick="SaveData(document.getElementById('lang').value);">เปลี่ยน - Change</button>
                                                    <br>
                                                    <div class="">
                                                        <p style="color:red">เมื่อเปลี่ยนภาษาจะต้องเข้าระบบใหม่อีกครั้ง / Log In Again After Change Language</P>
                                                        <p style="color:blue"><?php if (DB_NAME === "sport_mgr_dbs") { echo "[PRODUCTION]";} else { echo "[TEST]";}   ?></P>

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

    <script type="text/javascript">
        function SaveData(lang_value) {

            var newLine = "\r\n";
            var message_th = " เมื่อเปลี่ยนภาษาจะต้องเข้าระบบใหม่อีกครั้ง";
            var message_en = "LogIn Again After Change Language";

            alertify.confirm("Confirm Change Language ?" , "ต้องการเปลี่ยนภาษา " + lang_value + message_th + newLine + message_en ,
                function () {
                    window.location.href = 'change-language.php?lang_value=' + lang_value;
                }
                , function () {
                    alertify.error('Cancel - ยกเลิก')
                });

        }
    </script>

    </body>
    </html>

<?php } ?>
