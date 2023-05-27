<?php
//TODO The console does not notify if the record is not found.
namespace App\Console;

use App\Core\Container;
use App\Core\Functions;

require_once '../../vendor/autoload.php';

Functions::defineRootDir();
Functions::loadDotEnv();

$container = (new Container())->getContainer();
$container->get('\App\Controllers\UserShowController');

echo '1- All Users' . PHP_EOL;
echo '2- All Articles' . PHP_EOL;
echo '3- All Comments' . PHP_EOL;
echo '4- User By Id' . PHP_EOL;
echo '5- Article By Id' . PHP_EOL;
echo '6- Article Comments' . PHP_EOL;
echo '7- Exit Console' . PHP_EOL;


$i = readline('Your Choice:');

switch ($i) {
    case 1:
        ConsoleShowResponse::showUsers((
        new ConsoleMakeRequest($container->get('App\Services\Users\Show\UserService')))->allUsers());
        break;
    case 2:
        ConsoleShowResponse::showArticles((
        new ConsoleMakeRequest($container->get('App\Services\Articles\Show\ArticleService')))->allArticles());
        break;
    case 3:
        ConsoleShowResponse::showComments((
        new ConsoleMakeRequest($container->get('App\Services\Comments\Show\CommentService')))->allComments());
        break;
    case 4:
        $id = (int)readline('User Id:');
        ConsoleShowResponse::showUsers((
        new ConsoleMakeRequest($container->get('App\Services\Users\Show\UserService')))->userById($id));
        break;
    case 5:
        $id = (int)readline('Article Id:');
        ConsoleShowResponse::showArticles((
        new ConsoleMakeRequest($container->get('App\Services\Articles\Show\ArticleService')))->articlesById($id));
        break;
    case 6:
        $id = (int)readline('Article Id:');
        ConsoleShowResponse::showComments((
        new ConsoleMakeRequest($container->get('App\Services\Comments\Show\CommentService')))->postComments($id));
        break;
    case 7:
        echo 'Exit.' . PHP_EOL;
        exit;
    default:
        echo 'Something Wrong' . PHP_EOL;
        echo 'Exit.' . PHP_EOL;
        exit;
}
