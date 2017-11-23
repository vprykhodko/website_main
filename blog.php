<?php

namespace app;

require_once("admin/DBUtils.php");

$posts = DBUtils::getAllPostsSortedByCounter();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109520133-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-109520133-1');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Astudio</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta name="theme-color" content="#ffffff">

    <script src="js/jquery.js"></script>
    <script src="js/jquery.appear.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="articles-block main-block">
    <div class="container-md">
        <div class="navbar-main">
            <div class="logo popup-left"><a href="#"><img src="img/logo.png" alt="logo" width="160px"></a></div>
        </div>

        <ul id="mobile_nav" class="mobile-hidden">
            <li><a class="scroll" href="index.html">Главная</a></li>
            <li><a class="scroll" href="index.html#services">Услуги</a></li>
            <li><a class="scroll" href="blog.php">Блог</a></li>
            <li><a class="scroll" href="index.html#contacts">Контакты</a></li>

            <div id="toggle_nav" onclick="showNav();"><img src="img/menu-button.svg" alt=""></div>
        </ul>

        <ul id="articles_list" class="panel-group">
            <?php for($i = 0; $i < count($posts); $i++) { ?>
            <li class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#articles_list" href="#collapse<?=$i?>">
                            <span class="popup-left"><?=$posts[$i]->getTitle()?></span>
                        </a>
                    </h4>
                </div>
                <?php
                if($i == 0)
                    echo '<div id="collapse' . $i . '" class="panel-collapse collapse in">';
                else
                    echo '<div id="collapse' . $i . '" class="panel-collapse collapse">';
                ?>
                <div class="panel-body">
                    <img class="article-image" src="data:image;base64,<?=$posts[$i]->getImage();?>" alt="">
                    <div class="article-text-holder">
                        <span><?=$posts[$i]->getText()?></span>
                        <a href="article.php?id=<?= $posts[$i]->getID(); ?>" class="article-more-link">Подробнее...</a>
                    </div>
                </div>
    </div>
    </li>
    <?php } ?>
    </ul>

    <div class="articles-float-img-1"><img src="img/pallete.svg" alt=""></div>
    <div class="articles-float-img-2"><img src="img/cup.svg" alt=""></div>
    <div class="articles-float-img-3"><img src="img/keyboard.svg" alt=""></div>
    <div class="articles-float-img-4"><img src="img/tablet.svg" alt=""></div>
    <div class="articles-float-img-5"><img src="img/book.svg" alt=""><span>БЛОГ</span></div>
</div>
</div>
</body>

<script src="js/mine_min.js"></script>

</html>
