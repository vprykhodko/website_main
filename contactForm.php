<?php 
    $name = trim(strip_tags($_POST['name']));
    $phone = trim(strip_tags($_POST['phone']));
    $email = trim(strip_tags($_POST['email']));
    $section = trim(strip_tags($_POST['section']));

    if($section != "") {
        mail('ask@vector.agency', 'Письмо с vector.agency', 
        'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его почта: '.$email.'<br />С блока: '.$section,"Content-type:text/html;charset=UTF-8");

        mail('den7124@gmail.com', 'Письмо с vector.agency', 
        'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его почта: '.$email.'<br />С блока: '.$section,"Content-type:text/html;charset=UTF-8");


        mail('denisspassky@gmail.com', 'Письмо с vector.agency', 
        'Вам написал: '.$name.'<br />Его номер: '.$phone.'<br />Его почта: '.$email.'<br />С блока: '.$section,"Content-type:text/html;charset=UTF-8");
    }
?>