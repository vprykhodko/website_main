<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Админ панель</title>
</head>

<body>

<h1>Админ панель</h1>

<div>
    <form action="mailing-list.php" method="post">
        <label for="name">Имя</label>
        <input type="text" id="name" name="name">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Телефон</label>
        <input type="text" id="phone" name="phone">

        <label for="message">Сообщение</label>
        <input type="text" id="message" name="message">

        <input type="hidden" name="action" value="add">

        <input type="submit" value="Создать">
    </form>
</div>

</body>
</html>
