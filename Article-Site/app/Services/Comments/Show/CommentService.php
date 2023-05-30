<?php

namespace App\Services\Comments\Show;

use App\Repositories\Comment\CommentRepository;

class CommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute(): CommentResponse
    {
        return new CommentResponse($this->commentRepository);
    }
}