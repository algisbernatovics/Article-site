<?php

namespace App\Core;

class Functions
{
    public static function replaceSlash(string $uri): string
    {
        return str_replace('/', '', $uri);
    }
    public static function defineRootDir(){
        define('ROOT_DIR', realpath(__DIR__.'/../..'));
    }
}