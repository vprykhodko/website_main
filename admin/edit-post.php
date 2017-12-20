<?php

namespace app;

require_once("Controller/DBUtils.php");

session_start();

if(!DBUtils::checkUser())
{
    header("Location:auth/login.php");
    exit();
}

if(!empty($_POST))
{
    $result = DBUtils::deleteImage($_POST['dataID']);
    echo $result;
    exit();
}

$post = DBUtils::getPost($_GET['id']);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Редактировать</title>

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="res/css/bootstrap.min.css" rel="stylesheet">
    <link href="res/css/style.css" rel="stylesheet">

    <script src="res/js/jquery.js"></script>
    <script src="res/js/bootstrap.min.js"></script>
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
                                <input type="text" name="title" required class="form-control input-field" value="<?= $post->getTitle() ?>">
                            </div>
                        </div>
                        <div class="select-wrapper image-upload-form">
                                <?php
                                if($post->getImage() !== '')
                                {
                                    echo '<div class="image-load-holder">';
//                                    echo '<h1 style="cursor: pointer; color: red;" id="delete-img" data-toggle="modal" data-target="#myModal">Удалить</h1>';
                                    echo '<img width="100%" height="100%" src="data:image;base64,' . $post->getImage() . '">';
                                    echo '</div>';
                                }
                                ?>
                            <div class="select form-group upload-holder">
                                <div class="upload-fictive"><span>Choose a file</span></div>
                                <!-- 5MB limit -->
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                <input type="file" name="img" class="form-control upload-file">
                                <span class="not-found-label">File is not found</span>
                            </div>
                        </div>
                        <div class="select-wrapper mar-bt-1">
                            <textarea id="text" name="text" rows="7" name="message" class="textarea-field"><?= $post->getText() ?></textarea>
                        </div>

                        <input type="hidden" id="data-id" name="data-id" value="<?= $post->getID() ?>">
                        <input type="hidden" name="action" value="edit">
                        <input type="submit" value="Редактировать">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 100%; max-width: 250px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удалить изображение?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-yes">Да</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-no">Нет</button>
            </div>
        </div>

    </div>
</div>

</body>

<script>
    $('#delete-img').on( "click", function() {
        $('#modal-yes').attr("data-id", $('#data-id').val());
    });

    $('#modal-yes').on( "click", function() {
        var data = {dataID: $(this).attr('data-id')};
        $.ajax({
            url: 'edit-post.php',
            type: 'POST',
            data: data,
            error: function () {
                console.log('err');
            },
            success: function (result) {
                $('.img-block').remove();
            }
        });
    });
</script>

<script>
    CKEDITOR.replace( 'text' );
</script>

</html>