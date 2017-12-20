<?php

namespace admin;

require_once("SpecialUtils.php");

use app\SpecialUtils;

session_start();

if(!empty($_POST))
{
    if($_POST['action'] == 'add')
    {
        $result = SpecialUtils::addSubscriber($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']);
        if($result !== true)
            $_SESSION['result'] = $result;
        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'edit')
    {
        $result = SpecialUtils::editSubscriber($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']);
        if($result !== true)
            $_SESSION['result'] = $result;
        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
    else if($_POST['action'] == 'remove')
    {
        $result = SpecialUtils::removeSubscriber($_POST['dataID']);
        echo $result;
        exit();
    }
}

$subscribers = SpecialUtils::getAllSubscribers();
