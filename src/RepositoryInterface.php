<?php

interface RepositoryInterface
{
    public function load($loadOption, $loadOptionValue, $tableName, $returnObjectType);
    public function save(ObjectInterface $object, $tableName);
    public function remove();
}