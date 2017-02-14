<?php

/**
 * ModelGuestbook
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
class ModelGuestbook
{
    private $dbTable = 'entries';
    private $dbConnector = null;

    public function __construct(DbConnector $dbConnector) {
        $this->dbConnector = $dbConnector;
    }

    /**
     * retrieves all guestbook entries
     *
     * @return  array
     */
    public function getEntries()
    {
        $result = [];

        $statement = $this->dbConnector->prepare(
            'SELECT id, headline, text, author FROM entries WHERE validated = 1 AND deleted = 0'
        );
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

    /**
     * @param   ModelGuestbookEntry $entry
     * @return  void
     */
    public function saveEntry(ModelGuestbookEntry $entry)
    {
        $statement = $this->dbConnector->prepare('INSERT INTO entries 
          (headline, text, author) VALUES 
          (:headline, :text, :author)');

        $statement->execute([
            'headline' => $entry->getHeadline(),
            'text' => $entry->getText(),
            'author' => $entry->getAuthor(),
        ]);
    }
}