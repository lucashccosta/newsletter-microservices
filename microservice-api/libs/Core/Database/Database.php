<?php

namespace Libs\Core\Database;

use Libs\Core\Contracts\IDatabase;

abstract class Database implements IDatabase
{
    public $connection;

    public function instance() 
    {
        return $this;
    }
}