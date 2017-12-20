<?php require_once(dirname(__DIR__) . "/Controller/LoginController.php") ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Агенство">
    <meta name="keywords" content="">
    <title>Login</title>

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="../res/css/bootstrap.min.css" rel="stylesheet">
    <link href="../res/css/style.css" rel="stylesheet">
</head>

<body>
<div class="login-grid admin-grid">
    <div class="white-blur">
        <div class="outer-wrapper">
            <div class="inner-wrapper">
                <h2 class="header-float-top">Админ панель</h2>
                <h2><?=$_SESSION['result']?></h2>
                <?php unset($_SESSION['result']); ?>

                <div class="form-holder">
                    <form method="post" id="loginForm" class="form">
                        <p class="form-header">Вход</p>
                        <div class="select-wrapper">
                            <div class="select form-group mar-bt-2">
                                <input type="email" name="login" required placeholder="Введите адрес электронной почты" class="form-control input-field">
                            </div>
                        </div>
                        <div class="select-wrapper">
                            <div class="select form-group mar-bt-2">
                                <input type="password" name="password" required placeholder="Введите пароль" class="form-control input-field">
                            </div>
                        </div>

                        <div class="form-action-holder" align="left">
                            <div class="remember-checkbox">
                                <input type="checkbox" id="remember" class="ui-checkbox" value="remember">
                                <label for="remember">Запомнить</label>
                            </div>
                            <div class="login-btn-holder" align="right">
                                <input type='submit' class="green-btn" value='Вход'>
                            </div>
                        </div>

                        <div class="bottom-links">
                            <a href="registration.php">Регистрация</a>
                            <a href="password-recovery.php">Забыли пароль</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>