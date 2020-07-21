<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('myfw/gen-doc-id.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    $id = intval($_GET['id']);
    if (isset($_POST['submit'])) {

        $stid = $_POST['stid'];
        $doc_date = $_POST['doc_date'];
        $doc_borrow = $_POST['doc_borrow'];
        $doc_int_borrow = $_POST['doc_int_borrow'];
        $doc_return_borrow = $_POST['doc_return_borrow'];
        $equipment_id = $_POST['equipment_id'];
        $quantity = $_POST['quantity'];
        $borrow_status = $_POST['borrow_status'];

        $sql = "UPDATE  tblborrow_doc  SET stid=:stid,doc_borrow=:doc_borrow,doc_int_borrow=:doc_int_borrow,doc_return_borrow=:doc_return_borrow
                ,equipment_id=:equipment_id
                ,quantity=:quantity,borrow_status=:borrow_status WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':stid', $stid, PDO::PARAM_STR);
        $query->bindParam(':doc_borrow', $doc_borrow, PDO::PARAM_STR);
        $query->bindParam(':doc_int_borrow', $doc_return_borrow, PDO::PARAM_STR);
        $query->bindParam(':doc_return_borrow', $doc_return_borrow, PDO::PARAM_STR);
        $query->bindParam(':equipment_id', $equipment_id, PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $query->bindParam(':borrow_status', $borrow_status, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $msg = "เพิ่มข้อมูลเรียบร้อยแล้ว info added successfully " . $id;

    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SARRS Admin Create Class</title>
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

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#picture')
                            .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script>
            function bigImg(x) {
                x.style.height = "100%";
                x.style.width = "100%";
            }
            function normalImg(x) {
                x.style.height = "100px";
                x.style.width = "100px";
            }
        </script>

    </head>
    <body class="top-navbar-fixed">

    <div class="main-wrapper">

        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-equipment_idebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">แก้ไข ปรับปรุง เอกสารการยืมอุปกรณ์</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>บันทึกเอกสาร</li>
                                    <li class="active">แก้ไข ปรับปรุง เอกสารการยืมอุปกรณ์</li>
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
                                                <h5>แก้ไข ปรับปรุง เอกสารการยืมอุปกรณ์</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>ดำเนินการสำเร็จ : </strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>ข้อผิดพลาด !!! </strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <a href="manage-borrow-doc.php"
                                                           class="btn btn-info btn-labeled">BACK<span
                                                                class="btn-label btn-label-right"><i
                                                                    class="fa fa-check"></i></span></a>
                                                    </div>
                                                </div>
                                                <?php

                                                $sql = "SELECT tblborrow_doc.*
                                                ,(SELECT CONCAT(FirstName, ' ', LastName) FROM tblstudents where tblstudents.RollId=tblborrow_doc.stid) AS STDName
                                                ,(SELECT equipment_name FROM tblsport_equipment where tblsport_equipment.equipment_id=tblborrow_doc.equipment_id) AS EQName
                                                from tblborrow_doc where id=:id";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">เลขที่เอกสาร</label>

                                                            <div class="col-sm-4">
                                                                <input type="text" name="quantity" class="form-control"
                                                                       id="quantity"
                                                                       value="<?php echo htmlentities($result->doc_id) ?>"
                                                                       readonly="true" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="date"
                                                                   class="col-sm-2 control-label">วันที่เอกสาร</label>

                                                            <div class="col-sm-4">
                                                                <input id="doc_date" name="doc_date"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->doc_date) ?>"
                                                                       placeholder="วัน/เดือน/ปี" readonly="true">

                                                            </div>
                                                            <label for="date"
                                                                   class="col-sm-2 control-label">วันที่ยืม</label>

                                                            <div class="col-sm-4">
                                                                <input id="doc_borrow" name="doc_borrow"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->doc_borrow) ?>"
                                                                       placeholder="วัน/เดือน/ปี" readonly="true"
                                                                       required="required">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">ชื่อผู้ยืม</label>

                                                            <div class="col-sm-10">
                                                                <select name="stid" class="form-control" id="stid"
                                                                        data-live-search="true">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->stid); ?>"
                                                                        selected><?php echo htmlentities($result->STDName); ?></option>
                                                                    <?php $sql1 = "SELECT * from tblstudents order by FirstName ";
                                                                    $query1 = $dbh->prepare($sql);
                                                                    $query1->execute();
                                                                    $results1 = $query->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query1->rowCount() > 0) {
                                                                        foreach ($results1 as $result1) { ?>
                                                                            <option
                                                                                value="<?php echo htmlentities($result1->RollId); ?>"><?php echo htmlentities($result1->FirstName) . "-" . htmlentities($result1->LastName); ?></option>
                                                                        <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">อุปกรณ์ที่ยืม</label>

                                                            <div class="col-sm-10">
                                                                <select name="equipment_id" class="form-control"
                                                                        id="equipment_id"
                                                                        data-live-search="true">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->equipment_id); ?>"
                                                                        selected><?php echo htmlentities($result->EQName); ?></option>
                                                                    <?php $sql1 = "SELECT * from tblsport_equipment order by id ";
                                                                    $query1 = $dbh->prepare($sql);
                                                                    $query1->execute();
                                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                                    if ($query1->rowCount() > 0) {
                                                                        foreach ($results1 as $result1) { ?>
                                                                            <option
                                                                                value="<?php echo htmlentities($result1->equipment_id); ?>"><?php echo htmlentities($result1->equipment_name); ?></option>
                                                                        <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">จำนวน</label>

                                                            <div class="col-sm-4">
                                                                <input type="text" name="quantity" class="form-control"
                                                                       id="quantity"
                                                                       value="<?php echo htmlentities($result->quantity) ?>"
                                                                       required="required" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="date"
                                                                   class="col-sm-2 control-label">วันที่กำหนดคืน</label>

                                                            <div class="col-sm-4">
                                                                <input id="doc_int_borrow" name="doc_int_borrow"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->doc_int_borrow) ?>"
                                                                       placeholder="วัน/เดือน/ปี" readonly="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="date"
                                                                   class="col-sm-2 control-label">วันที่คืน</label>

                                                            <div class="col-sm-4">
                                                                <input id="doc_return_borrow" name="doc_return_borrow"
                                                                       class="form-control"
                                                                       value="<?php echo htmlentities($result->doc_return_borrow) ?>"
                                                                       placeholder="วัน/เดือน/ปี" readonly="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="default"
                                                                   class="col-sm-2 control-label">สถานะการ
                                                                ยืม/คืน</label>

                                                            <div class="col-sm-4">
                                                                <select id="borrow_status" name="borrow_status"
                                                                        class="form-control" data-live-search="true"
                                                                        title="Please select">
                                                                    <option
                                                                        value="<?php echo htmlentities($result->borrow_status); ?>"
                                                                        selected><?php echo htmlentities($result->borrow_status); ?></option>
                                                                    <option>เลือกรายการ</option>
                                                                    <option>ยืม</option>
                                                                    <option>คืนแล้ว</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>

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

        <script src="js/datepicker-thai/datepicker-lib.js"></script>

        <script>
        </script>

        <script>
            //กำหนดให้ textbox ที่มี id เท่ากับ my_date เป็นตัวเลือกแบบ ปฎิทิน
            picker_date(document.getElementById("doc_borrow"), {year_range: "-100:+1000"});
            picker_date(document.getElementById("doc_int_borrow"), {year_range: "-100:+1000"});
            picker_date(document.getElementById("doc_return_borrow"), {year_range: "-100:+1000"});
            /*{year_range:"-12:+10"} คือ กำหนดตัวเลือกปฎิทินให้ แสดงปี ย้อนหลัง 12 ปี และ ไปข้างหน้า 10 ปี*/
        </script>

        <script>

            // Setting default configuration here or you can set through configuration object as seen below
            $.fn.select2.defaults = $.extend($.fn.select2.defaults, {
                allowClear: true, // Adds X image to clear select
                closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
                placeholder: 'Select...',
                minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
            });

            $(document).ready(
                function () {

                    // Single select example if using params obj or configuration seen above
                    var configParamsObj = {
                        placeholder: 'Select an option...', // Place holder text to place in the select
                        minimumResultsForSearch: 3 // Overrides default of 15 set above
                    };
                    $("#singleSelectExample").select2(configParamsObj);
                });

        </script>


        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
    </html>
<?php } ?>

