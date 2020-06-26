<?php

if ($_POST['dropdownValue']){
    //call the function or execute the code

    GetSubMenuID($_POST['dropdownValue']);
}


function GetSubMenuID($selectedVal) {

    include("../includes/config.php");

// Establish database connection.
    try
    {
        $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch (PDOException $e)
    {
        exit("Error: " . $e->getMessage());
    }

    $sql = "SELECT * from menu_sub where main_menu_id = '" . $selectedVal ."' order by sort desc limit 1 ";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $sort = $result->sort + 1;
            $formatted_str = sprintf("%02d", $result->sort + 1);
        }

    } else {
        $sort = 1;
        $formatted_str = "01";
    }

    $return_value = "S" . substr($selectedVal,-1,1). $formatted_str;

    //$return_value = "true" ;
    //echo $return_value . " | " . $sql;

    echo $return_value;

}

?>
