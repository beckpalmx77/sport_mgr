<?php
/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 26/6/2563
 * Time: 10:36
 */


$str = 'one|two|three|four';

// positive limit
//print_r(explode('|', $str, 2));

// negative limit (since PHP 5.1)
//print_r(explode('|', $str, -1));

$doc_date = "24/06/2563";


echo " AP : " . substr($doc_date,3,8) ;


$dob_new = date('Y-m-d', strtotime($doc_date));


//echo $dob_new .'<br>';


$doc_date_sort = intval(substr($dob_new,0,4)-543) . substr($dob_new,4,6);

//echo "Date =  " . intval(substr($dob_new,0,4)-543) .'<br>';


//echo $doc_date_sort .'<br>';


?>