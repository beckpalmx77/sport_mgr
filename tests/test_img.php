<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARMS Admin Update Class</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body class="top-navbar-fixed">
<div class="main-wrapper">

    <!-- ========== TOP NAVBAR ========== -->
    <!--?php include('includes/topbar.php'); ?-->
    <!-----End Top bar>
      <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
    <div class="content-wrapper">
        <div class="content-container">

        </div>
    </div>
</div>

<?php

include('includes/config.php');

$sql = "SELECT * from menu_main ";
$query = $dbh->prepare($sql);
//$query->bindParam(':cid', $cid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);


if ($query->rowCount() > 0) {
    foreach ($results as $result) {

        //echo "result1 = " . $result->label;

        $sql1 = "SELECT * from menu_sub where main_menu_id =:mid";
        $query1 = $dbh->prepare($sql1);
        $query1->bindParam(':mid', $result->main_menu_id, PDO::PARAM_STR);
        $query1->execute();
        $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

        if ($query1->rowCount() > 0) {
            foreach ($results1 as $result1) { ?>

                <li class="has-children">
                    <a href="#"><i class="fa fa-cogs"></i><span><?php echo $result->label ?></span> <i
                            class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <li><a href="<?php echo $result1->link ?>"><i class="fa fa-user-plus"></i>
                                <span><?php echo $result1->label ?></span></a>
                        </li>
                    </ul>
                </li>
                <?php

            }

        }


    }

}

?>

</body>



