<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Services\Comments\Show\CommentRequest;
use App\Services\Comments\Show\CommentService;

class CommentAddDeleteController
{
    protected object $commentService;

    public function __construct(commentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function addComment(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new CommentRequest($_SERVER['REQUEST_URI']);
            $commentResponse = $this->commentService->execute();
            $commentResponse->getResponse()->insertComment($_POST, $_SESSION['user_id'], $request->getUri());
            Functions::Redirect('/');
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function deleteComment(): void
    {
        echo 'deletecomment';
    }
}