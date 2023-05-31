<?php

namespace App\Services\Comments\Insert;

use App\Core\Functions;

class InsertCommentRequest
{
    protected int $userId;
    protected int $postId;
    protected string $title;
    protected string $body;

    public function __construct(int $userId,string $postIdUri,string $title,string $body)
    {
        $this->userId = $userId;
        $this->postId = Functions::digitsOnly($postIdUri);
        $this->title = $title;
        $this->body =$body;
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
    public function getPostId():int
    {
        return $this->postId;
    }

}