<?php

namespace App\Models;

class Posts
{
    protected int $userId;
    protected int $id;
    protected string $title;
    protected string $body;

    protected string $userUrl;
    protected string $postUrl;

    public function __construct(int $userId, int $id, string $title, string $body, string $userUrl, string $postUrl)
    {
        $this->userId = $userId;
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->userUrl = $userUrl;
        $this->postUrl = $postUrl;
    }
    
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getUserUrl(): string
    {
        return $this->userUrl;
    }

    public function getPostUrl(): string
    {
        return $this->postUrl;
    }


}