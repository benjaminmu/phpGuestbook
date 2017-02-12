<?php

class ModelGuestbook extends ModelDbEntity
{
    private $dbTable = 'entries';

    public function getEntries()
    {
        $result = [];

        $statement = $this->dbConnector->prepare('SELECT * FROM ' . $this->dbTable);
        $statement->execute(array());

        while ($row = $statement->fetch()) {
            $entry = new ModelGuestbookEntry();
            $entry->setId($row['id'])
                ->setHeadline($row['headline'])
                ->setText($row['text'])
                ->setAuthor($row['author']);

            $result[] = $entry;
        }

        return $result;
    }
}