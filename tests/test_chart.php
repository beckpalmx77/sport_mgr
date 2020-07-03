<?php

include('../includes/config.php');

$sql = "SELECT * from  v_student_sport_quantity order by id ";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {

        echo "array('label'=> " . $result->SportName . ", 'y'=> " .  $result->Total . ")," . "<br>";

    }
}

?>


