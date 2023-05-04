<?php

namespace core;

use lib\Database;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}