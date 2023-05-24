<?php

namespace App\Services\Comments;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\JsonPlaceHolderCommentRepository;

class CommentService
{
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ae8e32e (First Commit)
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository=$commentRepository;
<<<<<<< HEAD
=======
    protected CommentRepository $repository;
    protected object $commentRequest;

    public function __construct(CommentRequest $commentRequest)
    {
        $this->commentRequest = $commentRequest;
        $this->repository = new JsonPlaceHolderCommentRepository($commentRequest->getUri());
>>>>>>> refs/remotes/origin/main
=======
>>>>>>> ae8e32e (First Commit)
    }

    public function execute(): CommentResponse
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return new CommentResponse($this->commentRepository);
=======
        return new CommentResponse($this->repository);
>>>>>>> refs/remotes/origin/main
=======
        return new CommentResponse($this->commentRepository);
>>>>>>> ae8e32e (First Commit)
    }
}