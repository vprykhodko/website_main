<?php

$name = trim(strip_tags($_POST['name']));
$phone = trim(strip_tags($_POST['phone']));
$email = trim(strip_tags($_POST['email']));
$message = trim(strip_tags($_POST['message']));

mail('astudio0711@gmail.com', 'Письмо с web-site.kiev.ua',
    'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его Email: '.$email.'<br />Его сообщение: '.$message,"Content-type:text/html;charset=UTF-8");

mail('astudio@web-site.kiev.ua', 'Письмо с web-site.kiev.ua',
    'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его Email: '.$email.'<br />Его сообщение: '.$message,"Content-type:text/html;charset=UTF-8");
?>

<!DOCTYPE html>
<html lang="ru">
<head>

    <!— Global site tag (gtag.js) - Google Analytics —>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-102719980-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-102719980-1');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Astudio</title>

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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

<a href="#home" class="scroll up_link"><img src="img/up-arrow.svg" alt=""></a>

<div id="home" class="main-block">
    <div class="container-md">
        <div class="navbar-main">
            <div class="logo popup-left"><a href="index.html"><img src="img/logo.png" alt="logo" width="160px"></a></div>

            <div class="nav-right">
                <a href="tel:+380962441388" class="phone-holder popup-up popup-delayed-1">
                    <img src="img/mobile-phone-sketch.svg" alt="">
                    <span>+38 (096) 244 13 88</span>
                </a>
                <div class="lang-holder popup-up popup-delayed-2"><span>русский</span></div>
            </div>
        </div>

        <ul id="mobile_nav" class="mobile-hidden">
            <li><a class="scroll" href="index.html">Главная</a></li>
            <li><a class="scroll" href="index.html#services">Услуги</a></li>
            <li><a class="scroll" href="blog.php">Блог</a></li>
            <li><a class="scroll" href="index.html#contacts">Контакты</a></li>

            <div id="toggle_nav" onclick="showNav();"><img src="img/menu-button.svg" alt=""></div>
        </ul>
        <div align="center" style="color: white; padding-top: 12em">
            <h2>Спасибо, что оставили заявку!</h2>
            <h3>Мы с Вами свяжемся, как только появится свободный менеджер.</h3>
        </div>
    </div>
</div>

</body>
<script src="js/mine_min.js"></script>
</html>
