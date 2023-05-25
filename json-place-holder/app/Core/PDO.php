<?php

namespace App\Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class PDO
{
    private $PDOconnection;

    public function __construct()
    {
        $_ENV = (new DotEnv())->getENV();

        $connectionParams = [
            'dbname' => $_ENV['DBNAME'],
            'user' => $_ENV['USER_'],
            'password' => $_ENV['PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER'],
        ];
        $this->PDOconnection = DriverManager::getConnection($connectionParams);
    }

    public function getPDOconnection(): Connection
    {
        return $this->PDOconnection;
    }

}