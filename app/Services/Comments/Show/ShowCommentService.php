<?php

namespace App\Services\Comments\Show;

use App\Repositories\Comment\CommentRepository;

class ShowCommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute(): ShowCommentResponse
    {
        return new ShowCommentResponse($this->commentRepository);
    }
}