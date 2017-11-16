<?php

namespace app;

require_once("../DBUtils.php");

if(!empty($_POST))
{
    $result = DBUtils::deleteImage($_POST['dataID']);
    echo $result;
    exit();
}

$post = DBUtils::getPost($_GET['id']);

include("edit-post.html");