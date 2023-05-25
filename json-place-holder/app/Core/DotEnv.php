<?php

namespace App\Core;


class DotEnv
{
    protected array $_ENV;

    public function __construct()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(ROOT_DIR);
        $dotenv->load();
        $this->_ENV = $_ENV;
    }

    public function getENV(): array
    {
        return $this->_ENV;
    }
}