<?php

interface ControllerInterface
{
    public function save(RepositoryInterface $repository);
    public function load(RepositoryInterface $repository, $loadOptionValue, $password);
    public function update(RepositoryInterface $repository, ObjectInterface $object);
}