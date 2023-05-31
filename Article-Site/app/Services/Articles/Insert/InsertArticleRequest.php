<?php

namespace App\Services\Articles\Insert;

use App\Core\Functions;

class InsertArticleRequest
{
    protected string $userId;
    protected string $title;
    protected string $body;

    public function __construct(int $userId,string $title,string $body)
    {
        $this->userId = $userId;
        $this->body = $body;
        $this->title = $title;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}