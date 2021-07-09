<?php
include("login.php");
include("includes/lang.php");
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?php echo $system_name_th . "-" . $system_name_en ?></title>
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>


    <style>
        /* Credit to bootsnipp.com for the css for the color graph */
        .colorgraph {
            height: 5px;
            border-top: 0;
            background: #c4e17f;
            border-radius: 5px;
            background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        }
    </style>

    <style>
        body {
            background: #eeeeee;
            font-family: 'Prompt', sans-serif;
        }

    </style>

</head>

<body>

<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-8 mx-auto">
            <div class="jumbotron">
                <form role="form" method="post">
                    <fieldset>
                        <img src="images/logo-name-1.png" alt="Logo" style="width:280px;">

                        <h2><?php echo $system_name_th ?></h2>
                        <hr class="colorgraph">
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control input-lg"
                                   placeholder="ชื่อผู้ใช้งานระบบ (User Account)">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control input-lg"
                                   placeholder="รหัสผ่าน (Password)">
                        </div>

                        <!--span class="button-checkbox">
                            <button type="button" class="btn" data-color="info">Remember Me</button>
                            <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
                            <a href="" class="btn btn-link pull-right">Forgot Password?</a>
                        </span-->
                        <hr class="colorgraph">

                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-lg btn-success btn-block" name="login"
                                           value="เข้าสู่ระบบ">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <input type="button" class="btn btn-lg btn-info btn-block" name="back"
                                           onclick="window.location.href='index.php'"
                                           value="กลับหน้าแรก"/>
                                </div>
                            </div>
                        </div>


                    </fieldset>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <!--a href="find-result.php" class="btn btn-lg btn-primary btn-block">Search Data</a-->

                                <p style="color:lightslategrey;"><i class="fa fa-copyright" aria-hidden="true"></i>
                                    กองพัฒนานักศึกษา เลขที่ 340 ถนนสุรนารายณ์
                                    อำเภอเมือง จังหวัดนครราชสีมา 30000 <br><i class="fa fa-phone"
                                                                              aria-hidden="true"></i> โทรศัพท์
                                    044-009009 ต่อ 3420</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</body>

</html>