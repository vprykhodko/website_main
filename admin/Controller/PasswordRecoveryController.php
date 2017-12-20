<?php

session_start();

require_once("DBUtils.php");

use app\DBUtils;

if(!empty($_POST['form-email']))
{
    $result = DBUtils::recoverPassword($_POST['form-email']);

    if($result !== true)
    {
        $_SESSION['result'] = $result;
        header('Location:' . $_SERVER['PHP_SELF']);
        exit();
    }
    else
    {
        $_SESSION['result'] = 'Новый пароль отправлен на почту!';
        header('Location:login.php');
        exit();
    }
}