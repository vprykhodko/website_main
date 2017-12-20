<?php

namespace admin;

require_once("Controller/SpecialUtils.php");

use app\SpecialUtils;

session_start();

if(!empty($_POST['send']))
{
    if(trim($_POST['title']) != '' && trim($_POST['text']) != '')
    {
        $subscribers = SpecialUtils::getAllSubscribers();

        if($subscribers !== false)
        {
            $headers = "From: Admin <noreply@web-site.kiev.ua> \r\n";
            $headers .= "Content-Type: text/plain; charset=utf8";

            $subject = $_POST['title'];
            $mail_body = $_POST['text'];

            foreach ($subscribers as $subscriber)
                if($subscriber->getEmail() != '')
                    mail($subscriber->getEmail(), $subject, $mail_body, $headers);

            $_SESSION['result'] = 'Рассылка прошла успешно!';
        }
        else
            $_SESSION['result'] = 'Ошибка, письма не отправлены!';

        header('Location:' . $_SERVER['PHP_SELF']);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Рассылка</title>

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="res/css/bootstrap.min.css" rel="stylesheet">
    <link href="res/css/style.css" rel="stylesheet">
</head>

<body>
<div class="inside-grid admin-grid">
    <div class="white-blur">
        <div class="outer-wrapper">
            <div class="inner-wrapper">
                <h2 class="header-float-top"><a href="index.php">Рассылка по базе</a></h2>
                <h2><?=$_SESSION['result']?></h2>
                <?php unset($_SESSION['result']); ?>

                <div class="form-holder">
                    <form method="post" id="insideForm" class="form">
                        <div class="select-wrapper">
                            <div class="select form-group mar-tp-1 mar-bt-2">
                                <input type="text" name="title" required placeholder="Имя" class="form-control input-field">
                            </div>
                            <div class="select form-group mar-tp-1 mar-bt-2">
                                <input type="text" name="text" required placeholder="Email" class="form-control input-field">
                            </div>
                        </div>

                        <input type="submit" value="Отправить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>