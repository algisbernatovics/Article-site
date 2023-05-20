<?php

namespace App\Services\Comments;

class CommentResponse
{
    protected object $commentRepository;

    public function __construct(object $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getComment(): array
    {
        return $this->commentRepository->getComments();
    }
}