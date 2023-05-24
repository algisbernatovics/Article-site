<?php

namespace App\Services\Comments;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\JsonPlaceHolderCommentRepository;

class CommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository=$commentRepository;
    }

    public function execute(): CommentResponse
    {
        return new CommentResponse($this->commentRepository);
    }
}