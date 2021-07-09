<style>
    a.ex1:hover, a.ex1:active {color: blue;}
    a.ex2:hover, a.ex2:active {font-size: 150%;color: red;}
    a.ex3:hover, a.ex3:active {background: red;}
    a.ex4:hover, a.ex4:active {font-family: monospace;}
    a.ex5:visited, a.ex5:link {text-decoration: none;}
    a.ex5:hover, a.ex5:active {text-decoration: underline;}
</style>

<?php

include('includes/config.php');

$sql = "SELECT tblnews.* from tblnews order by id desc limit 10";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
?>
<section class="my-5">
    <div class="media mt-4 px-1">
        <img src="images/last_news.png" style="width:10%"
             alt="Generic placeholder image">

        <!--div class="media-body"-->
            <?php
            if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                    <p>
                        <i class="fa fa-rss" aria-hidden="true" style="color:blue"></i>
                        <a href="read-news.php?id=<?php echo htmlentities($result->id); ?>" class="ex2" rel="external"><?php echo htmlentities($result->topic); ?></a>
                    </p>
                    <?php
                }
            }

            ?>
        <p>
            <i class="fa fa-external-link" aria-hidden="true" style="color:blue"></i>
            <a href="show-news-page.php" class="ex2" rel="external">อ่าน ข่าว/ประกาศ อื่นๆ</a>
        </p>
        <!--/div-->
    </div>
</section>

<!--section class="my-5">
    <div class="media mt-4 px-1">
        <img src="images/last_news.png" style="width:10%"
             alt="Generic placeholder image">
        <div class="media-body">
                <p>
                    <i class="fa fa-rss-square" aria-hidden="true" style="color:blue"></i>
                    <a href="show-news-page.php?id=<?php echo htmlentities($result->id); ?>" class="ex2" rel="external">อ่าน ข่าว/ประกาศ อื่นๆ</a>
                </p>
        </div>
    </div>
</section-->

