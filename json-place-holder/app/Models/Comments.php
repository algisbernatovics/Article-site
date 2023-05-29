<?php

namespace App\Models;

class Comments
{
    protected int $postId;
    protected int $id;
    protected string $name;
    protected string $body;
    protected string $userName;
    protected string $userUrl;

    public function __construct($postId, int $id, string $name, string $body, string $userName, string $userUrl)
    {
        $this->postId = $postId;
        $this->id = $id;
        $this->name = $name;
        $this->body = $body;
        $this->userName = $userName;
        $this->userUrl = $userUrl;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserUrl(): string
    {
        return $this->userUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}