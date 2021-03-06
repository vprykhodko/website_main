<?php

namespace app;

require_once("Controller/DBUtils.php");

session_start();

if(!DBUtils::checkUser())
{
    header("Location:auth/login.php");
    exit();
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
    <title>Создать</title>

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
                <h2 class="header-float-top"><a href="index.php">Админ панель</a></h2>

                <div class="form-holder">
                    <form action="mailing-list.php" method="post" id="insideForm" class="form">
                        <div class="select-wrapper">
                            <div class="select form-group mar-tp-1 mar-bt-2">
                                <input type="text" name="name" required placeholder="Имя" class="form-control input-field">
                            </div>
                            <div class="select form-group mar-tp-1 mar-bt-2">
                                <input type="text" name="email" required placeholder="Email" class="form-control input-field">
                            </div>
                            <div class="select form-group mar-tp-1 mar-bt-2">
                                <input type="text" name="phone" required placeholder="Телефон" class="form-control input-field">
                            </div>
                            <div class="select form-group mar-tp-1 mar-bt-2">
                                <input type="text" name="message" required placeholder="Сообщение" class="form-control input-field">
                            </div>
                        </div>
                        <input type="hidden" name="action" value="add">
                        <input type="submit" value="Создать">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
