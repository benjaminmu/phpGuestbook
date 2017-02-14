<?php

/**
 * ModelGuestbookEntry
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
class ModelGuestbookEntry
{
    public $id = null;
    public $headline = '';
    public $text = '';
    public $author = null;

    /**
     * @param   int $aId
     * @return  ModelGuestbookEntry
     */
    public function setId($aId)
    {
        $this->id = $aId;
        return $this;
    }

    /**
     * @param   int $aHeadline
     * @return  ModelGuestbookEntry
     */
    public function setHeadline($aHeadline)
    {
        $this->headline = (string)$aHeadline;
        return $this;
    }

    /**
     * @param   int $aText
     * @return  ModelGuestbookEntry
     */
    public function setText($aText)
    {
        $this->text = (string)$aText;
        return $this;
    }

    /**
     * @param   int $aAuthor
     * @return  ModelGuestbookEntry
     */
    public function setAuthor($aAuthor)
    {
        $this->author = (Int)$aAuthor;
        return $this;
    }

    /**
     * @return  int $id
     */
    public function getId()
    {
        return (int)$this->id;
    }

    /**
     * @return  int $headline
     */
    public function getheadline()
    {
        return strip_tags((string)$this->headline);
    }

    /**
     * @return  int $text
     */
    public function getText()
    {
        return strip_tags((string)$this->text);
    }

    /**
     * @return  int $author
     */
    public function getAuthor()
    {
        return strip_tags((string)$this->author);
    }
}