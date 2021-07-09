<?php
error_reporting(E_ALL);

/*
define('DB_NAME', 'sport_mgr_dbs');
define('DB_USER', 'sadmin');
define('DB_PASSWORD', 'sadmin');
define('DB_HOST', 'localhost');
*/

include ($_SERVER["DOCUMENT_ROOT"] . '/includes/config.php');

/*** DB INCLUDES ***/
include_once 'Database.php';
 
/*** DB CONNECTION ***/
$dsn        =   "mysql:dbname=".DB_NAME.";host=".DB_HOST."";
$pdo        =   '';
try {$pdo   =   new PDO($dsn, DB_USER, DB_PASSWORD);} catch (PDOException $e) {echo "Connection failed: " . $e->getMessage();}
 
/*Classes*/
$db         =   new Database($pdo);
?>