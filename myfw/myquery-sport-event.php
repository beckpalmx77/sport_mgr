<?php

if ($_POST['dropdownValue']) {
    //call the function or execute the code

    GetDateSportEvent($_POST['dropdownValue']);

}


function GetDateSportEvent($selectedVal)
{

    include("../includes/config.php");

// Establish database connection.
    try {
        $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

    $sql = "SELECT * from tblsport_events where event_id = '" . $selectedVal . "' ";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {

        foreach ($results as $result) {
            $data = $result->doc_date_from . "|" . $result->doc_date_to;
        }

    } else {

        $data = "|";
    }

    $return_value = $data;

    echo $return_value;

}

?>
