<?php

/**
 * ModelGuestbookEntry
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
class ModelGuestbookEntry
{
    private $id = null;
    private $headline = '';
    private $text = '';
    private $author = null;
    private $validationError = '';


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
    public function getHeadline()
    {
        return strip_tags((string)$this->headline);
    }

    /**
     * @return  int $text
     */
    public function getText()
    {
        return nl2br(strip_tags((string)$this->text));
    }

    /**
     * @return  int $author
     */
    public function getAuthor()
    {
        return strip_tags((string)$this->author);
    }

    /**
     * @return  string $validationError
     */
    public function getValidationError()
    {
        return $this->validationError;
    }

    /**
     * @return   array $validationResult
     */
    public function validate()
    {
        if ($this->text == '') {
            $this->validationError = 'Bitte geben sie einen Text in das Eingabefeld ein.';
            return false;
        }

        if (is_null($this->author)) {
            $this->validationError = 'Sie müssen angemeldet sein, um einen Eintrag verfassen zu können.';
            return false;
        }

        return true;
    }
}