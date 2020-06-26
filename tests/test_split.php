<?php
/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 26/6/2563
 * Time: 10:36
 */


$str = 'one|two|three|four';

// positive limit
print_r(explode('|', $str, 2));

// negative limit (since PHP 5.1)
print_r(explode('|', $str, -1));


?>