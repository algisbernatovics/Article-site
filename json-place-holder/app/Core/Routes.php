<?php

namespace App\Core;

use FastRoute;

class Routes
{
    protected object $dispatcher;

    public function __construct()
    {
        $this->dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

            $r->addRoute(['GET'], '/', '\App\Controllers\ArticleShowController@home');
            $r->addRoute(['GET'], '/allArticles', '\App\Controllers\ArticleShowController@allArticles');
            $r->addRoute(['GET'], '/posts[/{id}]', '\App\Controllers\ArticleShowController@singleArticle');

            $r->addRoute(['GET'], '/allUsers', '\App\Controllers\UserShowController@allUsers');
            $r->addRoute(['GET'], '/users[/{id}]', '\App\Controllers\UserShowController@singleUser');

            $r->addRoute(['GET'], '/deleteArticle[/{id}]', '\App\Controllers\ArticleAddEditDeleteController@deleteArticle');
            $r->addRoute(['GET'], '/addArticleForm', '\App\Controllers\ArticleAddEditDeleteController@showAddArticleForm');
            $r->addRoute(['GET'], '/addArticle', '\App\Controllers\ArticleAddEditDeleteController@addArticle');
            $r->addRoute(['GET'], '/editArticleForm[/{id}]', '\App\Controllers\ArticleAddEditDeleteController@showEditArticleForm');
            $r->addRoute(['GET'], '/updateArticle[/{id}]', '\App\Controllers\ArticleAddEditDeleteController@updateArticle');

            $r->addRoute(['GET'], '/registerForm', '\App\Controllers\UserAddEditDeleteController@showUserForm');
            $r->addRoute(['GET'], '/addUser', '\App\Controllers\UserAddEditDeleteController@addUser');

            $r->addRoute(['GET'], '/loginForm', '\App\Controllers\UserSessionController@showLoginForm');
            $r->addRoute(['GET'], '/login', '\App\Controllers\UserSessionController@login');
            $r->addRoute(['GET'], '/logout', '\App\Controllers\UserSessionController@logout');

            $r->addRoute(['GET'], '/addComment[/{id}]', '\App\Controllers\CommentAddDeleteController@addComment');

        });
    }

    public function getDispatcher(): object
    {
        return $this->dispatcher;
    }
}