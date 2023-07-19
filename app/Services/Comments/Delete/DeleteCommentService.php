<?php

namespace App\Services\Comments\Delete;

use App\Repositories\Comment\CommentRepository;

class DeleteCommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(commentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute($request):bool
    {
        return ((new DeleteCommentResponse($this->commentRepository))
            ->getResponse())
            ->deleteComment(
                $request->getCommentId()
            );
    }
}