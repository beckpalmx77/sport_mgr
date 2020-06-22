<?php

session_start();          //php part

$_SESSION['menu_main']=array();






$menu_main_name=$_POST['main_menu_id '];
$menu_main_city=$_POST['label'];



array_push($_SESSION['menu_main'],$menu_main_name,label);

//print_r($_SESSION['menu_main']);

?>

<table class="table">
    <tr>
        <th>Name</th>
        <th>City</th>
    </tr>

    <tr>
        <?php for($i = 0 ; $i < count($_SESSION['menu_main']) ; $i++) {
            echo '<td>'.$_SESSION['menu_main'][$i].'</td>';
        }  ?>
    </tr>
</table>

