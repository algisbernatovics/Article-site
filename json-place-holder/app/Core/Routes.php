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
            $r->addRoute(['GET'], '/allPosts', '\App\Controllers\ArticleShowController@allPosts');
            $r->addRoute(['GET'], '/posts[/{id}]', '\App\Controllers\ArticleShowController@singlePost');

            $r->addRoute(['GET'], '/allUsers', '\App\Controllers\UserShowController@allUsers');
            $r->addRoute(['GET'], '/users[/{id}]', '\App\Controllers\UserShowController@singleUser');

            $r->addRoute(['GET'], '/delete[/{id}]', '\App\Controllers\ArticleAddEditDeleteController@deleteArticle');
            $r->addRoute(['GET'], '/showForm', '\App\Controllers\ArticleAddEditDeleteController@showInputForm');
            $r->addRoute(['GET'], '/addArticle', '\App\Controllers\ArticleAddEditDeleteController@addArticle');

            $r->addRoute(['GET'], '/registerForm', '\App\Controllers\UserAddEditDeleteController@showUserAddEditForm');
            $r->addRoute(['GET'], '/addUser', '\App\Controllers\UserAddEditDeleteController@addUser');

            $r->addRoute(['GET'], '/loginForm', '\App\Controllers\UserSessionController@showLoginForm');
            $r->addRoute(['GET'], '/login', '\App\Controllers\UserSessionController@login');
        });
    }

    public function getDispatcher(): object
    {
        return $this->dispatcher;
    }
}