<?php

namespace App\Services\Comments;

class CommentResponse
{
    protected object $commentRepository;

    public function __construct(object $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

<<<<<<< HEAD
<<<<<<< HEAD
    public function getResponse(): object
    {
        return $this->commentRepository;
=======
    public function getComment(): array
    {
        return $this->commentRepository->getComments();
>>>>>>> refs/remotes/origin/main
=======
    public function getResponse(): object
    {
        return $this->commentRepository;
>>>>>>> ae8e32e (First Commit)
    }
}