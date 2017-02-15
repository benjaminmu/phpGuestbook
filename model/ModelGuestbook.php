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
     * retrieves all validated guestbook entries
     *
     * @return  array
     */
    public function getValidatedEntries()
    {
        $result = [];

        $statement = $this->dbConnector->prepare(
            'SELECT id, headline, text, author FROM entries WHERE validated = 1 AND deleted = 0'
        );
        $statement->execute(array());

        while ($row = $statement->fetch()) {
            $result[] = $this->createModelGuestbookEntryFromArray($row);
        }

        return $result;
    }

    /**
     * retrieves all guestbook entries
     *
     * @return  array
     */
    public function getUnvalidatedEntries()
    {
        $result = [];

        $statement = $this->dbConnector->prepare(
            'SELECT id, headline, text, author FROM entries WHERE validated = 0 AND deleted = 0'
        );
        $statement->execute(array());

        while ($row = $statement->fetch()) {
            $result[] = $this->createModelGuestbookEntryFromArray($row);
        }

        return $result;
    }

    /**
     * @param   array $databaseRow
     * @return  array
     */
    public function createModelGuestbookEntryFromArray($databaseRow)
    {
        $entry = new ModelGuestbookEntry();
        $entry->setId($databaseRow['id'])
            ->setHeadline($databaseRow['headline'])
            ->setText($databaseRow['text'])
            ->setAuthor($databaseRow['author']);

        return $entry;
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

    /**
     * @param   int  $id
     * @return  void
     */
    public function validateEntry($id)
    {
        $statement = $this->dbConnector->prepare(
            'UPDATE entries SET validated=1 WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }

    /**
     * @param   int  $id
     * @return  void
     */
    public function deleteEntry($id)
    {
        $statement = $this->dbConnector->prepare(
            'UPDATE entries SET deleted=1 WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }
}