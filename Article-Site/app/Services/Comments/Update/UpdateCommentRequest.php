<?php

namespace App\Services\Comments\Update;

use App\Core\Functions;

class UpdateCommentRequest
{
    protected int $commentId;
    protected string $title;
    protected string $body;

    public function __construct(string $commentIdUri,string $title,string $body)
    {
        $this->commentId = Functions::digitsOnly($commentIdUri);
        $this->title = $title;
        $this->body =$body;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
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