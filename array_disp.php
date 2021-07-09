<?php
$max=sizeof($_SESSION['menu']);
for($i=0; $i<$max; $i++) {

    while (list ($key, $val) = each ($_SESSION['menu'][$i])) {
        echo "$key -> $val ,";
    } // inner array while loop
    echo "<br>";
} // outer array for loop
?>