<?php

namespace admin;

require_once("DBUtils.php");

use app\DBUtils;

session_start();

if(!empty($_POST['send']))
{
    if(trim($_POST['title']) != '' && trim($_POST['text']) != '')
    {
        $subscribers = DBUtils::getAllSubscribers();

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
    <title>Админ панель</title>

    <link rel="stylesheet" href="style.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>

<h1>Рассылка по базе</h1>
<h2><?=$_SESSION['result']?></h2>
<?php unset($_SESSION['result']); ?>

<div>
    <form method="post">
        <label for="title">Тема письма</label>
        <input type="text" id="title" name="title" required>

        <label for="text">Текст</label>
        <textarea id="text" name="text" required></textarea>

        <input type="submit" name="send" value="Отправить">
    </form>
</div>

</body>
</html>