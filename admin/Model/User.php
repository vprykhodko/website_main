<?php

namespace app;

class User
{
    private $ID;
    private $login;
    private $password;
    private $email;
    private $hash;
    private $confirm;
    private $session;

    public function __construct($ID, $login, $password, $email, $hash, $confirm, $session)
    {
        $this->ID = $ID;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->hash = $hash;
        $this->confirm = $confirm;
        $this->session = $session;
    }

    public function constructWithoutID($login, $password, $email, $hash, $confirm, $session)
    {
        return new User(0 , $login, $password, $email, $hash, $confirm, $session);
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function getConfirm()
    {
        return $this->confirm;
    }

    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }
}