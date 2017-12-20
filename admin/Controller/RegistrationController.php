<?php

session_start();

require_once("DBUtils.php");

use app\DBUtils;

if(!empty($_POST))
{
    $result = DBUtils::addUser($_POST['login'], $_POST['password'], $_POST['password_confirm']);

    if($result === true)
    {
        $_SESSION['result'] = 'Регистрация прошла успешно!';
        header('Location: login.php');
        exit();
    }
    else
        $_SESSION['result'] = "Ошибка регистрации: $result";

    header('Location:' . $_SERVER['PHP_SELF']);
    exit();
}