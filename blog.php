<?php

namespace app;

require_once("DBUtils.php");

use app\DBUtils;

$posts = DBUtils::getAllPostsSortedByCounter();

include("blog.html");