<?php

namespace App\Services\Comments\Show;

class CommentResponse
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