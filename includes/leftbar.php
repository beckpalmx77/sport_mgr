<?php define('WEB_ROOTDIR', realpath(dirname(__FILE__) . '/..')); ?>

<div class="left-sidebar bg-black-300 box-shadow ">
    <div class="sidebar-content">
        <div class="user-info closed">
            <img src=<?php echo $_SESSION['user_picture'] ?> width="40" height="40"
                 alt=<?php echo $_SESSION['user_name'] ?> class="img-circle profile-img">
            <h6 class="title"><?php echo $_SESSION['user_name'] ?></h6>
            <small class="info"><?php echo $_SESSION['account_type'] ?></small>
        </div>
        <!-- /.user-info -->

        <div class="sidebar-nav">
            <ul class="side-nav color-gray">
                <li class="nav-header">
                    <span class="">Sports And Recreation Record System</span>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard"></i><span>Dashboard <!--?php echo WEB_ROOTDIR ?--> </span> </a>

                </li>

                <li class="nav-header">
                    <span class="">Data Information</span>
                </li>

                <?php

                //privilege 1 = root

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
                <li class="has-children">
                    <a href="<?php echo $result->link ?>"><?php echo "<i class='$result->icon'></i>" ?>
                        <!--span><?php echo $result->label ?></span-->
                        <span><?php echo $_SESSION['lang'] == "th" ? $result->label : $result->label_en; ?></span>
                    </a>

                    <?php

                    $sql1 = "SELECT * from menu_sub where main_menu_id =:mid " . $where_condS . " order by main_menu_id,sub_menu_id";
                    $query1 = $dbh->prepare($sql1);
                    $query1->bindParam(':mid', $result->main_menu_id, PDO::PARAM_STR);
                    $query1->execute();
                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

                    if ($query1->rowCount() > 0) {
                        foreach ($results1 as $result1) { ?>

                            <ul class="child-nav">
                                <li>
                                    <a href="<?php echo $result1->link ?>"><?php echo "<i class='$result1->icon'></i>" ?>
                                        <span><?php echo $_SESSION['lang'] == "th" ? $result1->label : $result1->label_en; ?></span>
                                    </a>
                                </li>
                            </ul>
                            <?php
                        }

                    }

                    }

                    }

                    ?>
                </li>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-nav -->
    </div>
    <!-- /.sidebar-content -->
</div>



