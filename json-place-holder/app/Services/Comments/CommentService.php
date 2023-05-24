<?php

namespace App\Services\Comments;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\JsonPlaceHolderCommentRepository;

class CommentService
{
<<<<<<< HEAD
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository=$commentRepository;
=======
    protected CommentRepository $repository;
    protected object $commentRequest;

    public function __construct(CommentRequest $commentRequest)
    {
        $this->commentRequest = $commentRequest;
        $this->repository = new JsonPlaceHolderCommentRepository($commentRequest->getUri());
>>>>>>> refs/remotes/origin/main
    }

    public function execute(): CommentResponse
    {
<<<<<<< HEAD
        return new CommentResponse($this->commentRepository);
=======
        return new CommentResponse($this->repository);
>>>>>>> refs/remotes/origin/main
    }
}