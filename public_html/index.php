<?php

require '../vendor/autoload.php';

session_start();

use App\Core\Router;

echo $response = Router::Router();

