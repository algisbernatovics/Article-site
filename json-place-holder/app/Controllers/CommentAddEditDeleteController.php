<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Articles\Show\ArticleRequest;
use App\Services\Comments\Show\CommentRequest;
use App\Services\Comments\Show\CommentService;

class CommentAddEditDeleteController
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
            Functions::Redirect('/posts/' . $request->getUri());
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function deleteComment(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new CommentRequest($_SERVER["REQUEST_URI"]);
            $commentResponse = $this->commentService->execute();
            $commentResponse->getResponse()->deleteComment($request->getUri());
            Functions::Redirect('/');
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function updateComment(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new ArticleRequest($_SERVER["REQUEST_URI"]);
            $commentResponse = $this->commentService->execute();
            $commentResponse->getResponse()->updateComment($_POST, $request->getUri());
            Functions::Redirect('/');
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function showEditCommentForm(): string
    {
        if (isset($_SESSION['user_id'])) {
            $request = new CommentRequest(($_SERVER["REQUEST_URI"]));
            $commentResponse = $this->commentService->execute();
            return (new Renderer())->showCommentEditForm(
                'CommentEditForm.twig',
                $commentResponse->getResponse()->getCommentForUpdate($request->getUri()));
        } else
            return (new ErrorController())->unauthorizedError();
    }
}