<?php

namespace admin;

require_once("DBUtils.php");

use app\DBUtils;

session_start();

if(empty($_GET['id']))
{
    $_SESSION['result'] = 'Не удалось получить пользователя из базы данных!';
    header("Location:mailing-list.php");
    exit();
}
else
    $subscriber = DBUtils::getSubscriber($_GET['id']);


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Админ панель</title>
</head>

<body>

<h1>Админ панель</h1>

<div>
    <form action="mailing-list.php" method="post">
        <label for="name">Имя</label>
        <input type="text" id="name" name="name" value="<?=$subscriber->getName();?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?=$subscriber->getEmail();?>" required>

        <label for="phone">Телефон</label>
        <input type="text" id="phone" name="phone" value="<?=$subscriber->getPhone();?>">

        <label for="message">Сообщение</label>
        <input type="text" id="message" name="message" value="<?=$subscriber->getMessage();?>">

        <input type="hidden" name="id" value="<?=$subscriber->getID();?>">
        <input type="hidden" name="action" value="edit">

        <input type="submit" value="Редактировать">
    </form>
</div>

</body>
</html>