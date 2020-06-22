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
                    <span class="">Athlete Record Management System</span>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a>

                </li>

                <li class="nav-header">
                    <span class="">Data Information</span>
                </li>


                <?php
                $sql_main = "SELECT * from menu_main order by id ";
                $query_main = $dbh->prepare($sql_main);
                //$query->bindParam(':cid', $cid, PDO::PARAM_STR);
                $query_main->execute();
                $results_main = $query_main->fetchAll(PDO::FETCH_OBJ);
                if ($query_main->rowCount() > 0) {
                foreach ($results_main as $result_main) { ?>

                    <li class="has-children">
                        <a href="#"><i class="fa fa-cogs"></i>
                            <span><?php echo $result_main->label ?></span>
                            <i class="<?php echo $result_main->icon ?>"></i>
                        </a>

                        <?php
                        $sql_sub = "SELECT * from menu_sub where main_menu_id =:main_menu_id " ;
                        $query_sub = $dbh->prepare($sql_sub);
                        $query_sub->bindParam(':main_menu_id', $result_main->main_menu_id, PDO::PARAM_STR);
                        $query_sub->execute();
                        $results_sub = $query_sub->fetchAll(PDO::FETCH_OBJ);
                        if ($query_sub->rowCount() > 0) {
                        foreach ($results_sub as $result_sub) { ?>

                        <ul class="child-nav">
                            <li><a href="<?php echo $result_sub->link ?>">
                                    <i class="<?php echo $result_sub->icon ?>"</i>
                                    <span><?php echo $result_sub->main_menu_id . "|" . $result_sub->label ?></span>
                                </a>
                            </li>
                        </ul>

                        <?php }
                        }
                        ?>

                    </li>

                <?php }
                }
                ?>




                <?php if ($_SESSION['account_type'] == "root") { ?>

                    <!--li class="has-children">
                        <a href="#"><i class="fa fa-cogs"></i><span>กำหนดระบบ</span> <i
                                class="fa fa-angle-right arrow"></i></a>
                        <ul class="child-nav">
                            <li><a href="create-account.php"><i class="fa fa-user-plus"></i>
                                    <span>สร้างผู้ใช้งานระบบ</span></a></li>
                            <li><a href="manage-account.php"><i class="fa fa-user"></i>
                                    <span>จัดการผู้ใช้งานระบบ</span></a></li>
                        </ul>
                    </li-->

                <?php } ?>

                <li class="has-children">
                    <a href="#"><i class="fa fa-file-text"></i><span>ทะเบียนหลัก</span> <i
                            class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <!--li><a href="create-class.php"><i class="fa fa-bars"></i> <span>Create Type</span></a></li-->
                        <li><a href="manage-classes.php"><i class="fa fa fa-server"></i><span>ทะเบียน คณะ/หน่วยงาน</span></a></li>
                        <!--li><a href="create-subject.php"><i class="fa fa-bars"></i> <span>Create Subject</span></a></li-->
                        <li><a href="manage-subjects.php"><i class="fa fa fa-server"></i><span>ทะเบียน สาขาวิชา/แผนก</span></a></li>
                        <li><a href="manage-sporttype.php"><i class="fa fa fa-server"></i><span>ทะเบียน ประเภทกีฬา</span></a></li>
                    </ul>
                </li>

                <li class="has-children">
                    <a href="#"><i class="fa fa-users"></i><span>ทะเบียนนักศึกษา/บุคลากร</span> <i
                            class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <!--li><a href="add-students.php"><i class="fa fa-bars"></i> <span>Add Athlete</span></a></li-->
                        <li><a href="manage-students.php"><i class="fa fa fa-server"></i><span>ข้อมูลนักกีฬา</span></a>
                        </li>

                    </ul>

                    <ul class="child-nav">
                        <!--li><a href="add-students.php"><i class="fa fa-bars"></i> <span>Add Athlete</span></a></li-->
                        <li><a href="manage-file-attach.php"><i class="fa fa fa-server"></i><span>ข้อมูล เอกสาร/ภาพถ่าย </span></a>
                        </li>

                    </ul>
                </li>


                <!--li class="has-children">
                    <a href="#"><i class="fa fa-file-text"></i> <span>Subjects</span> <i
                            class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <li><a href="create-subject.php"><i class="fa fa-bars"></i> <span>Create Subject</span></a></li>
                        <li><a href="manage-subjects.php"><i class="fa fa fa-server"></i>
                                <span>Manage Subjects</span></a></li>
                        <li><a href="add-subjectcombination.php"><i class="fa fa-newspaper-o"></i> <span>Add Subject Combination </span></a>
                        </li>
                        <a href="manage-subjectcombination.php"><i class="fa fa-newspaper-o"></i> <span>Manage Subject Combination </span></a></li>
                    </ul>
                </li-->

                <li class="has-children">
                    <!--a href="#"><i class="fa fa-info-circle"></i> <span>Result & Statistics</span> <i class="fa fa-angle-right arrow"></i></a-->
                    <!--ul class="child-nav">
                        <li><a href="add-result.php"><i class="fa fa-bars"></i> <span>Add Result</span></a></li>
                        <li><a href="manage-results.php"><i class="fa fa fa-server"></i> <span>Manage Result</span></a></li>

                    </ul-->
                <li><a href="change-password.php"><i class="fa fa-exchange"></i><span>เปลี่ยนรหัสผ่าน</span></a></li>


                </li>
            </ul>
        </div>
        <!-- /.sidebar-nav -->
    </div>
    <!-- /.sidebar-content -->
</div>