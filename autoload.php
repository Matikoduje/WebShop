<?php

function __autoload($class)
{
    include_once 'src/' . $class . '.php';
}