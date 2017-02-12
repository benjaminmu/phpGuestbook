<?php

class ModelGuestbookEntry
{
    public $id = null;
    public $headline = '';
    public $text = '';
    public $author = null;

    public function setId($aId)
    {
        $this->id = $aId;
        return $this;
    }

    public function setHeadline($aHeadline)
    {
        $this->headline = (string)$aHeadline;
        return $this;
    }

    public function setText($aText)
    {
        $this->text = (string)$aText;
        return $this;
    }

    public function setAuthor($aAuthor)
    {
        $this->author = (Int)$aAuthor;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getheadline()
    {
        return $this->headline;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}