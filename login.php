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
    $sql = "SELECT UserName,Password,account_type,picture,lang FROM tbluser_account  WHERE UserName=:uname and Password=:password";
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
            $_SESSION['lang'] = $result->lang;
        }
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {

        echo "<script>alert('เข้าระบบไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง Invalid Details');</script>";

    }

}

?>