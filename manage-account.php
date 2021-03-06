<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        $sql = "select * FROM tbluser_account  where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                $chk = $result->Respect;
                if ($chk==1) {
                    $error = "ไม่สามารถลบข้อมูล บัญชีผู้ใช้นี้ได้";
                } else {
                    $sql = "Delete FROM tbluser_account  where Respect <> 1 and id=:id";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                    $query->execute();

                    $msg = "ลบข้อมูลเรียบร้อยแล้ว Delete Data Successfully - ";
                }
            }
        }

    } catch (PDOException $e) {
        echo "ข้อผิดพลาด : " . $e->getMessage();
        $error = "ข้อผิดพลาด : " . $e->getMessage();
    }
}

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
        <title>Admin Manage Accout</title>
        <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
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
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">
                <!--?php include('includes/leftbar.php'); ?-->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">จัดการผู้ใช้งานระบบ</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li> User Accout</li>
                                    <li class="active">จัดการผู้ใช้งานระบบ</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                    <section class="section">
                        <div class="container-fluid">


                            <div class="row">
                                <div class="col-md-12">

                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>View Account Info</h5>
                                            </div>
                                        </div>

                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <a href="create-account.php"
                                                   class="btn btn-primary btn-labeled">เพิ่มบัญชีผู้ใช้งานระบบ<span
                                                        class="btn-label btn-label-right"><i
                                                            class="fa fa-check"></i></span></a>
                                            </div>
                                        </div>

                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>ดำเนินการสำเร็จ :  </strong><?php echo htmlentities($msg); ?>
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            </div>
                                        <?php } ?>
                                        <div class="panel-body p-20">

                                            <table id="example" class="display table table-striped table-bordered"
                                                   cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ชื่อผู้ใช้</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>ประเภทผู้ใช้งาน</th>
                                                    <th>Icon</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ชื่อผู้ใช้</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>ประเภทผู้ใช้งาน</th>
                                                    <th>Icon</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php $sql = "SELECT * FROM tbluser_account ";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->UserName); ?></td>
                                                            <td><?php echo htmlentities($result->FirstName) . " " . htmlentities($result->LastName); ?></td>
                                                            <td><?php echo htmlentities($result->account_type); ?></td>
                                                            <td><img src="<?php echo htmlentities($result->picture); ?>"
                                                                     width="28" height="28"</td>
                                                            <td>
                                                                <a href="edit-account.php?aid=<?php echo htmlentities($result->id); ?>"><i
                                                                        class="fa fa-edit" title="Edit Account"></i>
                                                                </a>
                                                                &nbsp;
                                                                <a href="reset-account-password.php?aid=<?php echo htmlentities($result->id); ?>"><i
                                                                        class="fa fa-refresh" title="Reset Account Password"></i>
                                                                </a>
                                                                &nbsp;
                                                                <a href="javascript: delete_id(<?php echo htmlentities($result->id); ?>)"><i
                                                                        class="fa fa-times"
                                                                        title="Delete Record"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>


                                                </tbody>
                                            </table>


                                            <!-- /.col-md-12 -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->


                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-6 -->

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
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="js/prism/prism.js"></script>
    <script src="js/DataTables/datatables.min.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script>
        $(function ($) {
            $('#example').DataTable();

            $('#example2').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": false
            });

            $('#example3').DataTable();
        });
    </script>

    <script type="text/javascript">
        function delete_id(id) {

            alertify.confirm('Confirm Delete !!!', 'ต้องการลบรายการนี้ออกจากระบบ?',
                function () {
                    window.location.href = 'manage-account.php?id=' + id;
                }
                , function () {
                    alertify.error('Cancel - ยกเลิก')
                });

        }
    </script>

    </body>
    </html>
<?php } ?>

