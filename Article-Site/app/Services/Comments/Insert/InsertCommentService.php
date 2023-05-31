<?php

namespace App\Services\Comments\Insert;

use App\Repositories\Comment\CommentRepository;

class InsertCommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(commentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute($request):bool
    {
        return ((new InsertCommentResponse($this->commentRepository))
            ->getResponse())
            ->insertComment(
                $request->getUserId(),
                $request->getPostId(),
                $request->getTitle(),
                $request->getBody()
            );
    }
}