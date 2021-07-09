<?php
session_start();
error_reporting(0);

try {

    include('../includes/config.php');

    $_SESSION['student'] = array();

    $sql = "SELECT * from menu_main order by main_menu_id";
    $query = $dbh->prepare($sql);
    //$query->bindParam(':cid', $cid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);


    if ($query->rowCount() > 0) {
        foreach ($results as $result) {

            array_push($_SESSION['menu_main'], $result->main_menu_id, $result->label);

            //echo "Array  = " .$result->main_menu_id . " | " . $result->label . "<br>" ;

        }

    }

    $num = 1;
    printf("%03d", $num);

    //print_r($_SESSION['menu_main']);

    ?>

    <table class="table">
    <tr>
        <th>เมนูหลัก</th>
        <th>ชื่อเมนู</th>
    </tr>

    <tr>
        <?php

        for ($i = 0; $i < count($_SESSION['menu_main']); $i++) {
            echo $_SESSION['menu_main'][$i] . '<br>';
        }

        ?>

    </tr>

    <?php

    session_destroy();

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>