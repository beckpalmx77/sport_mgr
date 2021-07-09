<?php
/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 20/1/2564
 * Time: 9:52
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags for Bootstrap 4 -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font_mystyle.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<!--Section: Block Content-->
<section class="text-center">

  <!-- Grid row -->
  <div class="row">

      <?php

      $sql = "SELECT * from tblslide where type_image = 'I' order by id desc limit 9 ";
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
      $create_date[$cnt] = $result->create_date;


    ?>

    <!-- Grid column -->
    <div class="col-md-6 col-lg-6 mb-6">

      <!-- Card -->
      <div class="">

        <div class="view zoom overlay z-depth-2 rounded">
          <img class="img-fluid w-200"
               src="<?php echo $file_name[$cnt]?>" alt="Sample">
          <!--h4 class="mb-0"><span class="badge badge-primary badge-pill badge-news">Sale</span></h4-->
            <p class="text-left"><h6><?php echo $file_desc[$cnt]?></h6></p>
            <p style="color:blue;">วันที่บันทึก : <?php echo $create_date[$cnt] ?></p>
        </div>

      </div>
      <!-- Card -->

    </div>
    <!-- Grid column -->
    <?php }} ?>

  </div>
  <!-- Grid row -->



</section>
<!--Section: Block Content-->