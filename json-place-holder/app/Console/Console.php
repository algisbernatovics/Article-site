<?php

namespace App\Console;

use App\Core\Functions;

require_once '../../vendor/autoload.php';

Functions::defineRootDir();

echo '1- All Users' . PHP_EOL;
echo '2- All Articles' . PHP_EOL;
echo '3- All Comments' . PHP_EOL;
echo '4- User By Id' . PHP_EOL;
echo '5- Article By Id' . PHP_EOL;
echo '6- Article Comments' . PHP_EOL;
echo '7- Exit Console' . PHP_EOL;

$i = (int)readline('Your Choice:');
switch ($i) {
    case 1:
        ConsoleShowResponse::showUsers((new ConsoleMakeRequest())->allUsers());
        break;
    case 2:
        ConsoleShowResponse::showPosts((new ConsoleMakeRequest())->allPosts());
        break;
    case 3:
        ConsoleShowResponse::showComments((new ConsoleMakeRequest())->allComments());
        break;
    case 4:
        $id = (int)readline('User Id:');
        ConsoleShowResponse::showUsers((new ConsoleMakeRequest())->userById($id));
        break;
    case 5:
        $id = (int)readline('Article Id:');
        ConsoleShowResponse::showPosts((new ConsoleMakeRequest())->postsById($id));
        break;
    case 6:
        $id = (int)readline('Article Id:');
        ConsoleShowResponse::showComments((new ConsoleMakeRequest())->postComments($id));
        break;
    case 7:
        echo 'Exit.' . PHP_EOL;
        exit;
    default:
        echo 'Something Wrong' . PHP_EOL;
        echo 'Exit.' . PHP_EOL;
        exit;
}
