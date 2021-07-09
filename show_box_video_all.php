<?php include('includes/lang.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags for Bootstrap 4 -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $system_name_th . " | " . $system_name_en ?> | Nakhon Ratchasima Rajabhat University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/bootstrap4/bootstrap.css">
    <link rel="stylesheet" href="css/font-thai.css" media="screen">
    <script src="vender/customjs/jquery3.51.js"></script>
    <script src="vender/customjs/umd/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font_mystyle.css">
</head>
<body>
<!-- Start of Card Columns Layout -->
<br>

<div class="container">

    <div class="card">
        <div class="card-header card bg-success text-white"><h3><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;ไฟล์ Video
            </h3>
        </div>
        <div class="card-body">

            <div class="card-columns">

                <?php

                include('includes/config.php');


                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                $total_records_per_page = 9;
                $offset = ($page_no - 1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";

                $sql_count = "SELECT id FROM tblvideo where type_image = 'V'";
                $query_count = $dbh->prepare($sql_count);
                $query_count->execute();
                $total_records = $query_count->rowCount();

                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; // total page minus 1

                $sql = "SELECT * from tblvideo where type_image = 'V' order by id desc LIMIT " . $offset . "," . $total_records_per_page;
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                $cnt = 0;
                $row = array();
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {

                        $video_id = "V-" . sprintf("%09d", $result->id + 1);
                        $file_name[$cnt] = $result->file_name;
                        $file_desc[$cnt] = $result->filedoc_desc;
                        $create_date[$cnt] = $result->create_date;
                        ?>

                        <div class="card">

                            <!--img class="card-img-top img-fluid" src="<?php echo $file_name[$cnt] ?>"
                                 alt="<?php echo $file_desc[$cnt] ?>"-->

                            <video class="card-img-top img-fluid" id="video" width="320" height="240" controls>
                                <source src="<?php echo $file_name[$cnt] ?>" type="video/mp4">
                                <!--source src="videos/20210708051607-2430.mp4" type="video/mp4"-->

                            </video>

                            <div class="card-body">
                                <!--h4 class="card-title">Card Title</h4-->
                                <p class="card-text"><h4><?php echo $file_desc[$cnt] ?></h4></p>
                                <p style="color:blue;">วันที่บันทึก : <?php echo $create_date[$cnt] ?></p>
                            </div>
                        </div>

                        <?php

                        $cnt = $cnt + 1;
                    }
                }

                ?>

            </div>
        </div>

        <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?> [
                Total <?php echo $total_records . " Records "; ?> ] </strong>
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
</div>


<!-- End of Card Columns Layout -->
<!-- Bootstrap 4 Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>