<?php

namespace app;

require_once("config.php");
require_once(dirname(__DIR__) . "/Model/Post.php");
require_once(dirname(__DIR__) . "/Model/User.php");

use mysqli;

class DBUtils
{
    private static function getConnection() //:\mysqli
    {
        $mysqli = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

        if ($mysqli->connect_errno) {
            return "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }

        if(!$mysqli->set_charset("utf8"))
            return "Не удалось установить кодировку utf8: " . $mysqli->error;

        return $mysqli;
    }

    public static function getAllPosts()
    {
        $mysqli = DBUtils::getConnection();

        $query = "SELECT * FROM Posts WHERE deleted = 0;";
        $result = $mysqli->query($query);

        if($result->num_rows == 0)
        {
            $mysqli->close();
            return null;
        }

        $posts = [];
        while($row = $result->fetch_assoc())
            $posts[] = new Post($row['ID'], $row['title'], $row['text'], $row['image'], $row['counter']);

        $mysqli->close();
        return $posts;
    }

    public static function getAllPostsSortedByCounter()
    {
        $mysqli = DBUtils::getConnection();

        $query = "SELECT * FROM Posts WHERE deleted = 0 ORDER BY `counter` DESC;";
        $result = $mysqli->query($query);

        if($result->num_rows == 0)
        {
            $mysqli->close();
            return null;
        }

        $posts = [];
        while($row = $result->fetch_assoc())
            $posts[] = new Post($row['ID'], $row['title'], $row['text'], $row['image'], $row['counter']);

        $mysqli->close();
        return $posts;
    }

    public static function getAllPostsFromBasket()
    {
        $mysqli = DBUtils::getConnection();

        $query = "SELECT * FROM Posts WHERE deleted = 1;";
        $result = $mysqli->query($query);

        if($result->num_rows == 0)
        {
            $mysqli->close();
            return null;
        }

        $posts = [];
        while($row = $result->fetch_assoc())
            $posts[] = new Post($row['ID'], $row['title'], $row['text'], $row['image'], $row['counter']);

        $mysqli->close();
        return $posts;
    }

    public static function getPost($ID)
    {
        $mysqli = DBUtils::getConnection();

        if(!($query = $mysqli->prepare("SELECT * FROM Posts WHERE ID = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("i", $ID))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        $result = $query->get_result();

        if($result->num_rows == 0)
        {
            $mysqli->close();
            return null;
        }

        $row = $result->fetch_assoc();
        $post = new Post($row['ID'], $row['title'], $row['text'], $row['image'], $row['counter']);

        $mysqli->close();
        return $post;
    }

    // $img -> $_FILES['img']
    public static function addPost($title, $text, $img)
    {
        if(getimagesize($img["tmp_name"]) !== false)
        {
            $image = $img['tmp_name'];
            $image = file_get_contents($image);
            $image = base64_encode($image);

            $mysqli = DBUtils::getConnection();

            if(!($query = $mysqli->prepare("INSERT INTO Posts (`title`, `text`, `image`) VALUES (?, ?, ?);")))
            {
                $mysqli->close();
                return "Не удалось подготовить запрос!<br>" . $query->error;
            }

            if (!$query->bind_param("sss", $title, $text, $image))
            {
                $mysqli->close();
                return "Не удалось привязать параметры!<br>" . $query->error;
            }

            if (!$query->execute())
            {
                $mysqli->close();
                return "Не удалось выполнить запрос!<br>" . $query->error;
            }

            if ($query->get_result())
                $result = true;
            else
                $result = '<h1 style="color:red">' . $mysqli->error . '</h1>';

            $mysqli->close();
            return $result;
        }
        else
            return '<h1 style="color:red">Файл не являеться картинкой</h1>';
    }

    // $img -> $_FILES['img']
    public static function editPost($ID, $title, $text, $img)
    {
        $mysqli = DBUtils::getConnection();

        // If image don't changed
        if($img == null)
        {
            if(!($query = $mysqli->prepare("UPDATE Posts SET title= ?, text= ? WHERE ID= ?;")))
            {
                $mysqli->close();
                return "Не удалось подготовить запрос!<br>" . $query->error;
            }

            if (!$query->bind_param("ssi", $title, $text, $ID))
            {
                $mysqli->close();
                return "Не удалось привязать параметры!<br>" . $query->error;
            }
        }
        // If image changed
        else
        {
            if(getimagesize($img["tmp_name"]) !== false)
            {
                $image = $img['tmp_name'];
                $image = file_get_contents($image);
                $image = base64_encode($image);

                if(!($query = $mysqli->prepare("UPDATE Posts SET title = ?, text = ?, image = ? WHERE ID = ?;")))
                {
                    $mysqli->close();
                    return "Не удалось подготовить запрос!<br>" . $query->error;
                }

                if (!$query->bind_param("sssi", $title, $text, $image, $ID))
                {
                    $mysqli->close();
                    return "Не удалось привязать параметры!<br>" . $query->error;
                }
            }
            else
                return '<h1 style="color:red">Файл не являеться картинкой</h1>';
        }

        if(!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($query->get_result())
            $result = true;
        else
            $result = '<h1 style="color:red">' . $mysqli->error . '</h1>';

        $mysqli->close();
        return $result;
    }

    public static function deletePost($ID)
    {
        $mysqli = DBUtils::getConnection();

        if(!($query = $mysqli->prepare("UPDATE Posts SET deleted = 1 WHERE ID = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("i", $ID))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($query->get_result())
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function deletePostFromBasket($ID)
    {
        $mysqli = DBUtils::getConnection();

        if(!($query = $mysqli->prepare("DELETE FROM Posts WHERE ID = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("i", $ID))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($query->get_result())
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function recoverPost($ID)
    {
        $mysqli = DBUtils::getConnection();

        if(!($query = $mysqli->prepare("UPDATE Posts SET deleted = 0 WHERE ID = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("i", $ID))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($query->get_result())
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function clearBasket()
    {
        $mysqli = DBUtils::getConnection();
        $query = "DELETE FROM Posts WHERE deleted = 1";

        if($mysqli->query($query))
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function deleteImage($ID)
    {
        $mysqli = DBUtils::getConnection();

        if(!($query = $mysqli->prepare("UPDATE Posts SET image = '' WHERE ID = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("i", $ID))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($query->get_result())
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function increaseCounter($ID, $counter)
    {
        $mysqli = DBUtils::getConnection();

        if(!($query = $mysqli->prepare("UPDATE Posts SET counter = ? WHERE ID = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("ii", $counter, $ID))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        $counter++;

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($query->get_result())
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function addUser($login, $password, $password_confirm)
    {
        $result = '';

        if($password !== $password_confirm)
            $result .= 'Пароли не совпадают!<br>';

        if(trim($password) == '')
            $result .= 'Пароль не введен<br>';

        if(trim($login) == '')
            $result .= 'Логин не введен<br>';

        $_SESSION['reg']['login'] = $login;

        if($result !== '')
            return $result;
        else
        {
            $mysqli = DBUtils::getConnection();
            $query = "SELECT * FROM users WHERE login = '$login';";
            $res = $mysqli->query($query);

            if($res->num_rows != 0)
            {
                $mysqli->close();
                return 'Этот логин уже занят!';
            }

            $password = md5($password);
            $hash = md5(microtime());

            if(!($query = $mysqli->prepare("INSERT INTO users (`login`, `password`, `hash`) VALUES (?, ?, ?);")))
            {
                $mysqli->close();
                return "Не удалось подготовить запрос!<br>" . $query->error;
            }

            if (!$query->bind_param('sss', $login, $password, $hash))
            {
                $mysqli->close();
                return "Не удалось привязать параметры!<br>" . $query->error;
            }

            if (!$query->execute())
            {
                $mysqli->close();
                return "Не удалось выполнить запрос!<br>" . $query->error;
            }

            if($query->get_result())
            {
                $mysqli->close();
                return "Ошибка регистрации пользователя!<br>" . $query->error;
            }
            else
            {
                $mysqli->close();

                $headers = "From: Admin <noreply@site.com> \r\n";
                $headers .= "Content-Type: text/plain; charset=utf8";

                $subject = "Registration";
                $mail_body = "Спасибо за регистрацию на сайте. Ваша ссылка для подтверждения  учетной записи: http://localhost/regauth/confirm.php?hash=" . $hash;

                mail($login, $subject, $mail_body, $headers);

                return true;
            }
        }
    }

    public static function confirmEmail($hash)
    {
        $mysqli = DBUtils::getConnection();


        if(!($query = $mysqli->prepare("UPDATE users SET confirm = 1 WHERE hash = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("s", $hash))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($mysqli->affected_rows != 0)
            $result = true;
        else
            $result = 'Не удалось подтвердить Email';

        return $result;
    }

    public static function login($login, $password, $remember)
    {
        $result = '';

        if(trim($login) == '')
            $result = 'Логин не введен<br>';
        if(trim($password) == '')
            $result = 'Пароль не введен<br>';

        if($result !== '')
            return $result;

        $password = md5(trim($password));

        $mysqli = DBUtils::getConnection();

        if(!($query = $mysqli->prepare("SELECT confirm FROM users WHERE login = ? AND password = ?;")))
        {
            $mysqli->close();
            return "Не удалось подготовить запрос!<br>" . $query->error;
        }

        if (!$query->bind_param("ss", $login, $password))
        {
            $mysqli->close();
            return "Не удалось привязать параметры!<br>" . $query->error;
        }

        if (!$query->execute())
        {
            $mysqli->close();
            return "Не удалось выполнить запрос!<br>" . $query->error;
        }

        if($query->num_rows > 0)
            $result = 'Такого пользователя не существует!';
        else if($query->get_result()->fetch_assoc()['confirm'] == 0)
            $result = 'Email не подтвержден!';
        else
        {
            if($remember == 'on')
            {
                // 10 days
                $time = time() + 864000;
                setcookie('blog-login', $login, $time, '/admin');
                setcookie('blog-password', $password, $time, '/admin');
            }

            $session = md5(microtime());

            if(!($query = $mysqli->prepare("UPDATE users SET session = ? WHERE login = ?;")))
            {
                $mysqli->close();
                return "Не удалось подготовить запрос!<br>" . $query->error;
            }

            if (!$query->bind_param("ss", $session, $login))
            {
                $mysqli->close();
                return "Не удалось привязать параметры!<br>" . $query->error;
            }

            if (!$query->execute())
            {
                $mysqli->close();
                return "Не удалось выполнить запрос!<br>" . $query->error;
            }

            if($query->affected_rows <= 0)
                $result = 'Не удалось авторизоваться!';
            else
            {
                $_SESSION['session'] = $session;
                $result = true;
            }
        }

        $mysqli->close();
        return $result;
    }

    public static function logout()
    {
        unset($_SESSION['session']);
        setcookie('blog-login', '', time() - 3600);
        setcookie('blog-password', '', time() - 3600);

        return true;
    }

    public static function checkUser()
    {
        if(!empty($_SESSION['session']))
        {
            $session = $_SESSION['session'];

            $mysqli = DBUtils::getConnection();

            if(!($query = $mysqli->prepare("SELECT ID FROM users WHERE session = ?;")))
            {
                $mysqli->close();
                return "Не удалось подготовить запрос!<br>" . $query->error;
            }

            if (!$query->bind_param("s", $session))
            {
                $mysqli->close();
                return "Не удалось привязать параметры!<br>" . $query->error;
            }

            if (!$query->execute())
            {
                $mysqli->close();
                return "Не удалось выполнить запрос!<br>" . $query->error;
            }

            if($query->get_result()->num_rows < 1)
                $result = false;
            else
                $result = true;

            $mysqli->close();
        }
        elseif(!empty($_COOKIE['blog-login']) && !empty($_COOKIE['blog-password']))
        {
            $login = urldecode($_COOKIE['blog-login']);
            $password = $_COOKIE['blog-password'];

            $mysqli = DBUtils::getConnection();

            if(!($query = $mysqli->prepare("SELECT ID FROM `users` WHERE login = ? AND password = ? AND confirm = 1;")))
            {
                $mysqli->close();
                return "Не удалось подготовить запрос!<br>" . $query->error;
            }

            if (!$query->bind_param("ss", $login, $password))
            {
                $mysqli->close();
                return "Не удалось привязать параметры!<br>" . $query->error;
            }

            if (!$query->execute())
            {
                $mysqli->close();
                return "Не удалось выполнить запрос!<br>" . $query->error;
            }

            $mysqli->close();

            if($query->get_result()->num_rows != 1)
                $result = false;
            else
            {
                $session = md5(microtime());

                if(!($query = $mysqli->prepare("UPDATE users SET session = ? WHERE login = ?;")))
                {
                    $mysqli->close();
                    return "Не удалось подготовить запрос!<br>" . $query->error;
                }

                if (!$query->bind_param("ss", $session, $login))
                {
                    $mysqli->close();
                    return "Не удалось привязать параметры!<br>" . $query->error;
                }

                if (!$query->execute())
                {
                    $mysqli->close();
                    return "Не удалось выполнить запрос!<br>" . $query->error;
                }

                if($mysqli->affected_rows > 0)
                    $_SESSION['session'] = $session;

                $result = true;
            }
        }
        else
            $result = false;

        return $result;
    }

    public static function getUsersCount()
    {
        $mysqli = DBUtils::getConnection();
        $res = $mysqli->query("SELECT COUNT(ID) FROM `users`");
        return $res->fetch_assoc()['COUNT(ID)'];
    }

    public static function recoverPassword($login)
    {
        $mysqli = DBUtils::getConnection();
        $query = "SELECT ID FROM users WHERE email='$login'";

        $res = $mysqli->query($query);
        if(!$res || $res->num_rows != 1)
            $result = 'Нет пользователя с таким email адресом!';
        else
        {
            $str = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM<>??~~##$$@@0123456789';
            $newPassword = '';

            for($i = 0; $i < 12; $i++)
                $newPassword .= $str[mt_rand(0, 83)];

            $md5Password = md5($newPassword);

            if(!($query = $mysqli->prepare("UPDATE users SET password = ? WHERE login = ?;")))
            {
                $mysqli->close();
                return "Не удалось подготовить запрос!<br>" . $query->error;
            }

            if (!$query->bind_param("ss", $md5Password, $login))
            {
                $mysqli->close();
                return "Не удалось привязать параметры!<br>" . $query->error;
            }

            if (!$query->execute())
            {
                $mysqli->close();
                return "Не удалось выполнить запрос!<br>" . $query->error;
            }

            if($mysqli->affected_rows != 1)
                $result = '';
            else
            {
                $result = true;

                $headers = "From: Admin <noreply@site.com> \r\n";
                $headers .= "Content-Type: text/plain; charset=utf8";

                $subject = 'Восстановление пароля';
                $mail_body = "Ваш новый пароль: " . $newPassword;

                mail($login, $subject, $mail_body, $headers);
            }
        }

        $mysqli->close();
        return $result;
    }

    public static function changePassword($oldPassword, $newPassword, $newPasswordConfirm)
    {
        return true;
    }
}