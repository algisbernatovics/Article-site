<?php

namespace App\Services\Comments;

use App\Repositories\CommentRepository;

class CommentService
{
    protected object $repository;
    protected object $commentRequest;

    public function __construct(CommentRequest $commentRequest)
    {
        $this->commentRequest = $commentRequest;
        $this->repository = new CommentRepository($commentRequest->getUri());
    }

    public function execute(): CommentResponse
    {
        return new CommentResponse($this->repository);
    }
}