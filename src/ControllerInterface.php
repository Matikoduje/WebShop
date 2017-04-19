<?php

interface ControllerInterface
{
    public function save(RepositoryInterface $repository);
    public function load(RepositoryInterface $repository, $loadOptionValue, $password, $isSetSession);
    public function update(RepositoryInterface $repository, ObjectInterface $object);
}