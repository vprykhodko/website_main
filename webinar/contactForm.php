<?php 
    $name = trim(strip_tags($_POST['name']));
    $phone = trim(strip_tags($_POST['phone']));
    $message = trim(strip_tags($_POST['message']));

    mail('engelss@ukr.net', 'Письмо с web-site.kiev.ua', 
    'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его сообщение: '.$message,"Content-type:text/html;charset=UTF-8");

    mail('astudio@web-site.kiev.ua', 'Письмо с web-site.kiev.ua', 
    'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его сообщение: '.$message,"Content-type:text/html;charset=UTF-8");

    mail('wolf1222555@gmail.com', 'Письмо с web-site.kiev.ua', 
    'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его сообщение: '.$message,"Content-type:text/html;charset=UTF-8");
?>
