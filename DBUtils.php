<?php

namespace app;

require_once("Post.php");
require_once("Subscriber.php");
require_once("config.php");

use mysqli;

class DBUtils
{
    private static function getConnection() //:\mysqli
    {
        $mysqli = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }

        if(!$mysqli->set_charset("utf8"))
        {
            echo "Не удалось установить кодировку utf8: " . $mysqli->error;
        }

        return $mysqli;
    }

    public static function getAllPosts()
    {
        $mysqli = DBUtils::getConnection();

        $query = "SELECT * FROM Posts;";
        $result = $mysqli->query($query);

        if($result->num_rows == 0)
        {
            $mysqli->close();
            return null;
        }

        $posts = [];
        while($row = $result->fetch_assoc())
        {
            $posts[] = new Post($row['ID'], $row['title'], $row['text'], $row['image'], $row['counter']);
        }

        $mysqli->close();
        return $posts;
    }

    public static function getAllPostsSortedByCounter()
    {
        $mysqli = DBUtils::getConnection();

        $query = "SELECT * FROM Posts ORDER BY `counter` DESC;";
        $result = $mysqli->query($query);

        if($result->num_rows == 0)
        {
            $mysqli->close();
            return null;
        }

        $posts = [];
        while($row = $result->fetch_assoc())
        {
            $posts[] = new Post($row['ID'], $row['title'], $row['text'], $row['image'], $row['counter']);
        }

        $mysqli->close();
        return $posts;
    }

    public static function getPost($ID)
    {
        $mysqli = DBUtils::getConnection();

        $query = "SELECT * FROM Posts WHERE ID = $ID;";
        $result = $mysqli->query($query);

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
            $query = "INSERT INTO Posts (`title`, `text`, `image`) VALUES ('$title', '$text', '$image');";

            if ($mysqli->query($query))
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
        // If image don't changed
        if($img == null)
        {
            $query = "UPDATE Posts SET title='$title', text='$text' WHERE ID=$ID;";
        }
        // If image changed
        else
        {
            if(getimagesize($img["tmp_name"]) !== false) {
                $image = $img['tmp_name'];
                $image = file_get_contents($image);
                $image = base64_encode($image);

                $query = "UPDATE Posts SET title='$title', text='$text', image='$image' WHERE ID=$ID;";
            }
            else
                return '<h1 style="color:red">Файл не являеться картинкой</h1>';
        }

        $mysqli = DBUtils::getConnection();

        if($mysqli->query($query))
            $result = true;
        else
            $result = '<h1 style="color:red">' . $mysqli->error . '</h1>';

        $mysqli->close();
        return $result;
    }

    public static function deletePost($ID)
    {
        $mysqli = DBUtils::getConnection();
        $query = "DELETE FROM Posts WHERE ID=$ID;";

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
        $query = "UPDATE Posts SET image='' WHERE ID=$ID;";

        if($mysqli->query($query))
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function increaseCounter($ID, $counter)
    {
        $mysqli = DBUtils::getConnection();
        $counter++;
        $query = "UPDATE Posts SET counter = $counter WHERE ID = $ID;";

        if($mysqli->query($query))
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function addSubscriber($name, $email, $phone, $message)
    {
        $mysqli = DBUtils::getConnection();
        $query = "INSERT INTO newsletter (`name`, `email`, `phone`, `message`) VALUES ('$name', '$email', '$phone', '$message');";

        if ($mysqli->query($query))
            $result = true;
        else
            $result = 'Ошибка записи в базу данных!';

        $mysqli->close();
        return $result;
    }

    public static function getAllSubscribers()
    {
        $mysqli = DBUtils::getConnection();
        $query = "SELECT * FROM newsletter";

        $result = $mysqli->query($query);

        if($result->num_rows == 0)
        {
            $mysqli->close();
            return false;
        }

        $subscribers = [];
        while($row = $result->fetch_assoc())
            $subscribers[] = new Subscriber($row['ID'], $row['name'], $row['email'], $row['phone'], $row['message']);

        $mysqli->close();
        return $subscribers;
    }
}