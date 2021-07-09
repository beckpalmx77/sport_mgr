<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "Delete from tblborrow_doc where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $msg = "ลบข้อมูลเรียบร้อยแล้ว Delete Data Successfully";
    } catch (PDOException $e) {
        echo "ข้อผิดพลาด : " . $e->getMessage();
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
        <title>รายการเอกสารการยืมอุปกรณ์</title>
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
                                <h2 class="title">รายการเอกสารการยืมอุปกรณ์</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="#">บันทึกเอกสาร</a></li>
                                    <li class="active">เอกสารการยืมอุปกรณ์</li>
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
                                                <h5>เอกสารการยืมอุปกรณ์</h5>
                                            </div>
                                        </div>
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <a href="create-borrow-doc.php"
                                                   class="btn btn-primary btn-labeled">เพิ่ม เอกสารการยืมอุปกรณ์<span
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

                                        <div class="panel-body p-20">

                                            <table id="example" class="display table table-striped table-bordered"
                                                   cellspacing="0" width="100%">

                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>เลขที่เอกสาร</th>
                                                    <th>วันที่เอกสาร</th>
                                                    <th>ชื่อเอกสารการยืมอุปกรณ์</th>
                                                    <th>ชื่อผู้ยืม</th>
                                                    <th>จำนวน</th>
                                                    <th>สถานะ</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>เลขที่เอกสาร</th>
                                                    <th>วันที่เอกสาร</th>
                                                    <th>ชื่ออุปกรณ์</th>
                                                    <th>ชื่อผู้ยืม</th>
                                                    <th>จำนวน</th>
                                                    <th>สถานะ</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php $sql = "SELECT tblborrow_doc.*
                                                ,(SELECT CONCAT(FirstName, ' ', LastName) FROM tblstudents WHERE tblstudents.RollId=tblborrow_doc.stid) AS STDName
                                                ,(SELECT equipment_name FROM tblsport_equipment WHERE tblsport_equipment.equipment_id=tblborrow_doc.equipment_id) AS EQName
                                                FROM tblborrow_doc ORDER BY doc_date_sort DESC ";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->doc_id); ?></td>
                                                            <td><?php echo htmlentities($result->doc_date); ?></td>
                                                            <td><?php echo htmlentities($result->EQName); ?></td>
                                                            <td><?php echo htmlentities($result->STDName); ?></td>
                                                            <td><?php echo htmlentities($result->quantity); ?></td>
                                                            <td><?php echo htmlentities($result->borrow_status); ?></td>
                                                            <td>
                                                                <a href="edit-borrow-doc.php?id=<?php echo htmlentities($result->id); ?>"><i
                                                                        class="fa fa-edit" title="Edit Record"></i> </a>
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
    <script src="vender/myjs/myAction.js"></script>

    <script src="js/sweet-alert/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert/sweetalert2.min.css">
    <script src="vender/alertifyjs/alertify.min.js"></script>
    <link rel="stylesheet" href="vender/alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="vender/alertifyjs/css/themes/default.min.css" />


    <script>
        $(function ($) {

            //$('#example').DataTable();

            $('#example').dataTable({
                "language": {
                    "search": "ค้นหาข้อมูล (Search) : ",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "lengthMenu": 'แสดง (Display) <select>' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="-1">All</option>' +
                    '</select> รายการ (records)'

                }
            });


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

                alertify.confirm('Confirm Delete !!!', 'ต้องการลบรายการนี้ออกจากระบบ?', function(){ window.location.href = 'manage-borrow-doc.php?id=' + id; }
                    , function(){ alertify.error('Cancel - ยกเลิก')});

        }
    </script>


    </body>
    </html>
<?php } ?>

