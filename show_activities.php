<?php
/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 18/1/2564
 * Time: 10:55
 */

include('includes/config.php');

?>

<html>
<head>
    <title>Create Simple Pagination Using PHP and MySQLi - AllPHPTricks.com</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font_mystyle.css">
</head>
<body>
<div style="width:700px; margin:0 auto;">

    <h3>Demo Create Simple Pagination Using PHP and MySQLi</h3>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th style='width:50px;'>ID</th>
            <th style='width:150px;'>Name</th>
            <th style='width:50px;'>Age</th>
            <th style='width:150px;'>Department</th>
        </tr>
        </thead>
        <tbody>
        <?php

        //include('db.php');

        if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
            $page_no = $_GET['page_no'];
        } else {
            $page_no = 1;
        }

        $total_records_per_page = 10;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";

        $sql_count = "SELECT * FROM tblsporttype";
        $query_count = $dbh->prepare($sql_count);
        $query_count->execute();
        $total_records = $query_count->rowCount();

        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1

        $sql = "SELECT * from tblsporttype order by id desc LIMIT " . $offset . "," . $total_records_per_page;
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {

                echo "<tr>
			  <td>" . $result->id . "</td>
			  <td>" . $result->SportName . "</td>
	 		  <td>" . $result->Section . "</td>
		   	  <td>" . $result->CreationDate . "</td>
		   	  </tr>";
            }

        }

        ?>
        </tbody>
    </table>

    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
        <strong>Total <?php echo $total_records . " Records ";?> </strong>
    </div>

    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
        <strong>Page <?php echo $page_no . " of " . $total_no_of_pages;?> </strong>
    </div>

    <ul class="pagination">
        <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>

        <li <?php if ($page_no <= 1) {
            echo "class='disabled'";
        } ?>>
            <a <?php if ($page_no > 1) {
                echo "href='?page_no=$previous_page'";
            } ?>>Previous</a>
        </li>

        <?php
        if ($total_no_of_pages <= 10) {
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                if ($counter == $page_no) {
                    echo "<li class='active'><a>$counter</a></li>";
                } else {
                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                }
            }
        } elseif ($total_no_of_pages > 10) {

            if ($page_no <= 4) {
                for ($counter = 1; $counter < 8; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                echo "<li><a href='?page_no=1'>1</a></li>";
                echo "<li><a href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            } else {
                echo "<li><a href='?page_no=1'>1</a></li>";
                echo "<li><a href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";

                for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            }
        }
        ?>

        <li <?php if ($page_no >= $total_no_of_pages) {
            echo "class='disabled'";
        } ?>>
            <a <?php if ($page_no < $total_no_of_pages) {
                echo "href='?page_no=$next_page'";
            } ?>>Next</a>
        </li>
        <?php if ($page_no < $total_no_of_pages) {
            echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
        } ?>
    </ul>


</div>
</body>
</html>