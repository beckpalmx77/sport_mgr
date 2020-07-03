<style>
    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .8);

    }

    .card-header:first-child {
        background-color: rgb(40, 167, 69);
    }
</style>

<?php

$news_icon = "images/news.png";

$sql = "SELECT tblnews.* from tblnews order by id desc limit 10";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;

if ($query->rowCount() > 0) {
    foreach ($results as $result) { ?>
        <div class="col-sm-6 col-md-12">
            <div class="thumbnail">
                <div class="caption">
                    <a href="read-news-other.php?id=<?php echo $result->id; ?>" target="_blank"><p class="text-blue"><i
                                class="fa fa-paper-plane" <?php if ($cnt == 1) echo "style=color:red;" ?>
                                aria-hidden="true"></i>
                            <?php echo $result->topic; ?></p></a>
                </div>
            </div>
        </div>

        <?php
        $cnt++;
    }
}
    ?>
