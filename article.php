<?php

namespace app;

require_once("admin/Controller/DBUtils.php");

$post = DBUtils::getPost($_GET['id']);
DBUtils::increaseCounter($post->getID(), $post->getCounter());

?>

<!DOCTYPE html>
<html lang="ru">
<head>
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

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js'
        );
        fbq('init', '318667258631947');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=318667258631947&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
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

        <div id="article">
            <h4 class="article-title"><?= $post->getTitle(); ?></h4>

            <div class="article-body">
                <img class="article-image" src="data:image;base64,<?=$post->getImage();?>" alt="">
                <div class="article-text-holder">
                    <span><?= $post->getText(); ?></span>
                </div>
            </div>
        </div>

        <div class="articles-float-img-1"><img src="img/pallete.svg" alt=""></div>
        <div class="articles-float-img-2"><img src="img/cup.svg" alt=""></div>
        <div class="articles-float-img-3"><img src="img/keyboard.svg" alt=""></div>
        <div class="articles-float-img-4"><img src="img/tablet.svg" alt=""></div>
    </div>
</div>
</body>

<script src="js/mine_min.js"></script>

</html>
