<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['update'])) {

        $aid = intval($_GET['aid']);
        $password = md5($_POST['password']);

        $sql = "update  admin set Password=:password where id=:aid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':aid', $aid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Password has been updated successfully ";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ARMS Admin Update Accout</title>
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
        <link rel="stylesheet" href="css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>

        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.password.value != document.chngpwd.confirmpassword.value) {
                    alert("กรุณาป้อนรหัสผ่านให้ตรงกัน    Password and Confirm Password Field do not match  !!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>


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
                <!-- /.left-sidebar -->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Reset รหัสผ่านผู้ใช้งานระบบ</h2>
                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="#">Account</a></li>
                                    <li class="active">Reset รหัสผ่านผู้ใช้งานระบบ</li>
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
                                                <h5>Reset รหัสผ่านผู้ใช้งานระบบ</h5>
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

                                        <form name="chngpwd" method="post" \ onSubmit="return valid();">
                                            <?php
                                            $aid = intval($_GET['aid']);
                                            $sql = "SELECT * from admin where id=:aid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>

                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <a href="manage-account.php"
                                                       class="btn btn-info btn-labeled">BACK<span
                                                            class="btn-label btn-label-right"><i
                                                                class="fa fa-check"></i></span></a>
                                                </div>
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">ชื่อผู้ใช้ User
                                                    Name</label>

                                                <div class="">
                                                    <input type="text" name="username" class="form-control"
                                                           value="<?php echo htmlentities($result->UserName); ?>"
                                                           readonly="true" id="username">
                                                </div>
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">ชื่อ First Name</label>

                                                <div class="">
                                                    <input type="text" name="FirstName" class="form-control"
                                                           value="<?php echo htmlentities($result->FirstName); ?>"
                                                           readonly="true" id="FirstName">
                                                </div>
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">นามสกุล Last Name</label>

                                                <div class="">
                                                    <input type="text" name="LastName" class="form-control"
                                                           value="<?php echo htmlentities($result->LastName); ?>"
                                                           readonly="true" id="LastName">
                                                </div>
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">รหัสผ่าน Password</label>

                                                <div class="">
                                                    <input type="password" name="password" class="form-control"
                                                           required="required" id="password">
                                                </div>
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">ยืนยันรหัสผ่าน Confirm
                                                    Password</label>

                                                <div class="">
                                                    <input type="password" name="confirmpassword"
                                                           class="form-control"
                                                           required="required" id="confirmpassword">
                                                </div>
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


            <!-- /.right-sidebar -->

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
