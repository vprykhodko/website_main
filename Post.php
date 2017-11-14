<?php

namespace app;

class Post
{
    private $ID;
    private $title;
    private $text;
    private $imgURL;
    private $counter;

    public function __construct($ID, $title, $text, $imgURL, $counter)
    {
        $this->ID = $ID;
        $this->title = $title;
        $this->text = $text;
        $this->imgURL = $imgURL;
        $this->counter = $counter;
    }

    public function constructWithoutID($title, $text, $imgURL, $counter)
    {
        $this->title = $title;
        $this->text = $text;
        $this->imgURL = $imgURL;
        $this->counter = $counter;
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

    public function getImgURL()
    {
        return $this->imgURL;
    }

    public function setImgURL($imgURL)
    {
        $this->imgURL = $imgURL;
    }

    public function getCounter()
    {
        return $this->counter;
    }

    public function setCounter($counter)
    {
        $this->counter = $counter;
    }
}