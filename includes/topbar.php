<?php include("includes/lang.php"); ?>

<script src="vender/alertifyjs/alertify.min.js"></script>
<link rel="stylesheet" href="vender/alertifyjs/css/alertify.min.css"/>
<link rel="stylesheet" href="vender/alertifyjs/css/themes/default.min.css"/>

<script src="../vender/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../vender/sweetalert2/sweetalert2.min.css">


<script>

    var msg1 = "<?php echo $system_organization_th?>";
    var msg2 = "<?php echo $system_owner?>";

    function msg() {
        alertify.alert(msg1, msg2);
    }

    function msg_wait() {
        alertify.success(msg1);
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


<nav class="navbar top-navbar bg-success box-shadow">
    <div class="container-fluid">
        <div class="row">
            <div class="navbar-header no-padding">
                <a class="navbar-brand" href="dashboard.php">
                    <?php echo "SARRS | " . $_SESSION['user_name'] ?>
                </a>
                <span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-outdent"></i></span>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <button type="button" class="navbar-toggle mobile-nav-toggle">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- /.navbar-header -->

            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <li class="hidden-sm hidden-xs"><a href="#" class="user-info-handle"><i class="fa fa-user"></i></a>
                    </li>
                    <li class="hidden-sm hidden-xs"><a href="javascript:msg();" class="info-msg"><i
                                class="fa fa-info-circle fa-lg" onmouseover="javascript:msg_wait();"></i></a></li>
                    <li class="hidden-sm hidden-xs"><a href="#" class="full-screen-handle"><i
                                class="fa fa-arrows-alt"></i></a></li>
                    <li class="hidden-xs hidden-xs"><!-- <a href="#">My Tasks</a> --></li>
                </ul>

                <a class="navbar-brand" href="dashboard.php">
                    <p style="color: yellow"><?php echo $system_name_th . " | " . $system_name_en ?></p>
                </a>

                <!-- /.nav navbar-nav -->

                <ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <li><a href="javascript:logout();" class="color-white text-center"><i class="fa fa-sign-out"></i>
                            ออกจากระบบ
                            Logout</a></li>

                </ul>
                <!-- /.nav navbar-nav navbar-right -->
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</nav>
