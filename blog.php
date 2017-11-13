<?php

namespace app;

require_once("DBUtils.php");

$posts = DBUtils::getAllPostsSortedByCounter();

include("blog.html");