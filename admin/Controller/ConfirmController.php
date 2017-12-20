<?php

session_start();

require_once("DBUtils.php");

use app\DBUtils;

if($_GET['hash'])
{
    $result = DBUtils::confirmEmail($_GET['hash']);

    if($result === true)
        $_SESSION['result'] = 'Email подтвержден!';
    else
        $_SESSION['result'] = "Ошибка подтверждения email: $result";
}
else
    $_SESSION['result'] = 'Неверная ссылка!';

header('Location:login.php');
exit();