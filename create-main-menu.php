<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {

        $main_menu_id = $_POST['main_menu_id'];
        $label = $_POST['label'];
        $label_en = $_POST['label_en'];
        $link = $_POST['link'];
        $icon = $_POST['icon'];
        $sort = $_POST['sort'];
        $privilege = $_POST['privilege'];

        $sql = "INSERT INTO  menu_main(main_menu_id,label,label_en,link,icon,sort,privilege) VALUES(:main_menu_id,:label,:label_en,:link,:icon,:sort,:privilege)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':main_menu_id', $main_menu_id, PDO::PARAM_STR);
        $query->bindParam(':label', $label, PDO::PARAM_STR);
        $query->bindParam(':label_en', $label_en, PDO::PARAM_STR);
        $query->bindParam(':link', $link, PDO::PARAM_STR);
        $query->bindParam(':icon', $icon, PDO::PARAM_STR);
        $query->bindParam(':sort', $sort, PDO::PARAM_STR);
        $query->bindParam(':privilege', $privilege, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Class Main Menu successfully";
        } else {
            $error = "Something went wrong. Please try again";
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
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
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

        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-----End Top bar>
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
                                <h2 class="title">Create Main Menu</h2>
                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="#">กำหนดระบบ</a></li>
                                    <li class="active">Create Main Menu</li>
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
                                                <h5>Create Main Menu</h5>
                                            </div>
                                        </div>

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <a href="manage-menu-main.php"
                                                   class="btn btn-info btn-labeled">BACK<span
                                                        class="btn-label btn-label-right"><i
                                                            class="fa fa-check"></i></span></a>
                                            </div>
                                        </div>

                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>ดำเนินการสำเร็จ :  </strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="panel-body">

                                            <form method="post">
                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">Main Menu ID</label>
                                                    <?php
                                                    $sql = "SELECT * from menu_main order by id desc limit 1 ";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {
                                                        }
                                                        $sort = $result->sort + 1;
                                                        $formatted_str = sprintf("%03d", $result->sort + 1);

                                                    } else {
                                                        $sort = 1;
                                                        $formatted_str = "001";
                                                    }

                                                    $formatted_str = "M" . $formatted_str;
                                                    ?>
                                                    <input type="hidden" name="sort" id="sort" value="<?php echo $sort ?>">

                                                    <div class="">
                                                        <input type="text" name="main_menu_id" class="form-control"
                                                               value="<?php echo $formatted_str ?>"
                                                               readonly="true"
                                                               required="required" id="main_menu_id">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">ชื่อเมนู ภาษาไทย / THAI MENU NAME</label>

                                                    <div class="">
                                                        <input type="text" name="label" class="form-control"
                                                               required="required" id="label">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">ชื่อเมนู ภาษาอังกฤษ  / ENGLISH MENU NAME</label>

                                                    <div class="">
                                                        <input type="text" name="label_en" class="form-control"
                                                               required="required" id="label_en">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">Link</label>

                                                    <div class="">
                                                        <input type="text" name="link" class="form-control"
                                                               required="required" id="link">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">Icon</label>

                                                    <div class="">
                                                        <input type="text" name="icon" class="form-control"
                                                               required="required" id="icon">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label class="control-label" for="select-testing">ประเภทผู้ใช้
                                                        Account Type (2 = user ทุกคน , 1 = root
                                                        สิทธิ์ผู้แก้ไขระบบ)</label>

                                                    <div class=”form-group”>
                                                        <select id="privilege" name="privilege"
                                                                class="form-control" data-live-search="true"
                                                                title="Please select">
                                                            <option>2</option>
                                                            <option>1</option>
                                                        </select>
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>

                                                <div class="form-group has-success">
                                                    <div class="">
                                                        <button type="submit" name="submit"
                                                                class="btn btn-success btn-labeled">Submit<span
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
