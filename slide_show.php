<?php

include('includes/config.php');

$sql = "SELECT * from tblslide where type_image = 'S' order by id desc limit 4 ";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 0;
$row = array();
if ($query->rowCount() > 0) {
    foreach ($results as $result) {

        $slide_id = "S-" . sprintf("%09d", $result->id + 1);

        $file_name[$cnt] = $result->file_name;
        $file_desc[$cnt] = $result->filedoc_desc;
        $link[$cnt] = $result->link;

        $cnt = $cnt + 1;
    }

}

?>

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="<?php echo $link[0] ?>" target="_blank">
                <img src="<?php echo $file_name[0] ?>" class="d-block w-100" alt="...">
            </a>

            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <a href="<?php echo $link[1] ?>" target="_blank">
                <img src="<?php echo $file_name[1] ?>" class="d-block w-100" alt="...">
            </a>

            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <a href="<?php echo $link[2] ?>" target="_blank">
                <img src="<?php echo $file_name[2] ?>" class="d-block w-100" alt="...">
            </a>

            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <a href="<?php echo $link[3] ?>" target="_blank">
                <img src="<?php echo $file_name[3] ?>" class="d-block w-100" alt="...">
            </a>

            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>