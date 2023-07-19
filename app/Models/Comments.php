<?php

namespace App\Models;

class Comments
{
    protected int $commentId;
    protected int $userId;
    protected string $title;
    protected string $body;
    protected string $userName;
    protected string $userUrl;

    public function __construct(int $commentId, int $userId, string $title, string $body, string $userName, string $userUrl)
    {
        $this->commentId = $commentId;
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
        $this->userName = $userName;
        $this->userUrl = $userUrl;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserUrl(): string
    {
        return $this->userUrl;
    }

    public function getUserId(): int
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