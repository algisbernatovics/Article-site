<?php

namespace App\Controllers;

use App\Core\Functions;
use App\Core\Renderer;
use App\Services\Comments\Delete\DeleteCommentRequest;
use App\Services\Comments\Delete\DeleteCommentService;
use App\Services\Comments\Insert\InsertCommentRequest;
use App\Services\Comments\Show\ShowCommentRequest;
use App\Services\Comments\Insert\InsertCommentService;
use App\Services\Comments\Show\ShowCommentService;
use App\Services\Comments\Update\UpdateCommentRequest;
use App\Services\Comments\Update\UpdateCommentService;

class CommentAddEditDeleteController
{
    protected object $commentService;
    protected object $insertCommentService;
    protected object $deleteCommentService;
    protected object $updateCommentService;

    public function __construct(
        ShowCommentService   $commentService,
        InsertCommentService $insertCommentService,
        DeleteCommentService $deleteCommentService,
        UpdateCommentService $updateCommentService
    )
    {
        $this->commentService = $commentService;
        $this->insertCommentService = $insertCommentService;
        $this->deleteCommentService = $deleteCommentService;
        $this->updateCommentService = $updateCommentService;
    }

    public function insertComment(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new InsertCommentRequest($_SESSION['user_id'], $_SERVER["REQUEST_URI"], $_POST['title'], $_POST['body']);
            $response = $this->insertCommentService->execute($request);
            if ($response) {
                Functions::Redirect('/');
            } else {
                (new ErrorController())->errorVoid();
            }
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function deleteComment(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new DeleteCommentRequest($_SERVER["REQUEST_URI"]);
            $response = $this->deleteCommentService->execute($request);
            if ($response) {
                Functions::Redirect('/');
            } else {
                (new ErrorController())->errorVoid();
            }
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function updateComment(): void
    {
        if (isset($_SESSION['user_id'])) {
            $request = new UpdateCommentRequest($_SERVER["REQUEST_URI"], $_POST['title'], $_POST['body']);
            $response = $this->updateCommentService->execute($request);
            if ($response) {
                Functions::Redirect('/');
            } else {
                (new ErrorController())->ErrorVoid();
            }
        } else
            (new ErrorController())->unauthorizedErrorVoid();
    }

    public function showEditCommentForm(): string
    {
        if (isset($_SESSION['user_id'])) {
            $request = new ShowCommentRequest(($_SERVER["REQUEST_URI"]));
            $commentResponse = $this->commentService->execute();
            return (new Renderer())->show(
                'CommentEditForm.twig',
                [
                    'comments' => $commentResponse->getResponse()->getCommentForUpdate($request->getUri())
                ]
            );

        } else
            return (new ErrorController())->unauthorizedError();
    }
}