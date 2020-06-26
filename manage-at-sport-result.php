<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "Delete from tblstudents where StudentId=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $msg = "ลบข้อมูลเรียบร้อยแล้ว Delete Dasta Successfully";

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
        <title>Admin Manage System</title>
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
                <?php include('includes/leftbar.php'); ?>

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">จัดการ ผลงานประวัติการแข่งขันกีฬา </h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li> Athlete</li>
                                    <li class="active">จัดการ ผลงานประวัติการแข่งขันกีฬา </li>
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
                                                <h5>View Athlete Info</h5>
                                            </div>
                                        </div>


                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            </div>
                                        <?php } ?>
                                        <div class="panel-body p-20">

                                            <table id="example" class="display table table-striped table-bordered"
                                                   cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อ</th>
                                                    <th>นามสกุล</th>
                                                    <th>คณะ/หน่วยงาน</th>
                                                    <th>ประเภทกีฬา</th>
                                                    <th>วันเกิด</th>
                                                    <!--th>Status</th-->
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อ</th>
                                                    <th>นามสกุล</th>
                                                    <th>คณะ/หน่วยงาน</th>
                                                    <th>ประเภทกีฬา</th>
                                                    <th>วันเกิด</th>
                                                    <!--th>Status</th-->
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php $sql = "SELECT tblstudents.FirstName,tblstudents.LastName,tblstudents.RollId,tblstudents.RegDate
                                                ,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section,tblstudents.DOB
					                            ,(select tblsporttype.SportName from tblsporttype where tblsporttype.id = tblstudents.sport_type1) as SportName1
                                                from tblstudents left join tblclasses on tblclasses.id=tblstudents.ClassId";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->RollId); ?></td>
                                                            <td><?php echo htmlentities($result->FirstName); ?></td>
                                                            <td><?php echo htmlentities($result->LastName); ?></td>
                                                            <td><?php echo htmlentities($result->ClassName); ?></td>
                                                            <td><?php echo htmlentities($result->SportName1); ?></td>
                                                            <td><?php echo htmlentities($result->DOB); ?></td>
                                                            <td>
                                                                <a href="add-at-sport-result.php?stid=<?php echo htmlentities($result->StudentId); ?>"><i
                                                                        class="fa fa-file-image-o" title="เพิ่ม (ผลงานประวัติการแข่งขันกีฬา)"></i> </a>
                                                                &nbsp;
                                                                <a href="manage-edit-at-sport-result.php?rollid=<?php echo htmlentities($result->RollId); ?>"><i
                                                                        class="fa fa-edit" title="ดู/แก้ไข (ผลงานประวัติการแข่งขันกีฬา)"></i></a>
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

    <script>
        $(function ($) {

            //$('#example').DataTable();

            //$('#example').dataTable( {

            $('#example').dataTable( {
                "language": {
                    "search": "ค้นหาข้อมูล (Search) : ",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "lengthMenu": 'แสดง (Display) <select>'+
                    '<option value="10">10</option>'+
                    '<option value="25">25</option>'+
                    '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '<option value="-1">All</option>'+
                    '</select> รายการ (records)'

                }
            } );


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
            if (id== null) {
                alert("Error Parameter");
            }
            else {
                if (confirm('ต้องการลบรายการนี้ออกจากระบบ?' + id)) {
                    window.location.href = 'manage-students.php?id=' + id;
                }
            }
        }

    </script>

    </body>
    </html>
<?php } ?>

