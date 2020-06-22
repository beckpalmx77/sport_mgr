<?php
/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 19/6/2563
 * Time: 13:26
 */

include("../myfw/myclass.php");

include("../myfw/mydbs.php");

include("../includes/config.php");

//echo DB_HOST . " | " . DB_USER . " | " . DB_PASS . " | " . DB_NAME . " | " ;


$db = new mydbs(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$accounts = $db->query('SELECT * FROM admin')->fetchAll();
foreach ($accounts as $account) {
    echo $account['id'] . ' | ';
    echo $account['UserName'] . ' | ';
    echo $account['account_type'] . ' | ';
    echo $account['picture'] . ' | ';
    echo '<br>';
}

$_SESSION['cart']=array
    (array("product"=>"apple","quantity"=>2),
    array("product"=>"Orange","quantity"=>4),
    array("product"=>"Banana","quantity"=>5),
    array("product"=>"Mango","quantity"=>7),
);


$h = new myclass( "Calvin", 15 );
echo "Hello, " . $h->getName(). "! You are ". $h->isAdult();

echo "<br>";


$max=sizeof($_SESSION['cart']);
for($i=0; $i<$max; $i++) {

    while (list ($key, $val) = each ($_SESSION['cart'][$i])) {
        echo "$key -> $val ,";
    } // inner array while loop
    echo "<br>";
} // outer array for loop


?>


