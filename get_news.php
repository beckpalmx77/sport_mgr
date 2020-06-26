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

<style>

    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }

</style>

<!------ Include the above in your HEAD tag ---------->

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 offset-md-2">
            <img src="images/last_news.png" style="width:20%"
                 alt="Generic placeholder image">
            <ul class="timeline">
                <li>
                    <?php
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <p>
                                <a href="read-news.php?id=<?php echo htmlentities($result->id); ?>" class="ex2" rel="external">&nbsp;&nbsp;<?php echo htmlentities($result->topic);?></a>
                                <br>&nbsp;&nbsp;วันที่ประกาศ&nbsp;&nbsp;<?php echo htmlentities($result->doc_date);?>
                            </p>
                            <?php
                        }
                    }
                    ?>
                </li>
            </ul>
        </div>
        <div class="col-md-4 offset-md-2">
            <img src="images/more_news.png" style="width:20%"
                 alt="Generic placeholder image">
            <ul class="timeline">
                <li>
                    <?php
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <p>
                                <a href="show-news-page.php" class="ex2" rel="external">&nbsp;&nbsp;อ่าน ข่าว/ประกาศ อื่นๆ ... </a>
                            </p>
                            <?php
                        }
                    }
                    ?>
                </li>
            </ul>
        </div>

    </div>
</div>



