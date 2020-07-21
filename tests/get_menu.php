

<html>
   <head>
      <title>Selecting Table in MySQLi Server</title>
   </head>

   <body>
      <?php
         $dbhost = 'localhost:3306';
         $dbuser = 'sadmin';
         $dbpass = 'sadmin';
         $dbname = 'sport_mgr_dbs';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

         if(! $conn ) {
             die('Could not connect: ' . mysqli_error());
         }
         echo 'Connected successfully<br>';
         $sql = "SELECT * FROM menu_main";
         $result = mysqli_query($conn, $sql);

         if (mysqli_num_rows($result) > 0) {
             while($row = mysqli_fetch_assoc($result)) {

                 $myarray[] = array(
                     array($row['link'], $row['label'], $row['main_menu_id'])
                 );

                 echo '<li class="current_page_item"><a href="' . $row['link'] . '">' . $row['label'] . '</a>';
             }

         } else {
             echo "0 results";
         }

         mysqli_close($conn);

      foreach($myarray as $value){
          echo $value[0] .  $value[1] ;
      }


      ?>
</body>
</html>
<?php
function topMenu()
{
    $MySQLi = new mysqli("localhost","sadmin","sadmin","sport_mgr_dbs");

    $query = "SELECT * FROM `menu_main` order by main_menu_id";
    $commit = $MySQLi->query($query);
    if ($commit === false) {
        header("Location: error?code=01SET");
        die();
    } else {
        while ($row = $commit->fetch_assoc()) {
            if ($_SERVER['PHP_SELF'] == $row['link']) {
                echo '<li class="current_page_item"><a href="' . $row['link'] . '">' . $row['label'] . '</a>';
            } else {
                echo '<li><a href="' . $row['link'] . '">' . $row['label'] . '</a>';
            }
            $this->topMenuChildren($row['main_menu_id']);
            echo '</li>';
        }
    }
}

function topMenuChildren($parent)
{
    $MySQLi = new mysqli("localhost","my_user","my_password","my_db");
    $query = "SELECT * FROM `menu_sub` WHERE `main_menu_id` = '" . $parent . "' ORDER BY `main_menu_id` , `sub_menu_id`";
    $commit = $MySQLi->query($query);
    if ($commit === false) {
        header("Location: error?code=01SET");
        die();
    } else {
        if ($commit->num_rows > 0) {
            echo '<ul>';
            while ($row = $commit->fetch_assoc()) {
                echo '<li><a href="' . $row['link'] . '">' . $row['label'] . '</a>';
                $this->topMenuChildren($row['sub_menu_id']);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}

?>