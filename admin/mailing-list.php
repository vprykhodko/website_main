<?php

namespace admin;

require_once("../DBUtils.php");

use app\DBUtils;

session_start();

if(!empty($_POST))
{
    if($_POST['action'] == 'add')
    {
        $result = DBUtils::addSubscriber($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']);
        if($result !== true)
            $_SESSION['result'] = $result;
        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'edit')
    {
        $result = DBUtils::editSubscriber($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']);
        if($result !== true)
            $_SESSION['result'] = $result;
        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'remove')
    {
        $result = DBUtils::removeSubscriber($_POST['dataID']);
        echo $result;
        exit();
    }
}

$subscribers = DBUtils::getAllSubscribers();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Админ панель</title>

    <link rel="stylesheet" href="style.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>

<h1>База рассылки</h1>
<h2><?=$_SESSION['result']?></h2>
<?php unset($_SESSION['result']); ?>
<h2><a href="newsletter.php">Отправить письмо</a></h2>
<h2><a href="add-subscriber.php">Добавить подписчика</a></h2>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>email</th>
        <th>phone</th>
        <th>message</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach($subscribers as $subscriber): ?>
        <tr>
            <td><?= $subscriber->getID(); ?></td>
            <td><?= $subscriber->getName(); ?></td>
            <td><?= $subscriber->getEmail(); ?></td>
            <td><?= $subscriber->getPhone(); ?></td>
            <td><?= $subscriber->getMessage(); ?></td>
            <td><a href="edit-subscriber.php?id=<?= $subscriber->getID(); ?>">Редактировать</a></td>
            <td class="delete-subscriber" data-toggle="modal" data-target="#myModal" data-id="<?= $subscriber->getID(); ?>">Удалить</td>
        </tr>
    <?php endforeach ?>
</table>

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
</html>

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
