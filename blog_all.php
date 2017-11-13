<?php

namespace app;

require_once("DBUtils.php");

use app\DBUtils;

$posts = DBUtils::getAllPosts();

include("blog_all.html");