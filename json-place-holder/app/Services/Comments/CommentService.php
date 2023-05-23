<?php

namespace App\Services\Comments;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\JsonPlaceHolderCommentRepository;

class CommentService
{
    protected CommentRepository $repository;
    protected object $commentRequest;

    public function __construct(CommentRequest $commentRequest)
    {
        $this->commentRequest = $commentRequest;
        $this->repository = new JsonPlaceHolderCommentRepository($commentRequest->getUri());
    }

    public function execute(): CommentResponse
    {
        return new CommentResponse($this->repository);
    }
}