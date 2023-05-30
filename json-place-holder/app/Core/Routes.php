<?php

namespace App\Core;

use FastRoute;

class Routes
{
    protected object $dispatcher;

    public function __construct()
    {
        $this->dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

            $r->addRoute(['GET'], '/', '\App\Controllers\ArticlesController@home');
            $r->addRoute(['GET'], '/allPosts', '\App\Controllers\ArticlesController@allPosts');

            $r->addRoute(['GET'], '/allUsers', '\App\Controllers\UsersController@AllUsers');
            $r->addRoute(['GET'], '/users[/{id}]', '\App\Controllers\UsersController@user');
            $r->addRoute(['GET'], '/posts[/{id}]', '\App\Controllers\ArticlesController@post');

            $r->addRoute(['GET'], '/delete[/{id}]', '\App\Controllers\ActionsController@deleteArticle');
            $r->addRoute(['GET'], '/showForm', '\App\Controllers\ActionsController@showInputForm');
            $r->addRoute(['GET'], '/addArticle', '\App\Controllers\ActionsController@addArticle');
        });
    }

    public function getDispatcher(): object
    {
        return $this->dispatcher;
    }
}