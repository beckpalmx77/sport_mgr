<?php
/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 25/6/2563
 * Time: 15:51
 */
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','sadmin');
define('DB_PASS','sadmin');
define('DB_NAME','sport_mgr_dbs');
// Establish database connection.
try
{
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage());
}

$slide_id = 'S-9999';
$filedoc_desc = 'MyFile';
$link = 'link1';
$doc_date = '24/06/2563';

$sql = "INSERT INTO  tblslide(slide_id,filedoc_desc,link,doc_date) VALUES(:slide_id,:filedoc_desc,:link,:doc_date)";
$query = $dbh->prepare($sql);
$query->bindParam(':slide_id', $slide_id, PDO::PARAM_STR);
$query->bindParam(':filedoc_desc', $filedoc_desc, PDO::PARAM_STR);
$query->bindParam(':link', $link, PDO::PARAM_STR);
$query->bindParam(':doc_date', $doc_date, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();

if ($lastInsertId) {
    $msg = "Insert เพิ่มข้อมูลเรียบร้อยแล้ว info added successfully";
} else {
    $msg = "Insert เกิดข้อผิดพลาด";
}

echo $msg . " | " . $slide_id . " | " . $filedoc_desc . " | " . $sql  ;

$sql = "SELECT * from tblslide order by id desc ";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0) {
    foreach ($results as $result) {

        $slide_id   = $result->id . $result->filedoc_desc ;

        echo "<br>" . " | " . $slide_id   ;
        $msg1 = "OK" ;

    }
} else {

        $slide_id = "S-" . sprintf("%09d", 1);
       $msg1 = "NO" ;
}


echo "<br>" .$msg1 . " | " . $slide_id . " | " . " | " . $sql  ;

?>