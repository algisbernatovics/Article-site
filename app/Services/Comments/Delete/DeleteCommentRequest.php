<?php

namespace App\Services\Comments\Delete;

use App\Core\Functions;

class DeleteCommentRequest
{
    protected int $commentId;

    public function __construct(string $commentIdUri)
    {
        $this->commentId = Functions::digitsOnly($commentIdUri);
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }
}