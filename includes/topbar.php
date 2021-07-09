<?php include("../includes/lang.php"); ?>
<?php $WebLocation = $_SERVER['DOCUMENT_ROOT']?>

<script src="vender/alertifyjs/alertify.min.js"></script>
<link rel="stylesheet" href="vender/alertifyjs/css/alertify.min.css"/>
<link rel="stylesheet" href="vender/alertifyjs/css/themes/default.min.css"/>

<script src="../vender/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../vender/sweetalert2/sweetalert2.min.css">


<script>

    var msg1 = "<?php echo $system_organization_th?>";
    var msg2 = "<?php echo $system_owner?>";
    var msg3 = "<?php echo $system_name_th?>";
    var msg4 = "<?php echo $system_name_en?>";


    function msg() {
        alertify.alert(msg1, msg2);
    }

    function msg_wait() {
        alertify.success(msg4);
    }

    function logout() {
        alertify.confirm('Confirm Logout !!!', 'ต้องการออกจากระบบ ?', function () {
                window.location.replace("logout.php");
            }
            , function () {
                alertify.error('Cancel - ยกเลิก')
            });
    }

</script>

<style>
    body {
        background: #eeeeee;
        font-family: 'Prompt', sans-serif;
    }

</style>

<body>

<!--nav class="navbar navbar-default bg-success"-->
<nav class="navbar navbar-default bg-success navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php">
                <img src="images/logo-name.png" alt="Logo" style="width:150px;">
            </a>
            <a class="navbar-brand" href="dashboard.php" onmouseover=""><p style="color: yellow">[<?php echo "SARRS | " . $_SESSION['user_name'] ?>]</p></a>

            <!--span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-bars"></i></span-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php

                if ($_SESSION['account_type'] != "root") {
                    $where_condM = " where privilege = '2' ";
                    $where_condS = " and privilege = '2' ";
                }

                $sql = "SELECT * from menu_main " . $where_condM . " order by main_menu_id";
                $query = $dbh->prepare($sql);
                //$query->bindParam(':cid', $cid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        ?>

                        <li class="dropdown">
                            <a href="<?php echo $result->link ?>" class="dropdown-toggle" data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true"
                               aria-expanded="false"><?php echo "<i class='$result->icon'></i>" ?>&nbsp;<?php echo $result->label ?>
                                <!--span class="caret"></span--></a>

                            <?php
                            $sql1 = "SELECT * from menu_sub where main_menu_id =:mid " . $where_condS . " order by main_menu_id,sub_menu_id";
                            $query1 = $dbh->prepare($sql1);
                            $query1->bindParam(':mid', $result->main_menu_id, PDO::PARAM_STR);
                            $query1->execute();
                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                            ?>

                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                                    if ($query1->rowCount() > 0) {
                                        foreach ($results1 as $result1) { ?>
                                            <a href="<?php echo $result1->link ?>"><?php echo "<i class='$result1->icon'></i>" ?>
                                                <?php echo $_SESSION['lang'] == "th" ? $result1->label : $result1->label_en; ?>
                                            </a>
                                            <?php
                                        }
                                    } ?>

                                </li>
                            </ul>

                        </li>

                    <?php }
                } ?>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:logout();" class="color-white text-center"><i class="fa fa-sign-out"></i>
                        ออกจากระบบ
                        Logout</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

</body>


