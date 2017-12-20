<?php

namespace app;

class Post
{
    private $ID;
    private $title;
    private $text;
    private $image;
    private $counter;

    public function __construct($ID, $title, $text, $image, $counter)
    {
        $this->ID = $ID;
        $this->title = $title;
        $this->text = $text;
        $this->image = $image;
        $this->counter = $counter;
    }

    public function constructWithoutID($title, $text, $image, $counter)
    {
        return new Post(0, $title, $text, $image, $counter);
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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
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