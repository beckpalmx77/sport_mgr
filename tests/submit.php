<?php

function processDrpdown($selectedVal) {
    echo "Selected value in php ".$selectedVal;
}

if ($_POST['dropdownValue']){
    //call the function or execute the code
    processDrpdown($_POST['dropdownValue']);
}

?>

