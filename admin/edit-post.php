<?php

namespace app;

require_once("../DBUtils.php");

use app\DBUtils;

$post = DBUtils::getPost($_GET['id']);

include("edit-post.html");