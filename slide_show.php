<!-- The slideshow -->
<?php

include('includes/config.php');

$sql = "SELECT * from tblslide order by id desc limit 4 ";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 0;
$row = array();
if ($query->rowCount() > 0) {
    foreach ($results as $result) {

        $slide_id = "S-" . sprintf("%09d", $result->id + 1);

        $file_name[$cnt] = $result->file_name ;
        $file_desc[$cnt] = $result->filedoc_desc ;
        //echo "slide = " . $slide_id ;
        $cnt = $cnt + 1;
    }
    //echo $row[1]  . " | " . $row[2] . " | " . $row[3] ;
}

?>


        <div id="nrru-item" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#nrru-item" data-slide-to="0" class="active"></li>
                <li data-target="#nrru-item" data-slide-to="1"></li>
                <li data-target="#nrru-item" data-slide-to="2"></li>
                <li data-target="#nrru-item" data-slide-to="3"></li>
            </ul>

            <!-- The slideshow -->

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo $file_name[0]?>" alt="" class="responsive">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $file_name[1]?>" alt="" class="responsive">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $file_name[2]?>" alt="" class="responsive">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $file_name[3]?>" alt="" class="responsive">
                </div>
            </div>


            <!--?php
                    echo $file_desc[1] . " | " . $file_desc[2] . " | " .  $file_desc[3];
            ?-->


            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#nrru-item" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#nrru-item" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>



