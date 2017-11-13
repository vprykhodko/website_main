<?php

namespace app;

class Post
{
    private $ID;
    private $title;
    private $text;

    public function __construct($ID, $title, $text)
    {
        $this->ID = $ID;
        $this->title = $title;
        $this->text = $text;
    }

    public function constructWithoutID($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
}