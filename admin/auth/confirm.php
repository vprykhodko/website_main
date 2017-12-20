<?php require_once(dirname(__DIR__) . "/Controller/ConfirmController.php") ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Confirmed</title>

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="../res/css/bootstrap.min.css" rel="stylesheet">
    <link href="../res/css/style.css" rel="stylesheet">
</head>

<body>
<div class="confirmed-grid admin-grid">
    <div class="white-blur">
        <div class="outer-wrapper">
            <div class="inner-wrapper">
                <h2 class="header-float-top">Админ панель</h2>

                <div class="form-holder">
                    <div class="confirmed-outer">
                        <div class="confirmed-inner"><span><?=$_SESSION['result']?></span></div>
                        <?php unset($_SESSION['result']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
