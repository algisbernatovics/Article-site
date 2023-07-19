<?php

namespace App\Services\Comments\Update;

use App\Repositories\Comment\CommentRepository;

class UpdateCommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(commentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute($request): bool
    {
        return ((new UpdateCommentResponse($this->commentRepository))
            ->getResponse())
            ->UpdateComment(
                $request->getCommentId(),
                $request->getTitle(),
                $request->getBody()
            );
    }
}