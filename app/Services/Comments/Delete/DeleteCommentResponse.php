<?php

namespace App\Services\Comments\Delete;

class DeleteCommentResponse
{
    protected object $commentRepository;

    public function __construct(object $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getResponse(): object
    {
        return $this->commentRepository;
    }
}