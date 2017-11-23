<?php

namespace webinar;

require_once("../admin/DBUtils.php");

use app\DBUtils;

$phone = trim(strip_tags($_POST['phone']));
$email = trim(strip_tags($_POST['email']));

mail('astudio@web-site.kiev.ua', 'Письмо с web-site.kiev.ua/webinar',
    'Его номер телефона: '.$phone.'<br />Его e-mail: '.$email,"Content-type:text/html;charset=UTF-8");

DBUtils::addSubscriber('', $email, $phone, '');