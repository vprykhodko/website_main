<?php

namespace app;

require_once("config.php");
require_once("DBUtils.php");
require_once(dirname(__DIR__) . "/Model/Subscriber.php");

use mysqli;

class SpecialUtils
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

    public static function getAllSubscribers()
    {
        $mysqli = SpecialUtils::getConnection();
        $query = "SELECT * FROM newsletter";

        $result = $mysqli->query($query);

        if ($result->num_rows == 0) {
            $mysqli->close();
            return false;
        }

        $subscribers = [];
        while ($row = $result->fetch_assoc())
            $subscribers[] = new Subscriber($row['ID'], $row['name'], $row['email'], $row['phone'], $row['message']);

        $mysqli->close();
        return $subscribers;
    }

    public static function getSubscriber($id)
    {
        $mysqli = SpecialUtils::getConnection();
        $query = "SELECT * FROM newsletter WHERE ID = $id";

        $result = $mysqli->query($query);

        if ($result->num_rows == 0) {
            $mysqli->close();
            return false;
        }

        $row = $result->fetch_assoc();
        $subscriber = new Subscriber($row['ID'], $row['name'], $row['email'], $row['phone'], $row['message']);

        $mysqli->close();
        return $subscriber;
    }

    public static function getSubscriberByEmail($email)
    {
        $mysqli = SpecialUtils::getConnection();
        $query = "SELECT * FROM newsletter WHERE email = '$email'";

        $result = $mysqli->query($query);

        if ($result->num_rows == 0) {
            $mysqli->close();
            return false;
        }

        $row = $result->fetch_assoc();
        $subscriber = new Subscriber($row['ID'], $row['name'], $row['email'], $row['phone'], $row['message']);

        $mysqli->close();
        return $subscriber;
    }

    public static function addSubscriber($name, $email, $phone, $message)
    {
        $mysqli = SpecialUtils::getConnection();
        $query = "INSERT INTO newsletter (`name`, `email`, `phone`, `message`) VALUES ('$name', '$email', '$phone', '$message');";

        if ($mysqli->query($query))
            $result = true;
        else
            $result = 'Ошибка записи в базу данных!';

        $mysqli->close();
        return $result;
    }

    public static function editSubscriber($id, $name, $email, $phone, $message)
    {
        $mysqli = SpecialUtils::getConnection();
        $query = "UPDATE newsletter SET name = '$name', email = '$email', phone = '$phone', message = '$message' WHERE ID = $id;";
        $mysqli->query($query);

        if ($mysqli->affected_rows !== 1)
            $result = 'Не удалось отредактировать запись!';
        else
            $result = true;

        $mysqli->close();
        return $result;
    }

    public static function removeSubscriber($id)
    {
        $mysqli = SpecialUtils::getConnection();
        $query = "DELETE FROM newsletter WHERE ID = $id;";
        $mysqli->query($query);

        if ($mysqli->affected_rows !== 1)
            $result = 'Не удалось удалить запись!';
        else
            $result = true;

        $mysqli->close();
        return $result;
    }

    public static function checkSubscriberEmail($email)
    {
        $mysqli = SpecialUtils::getConnection();
        $query = "SELECT email FROM newsletter WHERE email = '$email'";
        $result = $mysqli->query($query);

        if ($result->num_rows == 0)
            $res = false;
        else
            $res = true;

        $mysqli->close();
        return $res;
    }
}