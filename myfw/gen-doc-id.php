<?php

function GenDocID($table_name, $doc_year)

{

    include("../includes/config.php");

    try {
        $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

    $sql = "SELECT * FROM " . $table_name . " WHERE doc_date like '%" . $doc_year . "' ORDER BY id DESC limit 1 ";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {

            $return_value = $doc_year . "-" . sprintf("%05d", $result->id + 1);
        }
    } else {

        $return_value = $doc_year . "-" . sprintf("%05d", 1);
    }

    return $return_value;

}

?>