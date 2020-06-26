<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $account_type = $_POST['account_type'];
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        if ($account_type=="root") {
            $picture = "images/icon/admin-001.png";
        } else {
            $picture = "images/icon/user-001.png";
        }

        $sql = "SELECT UserName FROM admin WHERE UserName=:username ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $error = "มีชื่อ Account นี้อยู่แล้วในระบบ Something went wrong. Please try again !";
        } else {

            $sql = "INSERT INTO  admin(UserName,Password,FirstName,LastName,account_type,picture) VALUES(:username,:password,:FirstName,:LastName,:account_type,:picture)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':FirstName', $FirstName, PDO::PARAM_STR);
            $query->bindParam(':LastName', $LastName, PDO::PARAM_STR);
            $query->bindParam(':account_type', $account_type, PDO::PARAM_STR);
            $query->bindParam(':picture', $picture, PDO::PARAM_STR);
            $query->execute();

            $sql = "SELECT UserName FROM admin WHERE UserName=:username ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                $msg = " สร้าง User Account เรียบร้อย Created successfully";
            } else {
                $error = "สร้าง User Account ไม่สำเร็จ กรุณาตรวจสอบ Something went wrong. Please try again !";
            }

        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>สร้างบัญชีผู้ใช้งานระบบ Create Accout</title>
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
        <link rel="stylesheet" href="css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen">

        <script src="js/modernizr/modernizr.min.js"></script>
        <script src="js/bootstrap-select/bootstrap-select.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-sidebar -->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">เพิ่มผู้ใช้งานระบบ</h2>
                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">เพิ่มผู้ใช้งานระบบ</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                    <account_type class="account_type">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>เพิ่มผู้ใช้งานระบบ</h5>
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

                                        <div class="panel-body">

                                            <form name="chngpwd" method="post" \ onSubmit="return valid();">

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">ชื่อผู้ใช้ User
                                                        Name</label>

                                                    <div class="">
                                                        <input type="text" name="username" class="form-control"
                                                               required="required" id="username">
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">ชื่อ First Name</label>
                                                    <div class="">
                                                        <input type="text" name="FirstName" class="form-control"
                                                               required="required" id="FirstName">
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">นามสกุล Last Name</label>
                                                    <div class="">
                                                        <input type="text" name="LastName" class="form-control"
                                                               required="required" id="LastName">
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

                                                <div class="form-group has-success">
                                                    <label class="control-label" for="select-testing">ประเภทผู้ใช้
                                                        Account Type (root = สิทธิ์จัดการระบบ , user สิทธิ์ผู้ใช้งานระบบ)</label>

                                                    <div class=”form-group”>
                                                        <select id="account_type" name="account_type"
                                                                class="form-control" data-live-search="true"
                                                                title="Please select">
                                                            <option>user</option>
                                                            <option>root</option>
                                                        </select>
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>


                                                <div class="form-group has-success">

                                                    <div class="">
                                                        <button type="submit" name="submit"
                                                                class="btn btn-success btn-labeled">Save<span
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
                    </account_type>
                    <!-- /.account_type -->

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
    </body>
    </html>
<?php } ?>
