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

    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
</head>

<body>
<div class="inside-grid admin-grid">
    <div class="white-blur">
        <div class="outer-wrapper">
            <div class="inner-wrapper">
                <h2 class="header-float-top"><a href="index.php">Админ панель</a></h2>

                <div class="form-holder">
                    <form action="index.php" method="post" id="insideForm" class="form" enctype="multipart/form-data">
                        <div class="select-wrapper">
                            <div class="select form-group mar-tp-1 mar-bt-2">
                                <input type="text" name="title" required placeholder="Заголовок" class="form-control input-field">
                            </div>
                        </div>
                        <div class="select-wrapper image-upload-form">
                            <div class="select form-group upload-holder">
                                <div class="upload-fictive"><span>Choose a file</span></div>
                                <!-- 5MB limit -->
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                <input type="file" name="img" class="form-control upload-file">
                                <span class="not-found-label">File is not found</span>
                            </div>
                        </div>
                        <div class="select-wrapper mar-bt-1">
                            <textarea id="text" rows="7" name="text" placeholder="Текст" class="textarea-field"></textarea>
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

<script>
    CKEDITOR.replace( 'text' );
</script>