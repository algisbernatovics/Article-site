<?php

namespace App\Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DBALConnection
{
    protected $DBALConnection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DBNAME'],
            'user' => $_ENV['USER_'],
            'password' => $_ENV['PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER'],
        ];
        $this->DBALConnection = DriverManager::getConnection($connectionParams);
    }

    public function getDBALConnection(): Connection
    {
        return $this->DBALConnection;
    }

}