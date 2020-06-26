<?php
$sql = "SELECT * from tblslide order by id desc limit 4 ";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 0;
$row = array();
if ($query->rowCount() > 0) {
    foreach ($results as $result) {

        $slide_id = "S-" . sprintf("%09d", $result->id + 1);

        $file_name[$cnt] = $result->file_name;
        $file_desc[$cnt] = $result->filedoc_desc;
//echo "slide = " . $slide_id ;
        $cnt = $cnt + 1;
    }
//echo $row[1]  . " | " . $row[2] . " | " . $row[3] ;
}

?>