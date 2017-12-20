<?php

namespace admin;

require_once("DBUtils.php");

use app\DBUtils;

session_start();

if(!DBUtils::checkUser())
{
    $_SESSION['result'] = 'Войдите в систему!';
    header("Location:auth/login.php");
    exit();
}

if(!empty($_POST))
{
    if($_POST['action'] == 'add')
    {
        $result = DBUtils::addPost($_POST['title'], $_POST['text'], $_FILES['img']);

        if($result !== true)
            $_SESSION['result'] = $result;

        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'edit')
    {
        if($_FILES['img']['size'] === 0)
            $result = DBUtils::editPost($_POST['data-id'], $_POST['title'], $_POST['text'], null);
        else
            $result = DBUtils::editPost($_POST['data-id'], $_POST['title'], $_POST['text'], $_FILES['img']);

        if($result !== true)
            $_SESSION['result'] = $result;

        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'delete')
    {
        $result = DBUtils::deletePost($_POST['dataID']);
        echo $result;
        exit();
    }
}

$posts = DBUtils::getAllPosts();