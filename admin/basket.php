<?php require_once("Controller/BasketController.php")?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Admin-panel</title>

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="res/css/bootstrap.min.css" rel="stylesheet">
    <link href="res/css/style.css" rel="stylesheet">

    <script src="res/js/jquery.js"></script>
    <script src="res/js/bootstrap.min.js"></script>
</head>

<body>
<div class="main-grid admin-grid">
    <div class="white-blur">
        <h2 class="header-float-top"><a href="index.php">Админ панель</a></h2>
        <h2 align="center"><?=$_SESSION['result']?></h2>
        <?php unset($_SESSION['result']); ?>

        <div class="admin-holder table-responsive">
            <table class="table admin-table">
                <button id="clear" data-toggle="modal" data-target="#clearModal" class="add-new-btn">Очистить корзину</button>
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Текст</th>
                    <th scope="col">Картинка</th>
                    <th scope="col">Счетчик</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="table-content">
                <?php foreach($posts as $post): ?>
                    <tr>
                        <td><?=$post->getID();?></td>
                        <td><?=$post->getTitle();?></td>
                        <td>
                            <div class="overflow-issue"><span><?=$post->getText();?></span></div>
                        </td>
                        <td><img height="100%" src="data:image;base64,<?=$post->getImage();?>"></td>
                        <td><?=$post->getCounter();?></td>
                        <td class="delete-post" data-toggle="modal" data-target="#myModal" data-id="delete-<?=$post->getID();?>"><span class="action-admin">Удалить</span></td>
                        <td class="recover-post" data-toggle="modal" data-target="#recoverModal" data-id="recover-<?=$post->getID();?>"><span class="action-admin">Восстановить</span></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal delete -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 100%; max-width: 250px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удалить запись?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-yes">Да</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-no">Нет</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal recover -->
<div id="recoverModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 100%; max-width: 250px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Восстановить запись?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="recover-yes">Да</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="recover-no">Нет</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal clear -->
<div id="clearModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 100%; max-width: 250px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Очистить корзину?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="clear-yes">Да</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="clear-no">Нет</button>
            </div>
        </div>

    </div>
</div>

</body>
</html>

<script>
    $('.delete-post').on( "click", function() {
        $('#modal-yes').attr("data-id", $(this).attr('data-id'));
    });

    $('#modal-yes').on( "click", function() {
        var data = {dataID: $(this).attr('data-id'), action: "delete"};
        $.ajax({
            url: 'basket.php',
            type: 'POST',
            data: data,
            error: function () {
                console.log('err');
            },
            success: function (result) {
                var el = 'td[data-id=' + data['dataID'] + ']';
                $(el).parent().remove();
            }
        });
    });

    $('.recover-post').on( "click", function() {
        $('#recover-yes').attr("data-id", $(this).attr('data-id'));
    });

    $('#recover-yes').on( "click", function() {
        var data = {dataID: $(this).attr('data-id'), action: "recover"};
        $.ajax({
            url: 'basket.php',
            type: 'POST',
            data: data,
            error: function () {
                console.log('err');
            },
            success: function (result) {
                var el = 'td[data-id=' + data['dataID'] + ']';
                $(el).parent().remove();
            }
        });
    });

    $('#clear-yes').on( "click", function() {
        var data = {action: "clear"};
        $.ajax({
            url: 'basket.php',
            type: 'POST',
            data: data,
            error: function () {
                console.log('err');
            },
            success: function (result) {
                $('.table-content').empty();
            }
        });
    });
</script>