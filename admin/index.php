<?php

namespace admin;

require_once("../DBUtils.php");

use app\DBUtils;


if(!empty($_POST))
{
    if($_POST['action'] == 'add')
    {
        DBUtils::addPost($_POST['title'], $_POST['text']);
    }
    else if($_POST['action'] == 'edit')
    {
        DBUtils::editPost($_POST['data-id'], $_POST['title'], $_POST['text']);
    }
    // TODO Delete with ajax
    else
    {
        DBUtils::deletePost($_POST['dataID']);
        echo $_POST['dataID'];
        exit();
    }
}

$posts = DBUtils::getAllPosts();

include("main.html");