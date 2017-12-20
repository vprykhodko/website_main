<?php

namespace admin;

require_once("Controller/DBUtils.php");

use app\DBUtils;

session_start();

if(!DBUtils::checkUser())
{
    $_SERVER['result'] = 'Войдите в систему!';
    header("Location:auth/login.php");
    exit();
}

if(!empty($_POST))
{
    if($_POST['action'] == 'delete')
    {
        $id = substr($_POST['dataID'], 7);
        $result = DBUtils::deletePostFromBasket($id);

        if($result !== true)
            $_SESSION['result'] = $result;

        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'recover')
    {
        $id = substr($_POST['dataID'], 8);
        $result = DBUtils::recoverPost($id);

        if($result !== true)
            $_SESSION['result'] = $result;

        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'clear')
    {
        $result = DBUtils::clearBasket();

        if($result !== true)
            $_SESSION['result'] = $result;

        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
}

$posts = DBUtils::getAllPostsFromBasket();
