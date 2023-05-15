<?php

namespace App\Core;

class Functions
{
    public static function replaceSlash(string $uri): string
    {
        return str_replace('/', '', $uri);
    }
}