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

            $r->addRoute(['GET'], '/allUsers', '\App\Controllers\UsersController@allUsers');
            $r->addRoute(['GET'], '/users[/{id}]', '\App\Controllers\UsersController@singleUser');
            $r->addRoute(['GET'], '/posts[/{id}]', '\App\Controllers\ArticleShowController@singlePost');

            $r->addRoute(['GET'], '/delete[/{id}]', '\App\Controllers\ArticleAddEditDeleteController@deleteArticle');
            $r->addRoute(['GET'], '/showForm', '\App\Controllers\ArticleAddEditDeleteController@showInputForm');
            $r->addRoute(['GET'], '/addArticle', '\App\Controllers\ArticleAddEditDeleteController@addArticle');

            $r->addRoute(['GET'], '/register', '\App\Controllers\UserAddEditDeleteController@showInputForm');
            $r->addRoute(['GET'], '/addUser', '\App\Controllers\UserAddEditDeleteController@addUser');
        });
    }

    public function getDispatcher(): object
    {
        return $this->dispatcher;
    }
}