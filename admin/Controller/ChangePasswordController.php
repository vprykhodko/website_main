<?php

session_start();

require_once("DBUtils.php");

use app\DBUtils;

if(!DBUtils::checkUser())
{
    header("Location:login.php");
    exit();
}

if(!empty($_POST['old-pass']) && !empty($_POST['new-pass']) && !empty($_POST['new-pass-confirm']))
{
    $result = DBUtils::changePassword($_POST['old-pass'], $_POST['new-pass'], $_POST['new-pass-confirm']);

    if($result !== true)
    {
        $_SESSION['result'] = $result;
        header('Location:' . $_SERVER['PHP_SELF']);
        exit();
    }
    else
    {
        $_SESSION['result'] = 'Пароль успешно изменен!';
        header('Location:login.php');
        exit();
    }
}