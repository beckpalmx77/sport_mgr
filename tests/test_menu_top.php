<?php include("../includes/lang.php"); ?>
<?php include("../includes/config.php"); ?>


<?php
/*
if ($_SESSION['account_type'] == "root") {
$where_condM = "";
$where_condS = "";
} else {
$where_condM = " where privilege = '2' ";
$where_condS = " and privilege = '2' ";
}
*/
?>

<style>



</style>

<link rel="stylesheet" href="../css/bootstrap4/bootstrap.css" media="screen">
<link rel="stylesheet" href="../css/font-awesome.min.css" media="screen">
<link rel="stylesheet" href="../css/animate-css/animate.min.css" media="screen">
<script src="../js/jquery/jquery-2.2.4.min.js"></script>
<script src="../js/bootstrap/bootstrap.js"></script>

<link href="../js/bootstrap-hover/css/bootstrap-dropdownhover.min.css" rel="stylesheet">
<script src="../js/bootstrap-hover/js/bootstrap-dropdownhover.js"></script>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!--a class="navbar-brand" href="#">Navbar</a-->
    <img src="../images/logo-name-2.png" alt="Logo" style="width:280px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">

            <li class="nav-item active">
                <a class="nav-link" href="#">หน้าแรก <span class="sr-only">(current)</span></a>
            </li>

            <!--li class="nav-item">
                <a class="nav-link" href="<?php echo $result->link ?>"><?php echo $result->label ?></a>
            </li-->

            <?php
            $where_condM = "";
            $sql = "SELECT * from menu_main " . $where_condM . " order by main_menu_id";
            $query = $dbh->prepare($sql);
            //$query->bindParam(':cid', $cid, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);


            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                    ?>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?php echo $result->link ?>" id="navbarDropdownMenuLink"
                       role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $result->label ?>
                    </a>
                    <?php
                    $where_condS = "";
                    $sql1 = "SELECT * from menu_sub where main_menu_id =:mid " . $where_condS . " order by main_menu_id,sub_menu_id";
                    $query1 = $dbh->prepare($sql1);
                    $query1->bindParam(':mid', $result->main_menu_id, PDO::PARAM_STR);
                    $query1->execute();
                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

                    if ($query1->rowCount() > 0) {
                    ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?PHP
                        foreach ($results1 as $result1) { ?>

                            <!--?php echo "Data = " . $result1->label . "<br>" ?-->
                                <a class="dropdown-item" href="<?php echo $result1->link ?>"><?php echo $result1->label ?></a>

                            <?php
                        } ?>
                    </div>
                        <?PHP
                    }
                }
                ?>

                <?php
            } ?>


            <!--li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li-->

        </ul>
    </div>
</nav>



