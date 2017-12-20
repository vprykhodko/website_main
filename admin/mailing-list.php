<?php require_once("Controller/MailingListController.php") ?>

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
        <h2 class="header-float-top">Админ панель</h2>
        <h2 style="text-align: center;"><?=$_SESSION['result']?></h2>
        <?php unset($_SESSION['result']); ?>

        <div class="admin-holder table-responsive">
            <table class="table admin-table">
                <a href="newsletter.php">
                    <button id="basketBtn" name="add-new-btn" class="add-new-btn">Отправить письмо</button>
                </a>
                <a href="add-subscriber.php">
                    <button id="addNewBtn" name="add-new-btn" class="add-new-btn">Добавить подписчика</button>
                </a>
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Сообщение</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($subscribers as $subscriber): ?>
                    <tr>
                        <td><?= $subscriber->getID(); ?></td>
                        <td><?= $subscriber->getName(); ?></td>
                        <td><?= $subscriber->getEmail(); ?></td>
                        <td><?= $subscriber->getPhone(); ?></td>
                        <td>
                            <div class="overflow-issue"><span><?=$subscriber->getMessage();?></span></div>
                        </td>
                        <td><span class="action-admin"><a href="edit-subscriber.php?id=<?=$subscriber->getID();?>">Редактировать</span></a></td>
                        <td class="delete-subscriber" data-toggle="modal" data-target="#myModal" data-id="<?=$subscriber->getID();?>"><span class="action-admin">Удалить</span></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
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
                <h4 class="modal-title">Удалить подписчика?</h4>
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
    $('.delete-subscriber').on( "click", function() {
        $('#modal-yes').attr("data-id", $(this).attr('data-id'));
    });

    $('#modal-yes').on( "click", function() {
        var data = {dataID: $(this).attr('data-id'), action: 'remove'};
        $.ajax({
            url: 'mailing-list.php',
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
</script>

</html>
