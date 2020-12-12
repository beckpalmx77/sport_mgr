<?php include('includes/config.php'); ?>
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

        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">อ่าน ประกาศ/ข่าวสาร </h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li></li>
                                    <li class="active">อ่าน ประกาศ/ข่าวสาร</li>
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
                                        <div class="panel-body p-20">
                                            <table id="example" class="display table table-striped table-bordered"
                                                   cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>รหัสประกาศ</th>
                                                    <th>หัวข้อประกาศ</th>
                                                    <th>รูปภาพ ประกาศ</th>
                                                    <th>วันที่ประกาศ</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>รหัสประกาศ</th>
                                                    <th>หัวข้อประกาศ</th>
                                                    <th>รูปภาพ ประกาศ</th>
                                                    <th>วันที่ประกาศ</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>

                                                <?php $sql = "SELECT tblnews.* from tblnews order by id desc ";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><a href="read-news-other.php?id=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->news_id); ?></a></td>
                                                            <td><a href="read-news-other.php?id=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->topic); ?></a></td>
                                                            <td>
                                                                <?php
                                                                if (file_exists($result->file_name)) {
                                                                    $file = $result->file_name;
                                                                } else {
                                                                    $file = "images/Document-icon.png";
                                                                }
                                                                ?>

                                                                <img id="picture"
                                                                     src="<?php echo htmlentities($file) ?>"
                                                                     width="100" height="100"
                                                                     class="img-thumbnail"
                                                                     alt="<?php echo htmlentities($file) ?>"
                                                                     onmouseover="bigImg(this)"
                                                                     onmouseout="normalImg(this)"
                                                                     onclick="window.open(this.src,'_blank')">
                                                            </td>
                                                            <td><?php echo htmlentities($result->doc_date); ?></td>
                                                            <td>
                                                                <a href="read-news-other.php?id=<?php echo htmlentities($result->id); ?>"><i
                                                                        class="fa fa-newspaper-o"
                                                                        title="อ่านรายละเอียด ข่าว/ประกาศ"></i></a>
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
/*
        function delete_id(id, rollid) {
            if (id == null) {
                alert("Error Parameter");
            }
            else {
                if (confirm('ต้องการลบรายการนี้ออกจากระบบ? ' + id)) {
                    window.location.href = 'manage-edit-files.php?id=' + id + ',rollid=' + rollid;
                }
            }
        }
*/

        function delete_id(id) {
            if (id == null) {
                alert("Error Parameter");
            }
            else {
                if (confirm('ต้องการลบรายการนี้ออกจากระบบ? ' + id)) {
                    window.location.href = 'manage-edit-files.php?id=' + id ;
                }
            }
        }

    </script>

    <script>
        function bigImg(x) {
            x.style.height = "150%";
            x.style.width = "150%";
        }
        function normalImg(x) {
            x.style.height = "100px";
            x.style.width = "100px";
        }
    </script>


    </body>
    </html>
