<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
    <link rel="stylesheet" href="../css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="../css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="../css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="../css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="../css/prism/prism.css" media="screen">
    <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
    <link rel="stylesheet" href="../css/main.css" media="screen">
    <script src="../js/modernizr/modernizr.min.js"></script>


    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <script src="../js/jquery-ui/jquery-ui.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <script src="../js/pace/pace.min.js"></script>
    <script src="../js/lobipanel/lobipanel.min.js"></script>
    <script src="../js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="../js/prism/prism.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="../js/main.js"></script>

    <script>
        $(document).ready(function () {
            $('#myDropDown').change(function () {
                //Selected value
                var inputValue = $(this).val();
                alert("value in js " + inputValue);

                //Ajax for calling php function
                $.post('../myfw/myquery.php', {dropdownValue: inputValue}, function (data) {
                    alert('ajax completed. Response:  ' + data);
                    document.getElementById("sort").value = data;
                    //do after submission operation in DOM
                });
            });
        });
    </script>
</head>
<body>


<div class="content-wrapper">
    <div class="content-container">

        <div class="main-page">
            <div class="container-fluid">
                <div class="row page-title-div">
                    <div class="col-md-6">
                        <h2 class="title">ปรับปรุงผู้ใช้งานระบบ</h2>
                    </div>

                    <div class="col-sm-4">
                        <select id="myDropDown" class="form-control">
                            <option value='' disabled selected>Select Data</option>
                            <option value='M001'><i class="fa fa-check">M001</i></option>
                            <option value='M002'><i class="fa fa-check">M002</i></option>
                            <option value='M003'><i class="fa fa-check">M003</i></option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" id="sort" value="" class="form-control">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>


