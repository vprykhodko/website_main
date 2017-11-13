<?php

namespace app;

require_once("DBUtils.php");

use app\DBUtils;

$post = DBUtils::getPost($_GET['id']);
DBUtils::increaseCounter($post->getID(), $post->getCounter());

include("article.html");