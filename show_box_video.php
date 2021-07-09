<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags for Bootstrap 4 -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font_mystyle.css">
</head>

<!--style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
        border-radius: 5px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    img {
        border-radius: 5px 5px 0 0;
    }

    .container {
        padding: 2px 16px;
    }
</style-->

<body>
<!-- Start of Card Columns Layout -->

<div class="card-columns">

<?php

$sql = "SELECT * from tblvideo where type_image = 'V' order by id desc limit 9 ";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 0;
$row = array();
if ($query->rowCount() > 0) {
    foreach ($results as $result) {

        $slide_id = "V-" . sprintf("%09d", $result->id + 1);

        $file_name[$cnt] = $result->file_name;
        $file_desc[$cnt] = $result->filedoc_desc;
        $create_date[$cnt] = $result->create_date;

?>


            <div class="card">

                <!--img class="card-img-top img-fluid" src="<?php echo $file_name[$cnt]?>" alt="<?php echo $file_desc[$cnt]?>"-->
                <video class="card-img-top img-fluid" id="video" width="320" height="240" controls>
                    <source src="<?php echo $file_name[$cnt] ?>" type="video/mp4">
                    <!--source src="videos/20210708051607-2430.mp4" type="video/mp4"-->

                </video>

                <div class="card-body">
                    <!--h4 class="card-title">Card Title</h4-->
                    <p class="card-text"><h6><?php echo $file_desc[$cnt]?></h6></p>
                    <p style="color:blue;">วันที่บันทึก : <?php echo $create_date[$cnt] ?></p>
                    <!--div class="card-footer "><p style="color:blue;"><h6><?php echo $file_desc[$cnt]?></h6></p></div>
                    <div class="card-footer text-muted"><p style="color:blue;">วันที่บันทึก : <?php echo $create_date[$cnt] ?></p></div-->
                </div>
            </div>


<?php

        $cnt = $cnt + 1;
    }
}

?>

</div>

<!-- End of Card Columns Layout -->
<!-- Bootstrap 4 Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>