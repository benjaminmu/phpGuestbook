<?php

abstract class ModelUser extends ModelDbEntity
{
    protected $dbTable = 'users';
    protected $id;
    protected $name;
    protected $token;

    public function loadByName($name)
    {
        $statement = $this->dbConnector->prepare('SELECT * FROM ' . $this->dbTable . ' WHERE name = :name');
        $statement->execute(array(
            'name' => $name,
        ));

        if ($row = $statement->fetch()) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->token = $row['token'];
        }

        return $this;
    }
}