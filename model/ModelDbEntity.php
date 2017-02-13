<?php

/**
 * abstract base class for models representing database entities
 *
 * ModelDbEntity
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
abstract class ModelDbEntity
{
    protected $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new HelperDbConnector();
    }
}