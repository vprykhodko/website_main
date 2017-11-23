<?php

namespace admin;

require_once("../DBUtils.php");

use app\DBUtils;

if(!empty($_POST))
{
    if($_POST['action'] == 'add')
    {
        $status = DBUtils::addPost($_POST['title'], $_POST['text'], $_FILES['img']);

        if($status !== true)
            echo "$status";
    }
    else if($_POST['action'] == 'edit')
    {
        if($_FILES['img']['size'] === 0)
            $status = DBUtils::editPost($_POST['data-id'], $_POST['title'], $_POST['text'], null);
        else
            $status = DBUtils::editPost($_POST['data-id'], $_POST['title'], $_POST['text'], $_FILES['img']);

        if($status !== true)
            echo "$status";
    }
    else if($_POST['action'] == 'remove')
    {
        $result = DBUtils::deletePost($_POST['dataID']);
        echo $result;
        exit();
    }
}

$posts = DBUtils::getAllPosts();

include("main.html");