<?php

namespace App\Core;

class Functions
{
    public static function replaceSlash(string $uri): string
    {
        return str_replace('/', '', $uri);
    }

    public static function defineRootDir()
    {
        define('ROOT_DIR', realpath(__DIR__ . '/../..'));
    }

    public static function digitsOnly(string $value): int
    {
        return (int)preg_replace('/[^0-9]/', "", $value, -1);
    }

}