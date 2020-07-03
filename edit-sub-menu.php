<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['update'])) {
        $sid = $_POST['sid'];
        $main_menu_id = $_POST['main_menu_id'];
        $sub_menu_id = $_POST['sub_menu_id'];
        $label = $_POST['label'];
        $link = $_POST['link'];
        $icon = $_POST['icon'];
        $sort = $_POST['sort'];
        $privilege = $_POST['privilege'];

        $value = $sid . "|" . $main_menu_id . "|" . $sub_menu_id . "|" . $label  ;

        $sql = "update  menu_sub set main_menu_id=:main_menu_id,sub_menu_id=:sub_menu_id,label=:label,link=:link
            ,icon=:icon,sort=:sort,privilege=:privilege
            where id=:sid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':main_menu_id', $main_menu_id, PDO::PARAM_STR);
        $query->bindParam(':sub_menu_id', $sub_menu_id, PDO::PARAM_STR);
        $query->bindParam(':label', $label, PDO::PARAM_STR);
        $query->bindParam(':link', $link, PDO::PARAM_STR);
        $query->bindParam(':icon', $icon, PDO::PARAM_STR);
        $query->bindParam(':sort', $sort, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':privilege', $privilege, PDO::PARAM_STR);
        $query->execute();

        //$msg = "Data has been updated successfully" . $sql . " | " . $value ;
        $msg = "Data has been updated successfully";
    }
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin ปรับปรุง Class</title>
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
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-sidebar -->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">ปรับปรุง หน้าจอระบบ</h2>
                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="#">กำหนดระบบ</a></li>
                                    <li class="active">ปรับปรุง หน้าจอระบบ</li>
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
                                                <h5>ปรับปรุง หน้าจอระบบ</h5>
                                            </div>
                                        </div>

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <a href="manage-menu-sub.php"
                                                   class="btn btn-info btn-labeled">BACK<span
                                                        class="btn-label btn-label-right"><i
                                                            class="fa fa-check"></i></span></a>
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

                                            <form method="post">

                                                <?php
                                                $sid = intval($_GET['sid']);
                                                $sql = "SELECT menu_sub.*,menu_main.label as label_main
                                                        from menu_sub left join menu_main on menu_main.main_menu_id=menu_sub.main_menu_id
                                                        where menu_sub.id=:sid";

                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>

                                                <input type="hidden" name="sid" id="sid"
                                                       value="<?php echo htmlentities($result->id); ?>">

                                                <input type="hidden" name="sort" id="sort"
                                                       value="<?php echo htmlentities($result->sort); ?>">

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">หน้าจอระบบ ID</label>

                                                    <div class="">
                                                        <select name="main_menu_id" class="form-control"
                                                                id="main_menu_id" required="required">
                                                            <option
                                                                value="<?php echo htmlentities($result->main_menu_id); ?>"><?php echo htmlentities($result->label_main); ?></option>
                                                            <?php $sql1 = "SELECT * from menu_main order by sort";
                                                                $query1 = $dbh->prepare($sql1);
                                                                $query1->execute();
                                                                $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                                if ($query1->rowCount() > 0) {
                                                                foreach ($results1 as $result1) { ?>
                                                                    <option
                                                                        value="<?php echo htmlentities($result1->main_menu_id); ?>
                                                            "><?php echo htmlentities($result1->label); ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>

                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">รหัสหน้าจอ</label>

                                                        <div class="">
                                                            <input type="text" name="sub_menu_id" class="form-control"
                                                                   value="<?php echo htmlentities($result->sub_menu_id); ?>"
                                                                   required="required" id="sub_menu_id">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">ชื่อเมนู</label>

                                                        <div class="">
                                                            <input type="text" name="label" class="form-control"
                                                                   value="<?php echo htmlentities($result->label); ?>"
                                                                   required="required" id="label">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Link</label>

                                                        <div class="">
                                                            <input type="text" name="link" class="form-control"
                                                                   value="<?php echo htmlentities($result->link); ?>"
                                                                   required="required" id="link">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Icon</label>

                                                        <div class="">
                                                            <input type="text" name="icon" class="form-control"
                                                                   value="<?php echo htmlentities($result->icon); ?>"
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
                                                                <option
                                                                    value="<?php echo htmlentities($result->privilege); ?>"
                                                                    selected><?php echo htmlentities($result->privilege); ?></option>
                                                                <option>2</option>
                                                                <option>1</option>
                                                            </select>
                                                        </div>
                                                        <span class="help-block"></span>
                                                    </div>

                                                    <div class="form-group has-success">
                                                        <div class="">
                                                            <button type="submit" name="update"
                                                                    class="btn btn-success btn-labeled">Update<span
                                                                    class="btn-label btn-label-right"><i
                                                                        class="fa fa-check"></i></span></button>
                                                        </div>
                                                        <?php }
                                                        } ?>

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

    <!--script>
        $('#main_menu_id').change(function () {
            //alert('The option with value ' + $(this).val() + ' and text ' + $(this).text() + ' was selected.');
            alert('The option with value ' + $(this).val());
            var mid = $(this).val();
            alert("<!--?php echo GetSubMenuID($dbh,mid)?-->");

    });
    <!--/script-->

    <script>

        $(document).ready(function () {
            $('#main_menu_id').change(function () {
                //Selected value
                var inputValue = $(this).val();
                //alert("value in js " + inputValue);

                //Ajax for calling php function
                $.post('myfw/myquery.php', {dropdownValue: inputValue}, function (data) {
                    //alert('ajax completed. Response:  ' + data);
                    document.getElementById("sub_menu_id").value = data;
                    document.getElementById("sort").value = parseInt(data.substring(2, 4));
                    //do after submission operation in DOM
                });
            });
        });

    </script>

    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
    </html>
<?php } ?>
