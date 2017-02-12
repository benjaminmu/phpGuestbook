<?php

abstract class ModelDbEntity
{
    protected $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new HelperDbConnector();
    }
}