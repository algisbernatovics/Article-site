<?php

namespace App\Services\Comments\Insert;

class InsertCommentResponse
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