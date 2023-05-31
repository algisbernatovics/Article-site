<?php

namespace App\Services\Users\Show;

use App\Core\Functions;

class ShowUserRequest
{
    protected string $uri;

    public function __construct(string $uri)
    {
        $this->uri = Functions::digitsOnly($uri);
    }

    public function getUri(): string
    {
        return $this->uri;
    }
}