<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password,account_type,picture FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {

        $_SESSION['alogin'] = $_POST['username'];
        foreach ($results as $result) {
            $_SESSION['user_name'] = $result->UserName;
            $_SESSION['account_type'] = $result->account_type;
            $_SESSION['user_picture'] = $result->picture;
        }

        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {

        echo "<script>alert('Invalid Details');</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Athlete Record Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="v17/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="v17/css/util.css">
    <link rel="stylesheet" type="text/css" href="v17/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="post">
                    <span class="login100-form-title p-b-34">
						Athlete Record Management System
					</span>
					<span class="login100-form-title p-b-34">
						Account Login
					</span>

                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                    <input id="username" class="input100" type="text" name="username" placeholder="User name">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" name="login" class="login50-form-btn">
                        Sign in
                    </button>
                </div>
                    <!--span class="login100-form-title p-b-34"></span>
                <div class="container-login100-form-btn">
                    <button name="search_data" class="login100-form-btn">
                        <a href="find-result.php" class="login100-form-btn">Search Data</a>
                    </button>
                </div-->

                <!--div class="w-full text-center p-t-27 p-b-239">
                    <span class="txt1">
                        Forgot
                    </span>

                    <a href="#" class="txt2">
                        User name / password?
                    </a>
                </div-->

                <!--div class="w-full text-center">
                    <a href="#" class="txt3">
                        Sign Up
                    </a>
                </div-->
            </form>

            <div class="login100-more" style="background-image: url('images/background.jpg');"></div>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="v17/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="v17/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="v17/vendor/bootstrap/js/popper.js"></script>
<script src="v17/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="v17/vendor/select2/select2.min.js"></script>
<script>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script src="v17/vendor/daterangepicker/moment.min.js"></script>
<script src="v17/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="v17/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="v17/js/main.js"></script>

</body>
</html>