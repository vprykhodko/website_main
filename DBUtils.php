<?php

namespace app;

define('MYSQL_SERVER', '127.0.0.1');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '517');
define('MYSQL_DB', 'web-site');

require_once("Post.php");

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
            $posts[] = new Post($row['ID'], $row['title'], $row['text']);
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
        $post = new Post($row['ID'], $row['title'], $row['text']);

        $mysqli->close();
        return $post;
    }

    public static function addPost($title, $text)
    {
        $mysqli = DBUtils::getConnection();
        $query = "INSERT INTO Posts (`title`, `text`) VALUES ('$title', '$text');";

        if($mysqli->query($query))
            $result = true;
        else
            $result = false;

        $mysqli->close();
        return $result;
    }

    public static function editPost($ID, $title, $text)
    {
        $mysqli = DBUtils::getConnection();
        $query = "UPDATE Posts SET title='$title', text='$text' WHERE ID=$ID;";

        if($mysqli->query($query))
            $result = true;
        else
            $result = false;

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
}