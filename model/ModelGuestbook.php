<?php

/**
 * ModelGuestbook
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
class ModelGuestbook
{
    private $dbTable = 'entries';

    /**
     * retrieves all guestbook entries
     *
     * @return  array
     */
    public function getEntries()
    {
        $result = [];

        $statement = HelperDbConnector::prepare('SELECT * FROM ' . $this->dbTable);
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