<?php

namespace webinar;

require_once("../admin/DBUtils.php");

use app\DBUtils;

$phone = trim(strip_tags($_POST['phone']));
$email = trim(strip_tags($_POST['email']));
$response = 'Благодарим Вас за регистрацию. В день вебинара мы отправим вам ссылку, а пока вы можете <a href="http://www.web-site.kiev.ua/webinar">задать нам вопрос</a> 
Среди всех, кто задал вопрос мы разыграем призы во время вебинара! Попытайте свою удачу ! До встречи 16.12. В 19:00 
С уважением команда <a href="http://www.web-site.kiev.ua/">Astudio</a>';

if(empty($_POST['msg']))
{
    mail('emma0975182407@gmail.com', 'Письмо с web-site.kiev.ua/webinar',
        'Его номер телефона: ' . $phone .
        '<br />Его e-mail: ' . $email ,
        "Content-type:text/html;charset=UTF-8");

    mail($email, 'Регистрация на вебинар web-site.kiev.ua/webinar',
        $response,"Content-type:text/html;charset=UTF-8");

    DBUtils::addSubscriber('', $email, $phone, '');
}
else
{
    $msg = trim(strip_tags($_POST['msg']));
    
    mail('emma0975182407@gmail.com', 'Письмо с web-site.kiev.ua/webinar',
        'Его номер телефона: ' . $phone .
        '<br />Его e-mail: ' . $email .
        '<br />Сообщение - ' . $msg ,
        "Content-type:text/html;charset=UTF-8");

    mail($email, 'Регистрация на вебинар web-site.kiev.ua/webinar',
        $response,"Content-type:text/html;charset=UTF-8");

    DBUtils::addSubscriber('', $email, $phone, $msg);
}