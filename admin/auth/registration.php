<?php
    session_start();
    require_once(dirname(__DIR__) . "/Controller/RegistrationController.php")
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Registration</title>

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="../res/css/bootstrap.min.css" rel="stylesheet">
    <link href="../res/css/style.css" rel="stylesheet">
</head>

<body>
<div class="registration-grid admin-grid">
    <div class="white-blur">
        <div class="outer-wrapper">
            <div class="inner-wrapper">
                <h2 class="header-float-top">Админ панель</h2>
                <h2 style="text-align: center;"><?=$_SESSION['result']?></h2>
                <?php unset($_SESSION['result']); ?>

                <div class="form-holder">
                    <form method="post" class="form">
                        <p class="form-header">Регистрация</p>
                        <div class="select-wrapper">
                            <div class="select form-group mar-bt-2">
                                <input type="email" name="login" required placeholder="Введите адрес электронной почты" class="form-control input-field" value="<?=$_SESSION['reg']['login']?>">
                            </div>
                        </div>
                        <div class="select-wrapper">
                            <div class="select form-group mar-bt-2">
                                <input type="password" name="password" required placeholder="Введите пароль" class="form-control input-field">
                            </div>
                        </div>
                        <div class="select-wrapper">
                            <div class="select form-group mar-bt-2">
                                <input type="password" name="password_confirm" required placeholder="Подтвердите пароль" class="form-control input-field">
                            </div>
                        </div>

                        <div class="form-action-holder mar-bt-1" align="center">
                            <input type="submit" class="green-btn" value="Зарегистрироваться">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php unset($_SESSION['reg']); ?>
</body>
</html>