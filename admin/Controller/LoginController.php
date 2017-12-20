<?php

require_once("DBUtils.php");

use app\DBUtils;

session_start();

if(DBUtils::checkUser())
{
    $url = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER['HTTP_HOST'] . "/admin/index.php";
    header("Location:$url");
    exit();
}

if(!empty($_POST['login']) && !empty($_POST['password']))
{
    $result = DBUtils::login($_POST['login'], $_POST['password'], $_POST['remember']);

    if($result === true)
    {
        $url = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER['HTTP_HOST'] . "/admin/index.php";
        header("Location:$url");
        exit();
    }
    else
    {
        $_SESSION['result'] = $result;
        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
}
elseif(!empty($_POST['logout']))
{
    $result = DBUtils::logout();
    $_SESSION['result'] = 'Вы вышли из системы!';
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}